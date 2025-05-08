<?php
session_start();

session_destroy();

header('Location: /NumberCircled/app/view/login.php');
exit;
?>
