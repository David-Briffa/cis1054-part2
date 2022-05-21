<?php
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/db-inc.php';
require_once __DIR__ . '/session.php';
$db = new Db();

function cleanStr($string)
{
    $string = trim($string);
    $string = stripcslashes($string);
    $string = strip_tags($string);
    $string = htmlspecialchars($string);

    return $string;
}

function validateName($name)
{
    if (strlen($name) > 100) {
        return false;
    }
    return true;
}

function validateNumber($number)
{
    if (strlen($number) > 45) {
        return false;
    }
    return true;
}

function validateEmail($email)
{
    if (strlen($email) > 45 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    return true;
}

if (isset($_REQUEST["submit"])) {

    $name = $_REQUEST["name"];
    if (empty($name)) {
        $error = true;
        $resultMessage = "Error: A name is required for the message to be sent. <br> Please try again.";
    } else if (!validateName($name)) {
        $error = true;
        $resultMessage = "There was an error with your inserted name. <br> Please try again.";
    }
    $name = cleanStr($name);

    $number = $_REQUEST["number"];
    if (!validateNumber($number)) {
        $error = true;
        $resultMessage = "There was an error with your number. <br> Please try again.";
    }
    $number = cleanStr($number);

    $email = $_REQUEST["email"];
    if (!validateEmail($email)) {
        $error = true;
        $resultMessage = "There was an error with your email. <br> Please try again.";
    }

    $message = $_REQUEST["message"];
    if (empty($name)) {
        $error = true;
        $resultMessage = "Error: A message is required. <br> Please try again.";
    } else if (!cleanStr($message)) {
        $error = true;
        $resultMessage = "There was an error with your message. <br> Please try again.";
    }

    if (!$error) {
        $resultMessage = "Message sent. <br> Have a good day!";
    }

    $sql = "INSERT INTO menu.usr_msgs (msg_name, msg_number, msg_email, msg_content)
             VALUES (?, ?, ?, ?);
             "; //creating template for SQL statement using '?' as placeholders
    $params = [$name, $number, $email, $message]; //array of parameters that will take the place of said placeholders


    $stmt = $db->connect()->prepare($sql); //preparation of statement using template ($sql)
    $stmt->bind_param("ssss", ...$params); //binding of statement (i.e. substituting parameters inside the bound statement)

    $stmt->execute();

    echo $twig->render('formResult.html');
} else {
    echo $twig->render('404.html');
}
