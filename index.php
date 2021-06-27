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
                                Good evening <?php echo $user_data['name']; ?>
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

        <!-- Container for rest of website -->
        <section id="panels">
            <div class="container-fluid dash-container">
                <div class="row full-row">

                    <!-- Left panel -->
                    <div class="col-1 left-panel d-flex flex-column bd-highlight mb-3 container-fluid">
                        <div class="bd-highlight d-flex align-items-center row tab addNew">
                            <img class="svg p-0" src="assets/svg/plus.svg">
                        </div>
                        <div class="bd-highlight d-flex align-items-center row tab">
                            <img class="svg p-0" src="assets/svg/teams.svg">
                        </div>
                        <div class="bd-highlight d-flex mx-auto row settings">
                            <a href="#accountModal" data-bs-toggle="modal"><i class="fas fa-user p-0 mb-1"></i></a>
                        </div>
                    </div>

                    <!-- Center panel -->
                    <div class="col-11 center-panel">
                        <div class="addService-container">
                            <h6 class="dash-text m-0 py-1">Your current services</h6>
                            <div class="cards-container p-1">
                                <div class="row row-cols-1 row-cols-md-6 g-3">
                                    <div class="col card-holder">
                                        <div class="card h-100 p-2">
                                            <i class="fas fa-minus-circle delete"></i>
                                            <div class="p-2"><img id="teamssvg" src="assets/svg/teams.svg" class="card-img-top"></div>
                                            <p class="card-text text-center p-1">Microsoft Teams</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h6 class="dash-text m-0 py-1">Available services</h6>
                            <div class="cards-container p-1">
                                <div class="row row-cols-1 row-cols-md-6 g-3">
                                    <div class="col card-holder">
                                        <div class="card h-100 p-2">
                                            <i class="fas fa-plus-circle"></i>
                                            <div class="p-2"><img src="assets/svg/classroom.svg" class="card-img-top"></div>
                                            <p class="card-text text-center p-1">Google Classroom</p>
                                        </div>
                                    </div>
                                    <div class="col card-holder">
                                        <div class="card h-100 p-2">
                                            <i class="fas fa-plus-circle"></i>
                                            <div class="p-2"><img src="assets/svg/discord.svg" class="card-img-top"></div>
                                            <p class="card-text text-center p-1">Discord</p>
                                        </div>
                                    </div>
                                    <div class="col card-holder">
                                        <div class="card h-100 p-2">
                                            <i class="fas fa-plus-circle"></i>
                                            <div class="p-2"><img src="assets/svg/duo.svg" class="card-img-top"></div>
                                            <p class="card-text text-center p-1">Google Duo</p>
                                        </div>
                                    </div>
                                    <div class="col card-holder">
                                        <div class="card h-100 p-2">
                                            <i class="fas fa-plus-circle"></i>
                                            <div class="p-2"><img src="assets/svg/github.svg" class="card-img-top"></div>
                                            <p class="card-text text-center p-1">GitHub</p>
                                        </div>
                                    </div>
                                    <div class="col card-holder">
                                        <div class="card h-100 p-2">
                                            <i class="fas fa-plus-circle"></i>
                                            <div class="p-2"><img src="assets/svg/gmail.svg" class="card-img-top"></div>
                                            <p class="card-text text-center p-1">Gmail</p>
                                        </div>
                                    </div>
                                    <div class="col card-holder">
                                        <div class="card h-100 p-2">
                                            <i class="fas fa-plus-circle"></i>
                                            <div class="p-2"><img src="assets/svg/hangouts.svg" class="card-img-top"></div>
                                            <p class="card-text text-center p-1">Google Hangouts</p>
                                        </div>
                                    </div>
                                    <div class="col card-holder">
                                        <div class="card h-100 p-2">
                                            <i class="fas fa-plus-circle"></i>
                                            <div class="p-2"><img src="assets/svg/trello.svg" class="card-img-top"></div>
                                            <p class="card-text text-center p-1">Trello</p>
                                        </div>
                                    </div>
                                    <div class="col card-holder">
                                        <div class="card h-100 p-2">
                                            <i class="fas fa-plus-circle"></i>
                                            <div class="p-2"><img src="assets/svg/messenger.svg" class="card-img-top"></div>
                                            <p class="card-text text-center p-1">Messenger</p>
                                        </div>
                                    </div>
                                    <div class="col card-holder">
                                        <div class="card h-100 p-2">
                                            <i class="fas fa-plus-circle"></i>
                                            <div class="p-2"><img src="assets/svg/meet.svg" class="card-img-top"></div>
                                            <p class="card-text text-center p-1">Google Meet</p>
                                        </div>
                                    </div>
                                    <div class="col card-holder">
                                        <div class="card h-100 p-2">
                                            <i class="fas fa-plus-circle"></i>
                                            <div class="p-2"><img src="assets/svg/messages.svg" class="card-img-top"></div>
                                            <p class="card-text text-center p-1">Google Messages</p>
                                        </div>
                                    </div>
                                    <div class="col card-holder">
                                        <div class="card h-100 p-2">
                                            <i class="fas fa-plus-circle"></i>
                                            <div class="p-2"><img src="assets/svg/outlook.svg" class="card-img-top"></div>
                                            <p class="card-text text-center p-1">Outlook</p>
                                        </div>
                                    </div>
                                    <div class="col card-holder">
                                        <div class="card h-100 p-2">
                                            <i class="fas fa-plus-circle"></i>
                                            <div class="p-2"><img src="assets/svg/skype.svg" class="card-img-top"></div>
                                            <p class="card-text text-center p-1">Skype</p>
                                        </div>
                                    </div>
                                    <div class="col card-holder">
                                        <div class="card h-100 p-2">
                                            <i class="fas fa-plus-circle"></i>
                                            <div class="p-2"><img src="assets/svg/slack.svg" class="card-img-top"></div>
                                            <p class="card-text text-center p-1">Slack</p>
                                        </div>
                                    </div>
                                    <div class="col card-holder">
                                        <div class="card h-100 p-2">
                                            <i class="fas fa-plus-circle"></i>
                                            <div class="p-2"><img src="assets/svg/voice.svg" class="card-img-top"></div>
                                            <p class="card-text text-center p-1">Google Voice</p>
                                        </div>
                                    </div>
                                    <div class="col card-holder">
                                        <div class="card h-100 p-2">
                                            <i class="fas fa-plus-circle"></i>
                                            <div class="p-2"><img src="assets/svg/wechat.svg" class="card-img-top"></div>
                                            <p class="card-text text-center p-1">WeChat</p>
                                        </div>
                                    </div>
                                    <div class="col card-holder">
                                        <div class="card h-100 p-2">
                                            <i class="fas fa-plus-circle"></i>
                                            <div class="p-2"><img src="assets/svg/whatsapp.svg" class="card-img-top"></div>
                                            <p class="card-text text-center p-1">WhatsApp</p>
                                        </div>
                                    </div>
                                    <div class="col card-holder">
                                        <div class="card h-100 p-2">
                                            <i class="fas fa-plus-circle"></i>
                                            <div class="p-2"><img src="assets/svg/yahoo.svg" class="card-img-top"></div>
                                            <p class="card-text text-center p-1">Yahoo! Mail</p>
                                        </div>
                                    </div>
                                    <div class="col card-holder">
                                        <div class="card h-100 p-2" href="#serviceModal" data-bs-toggle="modal">
                                            <div class="p-2"><img src="assets/svg/plus.svg" class="card-img-top newService"></div>
                                            <p class="card-text text-center p-1">Add New Service</p>
                                        </div>
                                    </div>
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
                            <h2 class="form-title text-center">Account Settings</h2>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="firstname" class="account-label">Name</label>
                                    <input type="text" class="form-input" placeholder="<?php echo $user_data['name']; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="account-label">Email Address</label>
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
                                    <button class="account-deactivate p-1">Delete Account</button>
                                </div>
                            </div>
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
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="servicename" class="account-label">Service Name</label>
                                    <input type="text" class="form-input" placeholder="Service Name">
                                </div>
                                <div class="col-md-6">
                                    <label for="serviceaddress" class="account-label">Service Address</label>
                                    <input type="text" class="form-input" placeholder="web.service.com">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 pt-md-0 pt-3">
                                    <label for="fileupload" class="account-label">Upload Icon (.svg and .xml only)</label> <br>
                                    <input type="file" accept="image/svg+xml" id="fileupload" name="fileupload" class="account-label">
                                </div>
                            </div>
                            <div class="py-2">
                                <button class="account-submit text-wrap">Add Service</button>
                                <button type="button" class="account-cancel-submit text-wrap" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="css/bootstrap-5.0/bootstrap-5.0.0-beta2-dist/js/bootstrap.js"></script>
    <script src="scripts/script.js"></script>
</body>

</html>