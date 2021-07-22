<!-- PHP -->
<?php

// Starting Session
session_start();

// Linking PHP files
include("connection.php");
include("functions.php");

// Checking if user is already logged in
$user_data = check_login($con);
?>

<!DOCTYPE html>
<html lang="en">

<!-- Header Section -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | MessageHub</title>

    <!-- Links to styles -->
    <link rel="stylesheet" href="css/bootstrap-5.0/bootstrap-5.0.0-beta2-dist/css/bootstrap.css">
    <link rel="stylesheet" href="assets/icons/fontawesome-free-5.15.2-web/css/all.css">
    <link rel="stylesheet" href="css/stylesheet-dash.css">
    <link rel="stylesheet" href="css/stylesheet-welcome.css">
    <link rel="icon" href="assets/images/header.png">
</head>

<!-- Body Section -->

<body>

    <!-- Main Body of Website -->
    <main id="dashboard">

        <!-- Nav Bar -->
        <section id="nav-bar">
            <nav class="navbar nav-dash navbar-expand-lg navbar-light bg-transparent">
                <div class="container-fluid nav-container">
                    <a class="navbar-brand navbar-brand-dash" href="#">MessageHub</a>

                    <!-- Toggles navbar into hamburger menu on smaller screen width -->
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">

                        <!-- Navbar Unordered list -->
                        <ul class="navbar-nav">
                            <li class="nav-item user-name">
                                <!-- Display User's name using PHP -->
                                Hello <?php echo $user_data['name']; ?>
                            </li>
                            <li class="nav-item">
                                <!-- Link to Log Out -->
                                <a class="nav-link" href="logout.php">Log out</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </section>

        <section id="alert-section">
            <!-- <div class="row alert alert-warning alert-dismissible fade show m-0 p-0 text-center" role="alert" id="alertPopup">
            <p class="m-0 p-0 hiw-para">An error occured, please try again.</p>
            <button type="button" class="btn-close alert-close p-0" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> -->
        </section>

        <!-- Container for rest of website -->
        <section id="panels">
            <div class="container-fluid dash-container">
                <div class="row full-row">

                    <!-- Left panel -->
                    <div class="col-1 left-panel d-flex flex-column bd-highlight mb-3 container-fluid" id="services-tab">
                        <!-- Add service to dashboard button -->
                        <div class="bd-highlight d-flex align-items-center row tab addNew">
                            <img class="svg p-0" src="assets/svg/plus.svg">
                        </div>

                        <!-- Calling PHP file to automatically load user's current services -->
                        <!-- <?php
                                include 'current-services-tab.php';
                                ?> -->

                        <!-- Account Settings button -->
                        <div class="bd-highlight d-flex mx-auto row settings">
                            <a href="#accountModal" data-bs-toggle="modal"><i class="fas fa-user p-0 mb-1"></i></a>
                        </div>
                    </div>

                    <!-- Center panel -->
                    <div id="center-panel" class="col-11 center-panel">
                        <div class="addService-container">

                            <!-- Current Services section -->
                            <h6 class="dash-text m-0 py-1">Your current services</h6>
                            <div class="cards-container p-1">
                                <div class="row row-cols-1 row-cols-md-6 g-3" id="current-services">

                                    <!-- Calling PHP file to automatically load user's current services -->
                                    <?php
                                    include 'load-current-services.php';
                                    ?>

                                </div>
                            </div>

                            <!-- Available Services section -->
                            <h6 class="dash-text m-0 py-1">Available services</h6>
                            <div class="cards-container p-1">
                                <div class="row row-cols-1 row-cols-md-6 g-3" id="available-services">

                                    <!-- Add custom service if it is not already listed -->
                                    <div class="col card-holder">
                                        <div class="card h-100 p-2" href="#serviceModal" data-bs-toggle="modal">
                                            <div class="p-2"><img src="assets/svg/plus.svg" class="card-img-top newService"></div>
                                            <p class="card-text text-center p-1">Add New Service</p>
                                        </div>
                                    </div>

                                    <!-- Calling PHP file to automatically load available services -->
                                    <?php
                                    include 'load-available-services.php';
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Account Modal -->
    <div class="modal fade" id="accountModal" tabindex="-1" aria-labelledby="signUpModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="container modal-container">
                    <div class="account-content">
                        <div class="py-2">

                            <!-- Account Settings form using HTTP POST Method -->
                            <form action="" method="POST" id="account-form">
                                <h2 class="form-title text-center">Account Settings</h2>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="firstname" class="account-label">Name</label>

                                        <!-- Text field shows current user's name -->
                                        <input type="text" class="form-input" placeholder="<?php echo $user_data['name']; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="account-label">Email Address</label>

                                        <!-- Text field shows current user's email -->
                                        <input type="text" class="form-input" placeholder="<?php echo $user_data['email']; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 pt-md-0 pt-3">
                                        <label for="password" class="account-label">Password</label>
                                        <input type="password" class="form-input" placeholder="*********">
                                    </div>
                                </div>
                                <div class="py-2 border-bottom">
                                    <button class="account-submit text-wrap">Save Changes</button>
                                    <button type="button" class="account-cancel-submit text-wrap" data-bs-dismiss="modal">Cancel</button>
                                </div>
                                <div class="d-sm-flex align-items-center pt-1" id="deactivate">
                                    <div>
                                        <h6 class="deactivate-heading">Delete your account</h6>
                                        <p class="deactivate-para m-0">Deleting you account will remove all your information, settings and data. You will not be able to log back in.</p>
                                    </div>
                                    <div class="ml-auto ms-2">
                                        <!-- Button to delete account -->
                                        <button class="account-deactivate p-1">Delete Account</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Service Modal -->
    <div class="modal fade" id="serviceModal" tabindex="-1" aria-labelledby="signUpModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="container modal-container">
                    <div class="account-content">
                        <div class="py-2">
                            <h2 class="form-title text-center">New Service</h2>
                            <p class="text-center account-para">Don't see your service listed? Add your own here.</p>

                            <!-- New Service form using HTTP POST Method -->
                            <form method="POST" id="service-form" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="servicename" class="account-label">Service Name</label>
                                        <input id="service_name" type="text" class="form-input" name="name" placeholder="Service Name">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="serviceaddress" class="account-label">Service Address</label>
                                        <input id="service_address" type="text" class="form-input" name="address" value="https://">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 pt-md-0 pt-3">
                                        <label for="fileupload" class="account-label">Upload Icon (.svg and .xml only)</label> <br>
                                        <input type="file" accept="image/svg+xml" id="fileupload" name="file" class="account-label">
                                    </div>
                                </div>
                                <div class="py-2">
                                    <!-- Button to add new service -->
                                    <button onclick="return newService()" type="submit" class="account-submit text-wrap">Add Service</button>
                                    <!-- Button to cancel -->
                                    <button type="button" class="account-cancel-submit text-wrap" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Remove Custom Service Modal -->
    <div class="modal fade" id="removeCustomService" tabindex="-1" aria-labelledby="removeCustomService" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal">
            <div class="modal-content">
                <div class="container modal-container">
                    <div class="account-content">
                        <div class="py-2">
                            <h2 class="form-title text-center">Delete Custom Service</h2>
                            <p class="text-center account-para">Are you sure you want to delete your custom service?</p>
                            <div class="py-2 text-center">
                                <!-- Button to delete custom service -->
                                <button type="submit" id="delete-service-button" class="account-submit text-wrap">Delete Service</button>
                                <!-- Button to cancel -->
                                <button type="button" class="service-cancel-submit text-wrap" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="css/bootstrap-5.0/bootstrap-5.0.0-beta2-dist/js/bootstrap.js"></script>
    <script src="scripts/script.js"></script>
    <script src="scripts/service-script.js"></script>
</body>

</html>