<?php

require 'connection.php';

global $con;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //something was posted
    $user_email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($password) && !empty($user_email)) {
        //read from database
        $query = "SELECT * FROM user WHERE email = '$user_email LIMIT 1 '";

        $result = mysqli_query($con, $query);

        header("Location: index.php");
        die;
    } else {
        echo "Please enter some valid information!";
    }
}
