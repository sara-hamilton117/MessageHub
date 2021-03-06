<?php
require 'connection.php';

global $con;

$id = $_SESSION['user_id'];

$sql = "SELECT service.service_id, service.service_address, service.service_name, service.service_img, service.by_default FROM service INNER JOIN serviceuser ON service.service_id = serviceuser.service_id WHERE serviceuser.user_id = '$id'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    while($row = $result-> fetch_assoc()) {
        if ($row["by_default"] == 1){
            echo '<div class="col card-holder" id="card-'. $row["service_id"] .'">';
            echo '<div class="card h-100 p-2">';
            echo '<button class="fas fa-minus-circle delete bg-transparent border-0" onclick=removeservice('. $row["service_id"] .')></button>';
            echo '<div class="p-2"><img src='. $row["service_img"] .' class="card-img-top" onclick="opensite(\''.$row["service_address"].'\')"></div>';
            echo '<p class="card-text text-center p-1">'. $row["service_name"] .'</p>';
            echo '</div>';
            echo '</div>';
        } else{
            echo '<div class="col card-holder" id="card-' . $row["service_id"] . '">';
            echo '<div class="card h-100 p-2">';
            echo '<button class="fas fa-minus-circle delete bg-transparent border-0" onclick=removecustomservice(' . $row["service_id"] . ')></button>';
            echo '<div class="p-2"><img src=' . $row["service_img"] . ' class="card-img-top" onclick="opensite(\'' . $row["service_address"] . '\')"></div>';
            echo '<p class="card-text text-center p-1">' . $row["service_name"] . '</p>';
            echo '</div>';
            echo '</div>';
        } 
    }
}   
else {
    echo '<h6 class="dash-text m-0 pt-3 ps-2">Select a service from the Available Services to begin using MessageHub.</h6>';
}
