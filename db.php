<?php
$a="localhost";
$b="root";
$c="";
$d="market-POS";

$conn=mysqli_connect($a,$b,$c,$d);


if(!$conn){
echo "You dont have connection";
}else{
echo "You have connection ";
}







?>