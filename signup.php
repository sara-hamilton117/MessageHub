<?php

global $con;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //something was posted
    $user_name = $_POST['name'];
    $user_email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($user_name) && !empty($password) && !empty($user_email)) {
        //save to database
        $query = "insert into users (name,email,password) values ('$user_name','$user_email','$password')";

        mysqli_query($con, $query);

        header("Location: index.php");
        die;
    } else {
        echo "Please enter some valid information!";
    }
}