<?php
session_start();

require 'connection.php';

global $con;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Posting login details
    $user_email = $_POST['email'];
    $user_password = $_POST['password'];

    if (!empty($user_password) && !empty($user_email)) {
        // Read from database
        $stmt = $con->prepare("SELECT * FROM user WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $user_email);
        $result = $stmt->execute();

        // If there is a matching result
        if ($result == 1) 
        {
            $stmt->bind_result($user_id, $name, $email, $password);
            $stmt->fetch();
            if (password_verify($user_password, $password)) {
                // Take the user to the index page
                $_SESSION['user_id'] = $user_id;
                header("Location:index.php");
                die;
            }
            else {
                echo "Wrong password";
            }
        }
        else {
            echo "No email found";
        }
    } 
    else {
        echo "Empty fields";
    }
}