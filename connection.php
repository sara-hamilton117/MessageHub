<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "messagehub";

if (!$con = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname)) 
{
    die("Failed to connect to DB");
}
