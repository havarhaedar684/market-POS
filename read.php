<?php
//this page for show table in database by(crud=>Create, Read, Update, Delete);
include "db.php";
$sql="SELECT * FROM users";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($result)){
echo $row['id']."</br>";
echo $row['username']."</br>";
echo $row['email']."</br>";

echo password_hash($row['password'], PASSWORD_DEFAULT)."</br>";
}



?>