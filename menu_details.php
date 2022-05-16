<?php

require_once __DIR__.'/bootstrap.php';
require_once __DIR__.'/db-inc.php';
require_once __DIR__.'/session.php';

$favID = $_GET['pid'];
$favArray = array();

if(array_key_exists('setFavourite', $_POST)) {
    setFavourite();
}
function setFavourite(){  
    global $favID;
    global $favArray;
    if(!isset($_SESSION["favourite"])){
        
        $_SESSION["favourite"] = $favArray;
        array_push($_SESSION["favourite"], $favID);

    }
    else{   array_push($_SESSION["favourite"], $favID); }
}

if(isset($_GET['pid'])) 
{
    $db = new Db();    
    $foodID = $db -> quote($_GET['pid']);
    $result = $db -> select("SELECT Name, Description, Price, Type FROM menuitems WHERE ID=". $foodID);

    if (count($result) > 0){
        echo $twig->render('details.html', ['menuitems' => $result] );
    }
    else
        echo $twig->render('404.html');
}
else
    echo $twig->render('404.html');