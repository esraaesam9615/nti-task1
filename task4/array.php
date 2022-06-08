<?php
$arr1 = array (
    array(0=>"a" , 1=>"b" ,  2=>"c" ),
    array(0=>"x" , 1=>"b" ,  2=>"a"),
    array(0=>"z" , 1=>"z" ,  2=>"a")
  );

  $arr2=[];
  $arr3=[];
  function test($arr1){
      
      global $arr2,$arr3;
      if(is_array($arr1)){
         return array_map("test",$arr1);
      }
      if(!isset($arr2[$arr1])){
          $arr2[$arr1]=1;
          $arr3[]=$arr1;
      }
  }
  array_map("test",$arr1);
  print_r($arr3)



?>