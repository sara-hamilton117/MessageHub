<?php

require 'connection.php';

global $con;

$id = $_SESSION['user_id'];

$sql = "SELECT service_id, service_name, service_img, by_default FROM service WHERE service_id NOT IN (SELECT service_id FROM serviceuser WHERE serviceuser.user_id = '$id') AND by_default = 1";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    while($row = $result-> fetch_assoc()) {
        echo '<div class="col card-holder" id="card-'. $row["service_id"] .'">';
        echo '<div class="card h-100 p-2">';
        echo '<button class="fas fa-plus-circle bg-transparent border-0" onclick=addservice('. $row["service_id"] .') ></button>';
        echo '<div class="p-2"><img src='. $row["service_img"] .' class="card-img-top"></div>';
        echo '<p class="card-text text-center p-1">'. $row["service_name"].'</p>';
        echo '</div>';
        echo '</div>';
    }
}   else {
    echo '<h6 class="dash-text m-0 py-1">No services could be found at the moment.</h6>';
}
?>