<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Styles/style.css" />
    <link rel="stylesheet" type="text/css" href="./Styles/heFoStyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Oswald:wght@300;400;500;600&family=Source+Serif+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet" />
    <title>Restaurant Name</title>
</head>

<body>
    <?php

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

    require "db-inc.php";

    if (isset($_REQUEST["submit"])) {
        $error = false;

        $date = $_REQUEST["date"];
        if (empty($date)) {
            $error = true;
            $resultMessage = "Error: Reservation date is required for the booking. <br> Please try again.";
        } else if (!validateDate($date)) {
            $error = true;
            $resultMessage = "There was an error with your reservation date. <br> Please try again.";
        }

        $time = $_REQUEST["time"];
        if (empty($time)) {
            $error = true;
            $resultMessage = "Error: Reservation time is required for the booking. <br> Please try again.";
        }

        $name = $_REQUEST["name"];
        if (empty($name)) {
            $error = true;
            $resultMessage = "Error: A name is required is required for the booking. <br> Please try again.";
        } else if (!validateName($name)) {
            $error = true;
            $resultMessage = "There was an error with your reservation name. <br> Please try again.";
        }
        $name = cleanStr($name);

        $number = $_REQUEST["number"];
        if (!validateNumber($number)) {
            $error = true;
            $resultMessage = "There was an error with your reservation number. <br> Please try again.";
        }
        $number = cleanStr($number);

        $email = $_REQUEST["email"];
        if (!validateEmail(filter_var($email, FILTER_SANITIZE_EMAIL))) {
            $error = true;
            $resultMessage = "There was an error with your reservation email. <br> Please try again.";
        }

        $people = $_REQUEST["peopleNumber"];
        if (empty($people)) {
            $error = true;
            $resultMessage = "Error: Number of people is required for the booking. <br> Please try again.";
        } else if (!validatePeople($people)) {
            $error = true;
            $resultMessage = "There was an error with the number of people in your reservation. <br> Please try again.";
        }

        if (!$error) {
            $resultMessage = "Reservation completed. <br> See you soon!";
        }
    }



    //To improve security even more and prevent any type of SQL injection (examples of SQL injections inputs: "intended value OR 1=1", "'); AND DROP TABLE --" ).
    $sql = "INSERT INTO reservations (res_date, res_time, res_name, res_number, res_email, res_people)
             VALUES (?, ?, ?, ?, ?, ?);
             "; //creating template for SQL statement using '?' as placeholders
    $params = [$date, $time, $name, $number, $email, $people]; //array of parameters that will take the place of said placeholders

    $stmt = $conn->prepare($sql); //preparation of statement using template ($sql)

    $stmt->bind_param("sssssi", ...$params); //binding of statement (i.e. substituting parameters inside the bound statement)


    $stmt->execute();
    ?>

    <?php include "header.html" ?>

    <div class="middle">
        <div class="divider"></div>

        <div class="container blackBorder">
            <div class="img tableImg"></div>
            <span class="sideTxt">

                <h1>
                    <?php echo $resultMessage ?>
                </h1>
                <a href="./booking.php">Back to Booking</a>
                <a href="./index.php">Go to Home</a>
            </span>

        </div>

        <div class="divider"></div>
    </div>

    <?php include "footer.html" ?>

</body>

</html>