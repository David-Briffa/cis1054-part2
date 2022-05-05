<!--- This php file is the standard database connection file--->
<?php 
$dbServername = "localhost"; 
$dbUsername = "root"; 
$dbPassword = "password123";
$dbName = "menu";
$table = "reservations";
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

if(!$conn) {
    echo "Error Code: " . mysqli_connect_errno() . "<br>";
    echo "Error Message: " . mysqli_connect_errno() . "<br>";
    exit;
}
?>