<?php
  require_once('connection.php');
  $orderid = $_GET['edit_order_id'];
  $orderdate = $_GET['edit_order_date'];
  $invoiceid = $_GET['edit_invoice_id'];
  $pname = $_GET['edit_invoice_pname'];
  $prevqty = $_GET['edit_invoice_prevqty'];
  $prevsell = $_GET['edit_invoice_prev_selling'];
  $prevtotaltk = $_GET['edit_invoice_prevtk'];
  $prvprofit = $_GET['edit_invoice_prev_profit'];
  $productbye = $_GET['edit_invoice_buying'];
  $company = $_GET['edit_invoice_company'];
  $companysell = $_GET['edit_invoice_companysell'];
  $companytotal = $_GET['edit_invoice_companytotal'];
  $newsell = $_GET['edit_invoice_new_selling'];
  $newqty = $_GET['edit_invoice_new_qty'];
  $newprofit = $_GET['edit_invoice_new_profit'];
//   echo $invoiceid . " " . $pname . " " . $prevqty . " " . $prevsell . " " . $company . " " . $companysell . " " . $newsell . " " . $newqty;

//   if($prevqty > $newqty){
      $sql8 = "SELECT * FROM `company` WHERE `company`.`Company_name` = '$company';";
      $result8 = mysqli_query($conn, $sql8) or die ("cannot collect from company ");
      $prev_comp_profit = 0;
      while($row8 = mysqli_fetch_assoc($result8)){
          $prev_comp_profit = $row8['total_profit'];
      }

      $prev_comp_profit = Floatval($prev_comp_profit);
      $realcost = $productbye * $prevqty;
      $realcost = Floatval($realcost);

      $companytotal += $realcost; //company total baralam

      $prevtk = $prevqty * $prevsell;
      $prevtk = Floatval($prevtk);
      // $gainprofit = $prevtk - $realcost;
      // $prev_comp_profit -= $gainprofit;
      $tk = $newsell;
      $tk = Floatval($tk);
      // $newprofit = $tk - $realcost;
      // $prev_comp_profit += $newprofit;
      $prev_comp_profit -= $prvprofit;
      $prev_comp_profit += $newprofit;

      $com_tk_new = $newqty * $productbye; //company er koto kombe bar korci
      $companytotal -= $com_tk_new; //company total komalam
      
      
    //   echo $prevtk . " " . $tk;
      $companysell = $companysell - $prevtk;
      $companysell = $companysell + $tk;
      // $companyprofit = $companysell - $companytotal;
      //echo $companysell;
      $sql1 = "UPDATE `company` SET `total_amount` = '$companytotal', `total_sell` = '$companysell', `total_profit` = '$prev_comp_profit' WHERE `company`.`Company_name` = '$company';";
      $result1 = mysqli_query($conn, $sql1) or die ("cannot execute query1 in editorder");
      $sql2 = "SELECT * FROM `product` WHERE `product_name`='$pname';";
      $actualqty = 0;
      $result2 = mysqli_query($conn, $sql2) or die("Couldn't collect name of company in dltinvoice");
        while($row = mysqli_fetch_assoc($result2)){
           
            $actualqty = $row['qty'];
        }
     $actualqty = Floatval($actualqty);
     $actualqty = $actualqty + $prevqty;
     $actualqty = $actualqty - $newqty;
     $tk = strval($tk);
     $sql3 = "UPDATE `product` SET `qty` = '$actualqty' WHERE `product`.`product_name` = '$pname';";
     $result3 = mysqli_query($conn, $sql3) or die(" cannot execute query3 in dltinvoice");
    //  $sql4 = "UPDATE `invoice` SET `qty` = '$newqty', `total` = `$tk` WHERE `invoice`.`id` = $invoiceid;";
     $sql4 = "UPDATE `invoice` SET `qty` = '$newqty', `total` = '$tk', `total_profit` = '$newprofit' WHERE `invoice`.`id` = $invoiceid;";
     //echo $sql4;
     $result4 = mysqli_query($conn, $sql4) or die (" cannot execute query4 in editinvoice");
     header("Location:sortlist.php?id=$orderid&dt=$orderdate");

//   }
  
?>