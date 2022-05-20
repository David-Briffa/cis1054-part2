<?php
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
if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $emailErr  = "";
        $to = $from = "";

        // if both necessary emails are posted, uses the above function to clean them
        if (!empty($_POST["from"])) {
            $from = clean_input($_POST["from"]);
            if (!filter_var($from, FILTER_VALIDATE_EMAIL))
            {
                $emailErr= 'One of the emails is invalid';
                $validations['emailError'] = $emailErr;
            }
        }
        if (!empty($_POST["to"])) {
            $to = clean_input($_POST["to"]);
            if (!filter_var($to, FILTER_VALIDATE_EMAIL))
            {           
                $emailErr= 'One of the emails is invalid';
                $validations['emailError'] = $emailErr;
            }
        }
        else
        {
            $emailErr = "Email is required";
            $validations['emailError'] = $emailErr;
        }

        //If all's ok
        if (empty($emailErr))
        {
            //Onward processing using mail() or PHPMailer() passing in the $type, $email and $message vars
            $validations['pagemessage'] = "Email has been sent successfully. Thank you!";
            $formvalues = [];

        }
        else
        {
            $validations['pagemessage'] = "Please check that the emails are correct";
            //Repopulate text fields with submitted data if emails are incorrect 
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
