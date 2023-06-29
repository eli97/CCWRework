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

//$stmt=null;

$i = 0;
$id = sanitize($_POST["submit"]);
echo $id;

foreach($customers as $customer) {
    if($customer['gid'] != $id) {
        $stmt = $pdo->prepare("INSERT INTO CUSTOMER (phone, street, city, state, cname, email, filterWashes, serviceName, isActive, isAdmin, gid, zip)
                                VALUES (:phone,:street,:city,:state,:name,:email,:filterWashes,:serviceNames,:isActive,:isAdmin,:id,:zip)");
        
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':street', $street, PDO::PARAM_STR);
        $stmt->bindParam(':city', $city, PDO::PARAM_STR);
        $stmt->bindParam(':state', $state, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':filterWashes', 0);
        $stmt->bindValue(':serviceNames', "No Service", PDO::PARAM_STR);
        $stmt->bindValue(':isActive', 0);
        $stmt->bindValue(':isAdmin', 0);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->bindParam(':zip', $zip, PDO::PARAM_STR);
        
        $phone = validatePhone($_POST["phonenumber"]);
        $street = sanitize($_POST["street"]);
        $city = sanitize($_POST["city"]);
        $state = sanitize($_POST["state"]);
        $name = sanitize($_POST["check2"]);
        $email = sanitize($_POST["check1"]);
        //$filterWashes = $_POST["filterWashes"];
        //$serviceNames = $_POST["serviceNames"];
        //$isActive = $_POST["isActive"];
        //$isAdmin = $_POST["isAdmin"];
        $id = sanitize($_POST["submit"]);
        $zip = sanitize($_POST["zipcode"]);
        
        
        $stmt->execute();
        //$customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $pdo = null;
        $stmt = null;
        
        header("Location: https://crystalclearwestsac.com/profile.php", 301);
        exit();
    }
    
        $stmt = $pdo->prepare("UPDATE CUSTOMER SET phone=:phone, street=:street, city=:city, state=:state, zip=:zip");
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':street', $street, PDO::PARAM_STR);
        $stmt->bindParam(':city', $city, PDO::PARAM_STR);
        $stmt->bindParam(':state', $state, PDO::PARAM_STR);
        $stmt->bindParam(':zip', $zip, PDO::PARAM_STR);
        
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
*/


$stmt = $pdo->prepare("INSERT INTO CUSTOMER (phone, street, city, state, cname, email, filterWashes, serviceName, isActive, isAdmin, gid, zip)
                                VALUES (:phone,:street,:city,:state,:name,:email,:filterWashes,:serviceNames,:isActive,:isAdmin,:id,:zip)");
        
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':street', $street, PDO::PARAM_STR);
        $stmt->bindParam(':city', $city, PDO::PARAM_STR);
        $stmt->bindParam(':state', $state, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':filterWashes', 0);
        $stmt->bindValue(':serviceNames', "No Service", PDO::PARAM_STR);
        $stmt->bindValue(':isActive', 0);
        $stmt->bindValue(':isAdmin', 0);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->bindParam(':zip', $zip, PDO::PARAM_STR);
        
        $phone = validatePhone($_POST["phonenumber"]);
        $street = sanitize($_POST["street"]);
        $city = sanitize($_POST["city"]);
        $state = sanitize($_POST["state"]);
        $name = sanitize($_POST["check2"]);
        $email = sanitize($_POST["check1"]);
        //$filterWashes = $_POST["filterWashes"];
        //$serviceNames = $_POST["serviceNames"];
        //$isActive = $_POST["isActive"];
        //$isAdmin = $_POST["isAdmin"];
        $id = sanitize($_POST["submit"]);
        $zip = sanitize($_POST["zipcode"]);
        
        
        $stmt->execute();
        //$customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $pdo = null;
        $stmt = null;
        
        header("Location: https://crystalclearwestsac.com/profile.php", 301);
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