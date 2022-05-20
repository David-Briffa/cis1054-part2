<?php

require_once __DIR__.'/bootstrap.php';
require_once __DIR__.'/session.php';

echo $twig->render('index.html');
require_once 'footer.php';
