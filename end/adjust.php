<?php
    $q = $_GET['q'];
    
    $p = $_GET['p'];
    $totalp = $_GET['totalp'];
   
    $totalp = floatval($totalp);
    //echo $p . ' '. $q. ' '.$totalp;

    $previous = '';
    $alert = '';
    $company = '';
    $bprice = '';
    // $conn = new mysqli("localhost", "aurexaac_buja", "bu!ja4#20,38?kd", "aurexaac_anan") or die("cannot connect database");
    require_once('connection.php');
    if(isset($p)){
        $sql2 = "SELECT * FROM `product` WHERE `product_name` = '$p';";
        $result2 = $conn->query($sql2) or die("cannot execute query");
        while($row = mysqli_fetch_assoc($result2)){
            $previous = $row['qty'];
            $alert = $row['low_alert'];
            $company = $row['company'];
            $bprice = $row['buying_price'];
        }
        
        $recent = $previous - $q;
        if($recent<$alert){
            echo '<script>alert("Product Is Low")</script>';
        }

        $sql1 = "UPDATE `product` SET `qty` = '$recent' WHERE `product`.`product_name` = '$p';";
        $result = mysqli_query($conn, $sql1) or die("cannot execute query");

        $q = floatval($q);
        $bprice = floatval($bprice);
        $total = 0;
        $company_profit = 0;
        $sql4 = "SELECT * FROM `company` WHERE  `Company_name` = '$company';";
        $result4 = mysqli_query($conn, $sql4) or die("Couldn't collect total from company in company buying");
        while($row4 = mysqli_fetch_assoc($result4)){
            $total = $row4['total_amount'];
            $company_profit = $row4['total_profit'];
        }
        $total = floatval($total);
        $company_profit = floatval($company_profit);
        $company_profit += $totalp;
        $tkofcom = $q * $bprice;
        $total = $total - $tkofcom;
        $sql5 = "UPDATE `company` SET `total_amount` = '$total', `total_profit` = '$company_profit' WHERE `company`.`Company_name` = '$company';";
        $result5 = mysqli_query($conn, $sql5) or die("Couldn't update total from company in company buying");
       
        // echo $total;
    }
    
       
?>