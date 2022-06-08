<?php
// $my_text = 'getTagID(div id="container")';
// if (preg_match('/"([^"]+)"/', $my_text, $m)) {
//     print $m[1];   
// } else {
  
//     echo " false";
// }

$url = 'getTagID(div id="container")';
echo substr($url, strpos($url, 'id="' )+1);


?>