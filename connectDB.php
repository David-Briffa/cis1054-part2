<?php
$hostName = "localhost"; 
$username = "root"; 
$password = "";
$dbName = "restaurantdb";
$table = "reservations";
$connect = mysqli_connect($hostName, $username, $password, $dbName);

if(!$connect) {
    echo "Error Code: " . mysqli_connect_errno() . "<br>";
    echo "Error Message: " . mysqli_connect_errno() . "<br>";
    exit;
}
?>