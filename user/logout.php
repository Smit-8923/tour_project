<?php
session_start();
session_destroy();
header("Location: ../index.php"); // Redirect to homepage after logout
session_start();
exit();
?>
