<?php

$num1=10;
$num2=20;
echo 'before swap  ' , $num1 ." ". $num2  . "<br>";
$num1+=$num2;
$num2=$num1 - $num2;
$num1 =$num1-$num2;

echo 'after swap   ' , $num1." ". $num2;


?>