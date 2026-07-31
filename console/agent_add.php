<?php
require_once(dirname(__FILE__).'/protect.php');
require_once('agent_common.php');
$errors = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = trim($_POST['full_name'] ?? '');
    $mobile = trim($_POST['mobile'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $state = trim($_POST['state'] ?? '');
    $pincode = trim($_POST['pincode'] ?? '');
    $joiningDate = trim($_POST['joining_date'] ?? date('Y-m-d'));
    $status = ($_POST['status'] ?? 'Active') === 'Inactive' ? 'Inactive' : 'Active';
    $notes = trim($_POST['notes'] ?? '');
    $accountHolder = trim($_POST['account_holder_name'] ?? '');
    $bankName = trim($_POST['bank_name'] ?? '');
    $accountNumber = trim($_POST['account_number'] ?? '');
    $ifsc = trim($_POST['ifsc_code'] ?? '');
    $branch = trim($_POST['branch_name'] ?? '');
    $upi = trim($_POST['upi_id'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($fullName === '') { $errors[] = 'Full Name is required.'; }
    if ($mobile === '') { $errors[] = 'Mobile Number is required.'; }
    if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) { $errors[] = 'Email Address is invalid.'; }
    if ($password === '' || strlen($password) < 6) { $errors[] = 'Login Password must be at least 6 characters.'; }

    if (!$errors) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $con->prepare("INSERT INTO agents (full_name, mobile, email, address, city, state, pincode, joining_date, status, notes, account_holder_name, bank_name, account_number, ifsc_code, branch_name, upi_id, password_hash) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssssssssssss", $fullName, $mobile, $email, $address, $city, $state, $pincode, $joiningDate, $status, $notes, $accountHolder, $bankName, $accountNumber, $ifsc, $branch, $upi, $passwordHash);
        $stmt->execute();
        $stmt->close();
        header('Location: agents?msg=added');
        exit;
    }
}

agent_admin_start('Add Agent');
?>
<div class="row"><div class="col-sm-12"><div class="card"><div class="card-body">
<?php if ($errors) { ?><div class="alert alert-danger"><?php echo agent_h(implode(' ', $errors)); ?></div><?php } ?>
<form method="post">
    <h5>Personal Details</h5>
    <div class="row">
        <div class="col-md-6 form-group"><label>Full Name *</label><input class="form-control" name="full_name" required></div>
        <div class="col-md-6 form-group"><label>Mobile Number *</label><input class="form-control" name="mobile" required></div>
        <div class="col-md-6 form-group"><label>Email Address</label><input class="form-control" name="email" type="email"></div>
        <div class="col-md-6 form-group"><label>Login Password *</label><input class="form-control" name="password" type="password" minlength="6" required></div>
        <div class="col-md-6 form-group"><label>Joining Date</label><input class="form-control" name="joining_date" type="date" value="<?php echo date('Y-m-d'); ?>"></div>
        <div class="col-md-12 form-group"><label>Address</label><textarea class="form-control" name="address"></textarea></div>
        <div class="col-md-4 form-group"><label>City</label><input class="form-control" name="city"></div>
        <div class="col-md-4 form-group"><label>State</label><input class="form-control" name="state"></div>
        <div class="col-md-4 form-group"><label>Pincode</label><input class="form-control" name="pincode"></div>
        <div class="col-md-4 form-group"><label>Status</label><select class="form-control" name="status"><option>Active</option><option>Inactive</option></select></div>
        <div class="col-md-12 form-group"><label>Notes</label><textarea class="form-control" name="notes"></textarea></div>
    </div>
    <h5 class="mt-3">Bank Details</h5>
    <div class="row">
        <div class="col-md-6 form-group"><label>Account Holder Name</label><input class="form-control" name="account_holder_name"></div>
        <div class="col-md-6 form-group"><label>Bank Name</label><input class="form-control" name="bank_name"></div>
        <div class="col-md-6 form-group"><label>Account Number</label><input class="form-control" name="account_number"></div>
        <div class="col-md-6 form-group"><label>IFSC Code</label><input class="form-control" name="ifsc_code"></div>
        <div class="col-md-6 form-group"><label>Branch Name</label><input class="form-control" name="branch_name"></div>
        <div class="col-md-6 form-group"><label>UPI ID</label><input class="form-control" name="upi_id"></div>
    </div>
    <button class="btn btn-primary">Save Agent</button>
    <a href="agents" class="btn btn-light">Cancel</a>
</form>
</div></div></div></div>
<?php agent_admin_end(); ?>
