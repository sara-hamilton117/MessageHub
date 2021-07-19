<?php

require 'connection.php';

global $con;

$id = $_SESSION['user_id'];

$sql = "SELECT service.service_img, service.service_address FROM service INNER JOIN serviceuser ON service.service_id = serviceuser.service_id WHERE serviceuser.user_id = '$id'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="bd-highlight d-flex align-items-center row tab" onclick="opensite(\''. $row["service_address"].'\')">';
        echo '<img class="svg p-0" src='. $row["service_img"] .'>';
        echo '</div>';
    }
} else {
    
}
