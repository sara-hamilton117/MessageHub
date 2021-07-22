<?php
session_start();

require 'connection.php';

global $con;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Posting sign up details
    $user_name = $_POST['name'];
    $user_email = $_POST['email'];
    $password = $_POST['password'];

    // If fields are not empty
    if (!empty($user_name) && !empty($password) && !empty($user_email)) {

        // Save to database
        $query = "INSERT INTO user (name,email,password) VALUES ('$user_name','$user_email','$password')";

        mysqli_query($con, $query);

        // Read from database
        $query = "SELECT * FROM user WHERE email = '$user_email' LIMIT 1";

        $result = mysqli_query($con,
            $query
        );

        // If there is a matching result
        if ($result && mysqli_num_rows($result) > 0) 
        {
            $user_data = mysqli_fetch_assoc($result);

            if ($user_data['password'] === $password)
            {
                // Take the user to the index page
                $_SESSION['user_id'] = $user_data['user_id'];
                header("Location:index.php");
                die;
            }
        }
    } else {
        echo "Please enter some valid information!";
    }
}
?>