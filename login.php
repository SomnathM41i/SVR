<?php
require_once('sys_dbconnection.php');

// Do not render a login form with authenticated navigation. This can also
// recover members who reached login?action=wrong through an old completion URL.
$authenticatedMatriID = $_SESSION['MatriID'] ?? ($_SESSION['matriid'] ?? '');
if ($authenticatedMatriID !== '') {
    $safeMatriID = mysqli_real_escape_string($con, $authenticatedMatriID);
    $memberResult = mysqli_query($con, "SELECT reg_step FROM register WHERE MatriID='$safeMatriID' LIMIT 1");
    $authenticatedMember = $memberResult ? mysqli_fetch_assoc($memberResult) : null;
    if (($authenticatedMember['reg_step'] ?? '') === '9') {
        $_SESSION['MatriID'] = $authenticatedMatriID;
        $_SESSION['matriid'] = $authenticatedMatriID;
        header('Location: pageloader1');
        exit;
    }
}

$page_title = 'Member Login - Manpasand Jodidar';
?>
<?php include('header3.php'); ?>

<main id="main">

  <style>
    .login-section {
      min-height:620px;
      padding:72px 0 90px;
      background:
        linear-gradient(90deg, rgba(255,249,240,.99) 0%, rgba(255,249,240,.96) 38%, rgba(255,249,240,.48) 58%, rgba(255,249,240,.06) 100%),
        url('template/assets/images/maratha-wedding-hero.jpg') 68% center / cover no-repeat;
    }
    .login-card { background:rgba(255,255,255,.96); border-radius:var(--radius,22px); border:1px solid rgba(109,23,38,.14); padding:40px 36px; max-width:480px; margin:0; box-shadow:0 24px 70px rgba(79,35,25,.16); backdrop-filter:blur(10px); }
    .login-card h2 { font-size:1.5rem; font-weight:700; color:var(--maroon,#6B1A1A); text-align:center; margin:0 0 4px; }
    .login-card .login-sub { text-align:center; color:var(--muted,#888); font-size:.9rem; margin-bottom:24px; }
    .login-field { margin-bottom:16px; }
    .login-field label { display:block; font-size:.85rem; font-weight:600; color:#555; margin-bottom:4px; }
    .login-field input { width:100%; padding:12px 14px; border:1.5px solid #e0dbd5; border-radius:10px; font-size:.92rem; color:#444; transition:border-color .2s,box-shadow .2s; }
    .login-field input:focus { border-color:var(--mvv-gold,#C9921A); box-shadow:0 0 0 3px rgba(201,146,26,0.12); outline:none; }
    .login-field .input-icon-wrap { position:relative; }
    .login-field .input-icon-wrap input { padding-left:40px; }
    .login-field .input-icon-wrap i { position:absolute; left:14px; top:50%; transform:translateY(-50%); color:#bbb; font-size:1rem; }
    .login-row { display:flex; flex-wrap:wrap; gap:8px; align-items:center; margin-bottom:16px; font-size:.85rem; }
    .login-row label { display:flex; align-items:center; gap:6px; color:#555; cursor:pointer; }
    .login-row a { color:var(--maroon,#6B1A1A); text-decoration:none; }
    .login-row a:hover { text-decoration:underline; }
    .login-btn { display:inline-block; padding:12px 32px; border-radius:10px; font-weight:600; font-size:.95rem; border:none; cursor:pointer; text-decoration:none; transition:.2s; width:100%; text-align:center; background:var(--maroon,#6B1A1A); color:#fff; }
    .login-btn:hover { background:#8B1A1A; box-shadow:0 4px 14px rgba(107,26,26,0.3); }
    .login-footer { text-align:center; margin-top:16px; font-size:.88rem; color:#666; }
    .login-footer a { color:var(--maroon,#6B1A1A); font-weight:600; text-decoration:none; }
    .login-footer a:hover { text-decoration:underline; }
    .login-error { text-align:center; color:#d32f2f; font-size:.88rem; margin-bottom:12px; }
    .login-success { text-align:center; color:#2e7d32; font-size:.88rem; margin-bottom:12px; }
    @media (max-width: 760px) {
      .login-section {
        min-height:auto;
        padding:46px 0 60px;
        background:
          linear-gradient(rgba(255,249,240,.9), rgba(255,249,240,.96)),
          url('template/assets/images/maratha-wedding-hero.jpg') 72% center / cover no-repeat;
      }
      .login-card { max-width:520px; margin:0 auto; padding:30px 24px; }
    }
  </style>

  <section class="section login-section">
    <div class="container">
      <div class="login-card">
        <h2>Login</h2>
        <p class="login-sub">Existing Member? Sign in below</p>

        <?php if(isset($_GET['action'])){ ?>
        <div class="login-error">You entered wrong username or password. Please try again.</div>
        <?php } ?>
        <?php if(isset($_GET['action1'])){ ?>
        <div class="login-success">Your password changed successfully. Please login.</div>
        <?php } ?>

        <form method="post" action="login_submit.php">
          <div class="login-field">
            <label>Email ID / Username / Mobile No.</label>
            <div class="input-icon-wrap">
              <i class="fas fa-user"></i>
              <input type="text" name="txtusername" placeholder="Enter your email or username" required value="<?php if(isset($_COOKIE["user_login"])) echo $_COOKIE["user_login"]; ?>">
            </div>
          </div>
          <div class="login-field">
            <label>Password</label>
            <div class="input-icon-wrap">
              <i class="fas fa-lock"></i>
              <input type="password" name="txtpassword" placeholder="Enter your password" maxlength="35" id="pass" required value="<?php if(isset($_COOKIE["userpassword"])) echo $_COOKIE["userpassword"]; ?>">
            </div>
          </div>

          <div class="login-row">
            <label>
              <input type="checkbox" checked>
              I accept <a href="terms-conditions" target="_blank">Terms of Service</a> &amp; <a href="privacy-policy" target="_blank">Privacy Policy</a>
            </label>
          </div>

          <div class="login-row">
            <label>
              <input type="checkbox" name="remember_me" value="1">
              Keep me signed in
            </label>
            <a href="forgot_password" style="margin-left:auto;">Trouble logging in?</a>
          </div>

          <button class="login-btn" type="submit" name="submit"><i class="fas fa-sign-in-alt" style="margin-right:8px;"></i> Log In</button>
        </form>

        <div class="login-footer">
          New here? <a href="signup">Create Account</a>
        </div>
      </div>
    </div>
  </section>
</main>

<?php include('footer3.php'); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
