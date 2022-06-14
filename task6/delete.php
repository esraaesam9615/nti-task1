<?php 
require 'dbConnection.php';

 $id = $_GET['id'];

 $sql = "delete from contents where id = $id"; 
 $op = mysqli_query($con, $sql);

 if($op){
    $message =  "Record Deleted";
    unlink('uploads/'.trim($data[4]));
 }else{
    $message =  'Error Try Again' . mysqli_error($con);
 }


   # Set Message Session 
    $_SESSION['message'] = $message;

    header("Location: index.php");


    
?>