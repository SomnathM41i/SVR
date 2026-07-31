<?php
require_once'../includes/bootstrap.php';
include 'protect.php';

mysqli_set_charset($con, 'utf8mb4');

$message = '';
$selectedCountry = trim((string)($_REQUEST['country'] ?? 'India'));
$selectedState = trim((string)($_REQUEST['state'] ?? 'Maharashtra'));
$selectedDistrict = trim((string)($_REQUEST['district'] ?? ''));

if (isset($_POST['save_taluka'])) {
    $taluka = trim((string)($_POST['taluka'] ?? ''));

    if ($selectedDistrict === '' || $taluka === '') {
        $message = 'District and Taluka are required.';
    } else {
        $statement = mysqli_prepare(
            $con,
            "INSERT INTO e_taluka (taluka, dist_ref, state_ref, status)
             VALUES (?, ?, ?, 'enable')
             ON DUPLICATE KEY UPDATE status = 'enable'"
        );
        mysqli_stmt_bind_param(
            $statement,
            'sss',
            $taluka,
            $selectedDistrict,
            $selectedState
        );
        mysqli_stmt_execute($statement);
        mysqli_stmt_close($statement);
        $message = 'Taluka saved successfully.';
    }
}

if (isset($_POST['update_taluka'])) {
    $talukaId = (int)($_POST['taluka_id'] ?? 0);
    $taluka = trim((string)($_POST['taluka'] ?? ''));

    if ($talukaId > 0 && $taluka !== '') {
        $statement = mysqli_prepare(
            $con,
            "UPDATE e_taluka
             SET taluka = ?, dist_ref = ?, state_ref = ?
             WHERE id = ?"
        );
        mysqli_stmt_bind_param(
            $statement,
            'sssi',
            $taluka,
            $selectedDistrict,
            $selectedState,
            $talukaId
        );
        mysqli_stmt_execute($statement);
        mysqli_stmt_close($statement);
        $message = 'Taluka updated successfully.';
    }
}

if (isset($_GET['toggle'])) {
    $talukaId = (int)$_GET['toggle'];
    $statement = mysqli_prepare(
        $con,
        "UPDATE e_taluka
         SET status = IF(status = 'enable', 'disable', 'enable')
         WHERE id = ?"
    );
    mysqli_stmt_bind_param($statement, 'i', $talukaId);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);
    $message = 'Taluka status updated.';
}

$countryResult = mysqli_query(
    $con,
    "SELECT country
     FROM e_country
     WHERE status = 'enable'
     ORDER BY country"
);
$stateStatement = mysqli_prepare(
    $con,
    "SELECT state
     FROM e_state
     WHERE cid = ?
       AND status = 'enable'
     ORDER BY state"
);
mysqli_stmt_bind_param($stateStatement, 's', $selectedCountry);
mysqli_stmt_execute($stateStatement);
$stateResult = mysqli_stmt_get_result($stateStatement);
$districtStatement = mysqli_prepare(
    $con,
    "SELECT dist
     FROM e_dist
     WHERE LOWER(TRIM(sid2)) = LOWER(TRIM(?))
       AND status = 'enable'
     ORDER BY dist"
);
mysqli_stmt_bind_param($districtStatement, 's', $selectedState);
mysqli_stmt_execute($districtStatement);
$districtResult = mysqli_stmt_get_result($districtStatement);
$talukaRows = [];

if ($selectedDistrict !== '') {
    $talukaStatement = mysqli_prepare(
        $con,
        "SELECT id, taluka, status
         FROM e_taluka
         WHERE dist_ref = ?
         ORDER BY taluka"
    );
    mysqli_stmt_bind_param($talukaStatement, 's', $selectedDistrict);
    mysqli_stmt_execute($talukaStatement);
    $talukaResult = mysqli_stmt_get_result($talukaStatement);

    while ($row = mysqli_fetch_assoc($talukaResult)) {
        $talukaRows[] = $row;
    }

    mysqli_stmt_close($talukaStatement);
}

function talukaAdminEscape($value): string
{
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Taluka</title>
    <link rel="shortcut icon" href="../branding/favicons/favicon.ico" type="image/x-icon">
    <!-- MPJ: brand icons -->
    <link rel="apple-touch-icon" href="../branding/favicons/apple-touch-icon.png">
    <link rel="manifest" href="../branding/site.webmanifest">
    <meta name="theme-color" content="#5E1426">
    <link rel="stylesheet" href="assets/fonts/feather.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="assets/fonts/material.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/mpj-brand.css">
    <link rel="stylesheet" href="assets/css/layout-horizontal.css">
    <link rel="stylesheet" href="assets/css/customizer.css">
</head>
<body class="pc-horizontal">
<?php include 'topheader.php'; ?>
<?php include 'header.php'; ?>

<div class="pc-container">
    <div class="pcoded-content">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h3 class="mb-1">Manage Taluka</h3>
                                <p class="text-muted mb-0">
                                    Country → State → District → Taluka → City
                                </p>
                            </div>
                            <span class="badge bg-primary">
                                <?php echo count($talukaRows); ?> Talukas
                            </span>
                        </div>

                        <?php if ($message !== '') { ?>
                            <div class="alert alert-info">
                                <?php echo talukaAdminEscape($message); ?>
                            </div>
                        <?php } ?>

                        <form method="get" action="add_taluka" class="row g-3 mb-4">
                            <div class="col-md-4">
                                <label class="form-label" for="country">Country</label>
                                <select
                                    class="form-control"
                                    name="country"
                                    id="country"
                                    onchange="loadStates(this.value)"
                                >
                                    <?php while ($country = mysqli_fetch_assoc($countryResult)) { ?>
                                        <option
                                            value="<?php echo talukaAdminEscape($country['country']); ?>"
                                            <?php echo $country['country'] === $selectedCountry ? 'selected' : ''; ?>
                                        >
                                            <?php echo talukaAdminEscape($country['country']); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="state">State</label>
                                <select
                                    class="form-control"
                                    name="state"
                                    id="state"
                                    onchange="loadDistricts(this.value)"
                                >
                                    <option value="">Select State</option>
                                    <?php while ($state = mysqli_fetch_assoc($stateResult)) { ?>
                                        <option
                                            value="<?php echo talukaAdminEscape($state['state']); ?>"
                                            <?php echo $state['state'] === $selectedState ? 'selected' : ''; ?>
                                        >
                                            <?php echo talukaAdminEscape($state['state']); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="district">District</label>
                                <select
                                    class="form-control"
                                    name="district"
                                    id="district"
                                    onchange="this.form.submit()"
                                >
                                    <option value="">Select District</option>
                                    <?php while ($district = mysqli_fetch_assoc($districtResult)) { ?>
                                        <option
                                            value="<?php echo talukaAdminEscape($district['dist']); ?>"
                                            <?php echo $district['dist'] === $selectedDistrict ? 'selected' : ''; ?>
                                        >
                                            <?php echo talukaAdminEscape($district['dist']); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </form>

                        <?php if ($selectedDistrict !== '') { ?>
                            <form method="post" action="add_taluka" class="row g-3 mb-4">
                                <input type="hidden" name="country" value="<?php echo talukaAdminEscape($selectedCountry); ?>">
                                <input type="hidden" name="state" value="<?php echo talukaAdminEscape($selectedState); ?>">
                                <input type="hidden" name="district" value="<?php echo talukaAdminEscape($selectedDistrict); ?>">

                                <div class="col-md-9">
                                    <label class="form-label" for="taluka">Taluka</label>
                                    <input
                                        class="form-control"
                                        type="text"
                                        name="taluka"
                                        id="taluka"
                                        placeholder="Enter Taluka"
                                        required
                                    >
                                </div>

                                <div class="col-md-3 d-flex align-items-end">
                                    <button class="btn btn-success w-100" type="submit" name="save_taluka">
                                        <i class="feather icon-plus"></i>
                                        Add Taluka
                                    </button>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Taluka</th>
                                            <th>Status</th>
                                            <th style="width: 330px">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($talukaRows as $talukaRow) { ?>
                                        <tr>
                                            <td colspan="3">
                                                <form method="post" action="add_taluka" class="row g-2 align-items-center">
                                                    <input type="hidden" name="country" value="<?php echo talukaAdminEscape($selectedCountry); ?>">
                                                    <input type="hidden" name="state" value="<?php echo talukaAdminEscape($selectedState); ?>">
                                                    <input type="hidden" name="district" value="<?php echo talukaAdminEscape($selectedDistrict); ?>">
                                                    <input type="hidden" name="taluka_id" value="<?php echo (int)$talukaRow['id']; ?>">

                                                    <div class="col-md-5">
                                                        <input
                                                            class="form-control"
                                                            type="text"
                                                            name="taluka"
                                                            value="<?php echo talukaAdminEscape($talukaRow['taluka']); ?>"
                                                            required
                                                        >
                                                    </div>
                                                    <div class="col-md-2">
                                                        <span class="badge <?php echo $talukaRow['status'] === 'enable' ? 'bg-success' : 'bg-secondary'; ?>">
                                                            <?php echo talukaAdminEscape($talukaRow['status']); ?>
                                                        </span>
                                                    </div>
                                                    <div class="col-md-5 text-end">
                                                        <button class="btn btn-info btn-sm" type="submit" name="update_taluka">
                                                            Update
                                                        </button>
                                                        <a
                                                            class="btn btn-danger btn-sm"
                                                            href="add_taluka?country=<?php echo rawurlencode($selectedCountry); ?>&state=<?php echo rawurlencode($selectedState); ?>&district=<?php echo rawurlencode($selectedDistrict); ?>&toggle=<?php echo (int)$talukaRow['id']; ?>"
                                                        >
                                                            <?php echo $talukaRow['status'] === 'enable' ? 'Inactivate' : 'Activate'; ?>
                                                        </a>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<script>
function replaceOptions(elementId, html) {
    document.getElementById(elementId).innerHTML = html;
}

function loadStates(country) {
    replaceOptions('state', '<option value="">Select State</option>');
    replaceOptions('district', '<option value="">Select District</option>');

    if (!country) {
        return;
    }

    fetch('fill_state?q=' + encodeURIComponent(country))
        .then(response => response.text())
        .then(html => replaceOptions('state', html));
}

function loadDistricts(state) {
    replaceOptions('district', '<option value="">Select District</option>');

    if (!state) {
        return;
    }

    fetch('fill_dist?q=' + encodeURIComponent(state))
        .then(response => response.text())
        .then(html => replaceOptions('district', html));
}
</script>
</body>
</html>
