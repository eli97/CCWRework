<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="google-signin-client_id" content="550864736847-f9st76mo0i4h0bb5f8remug9pg01pjdg.apps.googleusercontent.com.apps.googleusercontent.com">
    <link rel="icon" type="image/x-icon" href="images\favicon.ico" >
    <title>CrystalClearAdmin</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/stars-rating.css">
</head>

<body onload="adminDB();">

    <main class="container justify-content-center">
        <h1>Customers Review</h1>
        <div class="card  shadow p-3 mb-5 bg-white rounded  h-75">
            <div class="card-body">
                <h5 class="card-title">Customer Name: JOE</h5>
                <h5 class="card-title">Customer ID: 45</h5>
                <h5 class="card-title">Date Written: 11/02/2022</h5>
                <h5 class="card-tittle"> Stars Input </h5>
                <div>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star "></span>
                    <span class="fa fa-star "></span>
                </div>
                <h4>Review text</h4>
                <ul>
                    <p class="card-text">I just recently bought my house and the pool was covered in ali and green stuff. I called Daniel and he was able
                        clean within 3 weeks. He gave me some tips on how to keep it clean. I will definitly recommend Daniel.
                    </p>
                </ul>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" checked>
                    <label class="form-check-label" for="flexSwitchCheckDefault">Approve</label>
                  </div>

            </div>

        </div>
            <form action="assets/php/review.php" method="POST">
                <div id="reviewCards"></div>
                <button class="btn btn-primary" type="submit" name="approvalChanges">Submit Changes</button>
            </form>
    </main>
    

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
    <script src="assets/js/services.js" defer></script>
    <script src="assets/js/review-cards.js" defer></script>

    <script type="text/javascript">
        if(localStorage.getItem('status') != null) {
            document.getElementById("logbtn").innerHTML = "Logout";
        }
    </script>
</body>

</html>