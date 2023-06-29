<?php

include('assets\php\dbconn.php');

if($_POST['action'] == 'edit')
{
 $data = array(
    ':cid'  => $_POST['cid'],
    ':cname'  => $_POST['cname'],
    ':phone'  => $_POST['phone'],
    ':street'   => $_POST['street'],
    ':city'    => $_POST['city'],
    ':state'  => $_POST['state'],
    ':filterWashes'  => $_POST['filterWashes'],
    ':subscriptionDate'   => $_POST['subscriptionDate'],
    ':serviceName'    => $_POST['serviceName']
 );

 $query = "
 UPDATE customer 
 SET cid = :cid, 
 cname = :cname,
 phone = :phone, 
 street = :street, 
 city = :city, 
 state = :state, 
 filterWashes = :filterWashes, 
 subscriptionDate = :subscriptionDate, 
 serviceName = :serviceName
 WHERE cid = :cid
 ";
 $statement = $connect->prepare($query);
 $statement->execute($data);
 echo json_encode($_POST);
}

// ***    DELETE button disabled    ***
// if($_POST['action'] == 'delete')
// {
//  $query = "
//  DELETE FROM customer 
//  WHERE cid = '".$_POST["cid"]."'
//  ";
//  $statement = $connect->prepare($query);
//  $statement->execute();
//  echo json_encode($_POST);
//}

// $connect = mysqli_connect("localhost", "root", "", "test");
// $query = "
//  UPDATE customer SET ".$_POST["name"]." = '".$_POST["value"]."' 
//  WHERE cid = '".$_POST["pk"]."'";
// mysqli_query($connect, $query);

?>