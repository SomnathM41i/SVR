<?php
require_once('../sys_dbconnection.php');
include('protect.php');

/* ============================================================
   CONFIGURATION
   ============================================================ */
define('UPLOAD_DIR',    '../uploads/videos/');
define('THUMB_DIR',     '../uploads/thumbs/');
define('ALLOWED_VIDEO', ['video/mp4', 'video/webm', 'video/ogg']);
define('ALLOWED_IMAGE', ['image/jpeg', 'image/png', 'image/webp', 'image/gif']);
define('MAX_VIDEO_SIZE', 500 * 1024 * 1024); // 500 MB
define('MAX_THUMB_SIZE', 5   * 1024 * 1024); // 5 MB

/* ============================================================
   HELPERS
   ============================================================ */
function redirect(string $url): void {
    header("Location: $url");
    exit();
}

function sanitize(string $value): string {
    return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
}

function ensureDir(string $path): void {
    if (!is_dir($path)) mkdir($path, 0755, true);
}

function uploadFile(array $file, string $dir, array $allowedMimes, int $maxSize): string|false {
    if ($file['error'] !== UPLOAD_ERR_OK)              return false;
    if ($file['size'] > $maxSize)                      return false;
    if (!in_array($file['type'], $allowedMimes, true)) return false;
    ensureDir($dir);
    $ext     = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $newName = uniqid('', true) . '_' . time() . '.' . $ext;
    return move_uploaded_file($file['tmp_name'], $dir . $newName) ? $newName : false;
}

function deleteFile(string $path): void {
    if ($path && file_exists($path)) unlink($path);
}

/* ============================================================
   ACTIONS
   ============================================================ */
$message = '';
$msgType = 'success';

/* ---------- DELETE ---------- */
if (isset($_GET['delete'])) {
    $id   = (int)$_GET['delete'];
    $stmt = $con->prepare("SELECT video_url, thumbnail FROM home_page_video WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $row  = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if ($row) {
        deleteFile(UPLOAD_DIR . $row['video_url']);
        deleteFile(THUMB_DIR  . $row['thumbnail']);
        $del = $con->prepare("DELETE FROM home_page_video WHERE id = ?");
        $del->bind_param('i', $id);
        $del->execute();
        $del->close();
        redirect($_SERVER['PHP_SELF'] . '?msg=deleted');
    }
    redirect($_SERVER['PHP_SELF'] . '?error=notfound');
}

/* ---------- TOGGLE STATUS ---------- */
if (isset($_GET['toggle'])) {
    $id   = (int)$_GET['toggle'];
    $stmt = $con->prepare("SELECT status FROM home_page_video WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $row  = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if ($row) {
        $newStatus = ($row['status'] === 'active') ? 'inactive' : 'active';
        if ($newStatus === 'active') {
            $con->query("UPDATE home_page_video SET status = 'inactive'");
        }
        $upd = $con->prepare("UPDATE home_page_video SET status = ?, updated_at = NOW() WHERE id = ?");
        $upd->bind_param('si', $newStatus, $id);
        $upd->execute();
        $upd->close();
    }
    redirect($_SERVER['PHP_SELF'] . '?msg=updated');
}

/* ---------- UPLOAD ---------- */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $title       = trim($_POST['title']       ?? '');
    $description = trim($_POST['description'] ?? '');
    $status      = in_array($_POST['status'] ?? '', ['active','inactive']) ? $_POST['status'] : 'inactive';
    $errors      = [];

    if ($title === '') $errors[] = 'Title is required.';

    $videoName = false;
    if (!empty($_FILES['video']['name'])) {
        $videoName = uploadFile($_FILES['video'], UPLOAD_DIR, ALLOWED_VIDEO, MAX_VIDEO_SIZE);
        if (!$videoName) $errors[] = 'Invalid video file. Allowed: MP4, WebM, OGG (max 500 MB).';
    } else {
        $errors[] = 'Please select a video file.';
    }

    $thumbName = null;
    if (!empty($_FILES['thumbnail']['name'])) {
        $thumbName = uploadFile($_FILES['thumbnail'], THUMB_DIR, ALLOWED_IMAGE, MAX_THUMB_SIZE);
        if (!$thumbName) $errors[] = 'Invalid thumbnail. Allowed: JPG, PNG, WebP, GIF (max 5 MB).';
    }

    if (empty($errors)) {
        if ($status === 'active') {
            $con->query("UPDATE home_page_video SET status = 'inactive'");
        }
        $ins = $con->prepare(
            "INSERT INTO home_page_video (title, video_url, thumbnail, description, status, created_at, updated_at)
             VALUES (?, ?, ?, ?, ?, NOW(), NOW())"
        );
        $ins->bind_param('sssss', $title, $videoName, $thumbName, $description, $status);
        $ins->execute();
        $ins->close();
        redirect($_SERVER['PHP_SELF'] . '?msg=uploaded');
    } else {
        if ($videoName) deleteFile(UPLOAD_DIR . $videoName);
        if ($thumbName) deleteFile(THUMB_DIR  . $thumbName);
        $message = implode('<br>', $errors);
        $msgType = 'danger';
    }
}

/* ---------- REDIRECT MESSAGES ---------- */
if (isset($_GET['msg'])) {
    $msgs = [
        'uploaded' => ['success', 'Video Uploaded Successfully.'],
        'updated'  => ['success', 'Video Status Updated.'],
        'deleted'  => ['success', 'Video Deleted Successfully.'],
    ];
    if (isset($msgs[$_GET['msg']])) {
        [$msgType, $message] = $msgs[$_GET['msg']];
    }
}
if (isset($_GET['error']) && $_GET['error'] === 'notfound') {
    $message = 'Video not found.';
    $msgType = 'warning';
}

/* ============================================================
   FETCH VIDEOS
   ============================================================ */
$videos = [];
$result = $con->query("SELECT * FROM home_page_video ORDER BY id DESC");
while ($r = $result->fetch_assoc()) {
    $videos[] = $r;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home Page Video – Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="shortcut icon" href="http://localhost/SVR/css3/assets/shivraj-logo.png" type="image/x-icon">

    <!-- Font CSS -->
    <link rel="stylesheet" href="assets/fonts/feather.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="assets/fonts/material.css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/stylenew.css">
    <link rel="stylesheet" href="assets/css/layout-horizontal.css">
    <link rel="stylesheet" href="assets/css/customizer.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="assets/css/popup.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/color-switcher-design.css">

    <style>
        /*.video-manager-wrap   { max-width: 1100px; margin: 30px auto; }*/
        .card                 { border: none; border-radius: 12px; box-shadow: 0 2px 16px rgba(0,0,0,.08); margin-bottom: 28px; }
        .card-header          { background: #fff; border-bottom: 1px solid #f0f0f0; padding: 18px 24px; border-radius: 12px 12px 0 0 !important; }
        .card-header h5       { margin: 0; font-weight: 600; font-size: 1rem; }
        .card-body            { flex: 1 1 auto; padding: 24px; }
        .table thead th       { background: #f7f8fc; font-size: .78rem; text-transform: uppercase; letter-spacing: .06em; color: #6b7280; border-bottom: 2px solid #e5e7eb; }
        .table td             { vertical-align: middle; font-size: .88rem; }
        .table-hover tbody tr:hover { background: #f9fafb; }
        .vid-preview          { width: 160px; border-radius: 8px; outline: none; }
        .thumb-img            { width: 80px; height: 50px; object-fit: cover; border-radius: 6px; }
        .badge-active         { background: #d1fae5; color: #065f46; padding: 4px 10px; border-radius: 50px; font-size: .75rem; font-weight: 600; display:inline-block; }
        .badge-inactive       { background: #f3f4f6; color: #6b7280;  padding: 4px 10px; border-radius: 50px; font-size: .75rem; font-weight: 600; display:inline-block; }
        .form-label           { font-weight: 500; font-size: .88rem; margin-bottom: 4px; display:block; }
        .form-control         { border-radius: 8px; font-size: .9rem; }
        .alert                { border-radius: 10px; font-size: .9rem; }
        .empty-state          { text-align: center; padding: 50px 20px; color: #9ca3af; }
        .empty-state i        { font-size: 3rem; display: block; margin-bottom: 12px; }
        .note { height:505px; position:relative; }
        .rbcss { margin-left: 1.5rem!important; }
        @media screen and (max-width: 768px) {
            .card-bodyme { flex: 1 1 auto; padding: 10px 7px; }
            .note { height:547px; }
            .feed-card { padding-bottom: 70px; }
        }
        @media screen and (max-width: 568px) {
            .card-bodyme { flex: 1 1 auto; padding: 10px 4px; }
            .note { height:547px; }
        }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(window).load(function() {
            <?php if (isset($_GET['msg'])): ?>
            $('#successModal').modal('show');
            <?php endif; ?>
        });
    </script>
</head>

<body class="pc-horizontal">
<div class="container">

    <!-- [ Pre-loader ] -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>

    <?php include('topheader.php'); ?>
    <?php include('header.php'); ?>
    <?php include('notification.php'); ?>

    <!-- [ Main Content ] -->
    <div class="pc-container">
        <div class="video-manager-wrap">

            <!-- ALERT -->
            <?php if ($message): ?>
            <div class="alert alert-<?= sanitize($msgType) ?> alert-dismissible fade show" role="alert">
                <?= $message ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php endif; ?>

            <!-- UPLOAD FORM -->
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <i class="feather icon-upload-cloud text-primary mr-2"></i>
                    <h5>Upload Home Page Video</h5>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="title">Video Title <span class="text-danger">*</span></label>
                                    <input type="text" id="title" name="title" class="form-control"
                                           placeholder="e.g. Wedding Highlights 2024" required maxlength="255">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="status">Status <span class="text-danger">*</span></label>
                                    <select id="status" name="status" class="form-control">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                    <small class="text-muted">Only one video can be <strong>Active</strong> at a time.</small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="video">Select Video <span class="text-danger">*</span></label>
                                    <input type="file" id="video" name="video" class="form-control"
                                           accept="video/mp4,video/webm,video/ogg" required>
                                    <small class="text-muted">MP4, WebM, OGG — max 500 MB</small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="thumbnail">Thumbnail Image <span class="text-muted">(optional)</span></label>
                                    <input type="file" id="thumbnail" name="thumbnail" class="form-control"
                                           accept="image/jpeg,image/png,image/webp,image/gif">
                                    <small class="text-muted">JPG, PNG, WebP — max 5 MB</small>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="description">Description</label>
                                    <textarea id="description" name="description" class="form-control"
                                              rows="3" placeholder="Short description of the video (optional)"></textarea>
                                </div>
                            </div>

                        </div>

                        <button type="submit" name="submit" class="btn btn-primary px-4">
                            <i class="feather icon-upload"></i> Upload Video
                        </button>

                    </form>
                </div>
            </div>

            <!-- VIDEO LIST -->
            <div class="card mt-4">
                <div class="card-header d-flex align-items-center">
                    <i class="feather icon-video text-primary mr-2"></i>
                    <h5>Uploaded Videos</h5>
                    <span class="badge badge-primary ml-auto"><?= count($videos) ?></span>
                </div>
                <div class="card-body p-0">
                    <?php if (empty($videos)): ?>
                        <div class="empty-state">
                            <i class="feather icon-video-off"></i>
                            No videos uploaded yet.
                        </div>
                    <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Thumbnail</th>
                                    <th>Preview</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Uploaded</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($videos as $i => $v): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><strong><?= sanitize($v['title']) ?></strong></td>
                                <td>
                                    <?php if (!empty($v['thumbnail'])): ?>
                                        <img src="<?= sanitize('../uploads/thumbs/' . $v['thumbnail']) ?>"
                                             alt="thumb" class="thumb-img">
                                    <?php else: ?>
                                        <span class="text-muted" style="font-size:.8rem">—</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <video class="vid-preview" controls preload="none"
                                        <?php if (!empty($v['thumbnail'])): ?>
                                            poster="<?= sanitize('../uploads/thumbs/' . $v['thumbnail']) ?>"
                                        <?php endif; ?>>
                                        <source src="<?= sanitize('../uploads/videos/' . $v['video_url']) ?>" type="video/mp4">
                                        Your browser does not support video.
                                    </video>
                                </td>
                                <td style="max-width:180px; white-space:normal; font-size:.82rem; color:#6b7280;">
                                    <?= nl2br(sanitize($v['description'] ?? '—')) ?>
                                </td>
                                <td>
                                    <?php if ($v['status'] === 'active'): ?>
                                        <span class="badge-active">● Active</span>
                                    <?php else: ?>
                                        <span class="badge-inactive">Inactive</span>
                                    <?php endif; ?>
                                </td>
                                <td style="font-size:.8rem; color:#9ca3af; white-space:nowrap;">
                                    <?= date('d M Y', strtotime($v['created_at'])) ?>
                                </td>
                                <td>
                                    <?php
                                        $toggleLabel = ($v['status'] === 'active') ? 'Set Inactive' : 'Set Active';
                                        $toggleClass = ($v['status'] === 'active') ? 'btn-warning'  : 'btn-success';
                                    ?>
                                    <a href="?toggle=<?= (int)$v['id'] ?>"
                                       class="btn <?= $toggleClass ?> btn-sm mb-1">
                                        <?= $toggleLabel ?>
                                    </a>
                                    <a href="?delete=<?= (int)$v['id'] ?>"
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Are you sure you want to permanently delete this video?')">
                                        <i class="feather icon-trash-2"></i> Delete
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

        </div><!-- .video-manager-wrap -->
    </div><!-- .pc-container -->
</div><!-- .container -->

<?php include('footer.php'); ?>

<!-- Success Modal -->
<?php if (isset($_GET['msg'])): ?>
<div id="successModal" class="modal" role="dialog" style="margin-top: 100px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body modalb">
                <div class="swal2-popup swal2-modal swal2-icon-success swal2-show" tabindex="-1"
                     role="dialog" aria-live="assertive" aria-modal="true" style="display: flex;">
                    <div class="swal2-header">
                        <div class="swal2-icon swal2-success swal2-icon-show" style="display: flex;">
                            <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                            <span class="swal2-success-line-tip"></span>
                            <span class="swal2-success-line-long"></span>
                            <div class="swal2-success-ring"></div>
                            <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                            <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                        </div>
                        <h2 class="swal2-title" style="display: flex;">
                            <?php
                                $modalMsg = [
                                    'uploaded' => 'Video Uploaded Successfully',
                                    'updated'  => 'Status Updated Successfully',
                                    'deleted'  => 'Video Deleted Successfully',
                                ];
                                echo $modalMsg[$_GET['msg']] ?? 'Done';
                            ?>
                        </h2>
                    </div>
                    <div class="swal2-actions">
                        <a href="<?= $_SERVER['PHP_SELF'] ?>" class="swal2-confirm swal2-styled"
                           style="display: inline-block;">OK</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Required JS -->
<script src="assets/js/vendor-all.min.js"></script>
<script src="assets/js/plugins/bootstrap.min.js"></script>
<script src="assets/js/plugins/feather.min.js"></script>
<script src="assets/js/pcoded.min.js"></script>
<script src="assets/js/plugins/apexcharts.min.js"></script>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Q8H86P6FK7"></script>
<script src="assets/js/pages/dashboard-sale.js"></script>

</body>
</html>