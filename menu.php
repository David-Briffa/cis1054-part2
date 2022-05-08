<!--- This php file generates the menu items from the database and displays them --->
<?php require_once 'db-inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="Styles/MenuStyle.css">
</head>
<body>
<?php include "header.html" ?>
    <div class="slider">
        <div class="load"> 
        </div>
        <div class="content">
        </div>
        <div class="principal">
            <h1>Menu</h1>
            <p>"Our passion on a plate"</p>
        </div>
    </div>
    <div class="divider">
        Starters
    </div>
    <?php 
        $sqlstarters = "SELECT * FROM menu.menuitems WHERE type = 'starter';";
        $menuresults = mysqli_query($conn, $sqlstarters);
        $resultCheck = mysqli_num_rows($menuresults);
        if($resultCheck > 0){
    ?>
        <div class='container'>
           <?php while($row = mysqli_fetch_assoc($menuresults)){ ?>
                <div class='menu'>
                    <?php
                    echo $row['Name'] . " ";
                    echo $row['Price']; 
                    ?> €
                    <?php echo "<form action='menu_descriptions.php?pid=". $row['ID'] . "' method='post' class='form'>"; ?>
                        <input type='submit' name='details' class='details' value='Details' /> <br>
                    </form>      
                </div>
           <?php } ?>
        </div>
    <?php    } ?>
    
    <div class="divider">
        Pasta
    </div>
    <?php 
        $sqlpasta = "SELECT * FROM menu.menuitems WHERE type = 'pasta';";
        $menuresults = mysqli_query($conn, $sqlpasta);
        $resultCheck = mysqli_num_rows($menuresults);
        if($resultCheck > 0){
            ?>
        <div class='container'>
           <?php while($row = mysqli_fetch_assoc($menuresults)){ ?>
                <div class='menu'>
                    <?php
                    echo $row['Name'] . " ";
                    echo $row['Price']; 
                    ?> €
                    <?php echo "<form action='menu_descriptions.php?pid=". $row['ID'] . "' method='post' class='form'>"; ?>
                        <input type='submit' name='details' class='details' value='Details' /> <br>
                    </form>      
                </div>
           <?php } ?>
        </div>
    <?php    } ?>
    <div class="divider">
        Mains
    </div>
    <?php 
    $sqlmain = "SELECT * FROM menu.menuitems WHERE type = 'main';";
        $menuresults = mysqli_query($conn, $sqlmain);
        $resultCheck = mysqli_num_rows($menuresults);
        if($resultCheck > 0){
            ?>
        <div class='container'>
           <?php while($row = mysqli_fetch_assoc($menuresults)){ ?>
                <div class='menu'>
                    <?php
                    echo $row['Name'] . " ";
                    echo $row['Price']; 
                    ?> €
                    <?php echo "<form action='menu_descriptions.php?pid=". $row['ID'] . "' method='post' class='form'>"; ?>
                        <input type='submit' name='details' class='details' value='Details' /> <br>
                    </form>      
                </div>
           <?php } ?>
        </div>
    <?php    } ?>
    <div class="divider">
        Desserts
    </div>
    <?php 
    $sqldesserts = "SELECT * FROM menu.menuitems WHERE type = 'dessert';";
        $menuresults = mysqli_query($conn, $sqldesserts);
        $resultCheck = mysqli_num_rows($menuresults);
        if($resultCheck > 0){
            ?>
        <div class='container'>
           <?php while($row = mysqli_fetch_assoc($menuresults)){ ?>
                <div class='menu'>
                    <?php
                    echo $row['Name'] . " ";
                    echo $row['Price']; 
                    ?> €
                    <?php echo "<form action='menu_descriptions.php?pid=". $row['ID'] . "' method='post' class='form'>"; ?>
                        <input type='submit' name='details' class='details' value='Details' /> <br>
                    </form>      
                </div>
           <?php } ?>
        </div>
    <?php    } ?>
<?php include "footer.html" ?>
</body>
</html>