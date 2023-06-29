<?php

    header('Access-Control-Allow-Origin: *');

    header('Access-Control-Allow-Methods: GET, POST');

    header("Access-Control-Allow-Headers: X-Requested-With");

    error_reporting(E_ALL & ~E_NOTICE);
    define("DB_HOST", "localhost");
    define("DB_NAME", "rystaly5_CrystClearMainDB");
    define("DB_CHARSET", "utf8");
    define("DB_USER", "rystaly5_cbearquiver");
    define("DB_PASSWORD", "SvenThePlant!");

    try{
        $pdo = new PDO("mysql:host=" . DB_HOST . ";charset=" . DB_CHARSET . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
    } catch (Exception $ex) { exit($ex->getMessage()); }

    $stmt = $pdo->prepare("SELECT * FROM `CUSTOMER`");
    $stmt->execute();
    $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $pdo = null;
    $stmt = null;

    
    //print_r($_POST);
    //print_r($customers);

    $i = 0;
    $checkid = json_decode($_POST['id']);

    foreach($customers as $customer) {
        if($customer['gid'] == $checkid) {
            //print_r($customers[$i]);
            //echo "<script type='text/javascript'>window.top.location='https://crystalclearwestsac.com/profile.php';</script>"; exit;

            try{
                $pdo = new PDO("mysql:host=" . DB_HOST . ";charset=" . DB_CHARSET . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
            } catch (Exception $ex) { exit($ex->getMessage()); }
        
            $stmt = $pdo->prepare("UPDATE CUSTOMER SET serviceName='No Service' WHERE gid=$checkid");
            $stmt->execute();
            $pdo = null;
            $stmt = null;
            include './phpmailer/service_mailer.php';
            exit;
            //header('Location:https://crystalclearwestsac.com/profile.php');
        }
        $i++;
    }
    //header('Content-Type: application/json');
    //echo json_encode(['location' => 'https://crystalclearwestsac.com/account.php']);
    //exit;
    
?>