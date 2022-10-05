<?php
    require_once('connection.php');
    // $conn = new mysqli("localhost", "aurexaac_buja", "bu!ja4#20,38?kd", "aurexaac_anan") or die("cannot connect database");
    $id = $_GET['id'];
    $cn = $_GET['cn'];
    $phn = $_GET['phn'];
    $d = $_GET['d'];
    $tm = $_GET['t'];
    $pro = $_GET['pro'];
    $q = $_GET['q'];
    $comp = $_GET['com'];
    $tot = $_GET['tot'];
    $month = $_GET['mname'];
    $year = $_GET['yname'];
    $total_profit = $_GET['totalp'];
    // $bprice = $_GET['bprice'];

    // $q = floatval($q);
    // $bprice = floatval($bprice);
    // $total = 0;
    // $sql4 = "SELECT * FROM `company` WHERE  `Company_name` = '$comp';";
    // $result4 = mysqli_query($conn, $sql4) or die("Couldn't collect total from company in company buying");
    // while($row4 = mysqli_fetch_assoc($result4)){
    //     $total = floatval($row['total_amount']);
    // }
    // $total = floatval($total);
    // $tkofcom = $qty * $bprice;
    // $total = $total - $tkofcom;
    // $sql5 = "UPDATE `company` SET `total_amount` = '$total' WHERE `company`.`Company_name` = '$comp';";
    // $result5 = mysqli_query($conn, $sql5) or die("Couldn't update total from company in company buying");

    $sql = "INSERT INTO `invoice` (`uid`, `cust_name`, `phn`, `date` , `time`, `month`, `year`, `pro_name`, `qty`, `total`, `total_profit`) VALUES ('$id', '$cn', '$phn', '$d', '$tm', '$month','$year', '$pro', '$q', '$tot', '$total_profit');";
    
    $result = mysqli_query($conn, $sql) or die("cannot execute query 1");	
    
    $sellTk = 0;
    $buytkcom = 0;
    $sql3 = "SELECT * FROM `company` WHERE `Company_name` = '$comp';";
    $result3 = mysqli_query($conn, $sql3) or die("cannot execute query3 in invoice");
    while ($row1 = mysqli_fetch_array($result3)){
      $sellTk = $row1['total_sell'];
      $buytkcom = $row1['total_amount'];
    }
    $sellTk = Floatval($sellTk);
    $tot = Floatval($tot);
    $buytkcom = Floatval($buytkcom);
    $sellTk = $sellTk + $tot;
    $profitcom = $sellTk - $buytkcom;
    $profitcom = Floatval($profitcom);
    $sql4 = "UPDATE `company` SET `total_sell` = '$sellTk' WHERE `company`.`Company_name` = '$comp';";
    $result4 = mysqli_query($conn, $sql4) or die("cannot execute query4 in invoice");
    $invoice_id = 0;
    
     $sql2 = " SELECT `id` FROM invoice WHERE `date` = '$d' AND `time` = '$tm';";
     $result2 = mysqli_query($conn, $sql2) or die("cannot execute query2 in invoice");
     while ($row2 = mysqli_fetch_array($result2)){
       $invoice_id = $row2['id'];
     }
     //echo $invoice_id;
    return json_encode($invoice_id);
?>