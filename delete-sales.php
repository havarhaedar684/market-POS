<?php
session_start();
include "db.php";
$index=$_GET['index'];
unset($_SESSION['cart'][$index]);
//bo rizkrdnaway array dway darhenani kallayak(12345) agar nabet 2 dar bkay allet(1345)agar habet (1234) dubara rizyan akatawa
$_SESSION['cart']=array_values($_SESSION['cart']);

header("Location:sales.php");
exit();




?>