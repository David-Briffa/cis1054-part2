<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__.'/bootstrap.php';
require_once __DIR__.'/db-inc.php';
require_once __DIR__.'/session.php';

//function used to ensure no malicious attacks can be inserted with the user input
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$mail = new PHPMailer(true);

if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $emailErr  = "";
        $to = $from = "";

        // if both necessary emails are posted, uses the above function to clean them
        if (!empty($_POST["from"])) {
            $from = clean_input($_POST["from"]);
            if (!filter_var($from, FILTER_VALIDATE_EMAIL))
            {
                $emailErr= 'Your email is invalid';
                $validations['emailError'] = $emailErr;
            }
        }
        if (!empty($_POST["to"])) {
            $to = clean_input($_POST["to"]);
            if (!filter_var($to, FILTER_VALIDATE_EMAIL))
            {           
                $emailErr= 'The recipient\'s email is invalid';
                $validations['emailError'] = $emailErr;
            }
        }
        else
        {   //failsafe in case the html required tag doesn't work
            $emailErr = "Email is required";
            $validations['emailError'] = $emailErr;
        }

        if (empty($emailErr))
        {
                $db = new Db(); 
            $implodedArray = implode(", ",$_SESSION["favourite"]);  //splits the array into numbers that can be used in the query below   
            $result = $db -> select("SELECT ID, Name, Description, Price, Type FROM menuitems WHERE menuitems.ID IN (" . $implodedArray . ")");
    
            if(count($result) > 0){
            try {
                //standard setup for PhPMailer
                $mail->SMTPDebug = 0;                                       
                $mail->isSMTP();                                            
                $mail->Host       = 'smtp.gmail.com;';                    
                $mail->SMTPAuth   = true;   
                $mail->SMTPSecure = 'tls';                              
                $mail->Port       = 587;                      
                $mail->Username   = 'davidbriffahost@gmail.com';                 
                $mail->Password   = 'ydtojkbclxftwhbu'; 
                $mail->isHTML(true);                                  

                $mail->setFrom($from);           
                $mail->addAddress($to);       
                $mail->Subject = $from .' is sending you their SupperThyme favourites!';
                $mail->Body  =  $twig->render('sentFavourites.html', ['menuitems' => $result] ); //sends the favourites as an html file       

                $mail->send();
                $validations['pagemessage'] = "Email has been sent successfully. Thank you!";
            //validation for success or failure
            }catch (Exception $e) { 
                $validations['pagemessage'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            $formvalues = [];
            $mail-> smtpclose();
        }
    
        }
        else
        {   //refills the input text in the event of an error 
            $formvalues['to'] = $to;  
            $formvalues['from'] = $from;
        }

        echo $twig->render('favourites.html', [
            'validations' => $validations,
            'formvalues' => $formvalues, 
        ]);
    }
    else {
        echo $twig->render('favourites.html');
    }
    require_once 'footer.php';
