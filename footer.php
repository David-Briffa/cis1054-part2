<?php
require_once __DIR__.'/bootstrap.php';
require_once __DIR__.'/db-inc.php';



$db = new Db();

$layout = $db -> select("SELECT * FROM footers");

echo $twig->render('footer.html', ['footers' => $layout]);

