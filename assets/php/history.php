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

    $stmt = $pdo->prepare("SELECT PAYMENT.cid, PAYMENT.confirm, PAYMENT.type, PAYMENT.DATE, CUSTOMER.cname, CUSTOMER.serviceName FROM `PAYMENT` INNER JOIN CUSTOMER ON PAYMENT.cid=CUSTOMER.cid");
    $stmt->execute();
    $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $pdo = null;
    $stmt = null;

    $array = [];
    foreach($customers as $customer) {
        $array[] = array
        (
            'cid' => $customer['cid'],
            'confirm' => $customer['confirm'],
            'type' => $customer['type'],
            'DATE' => $customer['DATE'],
            'cname' => $customer['cname'],
            'serviceName' => $customer['serviceName']
        );
    }
    echo json_encode($array);
    exit();
?>