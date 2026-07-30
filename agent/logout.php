<?php
require_once('common.php');
unset($_SESSION['agent_id'], $_SESSION['agent_name']);
header('Location: login');
exit;
?>
