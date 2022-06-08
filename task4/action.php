<?php
session_start();

function clean($input){
    
    $input = trim($input); 
    $input = stripslashes($input); 
    $input = strip_tags($input); 
    return $input;
    
    // return strip_tags(stripslashes(trim($input))); 

}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
   

    $name     = clean($_POST['name']);
    $password = clean($_POST['password']);
    $email    = clean($_POST['email']);
    $url      = clean($_POST["url"]); 
    $gender   = clean($_POST["gender"]); 
    $address  = clean($_POST["address"]); 


    $errors = [];


    # validate name . . .
    if (empty($name)) {    // == if(empty($name) == true)
        $errors['name'] = 'Field is Required';
    }elseif (!ctype_alpha(str_replace(' ', '', $name))) {
        $errors['name'] = 'Name must be only letters';
    }



    # validate email . . .
    if (empty($email)) {
        $errors['email'] = 'Field is Required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid Email';
    }


    # Validate password . . . 
    if (empty($password)) {
        $errors['password'] = 'Field is Required';
    } elseif (strlen($password) < 6) {
        $errors['password'] = 'Password must be at least 6 characters';
    }
#linkedin validate
    if (empty($url)) {
        $errors['url'] = 'Field is Required';
    }elseif (!filter_var($url, FILTER_VALIDATE_URL)) {
        $errors['url'] = 'Invalid URL';
    }
    if (empty($address)) {
        $errors['address'] = 'Field is Required';
    }elseif (strlen($address) >10|| strlen($address) <10) {
        $errors['address'] = 'Password must be 10 charchter';
    }
      $sex=array("male" , "famale");
    if (empty($gender)) {
        $errors['gender'] = 'Field is Required';
    }elseif (!strtolower( in_array($gender,  $sex, TRUE))) {
        $errors['gender'] = 'enter correct gender';
    }

   
    # Check errors 

    if (count($errors) > 0) {

        foreach ($errors as $key => $value) {
            # code...
            echo $key . ' : ' . $value . '<br>';
        }
    }
    if (!empty($_FILES['fileToUpload']['name'])) {

        $tempName  = $_FILES['fileToUpload']['tmp_name'];
        $fileName = $_FILES['fileToUpload']['name'];
        $fileType = $_FILES['fileToUpload']['type'];

        $extensionArray = explode('/', $fileType);
        $extension =  strtolower( end($extensionArray));

        $allowedExtensions = ['pdf'];    

        if (in_array($extension, $allowedExtensions)) {

            $finalName = uniqid() . time() . '.' . $extension;

            $disPath = 'uploads/' . $finalName;

            if (move_uploaded_file($tempName, $disPath)) {
                echo 'File Uploaded Successfully';
            } else {
                echo 'File Uploaded Failed';
            }
        } else {
            echo 'File Type Not Allowed';
        }
    } else {
        echo 'Please Select File';
    }
    
}
// //name validation
//     if (empty ($_POST["name"])) {  
//         $errMsg = "Field is Required.";  
//                  echo $errMsg;  
//     } 
//     elseif (!preg_match ("/^[a-zA-z]*$/", $name) ) {  
//         $ErrMsg = "Only letter are allowed.";  
//                  echo $ErrMsg; 
//                  }
//                  elseif( strlen ($_POST ["name"]) < 3 ) {  
//                     $ErrMsg = "name  must have more than 3 letter.";  
//                             echo $ErrMsg;  
//                 }
                   
//                 elseif( strlen ($_POST ["name"]) >20 ) {  
//                     $ErrMsg = "name  must have less than 20 letter.";  
//                             echo $ErrMsg;  
//                 }
                 
//     else {  
//         $name = $_POST["name"];  
//     } 

//     echo "<br>";
//     //email validation
//     if (empty ($_POST["email"])) {  
//         $errMsg = "Field is Required.";  
//                  echo $errMsg;  
//     } 
//     else {  
//         $email = $_POST["email"];  
//     } 
//     echo "<br>";
//     //url validation
//     if (empty ($_POST["url"])) {  
//         $errMsg = "Field is Required.";  
//                  echo $errMsg;  
//     } 
//     else {  
//         $url = $_POST["url"];  
//     } 
//     $word = "linkedin";

 
// // Test if string contains the word 
// if(strpos($url, $word) !== false){
//      $url = $_POST["url"]; 
// } else{
//     $errMsg = "please enter linked in link";  
//     echo $errMsg; 
    
// }

//  }


// // Validate e-mail
// if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
//   echo("$email is a valid email address");
// } 
// else{
//     $email = filter_var($email, FILTER_SANITIZE_EMAIL);
//     if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
//         echo($email);}
//         else{
//            echo ("$email is a not valid email address");
//         }
//       } 
//  }

?> 


