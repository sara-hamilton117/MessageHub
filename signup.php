<?php
session_start();
require 'connection.php';

global $con;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Posting sign up details
    $user_name = $_POST['name'];
    $user_email = $_POST['email'];
    $user_password = $_POST['password'];

    // If fields are not empty
    if (!empty($user_name) && !empty($user_password) && !empty($user_email)) {

        $stmt = $con->prepare("SELECT * FROM user WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $user_email);
        $stmt->execute();
        $result = $stmt -> get_result();
        $result_array = $result -> fetch_all();

        if (!empty($result_array)) {
            echo "Email exists";
        }

        else {
            // hashing password
            $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

            $stmt = $con->prepare("INSERT INTO user (name,email,password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $user_name, $user_email, $hashed_password);
            $result = $stmt->execute();

            $stmt = $con->prepare("SELECT * FROM user WHERE email = ? LIMIT 1");
            $stmt->bind_param("s", $user_email);
            $result = $stmt->execute();

            // If there is a matching result
            if ($result == 1) {
                /* bind result variables */
                $stmt->bind_result($user_id, $name, $email, $password);
                $stmt->fetch();

                if ($password === $hashed_password) {
                    // Take the user to the index page
                    $_SESSION['user_id'] = $user_id;
                    header("Location:index.php");
                    die;
                }
            }
        }
    }
}
?>