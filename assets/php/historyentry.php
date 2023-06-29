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


$stmt = $pdo->prepare("INSERT INTO PAYMENT (cid, confirm, type, date)
                                VALUES (:cid,:confirm,:type,:date)");
        
        $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
        $stmt->bindParam(':confirm', $confirm, PDO::PARAM_STR);
        $stmt->bindParam(':type', $type, PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        

        $cid = $_POST["id"];
        $confirm = $_POST["confirm"];
        $type = $_POST["type"];
        $date = $_POST["date"];
        /*
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
        */
        try {
            $stmt->execute();
        }
        catch(exception $e) {
            echo "Error on inputs, please make sure Customer ID is matches customer.";
        }
        //$customers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pdo = null;
        $stmt = null;
        
        header("Location: https://crystalclearwestsac.com/customerhistory.php", 301);
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