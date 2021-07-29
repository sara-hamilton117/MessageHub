<?php
session_start();
require 'connection.php';

global $con;

$id = $_SESSION['user_id'];

$sql = "SELECT service.service_img, service.service_address FROM service INNER JOIN serviceuser ON service.service_id = serviceuser.service_id WHERE serviceuser.user_id = '$id'";
$result = $con->query($sql);
$nodes = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($nodes, '<div class="bd-highlight d-flex align-items-center row tab" onclick="opensite(\''. $row["service_address"].'\')"><img class="svg p-0" src='. $row["service_img"] .'></div>');
    }
    echo json_encode($nodes);
} else {
    echo 'no services';
}

