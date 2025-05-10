<?php
session_start();

session_destroy();

header('Location: /NumberCircled/index.php');
exit;
?>
