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
    <title>Details</title>
    <link rel="stylesheet" href="./Styles/MenuStyle.css">
</head>
<body>
<?php include "header.html" ?>

<?php
$favID = $_GET['pid'];

if(array_key_exists('setFavourite', $_POST)) {
    setFavourite();
}
function setFavourite(){  
    global $favID;
    if(!isset($_SESSION["favourite"])){
        $favArray = array();
        $_SESSION["favourite"] = $favArray;
    }
    else{
    array_push($_SESSION["favourite"], $favID);
    
    echo "<div class='container'>";
        echo "favourite dish has been set<br>";
    echo "</div>";
    }
}


    if(isset($_GET['pid'])) { 
        $pid = $_GET['pid'];
        $sqlquery = "SELECT * FROM menu.menuitems WHERE ID = $pid;";
        $queryResult = mysqli_query($conn, $sqlquery);
        $resultCheck = mysqli_num_rows($queryResult);
        if($resultCheck > 0){
            echo "<div class='container'>";
            while($row = mysqli_fetch_assoc($queryResult)){
                echo "<div class='menu'><br>";
                echo "<br><br>";
                    echo $row['Name']." ";
                    echo $row['Price']."€". "<br>";
                        echo "<div class='description'>";
                            echo $row['Description'] . "<br>";
                            echo "<div class='favourite'>";
                                echo "<br><br>";
                                echo "Like this dish? Favourite it! &#8594;";
                                echo "<form method='post'>";
                                    echo "<input type='submit' name='setFavourite' class='favbutton' value=' &hearts; ' />" . "<br><br>";
                                echo " </form>";
                                echo "<br><br>";
                                echo "<form action='favourites.php' method='post'>";
                                    echo "<input type='submit' name='goToFavourites' class='favbutton' value='Go to favourites' />";
                                echo " </form>";
                            echo "</div>";
                        echo "</div>";
                echo "</div>";
        }
        echo "</div>";
    }
    

}



?>
<div class="divider">
    Restaurant
</div>
<?php include "footer.html" ?>


</body>
</html>