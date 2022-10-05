<?php
    
    ob_start();
        require_once('connection.php');
        $pname = $_GET['delete'];
        $qty = $_GET['qty'];
        $company = $_GET['company'];
        $b_price = $_GET['bprice'];
        $p_code = $_GET['PCODE'];
        //echo $pname . ' '. $company. ' '. $b_price . ' '. $qty. ' ';
        // $dlttk = $qty * $b_price;
        // echo $dlttk." ";
        $producttk = 0;
        $sql5 = "SELECT `total_tk` AS protk FROM pro_and_tk WHERE pro_code = '$p_code';";
        $result5 = mysqli_query($conn, $sql5) or die ("cannot collect protk from edit2");
        while ($row = mysqli_fetch_assoc($result5)){  $producttk = $row['protk'];}
        $sql3 = "SELECT `total_amount`AS total FROM `company` WHERE `Company_name` = '$company';";
        $result3 = mysqli_query($conn, $sql3) or die ("cannot execute sql3");
        $totaltk = 0;
        while ($row = mysqli_fetch_assoc($result3)){
            $totaltk = $row['total'];
        }
        $totaltk = floatval($totaltk);
        $producttk = floatval($producttk);
        $totaltk -= $producttk;
        $sql4 = "UPDATE `company` SET `total_amount` = '$totaltk' WHERE `company`.`Company_name` = '$company';";
        $result4 = mysqli_query($conn, $sql4) or die ("cannot update total_amount");
        $sql = "DELETE FROM `product` where `product_code` = '$p_code';" ;
        $result = mysqli_query($conn, $sql) or die ("cannot delete product");
        header("Location:searchbycompany.php?companygiven=$company&namegiven1=$p_name");

    // $mysqli = new mysqli("localhost", "aurexaac_buja", "bu!ja4#20,38?kd", "aurexaac_anan") or die("cannot connect database");
    // $company = '';
    // if(isset($_GET['delete'])){
    //     $id = $_GET['delete'];
    //     $qty = $_GET['qty'];
    //     $company = $_GET['company'];
    //     $b_price = $_GET['bprice'];
    //     $quantity = 0;
    //     $buy = 0;
    //     echo $id . ' '. $company. ' '. $b_price . ' '. $quantity;
    //     require_once('connection.php');
        // $conn = new mysqli("localhost", "aurexaac_buja", "bu!ja4#20,38?kd", "aurexaac_anan") or die("cannot connect database");
        // $sql = "SELECT * FROM `product` WHERE `product_name` = '$id';";
        // $result = mysqli_query($conn, $sql) or die("cannot execute query");
        // while($row = mysqli_fetch_assoc($result)){
        //     $company = $row['company'];
        //     $quantity += $row['qty'];
        //     $buy += $row['buying_price'];
        // }
        // $sql2 = "SELECT * FROM company WHERE company_name ='$company'; ";
        // $result2 = mysqli_query($conn , $sql2) or die ("cannot execute sql2");
        // // echo "hi";
        // $dd = mysqli_num_rows($result2);
        // // echo $dd;
        // $total = 0;
        
        // if ($dd >= 0){
        // // e¿cho "lo";
        // while($row = mysqli_fetch_object($result2)){
        //     // echo "yuu";
        //     $total += $row->total_amount;
        
        // }
        // }
        // $tk = $buy*$quantity;
        // $total -= $tk;
        // $sql3 = "UPDATE `company` SET `total_amount` = '$total' WHERE `company`.`Company_name` = '$company';";
        // $result3 = mysqli_query($conn, $sql3) or die ("cannot update total");
     
        // $mysqli->query("DELETE FROM `product` where `product_name` = '$id'") or die("cannot delete product");
        // $_SESSION['message'] = "Product deleted successfully";
        // $_SESSION['msg_type'] = 'danger';
        // header("Location:product.php");
        
ob_end_flush();
    
?>