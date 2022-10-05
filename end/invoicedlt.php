<?php
    require_once('connection.php');
    $id = $_GET['oid'];
    $date = $_GET['date'];
    $pid = $_GET['id'];
    $qty = $_GET['qty'];
    $qty = Floatval($qty);
    $total = $_GET['tot'];
    $total = Floatval($total);
    $pname = $_GET['pname'];
    $profit_of_product = $_GET['profit'];
    // echo "ID: " . $pid . " QTY: " . $qty . " Total: " . $total. "Proname: " . $pname. "ID: ". $id . "Date: ". $date;
    $sql1 = "SELECT * FROM `product` WHERE `product_name`='$pname';";
    $company = '';
    $bpriceofproduct = 0;
    $actualqty = 0;
    $result1 = mysqli_query($conn, $sql1) or die("Couldn't collect name of company in dltinvoice");
    while($row = mysqli_fetch_array($result1)){
        $company = $row['company'];
        $actualqty = $row['qty'];
        $bpriceofproduct = $row['buying_price'];
    }
    $bpriceofproduct = Floatval($bpriceofproduct);
    $actualqty = Floatval($actualqty);
    $actualqty = $actualqty + $qty;
    // echo "Company: " . $company;
    $sql2 = "SELECT * FROM `company` WHERE `Company_name`='$company';";
    $totaltk = 0;
    $selltk = 0;
    $profit = 0;
    $result2 = mysqli_query($conn, $sql2) or die(" Could not collect sell price of company in dltinvoice");
    while ($row1 = mysqli_fetch_array($result2)){
        $selltk = $row1['total_sell'];
        $totaltk = $row1['total_amount'];
        $profit = $row1['total_profit'];
    }
    $totaltk = Floatval($totaltk);
    $selltk = Floatval($selltk);
    $profit = Floatval($profit);
    // echo "sell: " . $selltk;
    $selltk = $selltk - $total;
    $actualprofit = $selltk - $totaltk;
    $protk = 0;
    $sql8 = "SELECT * FROM `invoice` WHERE `invoice`.`id` = '$pid';";
    $result8 = mysqli_query($conn, $sql8) or die(" cannot collect all from invoice");
    while ($row8 = mysqli_fetch_assoc($result8)){
        $protk = $row8['total'];
    }
    $protk = Floatval($protk);
    $actualselledtkproduct = $bpriceofproduct * $qty;
    $profitofproduct = $profit - $profit_of_product;
    $totaltk = $totaltk + $actualselledtkproduct;
    $sql3 = "UPDATE `product` SET `qty` = '$actualqty' WHERE `product`.`product_name` = '$pname';";
    echo $sql3;
    $result3 = mysqli_query($conn, $sql3) or die(" cannot execute query3 in dltinvoice");
    $sql4 = "UPDATE `company` SET `total_amount` = '$totaltk', `total_sell` = '$selltk', `total_profit` = '$profitofproduct' WHERE `company`.`Company_name` = '$company';";
    $result4 = mysqli_query($conn, $sql4) or die ("cannot execute query4 in dltinvoice");
    $sql5 = "DELETE FROM `invoice` WHERE `invoice`.`id` = '$pid';";
    $result5 = mysqli_query($conn, $sql5) or die("cannot delete query5 in dltinvoice");
    header("Location:sortlist.php?id=$id&dt=$date");
  
?>