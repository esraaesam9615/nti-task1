<?php

$url = 'http://www.example.com/5478631';
echo substr($url, strrpos($url, '/' )+1);

?>