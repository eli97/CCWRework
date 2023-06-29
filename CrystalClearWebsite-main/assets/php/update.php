<?php
    include_once('connect.php');
<?php
    //header('location: ../../profile.php');
    $conn = new mysqli('localhost', 'rystaly5_cbearquiver', 'SvenThePlant!', 'rystaly5_CrystClearMainDB');

    if (!$conn) {
        echo 'Connection error: ' . mysqli_connect_error();
    }

    // Test Data
    $cid = $_GET['id'];
    $sql = "SELECT * FROM customer WHERE cid = '$cid'";
    $result = mysqli_query($conn, $sql);
    $customer = mysqli_fetch_assoc($result);

    mysqli_free_result($result);

    // taking input values from the update form
    //sanitize($firstname) = $_REQUEST['firstname'];
    //sanitize($lastname) = $_REQUEST['lastname'];
    sanitize($street) = $_REQUEST['street'];
    sanitize($city) = $_REQUEST['city'];
    sanitize($state) = $_REQUEST['state'];
    sanitize($zipcode) = $_REQUEST['zipcode'];  // missing field in database
    sanitize($phonenumber) = $_REQUEST['phonenumber'];
    //sanitize($email) = $_REQUEST['email'];

    // clean up inputs to match database fields
    $cname = $firstname . ' ' . $lastname;
    
    // If the phone number doesn't validate, do something
    if (validatePhone($phone) != "OK") 
    {
        //return "Invalid Phone Number";
        $phone = 1231231234
    }


    // insert the values into the database
    $sql = "INSERT INTO tablename (cname, street, city, state, phone, email) VALUES ($cname, $street, $city, $state, $phonenumber, $email)";


    //````` ADDITIONAL FUNCTIONS FOR SANITATION/VALIDATION `````
    //

    function validatePhone($phone)
    {
        //Replace any character that's not 0-9 with an empty value
        $strippedPhone = preg_replace('/[^0-9]/', '', $phone);

        // Checks if the string is exactly 10 numbers
        if(preg_match('/^[0-9]{10}+$/', $strippedPhone)) 
        {
            return "OK";
        } 
        else 
        {
            return "NG";
        }
    }

    // Input sanitization function
    //
    function sanitize($input) 
    {
      if(is_array($input)):
        foreach($input as $key=>$value):
          $result[$key] = sanitize($value);
        endforeach;
      else:
        $result = htmlentities($input, ENT_QUOTES, 'UTF-8');
      endif;

      return $result;
    }
    
?>