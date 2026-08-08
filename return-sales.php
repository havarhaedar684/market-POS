<?php
session_start();
include "db.php";
if($_SERVER['REQUEST_METHOD']=='POST'){
$index=$_POST['index'];
$return=$_POST['return_qty'];
$name=$_SESSION['cart'][$index]['name'];
$sql="UPDATE products SET stock=stock+$return Where name='$name'";
$result=mysqli_query($conn, $sql);

//kamkrdnawa indexakaka
$_SESSION['cart'][$index]['qty']-=$return;
$_SESSION['cart'][$index]['total_amount']=$_SESSION['cart'][$index]['qty']* $_SESSION['cart'][$index]['price'];

if($_SESSION['cart'][$index]['qty'] <= 0){
    unset($_SESSION['cart'][$index]);
}
$_SESSION['cart'] = array_values($_SESSION['cart']);

header("Location:sales.php");
exit();


}
?>