<?php
header("Content-disposition: attachment; filename=FormatoRefacciones.csv");
header("Content-type: text/csv");
readfile("FormatoRefacciones.csv");
?>