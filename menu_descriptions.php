<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <link rel="stylesheet" href="MenuStyle.css">
</head>
<body>

<?php
    if(isset($_GET['pid'])) { 
        $pid = $_GET['pid'];
        $sqlquery = "SELECT * FROM menu.menuitems WHERE ID = $pid;";
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
                                echo "Like this dish? Favourite it! &#8594;";
                                echo "<input type='submit' name='favbutton' class='favbutton' value=' &hearts; ' />" . "<br><br>";
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


</body>
</html>