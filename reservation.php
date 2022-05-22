<?php
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/db-inc.php';
require_once __DIR__ . '/session.php';
$db = new Db();

$createTB = ("CREATE TABLE Reservations(
        res_id SERIAL UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
        res_date DATE NOT NULL,
        res_time TIME NOT NULL,
        res_name TEXT NOT NULL,
        res_number TEXT NOT NULL,
        res_email TEXT NOT NULL,
        res_people TINYINT(8) NOT NULL
        );");

function cleanStr($string)
{
    $string = trim($string);
    $string = stripcslashes($string);
    $string = strip_tags($string);

    return $string;
}

function validateDate($date)
{
    $d = \DateTime::createFromFormat("Y-m-d", $date);
    $minDate = date("Y-m-d");

    if (($date < $minDate) || !$d) {

        return false;
    }
    return true;
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

function validatePeople($people)
{
    if ($people > 999 || !filter_var($people, FILTER_VALIDATE_INT)) {
        return false;
    }
    return true;
}


if (isset($_REQUEST["submit"])) {
    $error = false;
    $date = $_REQUEST["date"];
    if (empty($date)) {
        $error = true;
        $resultMessage = "Error: Reservation date is required for the booking. Please try again.";
    } else if (!validateDate($date)) {
        $error = true;
        $resultMessage = "There was an error with your reservation date. Please try again.";
    }

    $time = $_REQUEST["time"];
    if (empty($time)) {
        $error = true;
        $resultMessage = "Error: Reservation time is required for the booking. Please try again.";
    }

    $name = $_REQUEST["name"];
    if (empty($name)) {
        $error = true;
        $resultMessage = "Error: A name is required for the booking. Please try again.";
    } else if (!validateName($name)) {
        $error = true;
        $resultMessage = "There was an error with your reservation name. Please try again.";
    }
    $name = cleanStr($name);

    $number = $_REQUEST["number"];
    if (!validateNumber($number)) {
        $error = true;
        $resultMessage = "There was an error with your reservation number. Please try again.";
    }
    $number = cleanStr($number);

    $email = $_REQUEST["email"];
    if (!validateEmail(filter_var($email, FILTER_SANITIZE_EMAIL))) {
        $error = true;
        $resultMessage = "There was an error with your reservation email. Please try again.";
    }

    $people = $_REQUEST["peopleNumber"];
    if (empty($people)) {
        $error = true;
        $resultMessage = "Error: Number of people is required for the booking. Please try again.";
    } else if (!validatePeople($people)) {
        $error = true;
        $resultMessage = "There was an error with the number of people in your reservation. Please try again.";
    }

    if (!$error) {
        $resultMessage = "Reservation completed. See you soon!";
    }

    // DONE IN FUNCTION validateDate
    // $d = \DateTime::createFromFormat('Y-m-d', $_REQUEST['date']);
    // if (!$d) {
    //     die("Data errata");
    // }



    //To improve security even more and prevent any type of SQL injection (examples of SQL injections inputs: "intended value OR 1=1", "'); AND DROP TABLE --" ).
    $sql = "INSERT INTO menu.reservations (res_date, res_time, res_name, res_number, res_email, res_people)
             VALUES (?, ?, ?, ?, ?, ?);
             "; //creating template for SQL statement using '?' as placeholders
    $params = [$date, $time, $name, $number, $email, $people]; //array of parameters that will take the place of said placeholders


    $stmt = $db->connect()->prepare($sql); //preparation of statement using template ($sql)
    $stmt->bind_param("sssssi", ...$params); //binding of statement (i.e. substituting parameters inside the bound statement)

    $stmt->execute();

    echo $twig->render('formResult.html', ['resultMessage' => $resultMessage]);
} else {
    echo $twig->render('404.html');
}

require_once 'footer.php';