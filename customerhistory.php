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
    <link rel="stylesheet" href="assets/css/adminViews.css">
    
    <!--
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.css" rel="stylesheet"/>
        
    <link href ="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet"/>
    -->
    
    <style>
        table.dataTable thead .sorting:after,
        table.dataTable thead .sorting:before,
        table.dataTable thead .sorting_asc:after,
        table.dataTable thead .sorting_asc:before,
        table.dataTable thead .sorting_asc_disabled:after,
        table.dataTable thead .sorting_asc_disabled:before,
        table.dataTable thead .sorting_desc:after,
        table.dataTable thead .sorting_desc:before,
        table.dataTable thead .sorting_desc_disabled:after,
        table.dataTable thead .sorting_desc_disabled:before {
            bottom: .5em;
        }
    </style>
    
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
                    <li class="nav-item" id="profile"><a class="nav-link" href="profile.php">Profile</a></li>
                    <li class="nav-item" id="boss"><a class="nav-link active" href="admin.html">Admin</a></li>
                </ul><a id="loginbtn" class="btn btn-primary border-0 border-dark ms-md-2" role="button" onclick="logout()" style="background: #171e28;--bs-primary: #052065;--bs-primary-rgb: 5,32,101;">Logout</a>
            </div>
        </div>
    </nav>
    <div class="container">
        <nav class="nav" aria-label="Secondary navigation" >
            <!-- <a class="nav-link" href="#" >Home</a> -->
            <a class="nav-link" href="admin.html">Update Services</a>
            <a class="nav-link" href="customerhistory.php">Payment History</a>
            <a class="nav-link" href="adminView.php">View/Update Customers</a> 
        </nav>
    </div>
    <main class="container">
    <div class="col md-6">
    <form id="my-form" action="./assets/php/historyentry.php" method="post">
        <div class="form-group mb-3" style="float:left;">
            <label class="form-label">Customer ID</label><input class="form-control" type="cid" id="cid" name="id">
        </div>
        <!--
        <div class="form-group mb-3" style="float:left;">
            <label class="form-label">Customer Name</label><input class="form-control" type="cid" id="cid" name="id">
        </div>
        -->
        <div class="form-group mb-3" style="float:left;">
            <label class="form-label">Confirmation Number</label><input class="form-control" type="confirm" id="confirm" name="confirm">
        </div>
        <div class="form-group mb-3" style="float:left;">
            <label class="form-label">Date</label><input class="form-control" type="date" id="date" name="date">
        </div>
        <!--
        <div class="form-group mb-3" style="float:left;">
            <label class="form-label">Service Type</label><input class="form-control" type="cid" id="cid" name="id">
        </div>
        -->
        <div class="form-group mb-3" style="float:left;">
            <label class="form-label">Payment Type</label><input class="form-control" type="type" id="type" name="type">
        </div>
        <div class="form-group mb-1" style="float:left; bottom:30px;">
            </br>
            <button class="btn btn-primary ms-1" id="form-btn-1" type="submit" name="submit">Add</button>
            <button class="btn btn-primary ms-1" id="form-btn-2" type="reset" name="reset" onclick="refresh()">Refresh</button>
        </div>
    </form>
    </div>
    <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">ID

      </th>
      <th class="th-sm">Customer Name

      </th>
      <th class="th-sm">Confirmation Number

      </th>
      <th class="th-sm">Date

      </th>
      <th class="th-sm">Service Type

      </th>
      <th class="th-sm">Payment Type

      </th>
    </tr>
  </thead>
  <tbody id="exampleid">
      <!--
    <tr>
      <td id="id"></td>
      <td id="name"></td>
      <td id="confirm"></td>
      <td id="date"></td>
      <td id="service"></td>
      <td id="type"></td>
    </tr>
    -->
  </tbody>
  <!--
  <tfoot>
    <tr>
      <th>Name
      </th>
      <th>Position
      </th>
      <th>Office
      </th>
      <th>Age
      </th>
      <th>Start date
      </th>
      <th>Salary
      </th>
    </tr>
  </tfoot>
  -->
</table>

        
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!--
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    -->
    <!--<script src="assets/js/admin-comfimation.js"></script>-->
    <script>
        if(localStorage.getItem('status') == null) {
            //document.getElementById('loginbtn').style.display = 'visible';
            //document.getElementById('logoutbtn').style.display = 'none';
            document.getElementById('profile').style.display = 'none';
        }
        if(localStorage.getItem('status') != null) {
            //document.getElementById("logbtn").innerHTML = "Logout";
            //document.getElementById("loginbtn").style.display = 'none';
            //document.getElementById('logoutbtn').style.display = 'visible';
            document.getElementById('profile').style.display = 'visible';
            document.getElementById('loginbtn').innerHTML = "Logout";
        }
        

        function logout() {
            var logbtn = document.getElementById('loginbtn');
            if(logbtn.innerHTML == "Login") {
                location.href = "login.php";
            }
            if(logbtn.innerHTML == "Logout") {
                document.getElementById('loginbtn').innerHTML = "Login";
                localStorage.clear();
                location.href = "index.html";
            }
        }
        
        function refresh() {
            location.href = "customerhistory.php";
        }
    </script>
        
    <script>
        /*
        $(document).ready(function() {
          $('#dtBasicExample').DataTable({
            
            "scrollY": "200px",
            "scrollCollapse": true,
            
            processing: true,
            serverSide: true,
            "paging": true,
            "pagingType": "simple_numbers", // "simple" option for 'Previous' and 'Next' buttons only
          $('.dataTables_length').addClass('bs-select');
          });
          */
          
    </script>
   
    <script>
        var check = {};
        var active = "";
        check.id = JSON.stringify(localStorage.getItem('id'));
        
        $(document).ready(function(){
        $.ajax({
            url:"https://crystalclearwestsac.com/assets/php/history.php",
            method: "post",
            //data: check,
            datatype: "json",
            success: function(res) {
                console.log(res);
                //JSON.stringify(res);
                active = JSON.parse(res);
                //alert(active);
                //alert(active[0].cid);
                //alert(active[0].confirm);
                //alert(active[0].type);
                //alert(active[0].DATE);
                //alert(active[0].cname);
                //alert(active.length);
                //document.getElementById('test').innerHTML = active[0].confirm;
                /*
                for(let i=0; i<active.length; i++) {
                    document.getElementById('id').innerHTML+=active[i].cid;
                    document.getElementById('confirm').innerHTML+=active[i].confirm;
                    document.getElementById('type').innerHTML+=active[i].type;
                    document.getElementById('date').innerHTML+=active[i].DATE;
                    document.getElementById('name').innerHTML+=active[i].cname;
                    document.getElementById('service').innerHTML+=active[i].serviceName;
                }
                */
                var reversal = active.reverse();
                $.each(active, function (key, value) {
							$('#exampleid').append("<tr>\
										<td>"+value.cid+"</td>\
										<td>"+value.cname+"</td>\
										<td>"+value.confirm+"</td>\
										<td>"+value.DATE+"</td>\
										<td>"+value.serviceName+"</td>\
										<td>"+value.type+"</td>\
										</tr>");
						})
            },
            error: function(res) {
                alert("Error!");
            }
        }
        );
        });
        
        //alert(active);
        
    </script>
</body>

</html>