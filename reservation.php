<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php

$date = $_GET("date");
$time = $_GET("time");
$name = $_GET("name");
$number = $_GET("number");
$email = $_GET("email");

echo ("Date: $date, Time: $time, Name: $name, Number: $number, Email: $email, Number of people: $peopleNumber");

?>

</body>
</html>