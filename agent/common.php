<?php
require_once(__DIR__ . '/../sys_dbconnection.php');
require_once(__DIR__ . '/../agent_commission_lib.php');

if (!isset($_SESSION)) {
    session_start();
}

function ap_h($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

function ap_money($value) {
    return number_format((float)$value, 2);
}

function ap_add_column_if_missing($con, $table, $column, $alterSql) {
    $stmt = $con->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME=? AND COLUMN_NAME=?");
    if (!$stmt) {
        return;
    }
    $stmt->bind_param("ss", $table, $column);
    $stmt->execute();
    $exists = $stmt->get_result()->num_rows > 0;
    $stmt->close();
    if (!$exists) {
        $con->query($alterSql);
    }
}

function ap_ensure_schema($con) {
    $con->query("CREATE TABLE IF NOT EXISTS agent_customers (
        customer_id INT AUTO_INCREMENT PRIMARY KEY,
        agent_id INT NOT NULL,
        customer_name VARCHAR(150) NOT NULL,
        customer_mobile VARCHAR(40) NOT NULL,
        customer_email VARCHAR(150) DEFAULT NULL,
        plan_id INT DEFAULT NULL,
        plan_name VARCHAR(150) DEFAULT NULL,
        customer_status ENUM('Interested','Follow Up','Purchased','Not Interested') NOT NULL DEFAULT 'Interested',
        notes TEXT,
        created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME NULL DEFAULT NULL,
        INDEX idx_agent_customer_agent (agent_id),
        INDEX idx_agent_customer_plan (plan_id),
        INDEX idx_agent_customer_mobile (customer_mobile)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    ap_add_column_if_missing($con, 'agents', 'password_hash', "ALTER TABLE agents ADD COLUMN password_hash VARCHAR(255) DEFAULT NULL AFTER upi_id");
    agent_commission_ensure_schema($con);
}

function ap_refresh_commissions($con) {
    $con->query("UPDATE agent_commissions SET commission_status='Eligible', updated_at=NOW() WHERE commission_status='On Hold' AND eligible_date <= CURDATE()");
}

function ap_require_login() {
    if (empty($_SESSION['agent_id'])) {
        header('Location: login');
        exit;
    }
}

function ap_agent_id() {
    return (int)($_SESSION['agent_id'] ?? 0);
}

function ap_agent($con) {
    $agentId = ap_agent_id();
    $stmt = $con->prepare("SELECT * FROM agents WHERE agent_id=? LIMIT 1");
    $stmt->bind_param("i", $agentId);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function ap_assigned_plans($con, $agentId) {
    $plans = array();
    $stmt = $con->prepare("SELECT mp.planid, mp.plandisplayname, mp.planamount, apa.commission_percentage
        FROM agent_plan_assignments apa
        INNER JOIN membershipplan mp ON mp.planid=apa.plan_id
        WHERE apa.agent_id=? AND apa.status='Active'
        ORDER BY mp.plandisplayname");
    $stmt->bind_param("i", $agentId);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $plans[] = $row;
    }
    return $plans;
}

function ap_available_balance($con, $agentId) {
    $eligible = 0;
    $reserved = 0;
    $stmt = $con->prepare("SELECT COALESCE(SUM(commission_amount),0) AS total FROM agent_commissions WHERE agent_id=? AND commission_status='Eligible'");
    $stmt->bind_param("i", $agentId);
    $stmt->execute();
    if ($row = $stmt->get_result()->fetch_assoc()) {
        $eligible = (float)$row['total'];
    }
    $stmt = $con->prepare("SELECT COALESCE(SUM(requested_amount),0) AS total FROM agent_withdrawal_requests WHERE agent_id=? AND status IN ('Pending','Approved')");
    $stmt->bind_param("i", $agentId);
    $stmt->execute();
    if ($row = $stmt->get_result()->fetch_assoc()) {
        $reserved = (float)$row['total'];
    }
    return max(0, $eligible - $reserved);
}

function ap_scalar($con, $sql, $agentId) {
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $agentId);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_row();
    return $row ? $row[0] : 0;
}

function ap_commission_availability($con, $agentId) {
    $agentId = (int)$agentId;
    $info = array(
        'on_hold_total' => 0,
        'next_amount' => 0,
        'next_date' => '',
        'days_left' => 0,
        'message' => ''
    );

    $stmt = $con->prepare("SELECT COALESCE(SUM(commission_amount),0) AS total FROM agent_commissions WHERE agent_id=? AND commission_status='On Hold'");
    $stmt->bind_param("i", $agentId);
    $stmt->execute();
    if ($row = $stmt->get_result()->fetch_assoc()) {
        $info['on_hold_total'] = (float)$row['total'];
    }
    $stmt->close();

    $stmt = $con->prepare("SELECT eligible_date, COALESCE(SUM(commission_amount),0) AS amount
        FROM agent_commissions
        WHERE agent_id=? AND commission_status='On Hold'
        GROUP BY eligible_date
        ORDER BY eligible_date ASC
        LIMIT 1");
    $stmt->bind_param("i", $agentId);
    $stmt->execute();
    if ($row = $stmt->get_result()->fetch_assoc()) {
        $info['next_date'] = $row['eligible_date'];
        $info['next_amount'] = (float)$row['amount'];
        $today = new DateTime(date('Y-m-d'));
        $eligible = new DateTime($info['next_date']);
        $info['days_left'] = max(0, (int)$today->diff($eligible)->format('%r%a'));
    }
    $stmt->close();

    if ($info['next_date'] !== '') {
        $formattedDate = date('d M Y', strtotime($info['next_date']));
        if ($info['days_left'] > 0) {
            $dayText = $info['days_left'] === 1 ? '1 day' : $info['days_left'] . ' days';
            $info['message'] = 'Your next commission of ' . ap_money($info['next_amount']) . ' will be available on ' . $formattedDate . ' after ' . $dayText . '.';
        } else {
            $info['message'] = 'Your commission of ' . ap_money($info['next_amount']) . ' is eligible now and will show in Available Balance after refresh.';
        }
    } elseif (ap_available_balance($con, $agentId) > 0) {
        $info['message'] = 'Your eligible commission is available for withdrawal now.';
    } else {
        $info['message'] = 'No commission is available yet. Commission becomes available after the hold period ends.';
    }

    return $info;
}

function ap_start($title) {
    global $con;
    $agent = ap_agent($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo ap_h($title); ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../branding/favicons/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../console/assets/fonts/feather.css">
    <link rel="stylesheet" href="../console/assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="../console/assets/css/style.css">
    <style>
        html, body { min-height:100%; }
        body { background:#FDFAF5; color:#2D1F3D; display:flex; flex-direction:column; }
        .ap-shell { width:100%; max-width:1180px; margin:0 auto; padding:24px 18px 48px; flex:1 0 auto; }
        .ap-top { background:#1c232f; color:#fff; }
        .ap-top-inner { max-width:1180px; margin:0 auto; padding:14px 18px; display:flex; align-items:center; justify-content:space-between; gap:16px; }
        .ap-brand { display:flex; align-items:center; gap:12px; font-weight:700; }
        .ap-brand img { width:48px; height:48px; border-radius:50%; background:#fff; }
        .ap-nav { background:#fff; border-bottom:1px solid rgba(201,168,76,0.25); box-shadow:0 2px 16px rgba(45,31,61,0.06); }
        .ap-nav-inner { max-width:1180px; margin:0 auto; padding:10px 18px; display:flex; gap:10px; flex-wrap:wrap; }
        .ap-nav a { color:#2D1F3D; padding:8px 12px; border-radius:8px; text-decoration:none; font-weight:600; font-size:13px; }
        .ap-nav a:hover, .ap-nav a.active { background:#F5EAE9; color:#8B1A2F; }
        .ap-title { margin:0 0 18px; font-size:22px; font-weight:700; }
        .ap-grid { display:grid; grid-template-columns:repeat(4,minmax(0,1fr)); gap:14px; margin-bottom:18px; }
        @media(max-width:992px){ .ap-grid { grid-template-columns:repeat(2,minmax(0,1fr)); } }
        @media(max-width:560px){ .ap-grid { grid-template-columns:1fr; } .ap-top-inner { align-items:flex-start; flex-direction:column; } }
        .ap-card { background:#fff; border:1px solid rgba(201,168,76,0.25); border-radius:14px; box-shadow:0 2px 20px rgba(45,31,61,0.08); padding:18px; }
        .ap-stat-label { color:#7A6E82; font-size:12px; text-transform:uppercase; letter-spacing:.04em; margin-bottom:8px; }
        .ap-stat-value { color:#8B1A2F; font-size:30px; font-family:Georgia,'Times New Roman',serif; font-weight:700; line-height:1; }
        .ap-footer { flex-shrink:0; background:#1c232f; color:#b5bdca; border-top:1px solid rgba(201,168,76,0.28); margin-top:auto; }
        .ap-footer-inner { max-width:1180px; margin:0 auto; padding:16px 18px; display:flex; align-items:center; justify-content:space-between; gap:12px; font-size:13px; }
        .ap-footer a { color:#e6d08a; text-decoration:none; }
        .ap-footer a:hover { color:#fff; }
        .ap-footer-links { display:flex; align-items:center; gap:14px; flex-wrap:wrap; }
        @media(max-width:560px){ .ap-footer-inner { align-items:flex-start; flex-direction:column; } }
        .table th, .table td { vertical-align:middle; }
    </style>
</head>
<body>
<div class="ap-top">
    <div class="ap-top-inner">
        <div class="ap-brand"><img src="../branding/logos/emblem.png" alt=""> <span>Agent Panel</span></div>
        <div><?php echo ap_h($agent['full_name'] ?? 'Agent'); ?></div>
    </div>
</div>
<div class="ap-nav">
    <div class="ap-nav-inner">
        <a href="dashboard">Dashboard</a>
        <a href="add_customer">Add Customer</a>
        <a href="my_customers">My Customers</a>
        <a href="my_commission">My Commission</a>
        <a href="withdrawal_request">Withdrawal Request</a>
        <a href="profile">Profile</a>
        <a href="logout">Logout</a>
    </div>
</div>
<main class="ap-shell">
    <h1 class="ap-title"><?php echo ap_h($title); ?></h1>
<?php
}

function ap_end() {
    global $con;
    $footerText = 'Manpasand Jodidar';
    $result = $con->query("SELECT copyright_footer FROM siteconfig WHERE ID='1' LIMIT 1");
    if ($result && ($row = $result->fetch_assoc()) && trim((string)$row['copyright_footer']) !== '') {
        $footerText = $row['copyright_footer'];
    }
?>
</main>
<footer class="ap-footer">
    <div class="ap-footer-inner">
        <div>&copy; <?php echo date('Y'); ?> <?php echo ap_h($footerText); ?>. All Rights Reserved.</div>
        <div class="ap-footer-links">
            <a href="dashboard">Dashboard</a>
            <a href="my_commission">My Commission</a>
            <a href="withdrawal_request">Withdrawal</a>
        </div>
    </div>
</footer>
<script src="../console/assets/js/vendor-all.min.js"></script>
<script src="../console/assets/js/plugins/bootstrap.min.js"></script>
<script src="../console/assets/js/plugins/feather.min.js"></script>
</body>
</html>
<?php
}

ap_ensure_schema($con);
ap_refresh_commissions($con);
?>
