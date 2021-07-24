<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'connection.php';

global $con;

$id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Posting login details
    $user_name = $_POST['name'];
    $user_email = $_POST['email'];
    $user_newPassword = $_POST['newPassword'];
    $user_oldPassword = $_POST['oldPassword'];

    $stmt = $con->prepare("SELECT PASSWORD FROM `user` WHERE user_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $result_array = $result->fetch_all();
    $stmt->close();
    $result->free();
    if(!password_verify($user_oldPassword, $result_array[0][0])){
        echo 'Wrong password';
        die();
    }

    $preparedSQL = "UPDATE user SET ";
    $params_types = "";
    $params = [];

    if (!empty($user_name)) {
        $params_types .= "s";
        array_push($params, $user_name);
        $preparedSQL .= "name= ? ";
        if (!empty($user_email) || !empty($user_newPassword)){
            $preparedSQL .= ",";
        }
    }

    if (!empty($user_email)) {
        if (checkEmailExists($con, $user_email)) {
            echo "Email exists";
            die();
        }
        $params_types .= "s";
        array_push($params, $user_email);
        $preparedSQL .= "email= ? ";
        if (!empty($user_newPassword)) {
            $preparedSQL .= ",";
        }
    }

    if (!empty($user_newPassword)) {
        $params_types .= "s";
        array_push($params, password_hash($user_newPassword, PASSWORD_DEFAULT));
        $preparedSQL .= "password= ? ";
    }
    $preparedSQL .= "WHERE user_id=" . $id;

    $update_stmt = $con->prepare($preparedSQL);
    $update_stmt->bind_param($params_types, ...$params);
    $update_stmt->execute();
    if ($update_stmt->affected_rows == 1) {
        echo 'Update successful';
    } else {
        echo 'Error updating';
    }
}

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