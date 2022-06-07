<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
   

    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $url = $_POST["url"];  
    // $url= $_POST['url'];
    
//name validation
    if (empty ($_POST["name"])) {  
        $errMsg = "Field is Required.";  
                 echo $errMsg;  
    } 
    elseif (!preg_match ("/^[a-zA-z]*$/", $name) ) {  
        $ErrMsg = "Only letter are allowed.";  
                 echo $ErrMsg; 
                 }
                 elseif( strlen ($_POST ["name"]) < 3 ) {  
                    $ErrMsg = "name  must have more than 3 letter.";  
                            echo $ErrMsg;  
                }
                   
                elseif( strlen ($_POST ["name"]) >20 ) {  
                    $ErrMsg = "name  must have less than 20 letter.";  
                            echo $ErrMsg;  
                }
                 
    else {  
        $name = $_POST["name"];  
    } 

    echo "<br>";
    //email validation
    if (empty ($_POST["email"])) {  
        $errMsg = "Field is Required.";  
                 echo $errMsg;  
    } 
    else {  
        $email = $_POST["email"];  
    } 
    echo "<br>";
    //url validation
    if (empty ($_POST["url"])) {  
        $errMsg = "Field is Required.";  
                 echo $errMsg;  
    } 
    else {  
        $url = $_POST["url"];  
    } 
    $word = "linkedin";

 
// Test if string contains the word 
if(strpos($url, $word) !== false){
     $url = $_POST["url"]; 
} else{
    $errMsg = "please enter linked in link";  
    echo $errMsg; 
    
}

 }


?> 


