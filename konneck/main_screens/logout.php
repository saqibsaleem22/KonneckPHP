<?php
//destroys the current session
session_start();
session_destroy();
header("Location: ../login&Registration/login.php");
?>
