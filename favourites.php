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
    $result = $db -> select("SELECT Name, Description, Price, Type FROM menuitems WHERE ID=". $foodID);
       

    if(count($result) > 0){


        // Animal loaded from store
        $food = [

                'Name'              => $result[0]['Name'],
                'Description'       => $result[0]['Description'],
                'Price'             => $result[0]['Price'],
                'Type'              => $result[0]['Type'],

        ];
        // Render view
        echo $twig->render('favourites.html', ['menuitems' => $food] );
    
}else
echo $twig->render('404.html');
    
}else
echo  $twig->render('noFavourites.html');







   
