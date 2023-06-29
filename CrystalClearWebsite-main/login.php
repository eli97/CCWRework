<?php

    //connect via PDO -- Change these values to match live site database
    /*
    $dbname = "crystalcleartestdb";
    $dbuser = "dev";
    $dbpass = "1234";
    $dbhost = "localhost";
    */

    error_reporting(E_ALL & ~E_NOTICE);
    define("DB_HOST", "localhost");
    define("DB_NAME", "rystaly5_CrystClearMainDB");
    define("DB_CHARSET", "utf8");
    define("DB_USER", "rystaly5_cbearquiver");
    define("DB_PASSWORD", "SvenThePlant!");

    try{
        $pdo = new PDO("mysql:host=" . DB_HOST . ";charset=" . DB_CHARSET . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
    } catch (Exception $ex) { exit($ex->getMessage()); }

    $stmt = $pdo->prepare("SELECT * FROM `CUSTOMER`");
    $stmt->execute();
    $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $pdo = null;
    $stmt = null; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="google-signin-client_id" content="550864736847-f9st76mo0i4h0bb5f8remug9pg01pjdg.apps.googleusercontent.com">
    <link rel="icon" type="image/x-icon" href="images\favicon.ico" >
    <title>Login</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/material-icons.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/Application-Form.css">
    <link rel="stylesheet" href="assets/css/Articles-Cards-images.css">
    <link rel="stylesheet" href="assets/css/Card-Carousel-slider.css">
    <link rel="stylesheet" href="assets/css/Card-Carousel.css">
    <link rel="stylesheet" href="assets/css/Carousel_Image_Slider-mycarousel.css">
    <link rel="stylesheet" href="assets/css/Carousel_Image_Slider.css">
    <link rel="stylesheet" href="assets/css/Customizable-Carousel-swipe-enabled.css">
    <link rel="stylesheet" href="assets/css/dropdown-search-bs4.css">
    <link rel="stylesheet" href="assets/css/ensign-form-form.css">
    <link rel="stylesheet" href="assets/css/ensign-form.css">
    <link rel="stylesheet" href="assets/css/figloo-carousal.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="assets/css/Navbar-Right-Links-icons.css">
    <link rel="stylesheet" href="assets/css/NMDIG-Jumbotron-Advanced-Responsive-Tint-jumbotron-bg-responsive-tint.css">
    <link rel="stylesheet" href="assets/css/NMDIG-Jumbotron-Advanced-Responsive-Tint.css">
    <link rel="stylesheet" href="assets/css/Signup-page-with-overlay.css">
    <link rel="stylesheet" href="assets/css/GoogleSignIn.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md py-3">
        <div class="container"><a class="navbar-brand d-flex align-items-center" href="#"><span><a href="index.html"><img src="assets/img/CClogo2.svg" width="248" height="79"></a></span></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-2"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-2">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="estimate.html">Estimates</a></li>
                    <li class="nav-item"><a class="nav-link" href="services.html">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="review.html">Review</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                </ul>
                <a class="btn btn-primary border-0 border-dark ms-md-2" role="button" href="login.php" style="background: #171e28;--bs-primary: #052065;--bs-primary-rgb: 5,32,101;">Login</a>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row" style="background: url(&quot;assets/img/water1.png&quot;);">
            <div class="col-12 col-sm-6 col-md-6 col-xxl-4 site-form" style="margin: auto;width: 400px;">
                <form class="pulse animated" id="my-form" style="text-align: center;">
                   <!-- <div class="form-group mb-3">
                        <label class="form-label visually-hidden" for="email">Email Address</label>
                        <input class="form-control" type="text" id="email" name="email" required="" placeholder="Email"></div>
                    <div class="form-group mb-3">
                        <label class="form-label visually-hidden" for="phonenumber">Phone Number</label>
                        <input class="form-control" type="password" id="phonenumber" name="password" required="" placeholder="Password">
                    </div>
					-->
                    
 
                   
                    <div id="g_id_onload"
                         data-client_id="550864736847-f9st76mo0i4h0bb5f8remug9pg01pjdg"
                         data-context="signin"
                         data-ux_mode="popup"
                         data-callback="onSignIn"
                         data-auto_prompt="false">
                         
                         <?php /*
                            $id = '<script type="text/javascript"> getid(); </script>';
                            foreach($customers as $customer){ 
                                if($customer['gid'] == $id) {
                                    echo 'reach and validated condition the condition';
                                    header('Location:profile.php');
                                }
                                else {
                                    echo 'id did not match';
                                } 
                            }*/?> 
                    </div>
                    
                    <div class="g_id_signin" style="margin-bottom: 15px;"
                         data-type="standard"
                         data-size="large"
                         data-theme="outline"
                         data-text="sign_in_with"
                         data-shape="rectangular"
						 data-logo_alignment="center"
						align="center">
                    </div>

                    <div></div>
                    <!-- <div class="form-group mb-3"><label class="form-label visually-hidden" for="messages">Last Name</label></div><a class="btn btn-light btn-lg" role="button" id="form-btn-1" href="profile.html" style="background: #92c9ff;font-size: 15px;">Log in</a> -->
                    <div style="margin-top: 30px;">
                        <p style="margin-top: 16px;margin-bottom: -2px;">No account? Sign up with Google!</p>
                       <!-- <a class="btn btn-light btn-lg" role="button" id="form-btn-2" href="signup.html" style="background: #92c9ff;font-size: 15px;">Sign-Up</a> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
    <footer class="text-center">
        <div class="container text-muted py-4 py-lg-5">
            <p>Servicing the greater Sacramento area<br>Sacramento, California 95825<br>email: no-reply@email.com<br>phone: (916) 123-4567<br><br></p>
            <p class="mb-0">Copyright © 2022 Crystal Clear</p>
        </div>
    </footer>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/Customizable-Carousel-swipe-enabled.js"></script>
    <script src="assets/js/Application-Form-1.js"></script>
    <script src="assets/js/Application-Form.js"></script>
    <script src="assets/js/Card-Carousel.js"></script>
    <script src="assets/js/dropdown-search-bs4.js"></script>
    <script src="https://apis.google.com/js/platform.js"></script>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script defer src="../assets/js/Google-Sign-In.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://unpkg.com/jwt-decode/build/jwt-decode.js"></script>

    <script>
        /*
        function getid() {
            var id = localStorage.getItem('id');
            $.POST('login.php', {'id' : id}, function(data) {
                alert('reached this javascript');
            })
        } */
    </script>
</body>

</html>
