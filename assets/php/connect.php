<?php 
    $servername = "localhost";
    $username = "username";
    $password = "password";
    $database = "database_name";
    
    mysql_connect($servername, $username, $password);
    mysql_select_db($database);
?>