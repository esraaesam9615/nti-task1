<?php 
  require 'dbConnection.php';
  function Clean($input)
{
    return stripslashes(strip_tags(trim($input)));
}



# Server Side Code . . . 
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name     = Clean($_POST['name']);
  
    $errors = [];

    # validate name .... 
    if (empty($name)) {
        $errors['name'] = "Field Required";
    }
    if (count($errors) > 0) {
        // print errors .... 

        foreach ($errors as $key => $value) {
            # code...

            echo '* ' . $key . ' : ' . $value . '<br>';
        }
    } else {
      
      $sql = "select id,name,email from user where like '%e%' OR email like'%e%' ";
      $op =  mysqli_query($con, $sql);
     while($row=mysql_fetch_array($op))
              {
           echo $row[id];
           echo $row[name];
           echo $row[email] ;
            exit();}

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
<div id="search_box">
 <form method="post"action="get_results.php" onsubmit="return do_search();">
  <input type="text" id="search_term" name="search_term" placeholder="Enter Search" onkeyup="do_search();">
  <input type="submit" name="search" value="SEARCH">
 </form>
</div>


</body>

</html>