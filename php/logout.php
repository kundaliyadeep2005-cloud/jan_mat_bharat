<?php
session_start();
session_unset();
session_destroy();
header("Location: /jan_mat_bharat/php/login.php");
exit;
?>
