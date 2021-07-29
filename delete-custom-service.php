<?php
session_start();
require 'connection.php';

global $con;

$id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Posting service details
    $service_id = $_POST['service_id'];

    if (!empty($service_id)) {
        $query = "DELETE FROM `serviceuser` WHERE `user_id` = '$id' AND `service_id` = '$service_id'";
        if (mysqli_query($con, $query)) {

            $query = "DELETE FROM `service` WHERE `service_id` = '$service_id'";
            if (mysqli_query($con, $query)) {
                echo "Successfully deleted";
            }

            else {
                echo "Service could not be deleted from service table: $query. " . mysqli_error($con);
            }
        }
        else{
            echo "Service could not be deleted from serviceuser table: $query. " . mysqli_error($con);
        }
    }
    else {
        echo "Service ID may be empty: $query. " . mysqli_error($con);
    }
}