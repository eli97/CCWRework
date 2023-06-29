<?php

    //connect via PDO -- Change these values to match live site database
    /*
    $dbname = "crystalcleartestdb";
    $dbuser = "dev";
    $dbpass = "1234";
    $dbhost = "localhost";

    error_reporting(E_ALL & ~E_NOTICE);
    define("DB_HOST", "localhost");
    define("DB_NAME", "rystaly5_CrystClearMainDB");
    define("DB_CHARSET", "utf8");
    define("DB_USER", "rystaly5_cbearquiver");
    define("DB_PASSWORD", "SvenThePlant!");

    try{
        $pdo = new PDO("mysql:host=" . DB_HOST . ";charset=" . DB_CHARSET . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
    }
    catch (PDOException $err){
        echo "Database connection problem: " . $err->getMessage();
        exit();  
    }

    $stmt = $pdo->prepare("SELECT * FROM `CUSTOMER`");
    $stmt->execute();
    $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $pdo = null;
    $stmt = null; 
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
    
        $stmt = $pdo->prepare("UPDATE CUSTOMER SET serviceName='No Service' WHERE gid=:id"); 
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        //echo $id;
        //$id = "<script>document.write(localStorage.getItem('id'));</script>";
        $stmt->execute();
        $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $pdo = null;
        $stmt = null;
        include './phpmailer/service_mailer.php';
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
    <title>Crystal Clear Service Manager</title>
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
        <div class="container"><a class="navbar-brand d-flex align-items-center" href="#"><span><a href="main.html"><img
                            src="assets/img/CClogo2.svg" width="248" height="79"></a></span></a><button
                data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-2"><span
                    class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-2">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="index.html">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="estimate.html">Estimates</a></li>
                    <li class="nav-item"><a class="nav-link" href="services.html">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                    <li class="nav-item" id="profile"><a class="nav-link" href="profile.php">Profile</a></li>
                    <li class="nav-item" id="boss" style="display:none"><a class="nav-link" href="admin.html">Admin</a></li>
                </ul><a class="btn btn-primary border-0 border-dark ms-md-2" role="button" onclick="logout()"
                    style="background: #171e28;--bs-primary: #052065;--bs-primary-rgb: 5,32,101;">Logout</a>
            </div>
        </div>
    </nav>
    <h2 class="text-center">Manage Services</h2>
    <div style="background: url(&quot;assets/img/water1.png&quot;) top / cover no-repeat;">
        <div class="container justify-content-center">
            <div class="row">
                <div class="col d-flex justify-content-center">
                    <div class="card p-5 content justify-content-center" style="width:750px">
                        <!--<h1 class="col d-flex justify-content-center">My Services</h1>-->
                            <!--current services-->
                            <div class="card text-center">

                                <div class="card-body">
                                    <!--
                                    <div class="row">
                                        <div class="col-md-4 text-center">
                                            <h5>Next Appointment</h5>
                                        </div>
                                        <div class="col-md-6 text-secondary">
                                            <h5 id="date"></h5>
                                        </div>
                                    </div>
                                    <hr>
                                    -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h5>Current Subscription</h5>
                                        </div>
                                        <div class="col-md-6 text-secondary">
                                            <h5 id="service"></h5>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4 d-inline-flex">
                                            <h5>Change Service</h5>
                                        </div>
                                        <div class="col-md-6">
                                            <h4>Basic Service</h4>
                                            <div id="paypal-button-container-P-9HF66130V58251053MNKGDKA"></div>

                                            <h4>Chem + Basket</h4>
                                            <div id="paypal-button-container-P-56D36467UM5356547MNLSN6A"></div>

                                            <h4>Full Service</h4>
                                            <label for="tierlist">Select a tier</label>
                                            <select name="tierlist" id="tierlist">
                                                <option value="none">None</option>
                                                <option value="1">Tier 1</option>
                                                <option value="2">Tier 2</option>
                                                <option value="3">Tier 3</option>
                                                <option value="4">Tier 4</option>
                                                <option value="5">Tier 5</option>
                                            </select>
                                            
                                            <!--
                                            <div class="dropdown">
                                                <button class="dropbtn">Tier List</button>
                                                <div class="dropdown-content">
                                                    <a href="" onclick="onclick()" value="1">Tier 1</a>
                                                    <a href="" onclick="onclick()" value="2">Tier 2</a>
                                                    <a href="" onclick="onclick()" value="3">Tier 3</a>
                                                    <a href="" onclick="onclick()" value="4">Tier 4</a>
                                                    <a href="" onclick="onclick()" value="5">Tier 5</a>
                                                </div>
                                            </div>
                                            -->
                                            
                                                    <div id="tier1" style="display:none" class="tier">
                                                        <hr>
                                                        <h5>Tier 1</h5>
                                                        <div id="paypal-button-container-P-5M55712851419515UMNLSLFI"></div>
                                                    </div>
                                                    <div id="tier2" style="display:none" class="tier">
                                                        <hr>
                                                        <h5>Tier 2</h5>
                                                        <div id="paypal-button-container-P-7DP89350A4104772AMOB5R2I"></div>
                                                    </div>
                                                    <div id="tier3" style="display:none" class="tier">
                                                        <hr>
                                                        <h5>Tier 3</h5>
                                                        <div id="paypal-button-container-P-5G4302032C805280UMOB5WVY"></div>
                                                    </div>
                                                    <div id="tier4" style="display:none" class="tier">
                                                        <hr>
                                                        <h5>Tier 4</h5>
                                                        <div id="paypal-button-container-P-0BP340016E096322YMOB55KA"></div>
                                                    </div>
                                                    <div id="tier5" style="display:none" class="tier">
                                                        <hr>
                                                        <h5>Tier 5</h5>
                                                        <div id="paypal-button-container-P-1T820724FE3270944MOB563Y"></div>
                                                    </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <!--
                                <form>
                                    <div class="col-md-3" style="margin-left: 20px">
                                        <input type="radio" onchange="service_change(basic)" name="basic_service" id=basicService value="BasicService">
                                        <label for="basicService">Basic Service</label>
                                        
                                    </div>
                                    <div class="col-md-3" style="margin-left: 20px">
                                        <input type="radio" onchange="service_change(chemBask)" name="basic_service" id=basicService value="BasicService">
                                        <label for="basicService">Chemical + Baskets</label>
                                    </div>
                                    <div class="col-md-3" style="margin-left: 20px">
                                        <input type="radio" onchange="service_change(basic)" name="basic_service" id=basicService value="BasicService">
                                        <label for="basicService">Full Service</label>
                                    </div>
                                </form>-->
                                <div class="row align-content-center">

                                    <!--Can add redirect to paypal when its available, for now it's just a prompt-->

                                    <form method="post" id="postsection">
                                        <div class="col-sm-8 mb-5"  style="float: none; margin: 0 auto;">
                                            <!--<button id="button1" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#popup">Change Service</button>
                                            <button id="button2" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#popup">Cancel Service</button>-->
                                            <button id="button1" class="btn btn-outline-danger btn-sm" name="cancel" value="0" style="display:none">Cancel Service </button>
                                        </div>
                                    </form>
                                        <div id="cancelsection" class="col-sm-8 mb-5" style="float: none; margin: 0 auto;">
                                            <button id="button2" class="btn btn-outline-danger btm-sm" data-bs-toggle="modal" data-bs-target="#popup" value="0" style="display:none">Cancel Service </button>
                                        </div>
                                        <!--
                                        <form method="post">
                                            <div class="col-sm-8 mb-5 align-content-center"  style="float: none; margin: 0 auto;">
                                                <button class="btn btn-outline-danger btn-sm">Change Service</button>
                                                <button class="btn btn-outline-danger btn-sm" name="cancel">Cancel Service</button>
                                            </div>
                                        -->
                                            <!--
                                            <div class="col-sm-5 mb-5" style="margin-top: 20px">
                                                <button class="btn btn-outline-danger btn-sm" name="cancel">Cancel Service</button>
                                            </div>
                                            
                                        </form>
                                        -->
                                </div>
                            </div>
                            <!--end-->
                        <div class="card-body">
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
                            <p>Please cancel your subscription on Paypal first.</p>
                        </div>
                        <div class="modal-footer">
                            <!--<button type="button" class="btn btn-primary" data-bs-dismiss="modal" data-bs-target="#confirm" onclick="confirmed()">Close</button>-->
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
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/Customizable-Carousel-swipe-enabled.js"></script>
    <script src="assets/js/Application-Form-1.js"></script>
    <script src="assets/js/Application-Form.js"></script>
    <script src="assets/js/Card-Carousel.js"></script>
    <script src="assets/js/dropdown-search-bs4.js"></script>
    <script src="assets/js/customerinfo.js" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <script type="text/javascript">
        function confirmed() {
            location.href = "login.php";
        }

        function logout() {
            localStorage.clear();
            location.href = "login.php";
        }
        
        $(document).ready(function() {
            $('#tierlist').on('change', function() {
                var val = $(this).val();
                $("div.tier").hide();
                $("#tier" + val).show();
            })
        })
            
            document.getElementById('button1').value = localStorage.getItem('id');
            //document.getElementById('button2').value = localStorage.getItem('id');

            var check = {};
            var active = 0;
            check.id = JSON.stringify(localStorage.getItem('id'));
            $.ajax({
                url:"https://crystalclearwestsac.com/assets/php/checkservice.php",
                method: "post",
                data: check,
                datatype: "json",
                success: function(res) {
                    //document.getElementById('date').innerHTML = res.subscriptionDate;
                    document.getElementById('service').innerHTML = res.serviceName;
                    document.getElementById('boss').value = res.isAdmin;
                    active = res.isActive;
                    
                    //alert("active in ajax is " + active);
                    
                    if(active == 1) {
                        //alert("alert is 1");
                        document.getElementById('button2').style.display = "inline";
                        document.getElementById('cancelsection').style.display = "inline";
                        document.getElementById('button1').style.display = "none";
                        document.getElementById('postsection').style.display = "none";
                    }
                    else {
                        //alert("alert is 0");
                        document.getElementById('button2').style.display = "none";
                        document.getElementById('cancelsection').style.display = "none";
                        document.getElementById('button1').style.display = "inline";
                        document.getElementById('postsection').style.display = "inline";
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
            /*
            document.getElementById('button2').value = active;
            alert("active out of ajax " + active);
            alert("button2 value is " + document.getElementById('button2').value);
            
            if(document.getElementById('button2').value == 1) {
                alert("alert is 1");
                document.getElementById('button2').style.display = "inline";
                document.getElementById('cancelsection').style.display = "inline";
                document.getElementById('button1').style.display = "none";
                document.getElementById('postsection').style.display = "none";
            }
            else if(document.getElementById('button2').value == 0){
                alert("alert is 0");
                document.getElementById('button2').style.display = "none";
                document.getElementById('cancelsection').style.display = "none";
                document.getElementById('button1').style.display = "inline";
                document.getElementById('postsection').style.display = "inline";
            }
            else {
                alert("it is neither 1 or 0");
            }
            */
        /*
        function onclick() {
            if(this.value == "1") {
                document.getElementById('paypal-button-container-P-5M55712851419515UMNLSLFI').style.display = "inline";
            }
            if(this.value == "2") {

            }
            if(this.value == "3") {

            }
            if(this.value == "4") {

            }
            if(this.value == "5") {

            }
        }
        */
    </script>

<!--Basic Service Button -->
<script src="https://www.paypal.com/sdk/js?client-id=Adgour_4agSkMWsIJ95JUgk_cF-xVX6TBaLwwMDrIISoPS8dNX7AvxFAg0sa9Cw_saQUBRaLflRtyLqy&vault=true&intent=subscription" data-sdk-integration-source="button-factory"></script>
<script>
  paypal.Buttons({
      style: {
          shape: 'pill',
          color: 'blue',
          layout: 'horizontal',
          label: 'subscribe'
      },
      createSubscription: function(data, actions) {
        return actions.subscription.create({
          /* Creates the subscription */
          plan_id: 'P-9HF66130V58251053MNKGDKA'
        });
      },
      onApprove: function(data, actions) {
        alert(data.subscriptionID); // You can add optional success message for the subscriber here
      }
  }).render('#paypal-button-container-P-9HF66130V58251053MNKGDKA'); 
</script>

<!--Chem + Basket Button-->
<script>
  paypal.Buttons({
      style: {
          shape: 'pill',
          color: 'blue',
          layout: 'horizontal',
          label: 'subscribe'
      },
      createSubscription: function(data, actions) {
        return actions.subscription.create({
          /* Creates the subscription */
          plan_id: 'P-56D36467UM5356547MNLSN6A'
        });
      },
      onApprove: function(data, actions) {
        alert(data.subscriptionID); // You can add optional success message for the subscriber here
      }
  }).render('#paypal-button-container-P-56D36467UM5356547MNLSN6A'); // Renders the PayPal button
</script>

<!--Full Service Buttons-->

<!--Tier 1-->
<script>
  paypal.Buttons({
      style: {
          shape: 'pill',
          color: 'blue',
          layout: 'horizontal',
          label: 'subscribe'
      },
      createSubscription: function(data, actions) {
        return actions.subscription.create({
          /* Creates the subscription */
          plan_id: 'P-5M55712851419515UMNLSLFI'
        });
      },
      onApprove: function(data, actions) {
        alert(data.subscriptionID); // You can add optional success message for the subscriber here
      }
  }).render('#paypal-button-container-P-5M55712851419515UMNLSLFI'); // Renders the PayPal button
</script>

<!--Tier 2-->
<script>
  paypal.Buttons({
      style: {
          shape: 'pill',
          color: 'blue',
          layout: 'horizontal',
          label: 'subscribe'
      },
      createSubscription: function(data, actions) {
        return actions.subscription.create({
          /* Creates the subscription */
          plan_id: 'P-7DP89350A4104772AMOB5R2I'
        });
      },
      onApprove: function(data, actions) {
        alert(data.subscriptionID); // You can add optional success message for the subscriber here
      }
  }).render('#paypal-button-container-P-7DP89350A4104772AMOB5R2I'); // Renders the PayPal button
</script>

<!--Tier 3-->
<script>
  paypal.Buttons({
      style: {
          shape: 'pill',
          color: 'blue',
          layout: 'horizontal',
          label: 'subscribe'
      },
      createSubscription: function(data, actions) {
        return actions.subscription.create({
          /* Creates the subscription */
          plan_id: 'P-5G4302032C805280UMOB5WVY'
        });
      },
      onApprove: function(data, actions) {
        alert(data.subscriptionID); // You can add optional success message for the subscriber here
      }
  }).render('#paypal-button-container-P-5G4302032C805280UMOB5WVY'); // Renders the PayPal button
</script>

<!--Tier 4-->
<script>
  paypal.Buttons({
      style: {
          shape: 'pill',
          color: 'blue',
          layout: 'horizontal',
          label: 'subscribe'
      },
      createSubscription: function(data, actions) {
        return actions.subscription.create({
          /* Creates the subscription */
          plan_id: 'P-0BP340016E096322YMOB55KA'
        });
      },
      onApprove: function(data, actions) {
        alert(data.subscriptionID); // You can add optional success message for the subscriber here
      }
  }).render('#paypal-button-container-P-0BP340016E096322YMOB55KA'); // Renders the PayPal button
</script>

<!--Tier 5-->
<script>
  paypal.Buttons({
      style: {
          shape: 'pill',
          color: 'blue',
          layout: 'horizontal',
          label: 'subscribe'
      },
      createSubscription: function(data, actions) {
        return actions.subscription.create({
          /* Creates the subscription */
          plan_id: 'P-1T820724FE3270944MOB563Y'
        });
      },
      onApprove: function(data, actions) {
        alert(data.subscriptionID); // You can add optional success message for the subscriber here
      }
  }).render('#paypal-button-container-P-1T820724FE3270944MOB563Y'); // Renders the PayPal button
</script>

</body>

</html>