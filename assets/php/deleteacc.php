<?php
    //header('location: ../../login.html');
    $conn = new mysqli('localhost', 'root', 'password1', 'crystalclear');

    if (!$conn) {
        echo 'Connection error: ' . mysqli_connect_error();
    }

    // Test data
    $cid = $_POST['id'];

    $sql = "DELETE FROM customer WHERE cid = '$cid'";
    mysqli_query($conn, $sql);

    //mysqli_free_result($result);
    mysqli_close($conn);

    echo '<script>window.location.replace("login.html")</script>';
?>