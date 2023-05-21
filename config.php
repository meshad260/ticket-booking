<?php
    $host = "127.0.0.1";
    $user = "root";                     
    $pass = "";                                  
    $db = "movietheatredb";
    $port = 3306;
     $con = mysqli_connect($host, $user, $pass, $db, $port)or die(mysql_error());


     //razor pay idisse
     
$keyId = "rzp_test_CsC4RgMXy0rEXg";
$keySecret ="34r78es4aoCqokU1XV6P9nna";
$displayCurrency = 'INR';
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>