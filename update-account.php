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

    $stmt = $con->prepare("SELECT PASSWORD FROM `user` WHERE user_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $result_array = $result->fetch_all();

    if(password_verify($user_oldPassword, $result_array[0][0])){

        $preparedSQL = "UPDATE user SET ";
        $params_types = "";
        $params = [];

        if (!empty($user_name)) {
            $params_types .= "s";
            array_push($params, $user_name);
            $preparedSQL .= "name = ? ";
        }

        if (!empty($user_email)) {
            $params_types .= "s";
            array_push($params, $user_email);
            $preparedSQL .= "email = ? ";
        }

        if (!empty($user_newPassword)) {
            $params_types .= "s";
            array_push($params, password_hash($user_password, PASSWORD_DEFAULT));
            $preparedSQL .= "password = ? ";
        }
        $preparedSQL .= "WHERE user_id=" .$id;

        $update_stmt = $con->prepare($preparedSQL);
        $update_stmt->bind_param($params_types, ...$params);
        $update_stmt->execute();
        $update_result = $stmt->get_result();
        $update_result_array = $result->fetch_all();
        echo $preparedSQL;
        print_r($params);
        if ($stmt->affected_rows == 1){
            echo 'Update successful';
        } else{
            echo 'Error updating';
        }

    }else{
        echo 'Wrong password';
    }
}
