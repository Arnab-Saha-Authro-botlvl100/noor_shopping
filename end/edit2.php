<?php
ob_start();
    require_once('connection.php');
    // $conn = new mysqli("localhost", "aurexaac_buja", "bu!ja4#20,38?kd", "aurexaac_anan") or die("cannot connect database");
    $p_name = $_POST['pname'];
    $p_code = $_POST['pcode'];
    $qty = $_POST['qty'];
    $up_qty = $_POST['updated_qty'];
    $nw_qty = $_POST['new_qty'];
    $company = $_POST['company'];
    $description = $_POST['description'];
    $mrp = $_POST['mrp'];
    $d_price = $_POST['d_price'];
    $s_price = $_POST['s_price'];
    $b_price = $_POST['b_price'];
    $pro = $_POST['profit'];
    $ptype = $_POST['pro_type'];
    $neg_qty = 0 - $qty;
    $twox_neg = 2*$neg_qty;
    if($up_qty == $neg_qty){
       $real_qty = $qty;
    }
    else if($up_qty == $twox_neg){
        $real_qty = $qty;
    }
    else{
    $real_qty = $up_qty + $qty;}

    // echo $neg_qty;
    // echo $pro;
    // echo $up_qty;
    $low = $_POST['low'];
    $sql = "UPDATE `product` SET `company` = '$company', `description` = '$description', `qty` = '$real_qty', `type` = '$ptype', `mrp` = '$mrp', `selling_price` = '$s_price', `buying_price` = '$b_price', `dealer_price` = '$d_price', `low_alert` = '$low' WHERE `product`.`product_code` = '$p_code';";
    $result = mysqli_query($conn, $sql) or die ("cannot update");
    $sql2 = "UPDATE `product` SET `net_profit` = '$pro' WHERE `product`.`product_code` = '$p_code';";
    $result2 = mysqli_query($conn, $sql2) or die ("cannot update profit");
    $sql3 = "SELECT `total_amount`AS total FROM `company` WHERE `Company_name` = '$company';";
    $result3 = mysqli_query($conn, $sql3) or die ("cannot execute sql3");
    $totaltk = 0;
    while ($row = mysqli_fetch_assoc($result3)){
        $totaltk = $row['total'];
    }
    $totaltk = floatval($totaltk);
    $producttk = 0;
    $sql5 = "SELECT `total_tk` AS protk FROM pro_and_tk WHERE pro_code = '$p_code';";
    $result5 = mysqli_query($conn, $sql5) or die ("cannot collect protk from edit2");
    while ($row = mysqli_fetch_assoc($result5)){  $producttk = $row['protk'];}
    $producttk = floatval($producttk);
    $prv_total = $totaltk;
    $prv_producttk = $producttk; 
    // echo $totaltk;
    if($up_qty<0 && $up_qty != $neg_qty && $up_qty != $twox_neg){
        $lesstk = $up_qty * $b_price;
        //echo $totaltk."nope";
        $lesstk = floatval($lesstk);
        $totaltk += $lesstk;
        $producttk += $lesstk;
        //echo " if";
        // echo " new tk ".$totaltk;
    }

    else if($up_qty == $qty && $nw_qty = 2*$qty){
        $moretk = $up_qty * $b_price;
        $totaltk += $moretk;
        $producttk += $moretk;
        //echo "chat er bal";
        // echo " new tk ".$totaltk;
    }
        else if($up_qty == $qty){
        $totaltk = $prv_total;
        //echo $totaltk."bal";
        $producttk = $prv_producttk;
        //echo "last er 2 ta ager else if";
        // echo " new tk ".$totaltk;
    }
    else if($up_qty == $neg_qty){
        $totaltk = $prv_total;
        //echo $totaltk."Wow";
        $producttk = $prv_producttk;
        //echo "last er ager else if";
        // echo " new tk ".$totaltk;
    }
    else if($up_qty == $twox_neg){
        $totaltk = $b_price*$real_qty;
       // echo $totaltk."test";
        $producttk = $totaltk;
        //echo "last else if";

    }
    else{
        $moretk = $up_qty * $b_price;
        //echo $totaltk."shit";
        $moretk = floatval($moretk);
        $totaltk += $moretk;
        $producttk += $moretk;
        //echo "else";
        // echo " new tk ".$totaltk;
        // echo " new tk ".$totaltk;
    }

    $sql4 = "UPDATE `company` SET `total_amount` = '$totaltk' WHERE `company`.`Company_name` = '$company';";
    $result4 = mysqli_query($conn, $sql4) or die ("cannot update total_amount");

    $sql6 = "UPDATE `pro_and_tk` SET `total_tk` = '$producttk' WHERE `pro_and_tk`.`pro_code` = '$p_code';";
    $result6 = mysqli_query($conn, $sql6) or die ("cannot update total tk in pro_and_tk");
    header("Location:searchbycompany.php?companygiven=$company&namegiven1=$p_name");



    
ob_end_flush();
?>