<?php
session_start();
include "db.php";
session_unset();//bo zanin
session_destroy();//bo zanin
header("Location:index.php");
exit();



?>
