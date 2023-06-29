<?php

include('assets\php\dbconn.php');

$column = array("cid", "cname", "phone", "street", "city", "state", "email", "filterWashes", "subscriptionDate", "serviceName");

$query = "SELECT * FROM customer ";

// search here ...
if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE cname LIKE "%'.$_POST["search"]["value"].'%" 
 OR street LIKE "%'.$_POST["search"]["value"].'%" 
 OR email LIKE "%'.$_POST["search"]["value"].'%" 
 OR phone LIKE "%'.$_POST["search"]["value"].'%" 
 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY cname DESC ';
}
$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connect->prepare($query);

$statement->execute();

$number_filter_row = $statement->rowCount();

$statement = $connect->prepare($query . $query1);

$statement->execute();

$result = $statement->fetchAll();

$data = array();

foreach($result as $row)
{
 $sub_array = array();
 $sub_array[] = $row['cid'];
 $sub_array[] = $row['cname'];
 $sub_array[] = $row['phone'];
 $sub_array[] = $row['street'];
 $sub_array[] = $row['city'];
 $sub_array[] = $row['state'];
 $sub_array[] = $row['email'];
 $sub_array[] = $row['filterWashes'];
 $sub_array[] = $row['subscriptionDate'];
 $sub_array[] = $row['serviceName'];
 $data[] = $sub_array;
}

function count_all_data($connect)
{
 $query = "SELECT * FROM customer";
 $statement = $connect->prepare($query);
 $statement->execute();
 return $statement->rowCount();
}

$output = array(
 'draw'   => intval($_POST['draw']),
 'recordsTotal' => count_all_data($connect),
 'recordsFiltered' => $number_filter_row,
 'data'   => $data
);

echo json_encode($output);

?>