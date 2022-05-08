<?php 
require_once 'db-inc.php';
require 'session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favourites</title>
    <link rel="stylesheet" href="Styles/MenuStyle.css">
</head>
<body>
<?php include "header.html" ?>
<div class='container'>
    <u> Favourites </u> 
</div>
<?php

    if(empty($_SESSION["favourite"])) { 
        echo "<div class='emptyFavs'>";
            echo "<br><br>You have no favourite dishes, let's work on that.<br>";
            echo "<a href='menu.php'><br>Go to Menu</a>";
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

        foreach($_SESSION["favourite"] as $fav){
            $sqlquery = "SELECT * FROM menu.menuitems WHERE ID =" .$fav;
            $queryResult = mysqli_query($conn, $sqlquery);
            $resultCheck = mysqli_num_rows($queryResult);

        if($resultCheck > 0){
            while($row = mysqli_fetch_assoc($queryResult)){
                ?>
            <div class='container'>
                <div class='menu'><br><br>
                <?php
                    echo $row['Name']." ";
                    echo $row['Price']."€". "<br>"; ?>
                        <div class='description'>
                            <?php echo $row['Description']; ?>                                                                                                               
                            <br><br><div class='favourite'><br><br>
                                Remove dish from favourites! &#8594;
                                <form method='post'>
                                    <input type='submit' name='removeFavourite' class='favbutton' value=' &#x1F62D; ' /><br><br>
                                </form>
                            </div>
                        </div>
                </div>
      <?php  } ?>
            </div>
      <?php                      
        }
    } 
}
?>
<?php include "footer.html" ?>
</body>
</html>