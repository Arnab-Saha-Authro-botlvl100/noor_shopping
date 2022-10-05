<?php
    require_once('connection.php');
    $oid = $_GET['orderid'];
    $date = $_GET['dt'];
    $totaltk = $_GET['tk'];
    $discount = $_GET['dis'];
    $due = $_GET['due'];
    $name = $_GET['nm'];
    $month = $_GET['nameofmonth'];
    $year = $_GET['yearof'];
    $totaltk = Floatval($totaltk);
    $due = Floatval($due);
    $profitshow = $_GET['profitshow'];
    $paidtk = $totaltk - $due;
    // echo $oid . " " . $date . " " . $totaltk . " " . $discount . " " . $due . "from php";

    $sql = "INSERT INTO `orders` (`order_id`, `user`, `date`, `month`, `year`, `total_tk`, `discount`, `paid_tk`, `due_tk`, `profit`) VALUES ('$oid', '$name', '$date', '$month', '$year', '$totaltk', '$discount', '$paidtk', '$due', '$profitshow');";
    $result = mysqli_query($conn, $sql) or die("unable to insert into orders");

?>