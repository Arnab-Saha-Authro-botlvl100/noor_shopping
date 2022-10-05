<?php
 require_once('connection.php');
    $prvname = $_GET['prvname'];
    $prvphn = $_GET['prvphn'];
    $prvtotal = $_GET['prvtotal'];

    $cname = $_GET['cname'];
    $cphn = $_GET['cphn'];
    $ctotal = $_GET['ctotal'];
    // echo $ctotal."\n".$prvtotal."\n";
    if($cname == ''){
        $cname = $prvname;
    }
    if($cphn == ''){
        $cphn = $prvphn;
    }
    if(empty($ctotal)){
        $ctotal = $prvtotal;
    }
    $sql = "UPDATE `company` SET `Company_name` = '$cname', `total_amount` = '$ctotal', `company_number` = '$cphn' WHERE `company`.`Company_name` = '$prvname';";
    //echo $sql;
    $result = mysqli_query($conn, $sql) or die("cannot edit company");
    $sql2 = "UPDATE `product` SET `company` = '$cname' WHERE `product`.`company` = '$prvname';";
    $result2 = mysqli_query($conn, $sql2) or die ("cannot change company name of product");
    header("Location:displayajex.php");
?>