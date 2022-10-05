<?php
 require_once('connection.php');
 $cname = $_GET['compname'];
 $sql ="DELETE FROM `company` WHERE `company`.`Company_name` ='$cname';";
 $result = mysqli_query($conn, $sql) or die("cannot delete company");
 header('Location:displayajex.php');
?>