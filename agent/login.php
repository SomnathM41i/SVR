<?php
require_once('common.php');

if (!empty($_SESSION['agent_id'])) {
    header('Location: dashboard');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $stmt = $con->prepare("SELECT agent_id, full_name, password_hash, status FROM agents WHERE (email=? OR mobile=?) LIMIT 1");
    $stmt->bind_param("ss", $login, $login);
    $stmt->execute();
    $agent = $stmt->get_result()->fetch_assoc();

    if ($agent && $agent['status'] === 'Active' && !empty($agent['password_hash']) && password_verify($password, $agent['password_hash'])) {
        $_SESSION['agent_id'] = (int)$agent['agent_id'];
        $_SESSION['agent_name'] = $agent['full_name'];
        header('Location: dashboard');
        exit;
    }
    $error = 'Invalid login details or inactive agent account.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Agent Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../console/assets/css/style.css">
    <style>
        html, body { min-height:100%; margin:0; }
        body { background:url('../images/main-slider/2.jpg') no-repeat center center fixed; background-size:cover; }
        body::before { content:''; position:fixed; inset:0; background:rgba(0,0,0,.45); }
        .login-wrap { position:relative; z-index:1; min-height:100vh; display:flex; justify-content:flex-end; align-items:center; padding:24px 8%; }
        .login-card { width:min(440px,100%); background:#fff; border-radius:14px; padding:34px; box-shadow:0 18px 60px rgba(0,0,0,.25); }
        .login-card img { width:90px; height:90px; border-radius:50%; display:block; margin:0 auto 14px; }
        .btn-primary { background:linear-gradient(135deg,#8B1A2F,#C9A84C); border:0; }
    </style>
</head>
<body>
<div class="login-wrap">
    <form class="login-card" method="post">
        <img src="http://localhost/SVR/css3/assets/shivraj-logo.png" alt="">
        <h4 class="text-center mb-2">Agent Login</h4>
        <p class="text-muted text-center">Login with email or mobile number</p>
        <?php if ($error) { ?><div class="alert alert-danger"><?php echo ap_h($error); ?></div><?php } ?>
        <div class="form-group">
            <label>Email or Mobile</label>
            <input type="text" name="login" class="form-control" required autofocus>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-primary w-100">Login</button>
    </form>
</div>
</body>
</html>
