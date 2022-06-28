<?php 
require 'dbConnection.php';

 $id = $_GET['id'];

 # Fetch User Data . . . 
   $sql = "select image from user where id = $id";
   $resultObj = mysqli_query($con, $sql);
   $userImage = mysqli_fetch_assoc($resultObj); 

# Remove User . . . 
 $sql = "delete from user where id = $id"; 
 $op = mysqli_query($con, $sql);

 if($op){
    
   # Remove Image 
   unlink('uploads/' . $userImage['image']);


    $message =  "Record Deleted";
 }else{
    $message =  'Error Try Again' . mysqli_error($con);
 }


   # Set Message Session 
    $_SESSION['message'] = $message;

    header("Location: index.php");