<?php
ob_start();
    require_once('connection.php');
    // $conn = new mysqli("localhost", "aurexaac_buja", "bu!ja4#20,38?kd", "aurexaac_anan") or die("cannot connect database");

    $code = $_POST['pro_code'];
    $name = $_POST['pro_name'];
    $name = mysqli_real_escape_string($conn, $name);
    $company = $_POST['pro_company'];
    $description = $_POST['pro_desc'];
    $quantity = $_POST['pro_qty'];
    $type = $_POST['pro_type'];
    $mrp = $_POST['mrp'];
    $dealer = $_POST['dlr'];
    $buy = $_POST['bpl'];
    $selling = $_POST['spl'];
    $profit = $_POST['profit'];
    $low = $_POST['alert'];

    // echo $code." ".$name." ".$company." ".$description." ".$quantity." ".$type." ".$mrp." ".$dealer." ".$buy." ".$selling." ".$profit." ".$low." ";

    $sql = "INSERT INTO `product` (`product_code`, `product_name`, `company`, `description`, `qty`, `type`, `mrp`, `dealer_price`, `buying_price`, `selling_price`, `net_profit`, `low_alert`) VALUES
     ('$code', '$name', '$company', '$description', '$quantity', '$type',
      '$mrp', '$dealer', '$buy', '$selling', '$profit', '$low');";

    $result = mysqli_query($conn , $sql) or die ("cannot add product");
  
    $addtk = $quantity * $buy;
    echo $addtk;
    $sql3 = "SELECT `total_amount`AS total FROM `company` WHERE `Company_name` = '$company';";
    $result3 = mysqli_query($conn, $sql3) or die ("cannot execute sql3");
    $totaltk = 0;
    while ($row = mysqli_fetch_assoc($result3)){
        $totaltk = $row['total'];
    }
    $addtk = floatval($addtk);
    $totaltk = floatval($totaltk);  
  	$totaltk += $addtk;
    $sql4 = "UPDATE `company` SET `total_amount` = '$totaltk' WHERE `company`.`Company_name` = '$company';";
    $result4 = mysqli_query($conn, $sql4) or die ("cannot update total_amount");

    $sql5 = "INSERT INTO pro_and_tk (`pro_code`,`pro_company`,`total_tk`) VALUES ('$code','$company', '$addtk');";
    $result5 = mysqli_query($conn, $sql5) or die ("cannot update pro_and_tk");

    // $sql2 = "SELECT * FROM company WHERE company_name ='$company'; ";
    // $result1 = mysqli_query($conn , $sql2) or die ("cannot execute sql2");
    // // echo "hi";
    // $dd = mysqli_num_rows($result1);
    // // echo $dd;
    // $total = 0;
    // $profit = 0;
    // if ($dd >= 0){
    //   // e¿cho "lo";
    //   while($row = mysqli_fetch_object($result1)){
    //     // echo "yuu";
    //     $total += $row->total_amount;
    //     $profit += $row->total_profit;
    //   }
    // }
    // // echo $selling;
    // // echo $profit;
    // $tk = $buy*$quantity;
    // $tksell = $selling*$quantity;
    // $total += $tk;
    // $profit += $tksell;
    // echo $profit."/br";
    // echo $total."br";
    // $profit = $profit-$total;
    // echo $profit;
    // $sql3 = "UPDATE `company` SET `total_amount` = '$total', `total_profit` = '$profit' WHERE `company`.`Company_name` = '$company';";
    // $result3 = mysqli_query($conn, $sql3) or die ("cannot update total");
    
    header("Location:searchbycompany.php?companygiven=$company&namegiven1=$name");

    ob_end_flush();
?>

