<?php
require_once __DIR__.'/bootstrap.php';
require_once __DIR__.'/db-inc.php';
require_once __DIR__.'/session.php';
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


    if (isset($_REQUEST["submit"])) {
        $date = $_REQUEST["date"];
        $time = $_REQUEST["time"];
        $name = $_REQUEST["name"];
        $number = $_REQUEST["number"];
        $email = $_REQUEST["email"];
        $people = $_REQUEST["peopleNumber"];

        $d = \DateTime::createFromFormat('Y-m-d', $_REQUEST['date']);
        if (!$d) {
            die("Data errata");
        }


         
         $sql = "INSERT INTO menu.reservations (res_date, res_time, res_name, res_number, res_email, res_people)
                 VALUES ('{$date}', '{$time}', '{$name}', '{$number}', '{$email}', {$people});
                 ";

        $stmt = $db ->query($sql);
        echo $twig->render('reservation.html');
    }
    else {
        echo $twig->render('404.html');
    }

        
/*
        $sql = "INSERT INTO reservations (res_date, res_time, res_name, res_number, res_email, res_people)
             VALUES (?, ?, ?, ?, ?, ?);
             ";
        $params = [$date, $time, $name, $number, $email, $people];

        $stmt = $db ->connect($sql);
*/
require_once 'footer.php';
