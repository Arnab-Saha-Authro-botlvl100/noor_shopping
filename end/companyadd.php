<?php
ob_start();
require_once('connection.php');
//  $conn = new mysqli("localhost","aurexaac_buja","bu!ja4#20,38?kd", "aurexaac_anan") or die ("cannot connect database at companyadd");
 $name = $_POST["companyname"];
 
 $number = $_POST["companynumber"];

 $sql ="INSERT INTO `company` (`Company_name`, `total_amount`, `total_profit`, `company_number`) VALUES ('$name', '', '', '$number');";
 $result = mysqli_query($conn,$sql) or die("cannot add database at companyadd");
 header("Location:displayajex.php");
 
ob_end_flush();
?>