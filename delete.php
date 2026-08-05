<?php
include "db.php";
$id=$_GET['id'];
$sql="DELETE FROM users where id=$id";
$result=mysqli_query($conn, $sql);
if($result){
    header("Location:read.php");
    exit();
}



?>