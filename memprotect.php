<?php
if (session_status() === PHP_SESSION_NONE) {
    $sessionPath = __DIR__ . DIRECTORY_SEPARATOR . 'sessions';
    if (is_dir($sessionPath) && is_writable($sessionPath)) {
        session_save_path($sessionPath);
    }
    session_start();
}
$_SESSION['url']=$_SERVER['REQUEST_URI'] ?? '';
if(empty($_SESSION['matriid']) && empty($_SESSION['MatriID'])) 
 {
	unset($_SESSION['matriid']);
	header('location:index');
	exit;
 }
if(empty($_SESSION['matriid']) && !empty($_SESSION['MatriID'])) {
    $_SESSION['matriid'] = $_SESSION['MatriID'];
} 
?>
