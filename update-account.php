<?php
session_start();
require 'connection.php';

global $con;

$id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Posting login details
    $user_name = $_POST['name'];
    $user_email = $_POST['email'];
    $user_newPassword = $_POST['newPassword'];
    $user_oldPassword = $_POST['oldPassword'];

    // Create a prepared statement to find the user's password
    $stmt = $con->prepare("SELECT PASSWORD FROM `user` WHERE user_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $result_array = $result->fetch_all();
    $stmt->close();
    $result->free();
    // Check if provided password matches the one in the database
    if(!password_verify($user_oldPassword, $result_array[0][0])){
        echo 'Wrong password';
        die();
    }

    // String to hold SQL query
    $preparedSQL = "UPDATE user SET ";
    // String to hold the parameters type
    $params_types = "";
    // Array to hold the parameters
    $params = [];

    // If user wants to change their username, add them to the strings and array
    if (!empty($user_name)) {
        $params_types .= "s";
        array_push($params, $user_name);
        $preparedSQL .= "name= ? ";
        // If something else needs to be added to the query, add a comma between values
        if (!empty($user_email) || !empty($user_newPassword)){
            $preparedSQL .= ",";
        }
    }

    // If user wants to change their email, add them to the strings and array
    if (!empty($user_email)) {
        if (checkEmailExists($con, $user_email)) {
            echo "Email exists";
            die();
        }
        $params_types .= "s";
        array_push($params, $user_email);
        $preparedSQL .= "email= ? ";
        // If something else needs to be added to the query, add a comma between values
        if (!empty($user_newPassword)) {
            $preparedSQL .= ",";
        }
    }

    // If user wants to change their password, add them to the strings and array
    if (!empty($user_newPassword)) {
        $params_types .= "s";
        array_push($params, password_hash($user_newPassword, PASSWORD_DEFAULT));
        $preparedSQL .= "password= ? ";
    }

    // Finish the SQL query
    $preparedSQL .= "WHERE user_id=" . $id;

    // Query the database with the update
    $update_stmt = $con->prepare($preparedSQL);
    // Pass parameters to the query
    $update_stmt->bind_param($params_types, ...$params);
    $update_stmt->execute();
    // Echo results
    if ($update_stmt->affected_rows == 1) {
        echo 'Update successful';
    } else {
        echo 'Error updating';
    }
}

// Queries DB to see if the email exists
function checkEmailExists($con, $user_email){
    $email_stmt = $con->prepare("SELECT * FROM user WHERE email = ? LIMIT 1");
    $email_stmt->bind_param("s", $user_email);
    $email_stmt->execute();
    $email_result = $email_stmt->get_result();
    $email_result_array = $email_result->fetch_all();
    $email_stmt->close();
    $email_result->free();
    if (empty($email_result_array)){
        return false;
    }else{
        return true;
    }
}