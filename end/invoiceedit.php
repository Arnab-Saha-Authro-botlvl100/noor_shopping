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
    $sprice = Floatval($total / $qty);


    // // echo "ID: " . $pid . " QTY: " . $qty . " Total: " . $total. "Proname: " . $pname. "ID: ". $id . "Date: ". $date;
    $sql1 = "SELECT * FROM `product` WHERE `product_name`='$pname';";
    $company = '';
    $actualqty = 0;
    $buyingprice = 0;
    $result1 = mysqli_query($conn, $sql1) or die("Couldn't collect name of company in dltinvoice");
    while($row = mysqli_fetch_array($result1)){
        $company = $row['company'];
        $actualqty = $row['qty'];
        $buyingprice = $row['buying_price'];
    }
    $buyingprice = Floatval($buyingprice);
    $actualqty = Floatval($actualqty);
    // // echo "Company: " . $company;
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
    $selltk = Floatval($selltk);
    $profit = Floatval($profit);
    // // echo "sell: " . $selltk;
    // $selltk = $selltk - $total;
    // $actualprofit = $selltk - $totaltk;
    // $sql3 = "UPDATE `product` SET `qty` = '$actualqty' WHERE `product`.`product_name` = '$pname';";
    // $result3 = mysqli_query($conn, $sql3) or die(" cannot execute query3 in dltinvoice");
    // $sql4 = "UPDATE `company` SET `total_sell` = '$selltk', `total_profit` = '$actualprofit' WHERE `company`.`Company_name` = '$company';";
    // $result4 = mysqli_query($conn, $sql4) or die ("cannot execute query4 in dltinvoice");
    // $sql5 = "DELETE FROM `invoice` WHERE `invoice`.`id` = '$pid';";
    // $result5 = mysqli_query($conn, $sql5) or die("cannot delete query5 in dltinvoice");
    // header("Location:sortlist.php?id=$id&dt=$date");
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order ID: <?php echo $id?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/jquery-3.5.0.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
    	// Get value on keyup funtion
    	$("#buying, #prvsell, #newsell, #newqty").keyup(function(){

    	var profit = 0;    	
    	var x = document.getElementById("buying").value;
        var y = document.getElementById("prvsell").value;
        var z = document.getElementById("newqty").value;
        var r = document.getElementById("newsell").value;

        var selling_per_product = r/z;
        console.log("sales_per_product: "+selling_per_product )
        var profit_per_product = selling_per_product - x;
        var total_profit = profit_per_product * z;
    	
    	$('#newpro').val(total_profit);
        var zx = document.getElementById("newpro");
        console.log(zx);
        zx.value = total_profit;
    });
});
    </script>
</head>
<body>
    <h1 class = "text-center fw-bold"> Edit Order <span class = "text-danger"> <?php echo $id?></span></h1>
    <div class="container-fluid">
        <form class="row g-4" method="get" action="editorder.php">
            <div class="col-md-2">
                <label for="inputEmail4" class="form-label">Order Number</label>
                <input type="text" class="form-control bg-dark text-danger" readonly="readonly" name="edit_order_id"  id="inputEmail48" value="<?php echo $id; ?>" required>
            </div>
            <div class="col-md-2">
                <label for="inputEmail4" class="form-label">Date</label>
                <input type="text" class="form-control bg-dark text-danger" readonly="readonly" name="edit_order_date"  id="inputEmailv4" value="<?php echo $date; ?>" required>
            </div>
            <div class="col-md-2">
                <label for="inputEmail4" class="form-label">Invoice Number</label>
                <input type="text" class="form-control" readonly="readonly" name="edit_invoice_id"  id="inputEmail4" value="<?php echo $pid; ?>" required>
            </div>
            <div class="col-md-2">
                <label for="inputEmail4" class="form-label">Name</label>
                <input type="text" class="form-control" readonly="readonly" name="edit_invoice_pname"  id="inputEmail4" value="<?php echo $pname; ?>" required>
            </div>
            <div class="col-md-4">
                <label for="inputPassword4" class="form-label">Previous Quantity</label>
                <input type="text" class="form-control" name="edit_invoice_prevqty" id="inputPassword4" value="<?php echo $qty; ?>" readonly="readonly" required>
            </div>
            <div class="col-md-4">
                <label for="inputPassword4" class="form-label">Previous Total TK</label>
                <input type="text" class="form-control" name="edit_invoice_prevtk" id="inputPasswrd4" value="<?php echo $total; ?>" readonly="readonly" required>
            </div>
            <div class="col-md-4">
                <label for="inputAddress" class="form-label">Previous Selling Price</label>
                <input type="text" class="form-control" id="prvsell"  name="edit_invoice_prev_selling" value = "<?php echo $sprice; ?>" readonly="readonly" required>
            </div>
            <div class="col-md-4">
                <label for="inputAddress" class="form-label">Previous Profit</label>
                <input type="text" class="form-control" id="inputAddress"  name="edit_invoice_prev_profit" value = "<?php echo $profit_of_product; ?>" readonly="readonly" required>
            </div>
            <div class="col-md-4">
                <label for="inputAddress" class="form-label">Buying Price</label>
                <input type="text" class="form-control" id="buying"  name="edit_invoice_buying" value = "<?php echo $buyingprice; ?>" readonly="readonly" required>
            </div>
            <div class="col-md-4">
                <label for="inputAddress" class="form-label">Company</label>
                <input type="text" class="form-control" id="inputAddress"  name="edit_invoice_company" value = "<?php echo $company; ?>" readonly="readonly" required>
            </div>
            <div class="col-md-4">
                <label for="inputAddress" class="form-label">Company Selling</label>
                <input type="text" class="form-control" id="inputAddress"  name="edit_invoice_companysell" value = "<?php echo $selltk; ?>" readonly="readonly" required>
            </div>
            <div class="col-md-4">
                <label for="inputAddress" class="form-label">Company Total Tk</label>
                <input type="text" class="form-control" id="inputAddress"  name="edit_invoice_companytotal" value = "<?php echo $totaltk; ?>" readonly="readonly" required>
            </div>
            <div class="col-md-3">
                <label for="inputAddress" class="form-label">New Selling Price</label>
                <input type="text" class="form-control" id="newsell"  name="edit_invoice_new_selling" value = "<?php echo $sprice; ?>"  required>
            </div>
            <div class="col-md-3">
                <label for="inputAddress" class="form-label">New Quantity</label>
                <input type="text" class="form-control" id="newqty"  name="edit_invoice_new_qty" required>
            </div>
            <div class="col-md-3">
                <label for="inputAddress" class="form-label">New Profit</label>
                <input type="text" class="form-control" id="newpro"  name="edit_invoice_new_profit" required>
            </div>
           
            <div class="col-12 mt-2">
                <button type="submit" class="btn btn-dark">Confirm</button>
            </div>
        </form>
    </div>
</body>
</html>