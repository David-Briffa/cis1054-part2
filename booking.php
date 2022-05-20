<?php

require_once __DIR__.'/bootstrap.php';
require_once __DIR__.'/session.php';
require_once __DIR__.'/db-inc.php';
echo $twig->render('booking.html');

$minDate = date("Y-m-d");
require_once 'footer.php';
