<?php
    /*
    // connect to database
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

    $name = $customer['cname'];
    $street = $customer['street'];
    $city = $customer['city'];
    $state = $customer['state'];
    $phone = $customer['phone'];
    $email = $customer['email'];
    $zip = $customer['zip'];  //Todo: Add field to database
    
    
    //function to call db if needed. -----NEEDS PARAMETER TO TAKE IN GOOGLE ID TO CHECK WITH DB FOR APPROPRIATE CUSTOMER TO CHANGE-----
    function editdb() {
        $dbname = "rystaly5_CrystClearMainDB";
        $dbuser = "rystaly5_cbearquiver";
        $dbpass = "SvenThePlant!";
        $dbhost = "localhost";
        $id = $_POST['submit'];
        $email = $_POST['check1'];
        $name = $_POST['check2'];
        
        //$id = "<script>document.write(localStorage.getItem('id'));</script>";
        //echo $id;
        
        try{
            $pdo = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpass);
        }
        catch (PDOException $err){
            echo "Database connection problem: " . $err->getMessage();
            exit();  
        }
    
        sanitize();
        sanitize();
        sanitize();
        sanitize();
        validatephone();
    
        $stmt = $pdo->prepare("INSERT INTO CUSTOMER (phone, street, city, state, cname, email, filterWashes, serviceName, isActive, isAdmin, gid, zip)
                                VALUES ($phone,$street,$city,$state,:name,:email,$filterWashes,$serviceNames,$isActive,$isAdmin,:id,$zip)"); 
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        //echo $id;
        //$id = "<script>document.write(localStorage.getItem('id'));</script>";
        $stmt->execute();
        $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $pdo = null;
        $stmt = null;
        //include './phpmailer/service_mailer.php';
    }

    function sanitize($input) {
        
    }

    function validatephone($phone) {
        
    }

    //Set to 'No Service' when cancel service is pressed and conditions are met.
    if(isset($_POST['submit'])){
        editdb(); 
    }
    */
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="google-signin-client_id" content="550864736847-f9st76mo0i4h0bb5f8remug9pg01pjdg.apps.googleusercontent.com.apps.googleusercontent.com">
    <link rel="icon" type="image/x-icon" href="images\favicon.ico" >
    <title>Account</title>
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
    
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md py-3">
        <div class="container"><a class="navbar-brand d-flex align-items-center" href="#"><span><a href="index.html"><img src="assets/img/CClogo2.svg" width="248" height="79"></a></span></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-2"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-2">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="estimate.html">Estimates</a></li>
                    <li class="nav-item"><a class="nav-link" href="services.html">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                    <li class="nav-item" id="profile"><a class="nav-link" href="profile.php">Profile</a></li>
                    <li class="nav-item" id="boss" style="display:none"><a class="nav-link" href="admin.html">Admin</a></li>
                </ul>
                <a id="logbtn" class="btn btn-primary border-0 border-dark ms-md-2" role="button" onclick="logout()" style="background: #171e28;--bs-primary: #052065;--bs-primary-rgb: 5,32,101;">Logout</a>
            </div>
        </div>
    </nav>
    <h2 class="text-center">Update Account Info</h2>
    <div style="background: url(&quot;assets/img/water1.png&quot;) top / cover no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-end">
                    <!--
                    <div><label class="form-label" style="margin-top: 25px;">First Name:</label></div>
                    <div><label class="form-label" style="padding-top: 23px;">Last Name:</label></div>
                    -->
                    <div><label class="form-label" style="padding-top: 23px;">Street:</label></div>
                    <div><label class="form-label" style="padding-top: 23px;">City:</label></div>
                    <div><label class="form-label" style="padding-top: 23px;">State:</label></div>
                    <div><label class="form-label" style="padding-top: 23px;">Zip Code:</label></div>
                    <div><label class="form-label" style="padding-top: 23px;">Phone Number:</label></div>
                    <!--
                    <div><label class="form-label" style="padding-top: 23px;">E-mail:</label></div>
                    -->
                </div>
                
                <div id="update" class="col-md-6" style="width: 400px;">
                    <form id="my-form" action="./assets/php/infoupdate.php" method="post" style="height: 500px;">
                        <!--
                        <div class="form-group mb-3"><label class="form-label visually-hidden" for="firstname">First Name</label><input class="form-control" type="text" id="firstname" name="firstname" maxlength="24" autofocus="" value="<?php echo $name;?>"></div>
                        <div class="form-group mb-3"><label class="form-label visually-hidden" for="lastname">Last Name</label><input class="form-control" type="text" id="lastname" name="lastname" maxlength="24" value="<?php echo $name;?>"></div>
                        -->
                        <div class="form-group mb-3"><label class="form-label visually-hidden" for="street">Street</label><input class="form-control" type="text" id="street" name="street" maxlength="32" value=""></div>
                        <div class="form-group mb-3"><label class="form-label visually-hidden" for="city">City</label><input class="form-control" type="text" id="city" name="city" maxlength="32" value=""></div>
                        <div class="form-group mb-3"><label class="form-label visually-hidden" for="state">State</label><input class="form-control" type="text" id="state" name="state" maxlength="32" value=""></div>
                        <div class="form-group mb-3"><label class="form-label visually-hidden" for="zipcode">Zip Code</label><input class="form-control" type="number" id="zipcode" name="zipcode" maxlength="5" value=""></div>
                        <div class="form-group mb-3"><label class="form-label visually-hidden" for="phonenumber">Phone Number</label><input class="form-control" type="tel" id="phonenumber" name="phonenumber" maxlength="10" value=""></div>
                        <input id="check1" name="check1" value="0" style="display:none;">
                        <input id="check2" name="check2" value="0" style="display:none;">
                        <!--
                        <div class="form-group mb-3"><label class="form-label visually-hidden" for="email">E-mail</label><input class="form-control" type="email" id="email" name="email" maxlength="32" value="<?php echo $email;?>"></div>
                        -->
                        <button class="btn btn-light btn-lg border rounded-0" id="form-btn-1" type="submit" name="submit" value="0" style="background: rgba(0,0,0,0.4);padding-top: 0px;padding-bottom: 0px;padding-right: 10px;padding-left: 10px;font-size: 16px;">Update</button>
                        <button class="btn btn-light btn-lg border rounded-0" id="form-btn-2" type="reset" style="background: rgba(0,0,0,0.4);padding-top: 0px;padding-bottom: 0px;padding-right: 10px;padding-left: 10px;font-size: 16px;margin-left: 10px;" onclick="window.location.href='./profile.php'">Cancel</button>
                    </form>
                </div>
                
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
    <script defer src="./assets/js/Google-Sign-In.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://unpkg.com/jwt-decode/build/jwt-decode.js"></script>

    <script type="text/javascript">
        if(localStorage.getItem('status') != null) {
            document.getElementById("logbtn").innerHTML = "Logout";
        }

        function logout() {
            localStorage.clear();
            location.href = "login.php";
        }
    </script>
    
    <script type="text/javascript">
    
        /*
        $(document).ready(function() {
            $('#profileName').text(localStorage.getItem('name'));
            $('#name').text(localStorage.getItem('name'));
            $('#email').text(localStorage.getItem('email'));
            $('#image').attr("src", localStorage.getItem('image'));
        })
        */
        
        document.getElementById('form-btn-1').value = localStorage.getItem('id');
        document.getElementById('check1').value = localStorage.getItem('email');
        document.getElementById('check2').value = localStorage.getItem('name');
        
        var check = {};
        check.id = JSON.stringify(localStorage.getItem('id'));
        $.ajax({
        url:"https://crystalclearwestsac.com/assets/php/checkprofile.php",
        method: "post",
        data: check,
        datatype: "json",
        success: function(res) {
            //document.getElementById('name').innerHTML = res.cname;
            //document.getElementById('email').innerHTML = res.email;
            //var result = JSON.parse(res);
            //alert(res.phone);
            
            document.getElementById('boss').value = res.isAdmin;
            
            document.getElementById('phonenumber').value = res.phone;
            if(document.getElementById('phonenumber').value == "undefined") {
                document.getElementById('phonenumber').value = '';
            }
            //$("input[name='phonenumber']").val(res.phone);
            document.getElementById('street').value = res.street;
            if(document.getElementById('street').value == "undefined") {
                document.getElementById('street').value = '';
            }
            document.getElementById('city').value = res.city;
            if(document.getElementById('city').value == "undefined") {
                document.getElementById('city').value = '';
            }
            document.getElementById('state').value = res.state;
            if(document.getElementById('state').value == "undefined") {
                document.getElementById('state').value = '';
            }
            document.getElementById('zipcode').value = res.zip;
            if(document.getElementById('zipcode').value == "undefined") {
                document.getElementById('zipcode').value = '';
            }
            
            //document.getElementById('filter').innerHTML = res.filterWashes;
            //document.getElementById('date').innerHTML = res.subscriptionDate;
            //document.getElementById('service').innerHTML = res.serviceName;
            /*
            if(document.getElementById('phonenumber').value == '' &&
                document.getElementById('street').value == '' &&
                document.getElementById('city').value == '' &&
                document.getElementById('state').value == '' &&
                document.getElementById('zipcode').value == '') {
                    document.getElementById('entry').style.display = 'block';
                    document.getElementById('update').style.display = 'none';
                    alert('entry');
                }
            else {
                document.getElementById('entry').style.display = 'none';
                document.getElementById('update').style.display = 'block';
                alert('update');
            }
            */
            
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
    
    /*$(document).ajaxComplete(function () {
        if(document.getElementById('phonenumber').value == '' &&
                document.getElementById('street').value == '' &&
                document.getElementById('city').value == '' &&
                document.getElementById('state').value == '' &&
                document.getElementById('zipcode').value == '') {
                    document.getElementById('entry').style.display = 'inline';
                    document.getElementById('update').style.display = 'none';
                    alert('entry is shown');
                }
            else {
                document.getElementById('entry').style.display = 'none';
                document.getElementById('update').style.display = 'inline';
                alert('update is shown');
            }
    });
    */
    </script>
    
    
    <script>
    /*
        if(document.getElementById('phonenumber').value == '' &&
                document.getElementById('street').value == '' &&
                document.getElementById('city').value == '' &&
                document.getElementById('state').value == '' &&
                document.getElementById('zipcode').value == '') {
                    document.getElementById('entry').style.display = 'inline';
                    document.getElementById('update').style.display = 'none';
                    alert('entry is shown');
                    alert(document.getElementById('state').value);
                }
            else {
                document.getElementById('entry').style.display = 'none';
                document.getElementById('update').style.display = 'inline';
                alert('update is shown');
                alert(document.getElementById('state').value);
            }
            */
    </script>
    
</body>

</html>