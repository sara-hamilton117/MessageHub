<?php
session_start();



include("connection.php");
include("functions.php");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap-5.0/bootstrap-5.0.0-beta2-dist/css/bootstrap.css">
    <link rel="stylesheet" href="css/stylesheet-main.css">
    <title>MessageHub</title>
    <link rel="icon" href="assets/images/header.png">
</head>

<body>
    <main>
        <section id="nav-bar">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
                <div class="container-fluid nav-container">
                    <a class="navbar-brand" href="#">MessageHub</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#howItWorks">How it Works</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#about">About MessageHub</a>
                            </li>
                            <li class="nav-item">
                                <!-- Link trigger modal -->
                                <a class="nav-link" data-bs-toggle="modal" data-bs-target="#logInModal" href="">Log In</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </section>

        <section id="banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 banner-container">
                        <p class="banner-header">One place for all your messaging.</p>
                        <p class="banner-para">MessageHub is a platform for all your messaging applications including Microsoft Teams, WhatsApp, LinkedIn, Messenger and more.</p>
                        <!-- Button trigger modal -->
                        <input type="submit" class="signIn-btn" value="Sign up Now" data-bs-toggle="modal" data-bs-target="#signUpModal" />
                    </div>
                    <div class="col-md-4 d-flex align-items-center justify-content-center img-container1">
                        <img src="assets/images/index-1.png" class="img-fluid index-img1">
                    </div>
                </div>
            </div>
        </section>

        <section id="howItWorks">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 d-flex align-items-center justify-content-center img-container2">
                        <img src="assets/images/index-2.png" class="img-fluid index-img2">
                    </div>
                    <div class="col-md-8 hiw-container">
                        <p class="hiw-header">Do more with less.</p>
                        <p class="hiw-para">Choose from any of the avilable services to fully customize your chatting needs. You can utilize from personal chat services such as WhatsApp, Messenger, Signal, Twitter, and many more, or you can stay on top of your work with business focused services like Slack, Microsoft Teams, Outlook and more.</p>
                        <p class="hiw-header2">How it works</p>
                        <p class="hiw-para">Simply sign up and get access to a wide range of messaging services to add to your dashboard, so you can go from multiple tabs, to only one. Add or remove as many services, and easily switch between them.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="about">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 about-container">
                        <p class="hiw-header">About MessageHub</p>
                        <p class="hiw-para">MessageHub has been developed as part of a Undergraduate Individual Project at Middlesex University Malta. Your contribution is greatly appreciated.</p>
                    </div>
                    <div class="col-md-4 d-flex align-items-center justify-content-center img-container3">
                        <img src="assets/images/index-3.png" class="img-fluid index-img3">
                    </div>
                </div>
            </div>
        </section>

        <footer>
            <p class="footer text-center">Designed and Developed by Sara Hamilton © All Rights Reserved 2021
            </p>
        </footer>

    </main>
    <script src="css/bootstrap-5.0/bootstrap-5.0.0-beta2-dist/js/bootstrap.js"></script>
    <!-- Sign Up Modal -->
    <div class="modal fade" id="signUpModal" tabindex="-1" aria-labelledby="signUpModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="container modal-container">
                    <div class="signup-content">
                        <form action="signup.php" method="POST" id="signup-form" class="signup-form">
                            <h2 class="form-title text-center">Create account</h2>
                            <div class="form-group">
                                <input type="text" class="form-input" name="name" id="name" placeholder="Your Name" />
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-input" name="email" id="email" placeholder="Your Email" />
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-input" name="password" id="password" placeholder="Password" />
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-input" name="re_password" id="re_password" placeholder="Repeat your password" />
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" id="submitSignUp" class="form-submit text-wrap" value="Sign up" />
                            </div>
                        </form>
                        <p class="loginhere">
                            Have already an account? <a href="#logInModal" data-bs-toggle="modal" data-bs-dismiss="modal" class="loginhere-link">Log in here</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End -->
    <!-- Log In Modal -->
    <div class="modal fade" id="logInModal" tabindex="-1" aria-labelledby="signUpModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="container modal-container">
                    <div class="signup-content">
                        <form action="login.php" method="POST" id="signup-form" class="signup-form">
                            <h2 class="form-title text-center">Log In</h2>
                            <div class="form-group">
                                <input type="email" class="form-input" name="email" id="email" placeholder="Your Email" />
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-input" name="password" id="password" placeholder="Password" />
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" id="submitLogIn" class="form-submit text-wrap" value="Log in" />
                            </div>
                        </form>
                        <span class="error-msg">Wrong pass</span>
                        <p class="loginhere">
                            Don't have an account? <a href="#signUpModal" data-bs-toggle="modal" data-bs-dismiss="modal" class="loginhere-link">Sign up here</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End -->
</body>

</html>