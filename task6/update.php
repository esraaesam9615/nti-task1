<?php

require 'dbConnection.php';


##################################################################################################################
 
$id = $_GET['id'];
$sql = "select id,name,email,image from user where id = $id";
$resultObj = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($resultObj);

##################################################################################################################







# Clean Function to sanitize the data
function Clean($input)
{
    return stripslashes(strip_tags(trim($input)));
}



# Server Side Code . . . 
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name     = Clean($_POST['name']);
    $email    = Clean($_POST['email']);


    # Validate ...... 
    $errors = [];

    # validate name .... 
    if (empty($name)) {
        $errors['name'] = "Field Required";
    }


    # validate email 
    if (empty($email)) {
        $errors['email'] = "Field Required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['Email'] = "Invalid Email";
    }
   
   # Validate Image  . . . 
    if (!empty($_FILES['image']['name'])) {

        # Validate Extension . . . 
        $imageType = $_FILES['image']['type'];
        $extensionArray = explode('/', $imageType);
        $extension =  strtolower(end($extensionArray));

        $allowedExtensions = ['png', 'jpg', 'jpeg', 'webp'];    // PNG 

        if (!in_array($extension, $allowedExtensions)) {

            $errors['image'] = "File Type Not Allowed";
        }
    }  




    # Check ...... 
    if (count($errors) > 0) {
        // print errors .... 

        foreach ($errors as $key => $value) {
            # code...

            echo '* ' . $key . ' : ' . $value . '<br>';
        }
    } else {

        // DB cODE . . . 

        if (!empty($_FILES['image']['name'])) {

          # Upload Image . . .
        $finalName = uniqid() . time() . '.' . $extension;
        $disPath = 'uploads/' . $finalName;
        # Get Temp Path . . .
        $tempName  = $_FILES['image']['tmp_name'];

        if (move_uploaded_file($tempName, $disPath)) {

            unlink('uploads/' . $data['image']);
        }

        }else{
            $finalName = $data['image'];
        }

        $sql = "update user set name = '$name', email = '$email' , image = '$finalName'  where id = $id";

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
                <label for="exampleInputName">Name</label>
                <input type="text" class="form-control" required id="exampleInputName" aria-describedby="" name="name" placeholder="Enter Name"  value = "<?php echo $data['name'];?>">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">Email address</label>
                <input type="email" class="form-control" required id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Enter email" value = "<?php echo $data['email'];?>">
            </div>


            <div class="form-group">
                <label for="exampleInputPassword">Image</label>
                <input type="file" name="image">
            </div>

            <p>
                <img src="./uploads/<?php echo $data['image'];?>"   height="150px"   width="150px"  alt="">
            </p>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>


</body>

</html>