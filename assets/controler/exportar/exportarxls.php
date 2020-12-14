<?php

function getErrorReporting(){
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
    date_default_timezone_set('Europe/London');
}

function noCli(){
if (PHP_SAPI == 'cli')
die('This example should only be run from a Web Browser');
}

function getHeaders(){
    // Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename=Refacciones '.date("Y-m-d", strtotime("now")).'.xls');

}