<?php
require_once __DIR__.'/bootstrap.php';
require_once __DIR__.'/db-inc.php';
require_once __DIR__.'/session.php';

//binds the removefavourite button with the function below
if(array_key_exists('removeFavourite', $_POST)) { removeFavourite(); }

//since this session is an array, a key is used to find the index which is then used to remove the appropriate items
function removeFavourite(){
    //when there is only one item in favourites, unsets the whole thing to avoid an array indexing error
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
        $implodedArray = implode(", ",$_SESSION["favourite"]);  //splits the array into numbers that can be used in the query below   
        $result = $db -> select("SELECT ID, Name, Description, Price, Type FROM menuitems WHERE menuitems.ID IN (" . $implodedArray . ")");

        if(count($result) > 0){
        echo $twig->render('favourites.html', ['menuitems' => $result] );
    }
    }else 
        echo $twig->render('noFavourites.html');   
        //echoes out the noFavourites page if the session array is empty

require_once 'footer.php';






   
