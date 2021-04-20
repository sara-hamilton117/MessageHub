<?php
session_start();

require 'connection.php';

global $con;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //something was posted
    $user_email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($password) && !empty($user_email)) {
        //read from database
        $query = "SELECT * FROM user WHERE email = '$user_email' LIMIT 1";

        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) 
        {
            $user_data = mysqli_fetch_assoc($result);
            if($user_data['password'] === $password)
            {
                $_SESSION['user_id'] = $user_data['user_id'];
                header("Location: index.php");
                die;
            }
        }
        echo "Please enter different password.";
    } else {
        echo "Please enter some valid information!";
    }
}
