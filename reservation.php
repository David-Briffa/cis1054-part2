<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Styles/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Oswald:wght@300;400;500;600&family=Source+Serif+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap"
        rel="stylesheet" />
    <title>Restaurant Name</title>
</head>

<body>
    <?php
    require "db-inc.php";

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


         /*
         $sql = "INSERT INTO reservations (res_date, res_time, res_name, res_number, res_email, res_people)
                 VALUES ('{$date}', '{$time}', '{$name}', '{$number}', '{$email}', {$people});
                 ";

         $connect->query($sql);
         */

        $sql = "INSERT INTO reservations (res_date, res_time, res_name, res_number, res_email, res_people)
             VALUES (?, ?, ?, ?, ?, ?);
             ";
        $params = [$date, $time, $name, $number, $email, $people];

        $stmt = $conn->prepare($sql);

        $stmt->bind_param("sssssi", ...$params);
        $stmt->execute();
    }
    ?>

    <?php include "header.html" ?>

    <div class="middle">
        <div class="divider"></div>

        <div class="container blackBorder">
            <div class="img tableImg"></div>
            <span class="sideTxt">
                <h1>
                    <br>
                    Reservation completed.
                    <br>
                    <br>
                    See you soon!
                </h1>

                <h2>

                </h2>
        </div>

        <div class="divider"></div>
    </div>

    <?php include "footer.html" ?>

</body>

</html>