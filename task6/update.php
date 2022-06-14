<?php

require 'dbConnection.php';
 
$id = $_GET['id'];
$sql = "select * from contents where id = $id";
$resultObj = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($resultObj);


function Clean($input)
{
    return stripslashes(strip_tags(trim($input)));
}


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $title    = Clean($_POST['title']);
    $content= Clean($_POST['content']);
    $image=$_FILES['image']['name'];
    


 
    $errors = [];
    if (empty($title)) {
        $errors['title'] = "Field Required";
    }
    elseif(!is_string($title)){
        $errors['title'] = "error must enter string";

    }

  
    if (empty($content)) {    
        $errors['content'] = 'Field is Required';
    }elseif (!strlen($content) > 50) {
        $errors['content'] = 'content must be more than 50';
    }

    if (empty($_FILES['image']['name'])) {
        $errors['image'] = "Field Required";
    } else {

        # Validate Extension . . . 
        $imageType = $_FILES['image']['type'];
        $extensionArray = explode('/', $imageType);
        $extension =  strtolower(end($extensionArray));

        $allowedExtensions = ['png', 'jpg', 'jpeg', 'webp'];    // PNG 

        if (!in_array($extension, $allowedExtensions)) {

            $errors['image'] = "File Type Not Allowed";
        }
    }


    if (count($errors) > 0) {
      

        foreach ($errors as $key => $value) {
          

            echo '* ' . $key . ' : ' . $value . '<br>';
        }
    } else {

        // DB cODE . . . 

        $sql = "update users set title= '$title', content= '$content' where id = $id";

        $op =  mysqli_query($con, $sql);

        if ($op) {
            $message =  "Success , Your Account Updated";

            $_SESSION['message'] = $message;
            
            header('Location: index.php');
            exit(); 

        } else {
            echo "Failed , " . mysqli_error($con);
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Update</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Update Info : </h2>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?id='.$data['id']; ?>" method="post" enctype="multipart/form-data">

        <div class="form-group">
                <label for="exampleInputTitle">Title</label>
                <input type="text" class="form-control" required id="exampleInputTitle" aria-describedby="" name="title" placeholder="EnterTitle">
            </div>


            <div class="form-group">
                <label for="exampleInputContent">Content</label>
                <input type="text" class="form-control" required id="exampleInputContent" aria-describedby="emailHelp" name="content" placeholder="Enter Content">
            </div>

        

            <div class="form-group">
                <label for="exampleInputPassword">Image</label>
                <input type="file" name="image">


            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>


</body>

</html>