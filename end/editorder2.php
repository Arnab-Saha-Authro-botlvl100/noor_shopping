<?php
    require_once('connection.php');
    $oid = $_GET['orderid'];
    $date = $_GET['dt'];
    $taka = $_GET['tk'];
    $discount = $_GET['dis'];
    $due = $_GET['due'];

    $taka = floatval($taka);
    $discount = floatval($discount);
    $due = floatval($due);

    // echo $oid . ' ' . $date . ' ' . $taka . ' ' . $discount . ' ' . $due . "from php";

    $paid_tk = $taka - $due;

    $sql ="UPDATE `orders` SET `total_tk`='$taka', `discount`='$discount', `paid_tk`='$paid_tk', `due_tk`='$due' WHERE `orders`.`order_id`='$oid';";
    $result = mysqli_query($conn, $sql) or die ("cannot update");
    

?>