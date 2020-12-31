<?php
session_start();
session_destroy();
header("Location: http://192.168.0.98/CentroServicio/index?alert=0");

?>