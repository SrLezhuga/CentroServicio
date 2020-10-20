<?php
session_start();
session_destroy();
header("Location: http://" . $_SERVER['HTTP_HOST'] . "/CentroServicio/index.php?alert=0");

?>