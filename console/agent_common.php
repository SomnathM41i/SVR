<?php
if (!isset($con)) {
    require_once('../includes/bootstrap.php');
}
include_once('protect.php');
require_once(__DIR__ . '/../agent_commission_lib.php');

function agent_h($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

function agent_money($value) {
    return number_format((float)$value, 2);
}

function agent_ensure_schema($con) {
    $queries = array(
        "CREATE TABLE IF NOT EXISTS agents (
            agent_id INT AUTO_INCREMENT PRIMARY KEY,
            full_name VARCHAR(150) NOT NULL,
            mobile VARCHAR(30) NOT NULL,
            email VARCHAR(150) DEFAULT NULL,
            address TEXT,
            city VARCHAR(100) DEFAULT NULL,
            state VARCHAR(100) DEFAULT NULL,
            pincode VARCHAR(20) DEFAULT NULL,
            joining_date DATE DEFAULT NULL,
            status ENUM('Active','Inactive') NOT NULL DEFAULT 'Active',
            notes TEXT,
            account_holder_name VARCHAR(150) DEFAULT NULL,
            bank_name VARCHAR(150) DEFAULT NULL,
            account_number VARCHAR(80) DEFAULT NULL,
            ifsc_code VARCHAR(30) DEFAULT NULL,
            branch_name VARCHAR(150) DEFAULT NULL,
            upi_id VARCHAR(120) DEFAULT NULL,
            password_hash VARCHAR(255) DEFAULT NULL,
            created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME NULL DEFAULT NULL,
            INDEX idx_agents_status (status),
            INDEX idx_agents_mobile (mobile)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
        "CREATE TABLE IF NOT EXISTS agent_plan_assignments (
            assignment_id INT AUTO_INCREMENT PRIMARY KEY,
            agent_id INT NOT NULL,
            plan_id INT NOT NULL,
            commission_percentage DECIMAL(7,2) NOT NULL DEFAULT 0.00,
            status ENUM('Active','Inactive') NOT NULL DEFAULT 'Active',
            created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME NULL DEFAULT NULL,
            UNIQUE KEY uq_agent_plan (agent_id, plan_id),
            INDEX idx_agent_plan_agent (agent_id),
            INDEX idx_agent_plan_plan (plan_id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
        "CREATE TABLE IF NOT EXISTS agent_sales (
            sale_id INT AUTO_INCREMENT PRIMARY KEY,
            sale_reference VARCHAR(80) NOT NULL,
            customer_matri_id VARCHAR(80) DEFAULT NULL,
            customer_name VARCHAR(150) NOT NULL,
            customer_mobile VARCHAR(40) DEFAULT NULL,
            customer_email VARCHAR(150) DEFAULT NULL,
            agent_id INT NOT NULL,
            plan_id INT DEFAULT NULL,
            plan_name VARCHAR(150) NOT NULL,
            plan_amount DECIMAL(12,2) NOT NULL DEFAULT 0.00,
            payment_status ENUM('Pending','Clear','Failed','Refunded') NOT NULL DEFAULT 'Clear',
            sale_status ENUM('Pending','Confirmed','Cancelled') NOT NULL DEFAULT 'Confirmed',
            sale_date DATE NOT NULL,
            created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            UNIQUE KEY uq_agent_sale_reference (sale_reference),
            INDEX idx_agent_sales_agent (agent_id),
            INDEX idx_agent_sales_plan (plan_id),
            INDEX idx_agent_sales_date (sale_date)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
        "CREATE TABLE IF NOT EXISTS agent_commissions (
            commission_id INT AUTO_INCREMENT PRIMARY KEY,
            sale_id INT NOT NULL,
            agent_id INT NOT NULL,
            plan_id INT DEFAULT NULL,
            sale_date DATE NOT NULL,
            commission_percentage DECIMAL(7,2) NOT NULL DEFAULT 0.00,
            commission_amount DECIMAL(12,2) NOT NULL DEFAULT 0.00,
            commission_status ENUM('Pending','On Hold','Eligible','Withdrawal Requested','Approved','Paid','Rejected') NOT NULL DEFAULT 'On Hold',
            eligible_date DATE NOT NULL,
            payment_date DATE DEFAULT NULL,
            admin_remarks TEXT,
            created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME NULL DEFAULT NULL,
            UNIQUE KEY uq_agent_commission_sale (sale_id),
            INDEX idx_agent_comm_agent (agent_id),
            INDEX idx_agent_comm_status (commission_status),
            INDEX idx_agent_comm_eligible (eligible_date)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
        "CREATE TABLE IF NOT EXISTS agent_withdrawal_requests (
            withdrawal_id INT AUTO_INCREMENT PRIMARY KEY,
            agent_id INT NOT NULL,
            requested_amount DECIMAL(12,2) NOT NULL DEFAULT 0.00,
            available_balance DECIMAL(12,2) NOT NULL DEFAULT 0.00,
            request_date DATE NOT NULL,
            status ENUM('Pending','Approved','Rejected','Paid') NOT NULL DEFAULT 'Pending',
            admin_remarks TEXT,
            payment_date DATE DEFAULT NULL,
            created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME NULL DEFAULT NULL,
            INDEX idx_agent_with_agent (agent_id),
            INDEX idx_agent_with_status (status)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
        "CREATE TABLE IF NOT EXISTS agent_customers (
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
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4"
    );

    foreach ($queries as $query) {
        $con->query($query);
    }

    agent_add_column_if_missing($con, 'agents', 'password_hash', "ALTER TABLE agents ADD COLUMN password_hash VARCHAR(255) DEFAULT NULL AFTER upi_id");
    agent_add_column_if_missing($con, 'agent_customers', 'updated_at', "ALTER TABLE agent_customers ADD COLUMN updated_at DATETIME NULL DEFAULT NULL");
    agent_commission_ensure_schema($con);
}

function agent_add_column_if_missing($con, $table, $column, $alterSql) {
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

function agent_refresh_commissions($con) {
    $con->query("UPDATE agent_commissions SET commission_status='Eligible', updated_at=NOW() WHERE commission_status='On Hold' AND eligible_date <= CURDATE()");
}

function agent_plan_options($con) {
    $items = array();
    $result = $con->query("SELECT planid, plandisplayname, planamount FROM membershipplan ORDER BY planid ASC");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
    }
    return $items;
}

function agent_active_options($con) {
    $items = array();
    $result = $con->query("SELECT agent_id, full_name, mobile FROM agents WHERE status='Active' ORDER BY full_name ASC");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
    }
    return $items;
}

function agent_available_balance($con, $agentId) {
    $agentId = (int)$agentId;
    $eligible = 0;
    $reserved = 0;
    $result = $con->query("SELECT COALESCE(SUM(commission_amount),0) AS total FROM agent_commissions WHERE agent_id=$agentId AND commission_status='Eligible'");
    if ($result && ($row = $result->fetch_assoc())) {
        $eligible = (float)$row['total'];
    }
    $result = $con->query("SELECT COALESCE(SUM(requested_amount),0) AS total FROM agent_withdrawal_requests WHERE agent_id=$agentId AND status IN ('Pending','Approved')");
    if ($result && ($row = $result->fetch_assoc())) {
        $reserved = (float)$row['total'];
    }
    return max(0, $eligible - $reserved);
}

function agent_create_commission_for_sale($con, $saleReference, $matriId, $customerName, $customerMobile, $customerEmail, $agentId, $planName, $planAmount, $saleDate) {
    return agent_create_commission_for_sale_shared($con, $saleReference, $matriId, $customerName, $customerMobile, $customerEmail, $agentId, $planName, $planAmount, $saleDate, array(
        'commission_source' => 'Manual Customer Purchase',
        'payment_reference_id' => $saleReference,
        'auto_source_by_history' => true
    ));
}

function agent_admin_start($title) {
    global $con, $db;
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo agent_h($title); ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="../branding/favicons/favicon.ico" type="image/x-icon">
    <!-- MPJ: brand icons -->
    <link rel="apple-touch-icon" href="../branding/favicons/apple-touch-icon.png">
    <link rel="manifest" href="../branding/site.webmanifest">
    <meta name="theme-color" content="#5E1426">
    <link rel="stylesheet" href="assets/fonts/feather.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="assets/fonts/material.css">
    <link rel="stylesheet" href="assets/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/stylenew.css">
    <link rel="stylesheet" href="assets/css/layout-horizontal.css">
    <link rel="stylesheet" href="assets/css/customizer.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <style>
        :root {
            --gold: #C9A84C;
            --gold-light: #E8D5A3;
            --gold-dark: #9A7230;
            --crimson: #8B1A2F;
            --deep: #1A1025;
            --surface: #FDFAF5;
            --text-main: #2D1F3D;
            --text-muted: #7A6E82;
            --border: rgba(201,168,76,0.25);
            --shadow-card: 0 2px 20px rgba(45,31,61,0.08);
            --shadow-gold: 0 4px 24px rgba(201,168,76,0.15);
            --radius: 14px;
        }
        body {
            background: var(--surface);
        }
        .agent-page-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0 4px 14px;
        }
        .agent-title-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 14px 4px 8px;
            border-radius: 100px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.04em;
            background: rgba(139,26,47,0.1);
            color: var(--crimson);
        }
        .agent-stat-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 10px;
            margin-bottom: 10px;
        }
        @media(max-width:1100px){ .agent-stat-grid { grid-template-columns: repeat(3,1fr); } }
        @media(max-width:680px) { .agent-stat-grid { grid-template-columns: repeat(2,1fr); } }
        .agent-stat-card {
            background: #fff;
            border-radius: var(--radius);
            padding: 16px 14px 14px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow-card);
            text-decoration: none;
            display: block;
            position: relative;
            overflow: hidden;
            min-height: 112px;
        }
        .agent-stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            border-radius: var(--radius) var(--radius) 0 0;
            background: var(--accent, var(--gold));
        }
        .agent-stat-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-gold);
            border-color: var(--gold);
            text-decoration: none;
        }
        .agent-stat-card .sc-label {
            font-size: 10.5px;
            font-weight: 500;
            color: var(--text-muted);
            letter-spacing: 0.04em;
            text-transform: uppercase;
            margin-bottom: 8px;
        }
        .agent-stat-card .sc-value {
            font-family: Georgia, 'Times New Roman', serif;
            font-size: 32px;
            font-weight: 700;
            line-height: 1;
            color: var(--accent, var(--gold-dark));
        }
        .agent-stat-card .sc-icon {
            position: absolute;
            bottom: 10px;
            right: 12px;
            font-size: 22px;
            opacity: 0.12;
            color: var(--accent, var(--gold-dark));
        }
        .sc--total { --accent: #8B1A2F; }
        .sc--active { --accent: #3CB87A; }
        .sc--inactive { --accent: #4AABB8; }
        .sc--sales { --accent: #C9A84C; }
        .sc--today { --accent: #6C63FF; }
        .sc--hold { --accent: #E05C6A; }
        .sc--paid { --accent: #9A7230; }
        .sc--withdrawal { --accent: #2D1F3D; }
        .agent-table th, .agent-table td { vertical-align: middle; }
        .agent-actions .btn { margin: 2px; }

        header.pc-header {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            width: 100% !important;
            z-index: 1025 !important;
            height: 60px !important;
        }
        nav.topbar {
            position: fixed !important;
            top: 60px !important;
            left: 0 !important;
            right: 0 !important;
            width: 100% !important;
            z-index: 1024 !important;
            height: 48px !important;
        }
        .pc-mob-header {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            z-index: 1025 !important;
        }
        body.pc-horizontal .pc-container,
        body.pc-horizontal .pcoded-content {
            padding-top: 0 !important;
            margin-top: 0 !important;
        }
        body.pc-horizontal > .container {
            padding-top: 19px !important;
        }
        @media (max-width: 991px) {
            body.pc-horizontal > .container {
                padding-top: 70px !important;
            }
        }
    </style>
</head>
<body class="pc-horizontal">
<div class="loader-bg"><div class="loader-track"><div class="loader-fill"></div></div></div>
<?php include('topheader.php'); ?>
<?php include('header.php'); ?>
<?php include('notification.php'); ?>
<div class="container">
    <div class="pc-container">
        <div class="pcoded-content">
<?php
}

function agent_admin_end() {
    global $con, $db;
    ?>
        </div>
    </div>
</div>
<script src="assets/js/vendor-all.min.js"></script>
<script src="assets/js/plugins/bootstrap.min.js"></script>
<script src="assets/js/plugins/feather.min.js"></script>
<script src="assets/js/pcoded.min.js"></script>
<?php include('footer.php'); ?>
</body>
</html>
<?php
}

agent_ensure_schema($con);
agent_refresh_commissions($con);
?>
