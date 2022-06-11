
<?php

// $file = fopen('data.txt', 'r') or die('Unable to open file!');

//    while (!feof($file)) {

//       $data = explode('||',fgets($file));
     
//       foreach ($data as $key => $value) {
//          function getId($data)
//         {
        
//             $index =   strrpos($link, '||') + 1;
        
//             return  substr($link, $index);
//         }
         
//           $id=$data[0];


      
//       }
      
       
      


//    }

//    fclose($file);



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
    
     <form method="POST" action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
<div class="form-group">
                <label><?php echo nl2br(file_get_contents( "data.txt" )) ?></label>
                <input type="button" name="delete" value="Delete">
            </div>
</form> 

</body>
</html>








