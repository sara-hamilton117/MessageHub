<?php

// Local host credentials
// $dbhost = "localhost";
// $dbuser = "root";
// $dbpass = "";
// $dbname = "messagehub";

// Heroku credentials
$dbhost = "eu-cdbr-west-01.cleardb.com";
$dbuser = "b4a74350668e0f";
$dbpass = "c5d28f87";
$dbname = "heroku_64958899b23da1c";



if (!$con = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname)) 
{
    die("Failed to connect to DB");
}
