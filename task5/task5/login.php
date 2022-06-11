<?php

session_start();

function clean($input){
    
    $input = trim($input); 
    $input = stripslashes($input); 
    $input = strip_tags($input); 
    return $input;
    
   

}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // CODE .... 

    $title    = clean($_POST['title']);
    $content    = clean($_POST['content']);
   

   
    $errors = [];


   
    if (empty($title)) {    
        $errors['title'] = 'Field is Required';
    }


    if (empty($content)) {    
        $errors['content'] = 'Field is Required';
    }elseif (strlen($content) > 50) {
        $errors['content'] = 'content must be more than 30';
    }

    if (!empty($_FILES['image']['name'])) {

        $tempName  = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];
        $imageType = $_FILES['image']['type'];

        $extensionArray = explode('/', $imageType);
        $extension =  strtolower( end($extensionArray));

        $allowedExtensions = ['png', 'jpg', 'jpeg', 'webp'];    // PNG 

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

  

    # Check errors 

    if (count($errors) > 0) {

        foreach ($errors as $key => $value) {
            # code...
            echo $key . ' : ' . $value . '<br>';
        }
    } else {
            
        //  $_SESSION['blogData'] = [
        //     'title' => $title,
        //     'content' => $content];
        $target_file = "uploads/" . basename ($_FILES["image"]["name"]);
        if(isset($_POST['submit'])){
         $data = uniqid()."||".$title . "||" . $content . "||" . $target_file . "\n";
            $fb=fopen("data.txt", "a");
            fwrite($fb, $data);
    
            fclose($fb);
            }
       

    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Register</h2>
        <!-- action.php -->
        <form method="post" action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputTitle">Title</label>
                <input type="text" class="form-control" name="title" id="exampleInputTitle" aria-describedby="" placeholder="Enter Title">
            </div>

            <div class="form-group">
                <label for="exampleInputContent">Content</label>
                <input type="text" class="form-control" name="content" id="exampleInputContent" aria-describedby="" placeholder="Enter Content">
            </div>
           
            <div class="form-group">
                <label for="exampleInputimg">Image</label>
                <input type="file" name="image">
            </div>


            <input type="submit" name="submit" value="Submit">
        </form>
    </div>

</body>

</html>