<?php
session_start();
require 'connection.php';

global $con;

$id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Posting login details
    $user_password = $_POST['password'];

    if (!empty($user_password)) {
        // Read from database
        $query = "SELECT * FROM user WHERE user_id = '$id' LIMIT 1";
        $result = $con->query($query);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                if(password_verify($user_password, $row['password'])){
                    $query = "DELETE FROM serviceuser WHERE user_id ='$id'";
                    $deleteServiceResult = $con->query($query);

                    $query = "DELETE FROM user WHERE user_id ='$id'";
                    $deleteUserResult = $con->query($query);

                    if(!empty($deleteUserResult)){
                        echo 'Successfully deleted';
                    }
                    else{
                        echo 'Error';
                    }
                }
                else{
                    echo 'Wrong password';
                }
            }
        }
    }
    else {
        echo "Empty fields";
    }
}