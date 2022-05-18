<?php
require_once __DIR__.'/bootstrap.php';
require_once __DIR__.'/db-inc.php';
require_once __DIR__.'/session.php';

if(array_key_exists('sendEmail', $_POST)) { sendEmail(); }
    function sendEmail(){

        if(isset($_POST["from"]) && isset($_POST["to"])) {     
            $to = $_POST['to'];
            $from = $_POST['from'];
            $subject = "Check out my favourites!";           
            $headers = 'From:' . $from;
            $message = "test email";

            if(mail($to, $subject, $message, $headers)){ 
                echo 'Email has been sent successfully.';
             }else{ 
                echo 'Email sending failed.'; 
             }
            }
    }

if(array_key_exists('removeFavourite', $_POST)) { removeFavourite(); }
function removeFavourite(){
  if (sizeof($_SESSION["favourite"]) == 1){
    unset($_SESSION["favourite"]);
  }
    elseif (isset($_SESSION["favourite"])){
        $key = $_REQUEST['rmv'];
        $index = array_search($key,$_SESSION["favourite"]);
        unset($_SESSION["favourite"][$index]);  
      }
    }




if(isset($_SESSION["favourite"])){ 
    $db = new Db(); 
    $implodedArray = implode(", ",$_SESSION["favourite"]);
       
    $result = $db -> select("SELECT ID, Name, Description, Price, Type FROM menuitems WHERE menuitems.ID IN (" . $implodedArray . ")");
    if(count($result) > 0){
    echo $twig->render('favourites.html', ['menuitems' => $result] );
    }

}else 
echo $twig->render('noFavourites.html');   








   
