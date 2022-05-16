<?php
require_once __DIR__.'/bootstrap.php';
require_once __DIR__.'/db-inc.php';
require_once __DIR__.'/session.php';

if(array_key_exists('sendEmail', $_POST)) { sendEmail(); }
    function sendEmail(){
        if(isset($_POST["from"]) && isset($_POST["email"])) {     
            $to = $_POST['email'];
            $from = $_POST['from'];
            $subject = "Check out my favourites!";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: <info@example.com>' . "\r\n";
            $message = "test email";
            if(mail($to, $subject, $message, $headers)){ 
                echo "<div class='container'>";
                echo 'Email has been sent successfully.';
                echo "</div>"; 
             }else{ 
                echo 'Email sending failed.'; 
             }
        }
    }

if(array_key_exists('removeFavourite', $_POST)) { removeFavourite(); }
function removeFavourite(){
    unset($_SESSION["favourite"]);

}


if(isset($_SESSION["favourite"])){ 
    $db = new Db(); 
    $implodedArray = implode(", ",$_SESSION["favourite"]);
       
    $result = $db -> select("SELECT Name, Description, Price, Type FROM menuitems WHERE menuitems.ID IN (" . $implodedArray . ")");
    if(count($result) > 0){
    echo $twig->render('favourites.html', ['menuitems' => $result] );
    }

}else 
echo $twig->render('noFavourites.html');   








   
