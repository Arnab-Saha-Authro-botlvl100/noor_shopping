<?php
    require_once('connection.php');
    //  $conn = new mysqli("localhost", "aurexaac_buja", "bu!ja4#20,38?kd", "aurexaac_anan") or die("cannot connect database");
     
     $id = $_GET['id'];
     $date = $_GET['dt'];
     $proname = $_GET['pname'];
     $compname = $_GET['cname'];
     $sellprice = $_GET['sprice'];
     $qty = $_GET['qt'];
     $pid = $_GET['pid'];
     $totalp = $_GET['totalprofit'];
     $qty = Floatval($qty);
     $totalp = Floatval($totalp);
    //  echo $id . ": " . $date .": " . $proname . " " . $qty;
    //  return "hi";
     $sql = "DELETE FROM `invoice` WHERE `invoice`.`id` = '$pid';";
     //echo $sql;
     $result = mysqli_query($conn, $sql) or die("cannot execute sql1");
    //  print_r($result); 
     $getqty = 0;
     $bprice = 0;
     $sql2 = "SELECT * FROM `product` WHERE product_name = '$proname';";
     //echo $sql2;
     $result2 = mysqli_query($conn, $sql2) or die ("cannot execute query");
     
     while($row = mysqli_fetch_assoc($result2)){
        $getqty = $row['qty'];
        $bprice = $row['buying_price'];
     }
     $getqty = Floatval($getqty);
     $bprice = Floatval($bprice);
     $adjusttk = $qty * $bprice;
     $getqty = $getqty + $qty;
     //echo $getqty;
     $sql3 = "UPDATE `product` SET `qty` = '$getqty' WHERE `product`.`product_name` = '$proname';";
     $result3 = mysqli_query($conn, $sql3) or die("cannot execute query3");

     $sellprice = Floatval($sellprice);
     $totalsell = $sellprice * $qty;
     $sellTk = 0;
     $buytkcom = 0;
     $totalpro = 0;
     $sql4 = "SELECT * FROM `company` WHERE `Company_name` = '$compname';";
     $result4 = mysqli_query($conn, $sql4) or die("cannot execute query4 in dltbilling");
     while ($row1 = mysqli_fetch_array($result4)){
      $sellTk = $row1['total_sell'];
      $buytkcom = $row1['total_amount'];
      $totalpro = $row1['total_profit'];
    }
    $totalpro = Floatval($totalpro);
    $totalpro -= $totalp;
    $sellTk = Floatval($sellTk);
    $buytkcom = Floatval($buytkcom);
    $buytkcom = $buytkcom + $adjusttk;
    $sellTk = $sellTk - $totalsell;
    $profitcom = $sellTk - $buytkcom;
    $profitcom = Floatval($profitcom);
    $sql5 = "UPDATE `company` SET `total_amount` = '$buytkcom', `total_sell` = '$sellTk', `total_profit` = '$totalpro' WHERE `company`.`Company_name` = '$compname';";
    $result5 = mysqli_query($conn, $sql5) or die("cannot execute query5 in dltbilling");
    //  header("Location:billing2.php");
?>