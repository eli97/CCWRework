<?php

    //connect via PDO
    $dbname = "crystalcleartestdb";
    $dbuser = "dev";
    $dbpass = "1234";
    $dbhost = "localhost";

    try{
        $pdo = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpass);
    }
    catch (PDOException $err){
        echo "Database connection problem: " . $err->getMessage();
        exit();  
    }

    $stmt = $pdo->prepare("SELECT * FROM `customer`");
    $stmt->execute();
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);


    print_r($services);

    $pdo = null;
    $stmt = null;


/*  TESTING WITH mysqli

    //connect to DB
    $conn = mysqli_connect('localhost', 'dev', '1234', 'crystalcleartestdb');

    //check connection
    if(!$conn) {
        echo 'Connection Error: ' . mysqli_connect_error();
    } 

    $sql = 'SELECT * FROM customer'; 

    //make query and return result
    $result = mysqli_query($conn, $sql);

    //fetch resulting rows as an array
    $customers = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //free data from memory
    mysqli_free_result($result);

    //close connection
    mysqli_close($conn);

    //just to view result from array
    print_r($customers);

*/
?>