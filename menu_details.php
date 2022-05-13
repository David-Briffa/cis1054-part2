<?php

require_once __DIR__.'/bootstrap.php';
require_once __DIR__.'/db-inc.php';
require_once __DIR__.'/session.php';

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
    else{   array_push($_SESSION["favourite"], $favID); }
}

if(isset($_GET['pid'])) 
{
    $db = new Db();    
    $foodID = $db -> quote($_GET['pid']);
    $result = $db -> select("SELECT Name, Description, Price, Type FROM menuitems WHERE ID=". $foodID);

    if (count($result) > 0){
        // Animal loaded from store
        $food = [

                'Name'              => $result[0]['Name'],
                'Description'       => $result[0]['Description'],
                'Price'             => $result[0]['Price'],
                'Type'              => $result[0]['Type'],

        ];
        // Render view
        echo $twig->render('details.html', ['menuitems' => $food] );
    }
    else
        echo $twig->render('404.html');
}
else
    echo $twig->render('404.html');