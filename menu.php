<?php

require_once __DIR__.'/bootstrap.php';
require_once __DIR__.'/db-inc.php';
require_once __DIR__.'/session.php';


if (isset($_GET['type']))
{
    $typeSelected = $db -> quote($_GET["type"]);
}
else
{
    $typeSelected = -1;
}

//Get the db object
$db = new Db();

$food = $db -> select("SELECT menuitems.ID, menuitems.name, menuitems.description, menuitems.Price, menuitems.Type as type FROM menuitems");

echo $twig->render('menu.html', ['menuitems' => $food]);
require_once 'footer.php';

