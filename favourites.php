<?php
require_once 'db-inc.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favourites</title>
    <link rel="stylesheet" href="Styles/MenuStyle.css">
    <link rel="stylesheet" href="Styles/heFoStyleWhite.css">
</head>

<body>
    <?php include "header.html" ?>
    <div class='container'>
        <u> Favourites </u>
    </div>
    <?php
    session_start();
    if (empty($_SESSION["favourite"])) {

        echo "<div class='emptyFavs'>";
        echo "<br><br>You have no favourite dishes, let's work on that.<br>";
        echo "<br><a class='favbutton' href='menu.php'>Go to Menu</a>";
        echo "</div>";
    }
    if (array_key_exists('removeFavourite', $_POST)) {
        removeFavourite();
    }
    function removeFavourite()
    {
        //unset($_SESSION["favourite"]);
        array_pop($_SESSION["favourite"]);
    }

    if (isset($_SESSION["favourite"])) {
        $fav = $_SESSION["favourite"];
        foreach ($_SESSION["favourite"] as $fav) {
            $sqlquery = "SELECT * FROM menu.menuitems WHERE ID =" . $fav;
            $queryResult = mysqli_query($conn, $sqlquery);
            $resultCheck = mysqli_num_rows($queryResult);

            if ($resultCheck > 0) {
                echo "<div class='container'>";
                while ($row = mysqli_fetch_assoc($queryResult)) {
                    echo "<div class='menu'>";
                    echo "<br><br>";
                    echo $row['Name'] . " ";
                    echo $row['Price'] . "€" . "<br>";
                    echo "<div class='description'>";
                    echo $row['Description'];
                    echo "<br><br>";
                    echo "<div class='favourite'>";
                    echo "<br><br>";
                    echo "Remove dish from favourites! &#8594;";
                    echo "<form method='post'>";
                    echo "<input type='submit' name='removeFavourite' class='favbutton' value=' &#x1F62D; ' />" . "<br><br>";
                    echo " </form>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
                echo "</div>";
            }
        }
    }
    ?>
    <?php include "footer.html" ?>
</body>

</html>