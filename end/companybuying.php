<?php

  require_once('connection.php');
  $rtn = FALSE;
  $com = $_GET['compname'];
  $qty = $_GET['qty'];
  $bprice = $_GET['bprice'];
  $qty = floatval($qty);
  $bprice = floatval($bprice);
  $total = 0;
  $sql = "SELECT * FROM `company` WHERE  `Company_name` = '$com';";
  $result = mysqli_query($conn, $sql) or die("Couldn't collect total from company in company buying");
  while($row = mysqli_fetch_assoc($result)){
      $total = floatval($row['total_amount']);
  }
  $total = floatval($total);
  $tk = $qty * $bprice;
  $total = $total - $tk;
  $sql1 = "UPDATE `company` SET `total_amount` = '$total' WHERE `company`.`Company_name` = '$com';";
  $result1 = mysqli_query($conn, $sql1) or die("Couldn't update total from company in company buying");
  if ($conn->query($sql) === TRUE) {
   if ($conn->query($sql1) === TRUE) {
       $rtn = TRUE;
   }
  }
   return json_encode($rtn);
 
?>