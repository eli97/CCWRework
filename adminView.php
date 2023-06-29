<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="google-signin-client_id" content="292091807783-ca0u6h3tmm137rmnnfq3i0f1iv85fv34.apps.googleusercontent.com.apps.googleusercontent.com">
    <link rel="icon" type="image/x-icon" href="images\favicon.ico" >
    <link rel="stylesheet" href="assets/css/Data-table.css">
    <script defer src="../scripts/Data-table.js"></script>
    <link rel="stylesheet" href="assets/css/updateTable.css">
    <link rel="stylesheet" href="assets/css/adminViews.css">




    <title>View/Update Customer Information</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!-- <script src="https://markcell.github.io/jquery-tabledit/assets/js/tabledit.min.js"></script> -->
    <script src="assets\js\tableditAdminView.js"></script>
 </head>
 <body>
 <nav class="navbar navbar-light navbar-expand-md py-3">
        <div class="container"><a class="navbar-brand d-flex align-items-center" href="#"><span><a href="index.html"><img src="assets/img/CClogo2.svg" width="248" height="79"></a></span></a>
        <a class="btn btn-primary border-0 border-dark ms-md-2" role="button" href="login.html" style="background: #171e28;--bs-primary: #052065;--bs-primary-rgb: 5,32,101;">Log out</a>
        </div>
    </nav>

    <div class="container">
        <nav class="nav" aria-label="Secondary navigation" >
            <!-- <a class="nav-link" href="#" >Home</a> -->
            <a class="nav-link" href="admin.html">Update Services</a>
            <a class="nav-link" href="customerhistory.php">Payment History</a>
            <a class="nav-link" href="adminView.php">View/Update Customers</a>   
            <a class="nav-link" href="reviewPost.html">Reviews</a> 
        </nav>
    </div>


  <div class="container">
   <h3 align="center" class="title" >View/Update Customer Information</h3>
   <br />
   <div class="panel panel-default">
    <!-- <div class="panel-heading">Customers:</div> -->
    <div class="panel-body">
     <div class="table-responsive">
      <table id="customer_table" class="table table-bordered table-striped">
       <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Street</th>
            <th>City</th>
            <th>State</th>
            <th>Email</th>
            <th>Filter Washes</th>
            <th>Subscription date</th>
            <th>Service</th>
        </tr>
       </thead>
       <tbody></tbody>
      </table>
     </div>
    </div>
   </div>
  </div>
  <br />
  <br />
 </body>
</html>

<script type="text/javascript" language="javascript" >
$(document).ready(function(){

 var dataTable = $('#customer_table').DataTable({
  "processing" : true,
  "serverSide" : true,
  "order" : [],
  "ajax" : {
   url:"fetchView.php",
   type:"POST"
  }
 });

 $('#customer_table').on('draw.dt', function(){
  $('#customer_table').Tabledit({
   url:'actionView.php',
   deleteButton: false,
   dataType:'json',
   columns:{
    identifier : [0, 'cid'],
    editable:[[1, 'cname'], [2, 'phone'], [3, 'street'], [4, 'city'],[5, 'state'],[7, 'filterWashes'],[8, 'subscriptionDate'],[9, 'serviceName', '{"Basic":"Basic","Chemical":"Chemical","Full":"Full"}']]
   },
   restoreButton:false,
   onSuccess:function(data, textStatus, jqXHR)
   {
    if(data.action == 'delete')
    {
     $('#' + data.id).remove();
     $('#customer_table').DataTable().ajax.reload();
    }
   }
  });
 });
  
}); 
</script>