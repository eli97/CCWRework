<?php

ob_start();

error_reporting(E_ALL & ~E_NOTICE);
define("DB_HOST", "localhost");
define("DB_NAME", "rystaly5_CrystClearMainDB");
define("DB_CHARSET", "utf8");
define("DB_USER", "rystaly5_cbearquiver");
define("DB_PASSWORD", "SvenThePlant!");

try{
    $pdo = new PDO("mysql:host=" . DB_HOST . ";charset=" . DB_CHARSET . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
} catch (Exception $ex) { exit($ex->getMessage()); }

/*
$stmt = $pdo->prepare("SELECT * FROM `CUSTOMER`");
$stmt->execute();
$customers = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt=null;

$i = 0;
*/
$id = json_decode($_POST["submit"]);
//echo $id;
/*
foreach($customers as $customer) {
    if($customer['gid'] == $id) {
        $stmt = $pdo->prepare("UPDATE CUSTOMER SET phone=:phone, street=:street, city=:city, state=:state, zip=:zip WHERE gid=:id");
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':street', $street, PDO::PARAM_STR);
        $stmt->bindParam(':city', $city, PDO::PARAM_STR);
        $stmt->bindParam(':state', $state, PDO::PARAM_STR);
        $stmt->bindParam(':zip', $zip, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        
        $phone = validatePhone($_POST["phonenumber"]);
        $street = sanitize($_POST["street"]);
        $city = sanitize($_POST["city"]);
        $state = sanitize($_POST["state"]);
        $zip = sanitize($_POST["zipcode"]);
        
        $stmt->execute();
        $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $stmt = null;
        $pdo = null;
        
        header("Location: https://crystalclearwestsac.com/profile.php", 301);
        exit();
    }   
}
*/

    $stmt = $pdo->prepare("UPDATE CUSTOMER SET phone=:phone, street=:street, city=:city, state=:state, zip=:zip WHERE gid=:id");
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':street', $street, PDO::PARAM_STR);
    $stmt->bindParam(':city', $city, PDO::PARAM_STR);
    $stmt->bindParam(':state', $state, PDO::PARAM_STR);
    $stmt->bindParam(':zip', $zip, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        
        
    $phone = validatePhone($_POST["phonenumber"]);
    $street = sanitize($_POST["street"]);
    $city = sanitize($_POST["city"]);
    $state = sanitize($_POST["state"]);
    $zip = sanitize($_POST["zipcode"]);
    $id = sanitize($_POST["submit"]);
    
    $stmt->execute();
    $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    $stmt = null;
    $pdo = null;
        
    header("Location: https://crystalclearwestsac.com/profile.php");
    exit();


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


    function validatePhone($phone)
    {
        //Replace any character that's not 0-9 with an empty value
        $strippedPhone = preg_replace('/[^0-9]/', '', $phone);

        // Checks if the string is exactly 10 numbers
        if(preg_match('/^[0-9]{10}+$/', $strippedPhone)) 
        {
            return "$phone";
        } 
        else 
        {
            return "Invalid";
        }
    }
?>