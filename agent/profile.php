<?php
require_once('common.php');
ap_require_login();
$agentId = ap_agent_id();
$agent = ap_agent($con);
$message = '';
$errors = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $state = trim($_POST['state'] ?? '');
    $pincode = trim($_POST['pincode'] ?? '');
    $accountHolder = trim($_POST['account_holder_name'] ?? '');
    $bankName = trim($_POST['bank_name'] ?? '');
    $accountNumber = trim($_POST['account_number'] ?? '');
    $ifsc = trim($_POST['ifsc_code'] ?? '');
    $branch = trim($_POST['branch_name'] ?? '');
    $upi = trim($_POST['upi_id'] ?? '');
    $password = trim($_POST['password'] ?? '');
    if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) { $errors[] = 'Email is invalid.'; }
    if ($password !== '' && strlen($password) < 6) { $errors[] = 'Password must be at least 6 characters.'; }
    if (!$errors) {
        if ($password !== '') {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $con->prepare("UPDATE agents SET email=?, address=?, city=?, state=?, pincode=?, account_holder_name=?, bank_name=?, account_number=?, ifsc_code=?, branch_name=?, upi_id=?, password_hash=?, updated_at=NOW() WHERE agent_id=?");
            $stmt->bind_param("ssssssssssssi", $email, $address, $city, $state, $pincode, $accountHolder, $bankName, $accountNumber, $ifsc, $branch, $upi, $hash, $agentId);
        } else {
            $stmt = $con->prepare("UPDATE agents SET email=?, address=?, city=?, state=?, pincode=?, account_holder_name=?, bank_name=?, account_number=?, ifsc_code=?, branch_name=?, upi_id=?, updated_at=NOW() WHERE agent_id=?");
            $stmt->bind_param("sssssssssssi", $email, $address, $city, $state, $pincode, $accountHolder, $bankName, $accountNumber, $ifsc, $branch, $upi, $agentId);
        }
        $stmt->execute();
        $stmt->close();
        $agent = ap_agent($con);
        $message = 'Profile updated.';
    }
}

ap_start('Agent Profile');
?>
<div class="ap-card">
<?php if ($message) { ?><div class="alert alert-success"><?php echo ap_h($message); ?></div><?php } ?>
<?php if ($errors) { ?><div class="alert alert-danger"><?php echo ap_h(implode(' ', $errors)); ?></div><?php } ?>
<form method="post">
    <h5>Basic Details</h5>
    <div class="row">
        <div class="col-md-6 form-group"><label>Name</label><input class="form-control" value="<?php echo ap_h($agent['full_name']); ?>" readonly></div>
        <div class="col-md-6 form-group"><label>Mobile</label><input class="form-control" value="<?php echo ap_h($agent['mobile']); ?>" readonly></div>
        <div class="col-md-6 form-group"><label>Email</label><input class="form-control" name="email" type="email" value="<?php echo ap_h($agent['email']); ?>"></div>
        <div class="col-md-6 form-group"><label>New Password</label><input class="form-control" name="password" type="password" minlength="6" placeholder="Leave blank to keep current password"></div>
        <div class="col-md-12 form-group"><label>Address</label><textarea class="form-control" name="address"><?php echo ap_h($agent['address']); ?></textarea></div>
        <div class="col-md-4 form-group"><label>City</label><input class="form-control" name="city" value="<?php echo ap_h($agent['city']); ?>"></div>
        <div class="col-md-4 form-group"><label>State</label><input class="form-control" name="state" value="<?php echo ap_h($agent['state']); ?>"></div>
        <div class="col-md-4 form-group"><label>Pincode</label><input class="form-control" name="pincode" value="<?php echo ap_h($agent['pincode']); ?>"></div>
    </div>
    <h5 class="mt-3">Bank / UPI Details</h5>
    <div class="row">
        <div class="col-md-6 form-group"><label>Account Holder Name</label><input class="form-control" name="account_holder_name" value="<?php echo ap_h($agent['account_holder_name']); ?>"></div>
        <div class="col-md-6 form-group"><label>Bank Name</label><input class="form-control" name="bank_name" value="<?php echo ap_h($agent['bank_name']); ?>"></div>
        <div class="col-md-6 form-group"><label>Account Number</label><input class="form-control" name="account_number" value="<?php echo ap_h($agent['account_number']); ?>"></div>
        <div class="col-md-6 form-group"><label>IFSC Code</label><input class="form-control" name="ifsc_code" value="<?php echo ap_h($agent['ifsc_code']); ?>"></div>
        <div class="col-md-6 form-group"><label>Branch Name</label><input class="form-control" name="branch_name" value="<?php echo ap_h($agent['branch_name']); ?>"></div>
        <div class="col-md-6 form-group"><label>UPI ID</label><input class="form-control" name="upi_id" value="<?php echo ap_h($agent['upi_id']); ?>"></div>
    </div>
    <button class="btn btn-primary">Update Profile</button>
</form>
</div>
<?php ap_end(); ?>
