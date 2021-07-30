<?php
session_start();

$response = array("success" => false, "card" => "", "errorMessage" => "");

$target_dir = "assets/svg/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $response['errorMessage'] = "File is not an image.";
        $uploadOk = 0;
    }
}

if (file_exists($target_file)) {
    $response['errorMessage'] = "Sorry, file already exists.";
    $uploadOk = 0;
}

if ($_FILES["file"]["size"] > 500000) {
    $response['errorMessage'] = "Sorry, your file is too large.";
    $uploadOk = 0;
}

if ($imageFileType != "svg" && $imageFileType != "xml") {
    $response['errorMessage'] = "Sorry, only svg and xml files are allowed.";
    $uploadOk = 0;
}

if ($uploadOk != 0) {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {

        require 'connection.php';

        global $con;

        $id = $_SESSION['user_id'];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            // Posting service details
            $service_name = $_POST['name'];
            $service_address = $_POST['address'];
            $by_default = 0;
            $file = 'assets/svg/' . $_FILES["file"]["name"];

            // If fields are not empty
            if (!empty($service_name) && !empty($service_address) && !empty($file)) {

                $stmt = $con -> prepare("INSERT INTO service (service_name, service_address, by_default, service_img) VALUES (?, ?, ?, ?)");
                $stmt -> bind_param("ssis", $service_name, $service_address, $by_default, $file);
                $result = $stmt -> execute();
                if ($result == 1){
                    $service_id = $con->insert_id;

                    $query = "INSERT INTO serviceuser (user_id, service_id) VALUES ('$id', '$service_id')";
                    // New service created successfully
                    if (mysqli_query($con, $query)) {

                        $response['success'] = true;

                        $response['card'] .= '<div class="col card-holder" id="card-' . $service_id  . '">';
                        $response['card'] .= '<div class="card h-100 p-2">';
                        $response['card'] .= '<button class="fas fa-minus-circle delete bg-transparent border-0" onclick=removecustomservice(' . $service_id  . ')></button>';
                        $response['card'] .= '<div class="p-2"><img src=' . $file . ' class="card-img-top" onclick="opensite(\'' . $service_address . '\')"></div>';
                        $response['card'] .= '<p class="card-text text-center p-1" id="name-' . $service_name . '>' . $service_name . '</p>';
                        $response['card'] .= '</div>';
                        $response['card'] .= '</div>';
                    } 
                    else {
                        $response['errorMessage'] = "Not added to serviceuser table $query. " . mysqli_error($con);
                    }
                }
                else {
                    $response['errorMessage'] = "An error occured, please try again";
                }
            }
        }
    } 
    else {
        $response['errorMessage'] = "Sorry, there was an error uploading your file.";
    }
}
echo json_encode($response);




