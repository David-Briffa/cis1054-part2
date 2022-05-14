<?php
require_once __DIR__.'/bootstrap.php';
require_once __DIR__.'/db-inc.php';
require_once __DIR__.'/session.php';

if(array_key_exists('removeFavourite', $_POST)) { removeFavourite(); }
function removeFavourite(){
    unset($_SESSION["favourite"]);
}


if(isset($_SESSION["favourite"])){ 
    $fav= implode(" ",$_SESSION["favourite"]);
    $db = new Db(); 
    $foodID = $db -> quote($fav);

    foreach($_SESSION["favourite"] as $fav){
    $result = $db -> select("SELECT Name, Description, Price, Type FROM menuitems WHERE ID=". $fav);
    
        echo $twig->render('favourites.html', ['menuitems' => $result] );
     
}
}else
echo  $twig->render('noFavourites.html');   







   
