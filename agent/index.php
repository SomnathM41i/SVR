<?php
require_once('common.php');
header('Location: ' . (!empty($_SESSION['agent_id']) ? 'dashboard' : 'login'));
exit;
?>
