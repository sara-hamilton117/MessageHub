<?php
session_start();
require 'connection.php';

global $con;

$id = $_SESSION['user_id'];
$service_id = $_POST['service_id'];

// $sql = "SELECT service_name, service_img FROM service WHERE by_default = 1";
$sql = "INSERT INTO serviceuser (user_id, service_id) VALUES ('$id', '$service_id')";
$result = $con->query($sql);

if ($result == '' || is_null($result)) {
    echo "Cannot compute";
    }
    else {
    echo "Successfully added";
}
