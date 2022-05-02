<?php 
require_once 'db-inc.php';
include 'header.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favourites</title>
    <link rel="stylesheet" href="MenuStyle.css">
</head>
<body>
<div class='container'>
        Favourites
    </div>
<?php
    session_start();
    if(!isset($_SESSION["favourite"])){
        echo "<div class='container'>";
        echo "You have no favourite dishes &#x1F62D;";
        echo "</div>";
    }
    if(array_key_exists('removeFavourite', $_POST)) {
        removeFavourite();
    }
    function removeFavourite(){
        unset($_SESSION["favourite"]);
    }

    if(isset($_SESSION["favourite"])) { 
        $fav = $_SESSION["favourite"];
        $sqlquery = "SELECT * FROM menu.menuitems WHERE ID = $fav;";
        $queryResult = mysqli_query($conn, $sqlquery);
        $resultCheck = mysqli_num_rows($queryResult);
        if($resultCheck > 0){
            echo "<div class='container'>";
            while($row = mysqli_fetch_assoc($queryResult)){
                echo "<div class='menu'><br>";
                    echo $row['Name']." ";
                    echo $row['Price']."€". "<br>";
                        echo "<div class='description'>";
                            echo $row['Description'] . "<br>";
                            echo "<div class='favourite'>";
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
?>
</body>
</html>