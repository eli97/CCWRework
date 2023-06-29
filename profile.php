<?php
/*
// connect to database - host, username, pw, databasename
    //$conn = new mysqli('localhost', 'dev', '1234', 'crystalcleartestdb');
    $conn = new mysqli('localhost', 'rystaly5_cbearquiver', 'SvenThePlant!', 'rystaly5_CrystClearMainDB');

    // check connection
    if (!$conn) {
        echo 'Connection error: ' . mysqli_connect_error();
    }

    // Test Data
    $sql = 'SELECT * FROM CUSTOMER';
    $result = mysqli_query($conn, $sql);
    $customers = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $customer = $customers[0];

    // free memory & close connection
    mysqli_free_result($result);
    mysqli_close($conn);
    */
    
    //function to call db if needed. -----NEEDS PARAMETER TO TAKE IN GOOGLE ID TO CHECK WITH DB FOR APPROPRIATE CUSTOMER TO CHANGE-----
    function editdb() {
        $dbname = "rystaly5_CrystClearMainDB";
        $dbuser = "rystaly5_cbearquiver";
        $dbpass = "SvenThePlant!";
        $dbhost = "localhost";
        $id = $_POST['cancel'];
        //$id = "<script>document.write(localStorage.getItem('id'));</script>";
        //echo $id;
        
        try{
            $pdo = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpass);
        }
        catch (PDOException $err){
            echo "Database connection problem: " . $err->getMessage();
            exit();  
        }
    
        $stmt = $pdo->prepare("DELETE FROM CUSTOMER WHERE gid=:id"); 
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        //echo $id;
        //$id = "<script>document.write(localStorage.getItem('id'));</script>";
        $stmt->execute();
        $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $pdo = null;
        $stmt = null;
        header("Location: https://crystalclearwestsac.com/login.php");
        //echo '<script type="text/javascript">confirmed()</script>';
        exit();

    }

    //Set to 'No Service' when cancel service is pressed and conditions are met.
    if(isset($_POST['cancel'])){
        editdb(); 
    }
    
?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="google-signin-client_id" content="550864736847-f9st76mo0i4h0bb5f8remug9pg01pjdg.apps.googleusercontent.com.apps.googleusercontent.com">
    <link rel="icon" type="image/x-icon" href="images\favicon.ico" >
    <title>Profile</title>
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
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/GoogleSignIn.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md py-3">
        <div class="container"><a class="navbar-brand d-flex align-items-center" href="#"><span><a href="index.html"><img src="assets/img/CClogo2.svg" width="248" height="79"></a></span></a>
        <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-2"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-2">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="estimate.html">Estimates</a></li>
                    <li class="nav-item"><a class="nav-link" href="services.html">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="review.html">Review</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                    <li class="nav-item" id="profile"><a class="nav-link active" href="profile.php">Profile</a></li>
                    <li class="nav-item" id="boss" style="display:none"><a class="nav-link" href="admin.html">Admin</a></li>
                </ul>
                <a id="logoutbtn" class="btn btn-primary border-0 border-dark ms-md-2" role="button" onclick="logout()"
                    style="background: #171e28;--bs-primary: #052065;--bs-primary-rgb: 5,32,101;">Logout</a>
            </div>
        </div>
    </nav>

    <h2 class="text-center">My Profile</h2>
    <div style="background: url(&quot;assets/img/water1.png&quot;) top / cover no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mt-1">
                    <div class="card text-center sidebar" style="max-width:18rem">
                        <div class="card-body">
                            <img id="image" class="rounded-circle" width="200">
                            <div class="data mt-3">
                                <h3 id="profileName"></h3>
                                <!--<a href="account.php">Update</a>-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 mt-1">
                    <div class="card mb-3 content" style="max-width:95%">
                        <h1 class="m-3 pt-3">About</h1>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>Name</h5>
                                </div>
                                <div class="col-md-9 text-secondary">
                                    <!--<p name="name"><?php #echo htmlspecialchars($customer['cname']);?></p>-->
                                    <p id="name"></p>
                                </div>
                            </div>
                            <!--<hr> -->
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>E-mail</h5>
                                </div>
                                <div class="col-md-9 text-secondary">
                                    <!--<p name="email"><?php #echo htmlspecialchars($customer['email']);?></p>-->
                                    <p id="email"></p>
                                </div>
                            </div>
                            <!--<hr> -->
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>Phone</h5>
                                </div>
                                <div class="col-md-9 text-secondary">
                                    <!--<p name="phone"><?php #echo htmlspecialchars($customer['phone']);?></p>-->
                                    <p id="phone"></p>
                                </div>
                            </div>
                            <!--<hr> -->
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>Address</h5>
                                </div>
                                <div class="col-md-9 text-secondary">
                                    <!--<p name="address">
                                     <?php #echo htmlspecialchars($customer['street']);?>
                                     <?php #echo "<br>";?>
                                     <?php #echo htmlspecialchars($customer['city'] . ", " . $customer['state'] . " ". $customer['zip']);?>
                                    </p>-->
                                    <text id="street"></text> <br>
                                    <text id="city"></text>, <text id="state"></text> <text id="zip"></text>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <a id="anchor1" class="col-sm-auto" href="account.php" style="display:none">Insert</a>
                                <a id="anchor2" class="col-sm-auto" href="accountupdate.php" style="display:none">Edit</a>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3 content" style="max-width:95%">
                        <h1 class="m-3">Account Information</h1>
                        <div class="card-body">
                            <!--
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>Next Appointment</h5>
                                </div>
                                <div class="col-md-9 text-secondary">
                                    <h5>12/31/2022</h5>
                                    <h5 id="date"></h5>
                                </div>
                            </div>
                            -->
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>Total of Filter Wash: </h5>
                                </div>
                                <div class="col-md-3 text-secondary">
                                    <!--<h5 name="numfilters"><?php #echo htmlspecialchars($customer['filterWashes']);?></h5>-->
                                    <h5 id="filter"></h5>
                                </div>
                                <!--
                                <div class="col">
                                    <h6> Add more </h6>
                                    <select class="form-select">
                                        <option selected>How many?</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                      </select>
                                </div>
                                -->
                                <div class="col">
                                    <!--<a class="btn btn-primary" float="right" role="button" href="">Paypal</a>-->
                                    <div id="smart-button-container">
                                        <div style="text-align: center;">
                                          <div id="paypal-button-container"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>Current Subscription</h5>
                                </div>
                                <div class="col-md-3 text-secondary">
                                    <!--<h5 name="servicename"><?php #echo htmlspecialchars($customer['serviceName']);?></h5>-->
                                    <h5 id="service"></h5>
                                    <a href="service_manager.php">Manage</a>
                                </div>
                                <!--
                                <div class="col-sm">
                                    <h6> Payment </h6>
                                </div>
                                <div class="col">
                                    <a class="btn btn-primary" float="right" role="button" href="">Paypal</a>
                                </div>
                                -->
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3 d-inline-flex">
                                    <h5>Payment History</h5>
                                </div>
                                
                                <div class="col-md-5 text-right">
                                    <p>Any and all payment history and payment invoices can be found via Paypal</p>
                                    <a type="button" href="https://www.paypal.com/us/signin" class="btn btn-primary">Paypal</a>
                                    <!--
                                    <div class="ratio " style="--bs-aspect-ratio: 44%;">
                                        <iframe src="customer-history-next.html" ></iframe>
                                    </div>
                                    -->
                                </div>
                                
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#popup">Delete Account</button>
                            </div>
                            <p id="warning" style="display:none; color:red;">Please first cancel paypal subscription before deleting.</p>
                        </div>
                    </div>
                </div>
            </div>



            <!--Account Deletion Popup Window-->
            <div class="modal fade" id="popup" tabindex="-1">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete your account?</p>
                        </div>
                        
                        <form method="post" id="postsection">
                            <div id="cancelsection" class="modal-footer" style="display:none;">
                                <button type="submit" id="button1" name="cancel" class="btn btn-primary" data-bs-dismiss="modal" data-bs-target="#confirm" value="0" onclick="confirmed()">Confirm</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                        
                            <div id="warningsection" class="modal-footer" style="display:none;">
                                <button type="button" id="button2" class="btn btn-primary" data-bs-dismiss="modal" onclick="notice()">Confirm</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        
                    </div>
                </div>
            </div>
            


        </div>
    </div>
    <footer class="text-center">
        <div class="container text-muted py-4 py-lg-5">
            <p>Servicing the greater Sacramento area<br>Sacramento, California 95825<br>email:
                no-reply@email.com<br>phone: (916) 123-4567<br><br></p>
            <p class="mb-0">Copyright © 2022 Crystal Clear</p>
        </div>
    </footer>
    <script src="https://www.paypal.com/sdk/js?client-id=AS9OF1qrA62ErCfktIrTM5P2pLO6lqdgqKPvdyhiuIW0VbVX7utCiohS10dJeFAYNAmubd9Wp4nfdFnl&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/Customizable-Carousel-swipe-enabled.js"></script>
    <script src="assets/js/Application-Form-1.js"></script>
    <script src="assets/js/Application-Form.js"></script>
    <script src="assets/js/Card-Carousel.js"></script>
    <script src="assets/js/dropdown-search-bs4.js"></script>
    <script src="https://apis.google.com/js/platform.js"></script>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script defer src="./assets/js/Google-Sign-In.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://unpkg.com/jwt-decode/build/jwt-decode.js"></script>
    <script src="assets/js/customer-history-payments.js"></script>

    <script>
        function confirmed() {
            localStorage.clear();
            //location.href = "login.php";
        }

        function notice() {
            document.getElementById('warning').style.display = "inline";
        }

        function logout() {
            localStorage.clear();
            location.href = "login.php";
        }
        
        document.getElementById('button1').value = localStorage.getItem('id');
        
        function initPayPalButton() {
            paypal.Buttons({
              style: {
                shape: 'pill',
                color: 'blue',
                layout: 'horizontal',
                label: 'buynow',
                tagline: true
              },

        createOrder: function(data, actions) {
            return actions.order.create({
              purchase_units: [{"description":"TEST ITEM","amount":{"currency_code":"USD","value":1}}]
            });
        },

        onApprove: function(data, actions) {
            return actions.order.capture().then(function(orderData) {
              
              // Full available details
              console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
    
              // Show a success message within this page, e.g.
              const element = document.getElementById('paypal-button-container');
              element.innerHTML = '';
              element.innerHTML = '<h3>Thank you for your payment!</h3>';
    
              // Or go to another URL:  actions.redirect('thank_you.html');
              
            });
        },

        onError: function(err) {
            console.log(err);
        }
        }).render('#paypal-button-container');
        }
        initPayPalButton();
        
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#profileName').text(localStorage.getItem('name'));
            $('#name').text(localStorage.getItem('name'));
            $('#email').text(localStorage.getItem('email'));
            $('#image').attr("src", localStorage.getItem('image'));
        })
        var check = {};
        check.id = JSON.stringify(localStorage.getItem('id'));
        
        var num = 0;
        
        $.ajax({
        url:"https://crystalclearwestsac.com/assets/php/checkprofile.php",
        method: "post",
        data: check,
        datatype: "json",
        success: function(res) {
            //document.getElementById('name').innerHTML = res.cname;
            //document.getElementById('email').innerHTML = res.email;
            document.getElementById('phone').innerHTML = res.phone;
            document.getElementById('street').innerHTML = res.street;
            document.getElementById('city').innerHTML = res.city;
            document.getElementById('state').innerHTML = res.state;
            document.getElementById('zip').innerHTML = res.zip;
            document.getElementById('filter').innerHTML = res.filterWashes;
            //document.getElementById('date').innerHTML = res.subscriptionDate;
            document.getElementById('service').innerHTML = res.serviceName;
            document.getElementById('service').value = res.serviceName;
            document.getElementById('boss').value = res.isAdmin;
            
            //alert(document.getElementById('service').value);
            if(typeof document.getElementById('service').value != "undefined") {
                num = 1;
            }
            else {
                num = 0;
            }
            
            if(num == 1) {
                document.getElementById('anchor1').style.display = "none";
                //document.getElementById('cancelsection').style.display = "none";
                document.getElementById('anchor2').style.display = "inline";
                //document.getElementById('warningsection').style.display = "inline";
            }
            else{
                document.getElementById('anchor1').style.display = "inline";
                //document.getElementById('cancelsection').style.display = "";
                document.getElementById('anchor2').style.display = "none";
                //document.getElementById('warningsection').style.display = "";
            }
            
            if(document.getElementById('service').value != "No Service" && document.getElementById('service').value != "undefined") {
                document.getElementById('cancelsection').style.display = "none";
                document.getElementById('warningsection').style.display = "inline";
            }
            
            if(document.getElementById('service').value == "No Service") {
                document.getElementById('cancelsection').style.display = "inline";
                document.getElementById('warningsection').style.display = "none";
            }

            if(document.getElementById('boss').value == 1) {
                document.getElementById('boss').style.display = "inline";
            }
            else {
                document.getElementById('boss').style.display = "none";
            }
        },
          error: function(res) {
              alert("Error!");
          }
        }
    );
    </script>
</body>

</html>
