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
    else{   array_push($_SESSION["favourite"], $favID);   ?>

    <div class='container'>
        favourite dish has been set<br>
    </div>
    <?php
    }
}
    if(isset($_GET['pid'])) { 
        $pid = $_GET['pid'];
        $sqlquery = "SELECT * FROM menu.menuitems WHERE ID = $pid;";
        $queryResult = mysqli_query($conn, $sqlquery);
        $resultCheck = mysqli_num_rows($queryResult);

        if($resultCheck > 0){
        ?>
            <div class='container'>
                <?php while($row = mysqli_fetch_assoc($queryResult)){ ?>
                <div class='menu'><br><br>
                <?php
                    echo $row['Name']." ";
                    echo $row['Price'] ?> € <br>                   
                        <div class='description'>
                            <?php
                            echo $row['Description']?> <br>
                            <div class='favourite'><br><br>
                                Like this dish? Favourite it! &#8594;
                                <form method='post'>
                                    <input type='submit' name='setFavourite' class='favbutton' value=' &hearts; ' /><br><br>
                                </form>                          
                                <form action='favourites.php' method='post'>
                                    <br><input type='submit' name='goToFavourites' class='favbutton' value='Go to favourites' />
                                </form>
                            </div>
                        </div>
               </div>
               <?php } ?>
            </div>
            <?php
        }
    }
?>
<div class="divider">
    Restaurant
</div>
<?php include "footer.html" ?>


</body>
</html>