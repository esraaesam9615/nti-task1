<?php
$my_text = 'getTagID(div id="container")';
if (preg_match('/"([^"]+)"/', $my_text, $m)) {
    print $m[1];   
} else {
  
    echo " false";
}


?>