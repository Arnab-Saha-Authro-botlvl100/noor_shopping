<?php
    session_start();
    if(isset($_SESSION['User'])){
?>

<?php
    require_once('connection.php');
    // $conn = new mysqli("localhost", "aurexaac_buja", "bu!ja4#20,38?kd", "aurexaac_anan") or die("cannot connect database");
    // $pname = $_GET['pname'];
    $pname = html_entity_decode($_GET['pname']);
    $qty = $_GET['qty'];
    $company = $_GET['company'];
    $mrp = $_GET['mrp'];
    $dprice = $_GET['dprice'];
    $b_price = $_GET['bprice'];
    $s_price = $_GET['sprice'];
    $low = $_GET['low_alert'];
    $description = $_GET['des'];
    $p_code = $_GET['PCODE'];
    $profit = $_GET['profit'];
    $type = $_GET['type']
    // echo $description;
    // $mrp = $_GET['m'];
    // echo $pname . " " . $qty . " " . $company . " " . $dprice . " " . $b_price . " " . $s_price . " " . $low; 
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="js/jquery-3.5.0.min.js"></script>
	<script>
		$(document).ready(function(){
    	// Get value on keyup funtion
    	$("#price, #qty").keyup(function(){

    	var total=0;    	
    	var x = Number($("#price").val());
    	var y = Number($("#qty").val());
    	var total=y - x;  

    	$('#total').val(total);
        var z = document.getElementById("total");
        console.log(z);
        z.value = total;
    });

    $("#new_qty, #prv_qty").keyup(function(){
            var update = 0;
            var x = Number($("#prv_qty").val());
            var y = Number($("#new_qty").val());
            console.log(x);
            console.log(y);
            var update = y - x;

            
            if(update == 0){
                $('#up_qty').val(x);
            }

            else if( update != 0){
                $('#up_qty').val(update);
                var z = document.getElementById("up_qty");
                console.log(z);
                z.value = update;
            }

     });

});

    
</script>
</head>
<body>
    <h1 class="text-center text-success mt-5">Edit <span class = "text-danger"><?php echo $pname; ?></span></h1>
    <div class="container-fluid mt-3">
        <form class="row g-3 container-fluid" method="post" action="edit2.php">
                <div class="col-sm-2">
                    <label for="inputEmail4" class="form-label">Product Code</label>
                    <input type="text" class="form-control bg-danger text-white fw-bold" readonly="readonly" name="pcode" value='<?php echo $p_code ?> '> 
                </div>
                <div class="col-sm-3">
                    <label for="inputEmail4" class="form-label">Product Name</label>
                    <input type="text" class="form-control bg-danger text-white fw-bold" readonly="readonly" name="pname" value="<?php echo $pname; ?> "> 
                </div>
            <div class="col-sm-3">
                <label for="inputEmail4" class="form-label">Previous Quantiy</label>
                <input type="text" class="form-control"  readonly="readonly" id="prv_qty" name="qty" value="<?php echo $qty; ?>">
            </div>
            <div class="col-sm-3">
                <label for="inputEmail4" class="form-label">New Quantiy</label>
                <input type="text" class="form-control" id="new_qty" name="new_qty" placeholder = "Please fill it, if nothing to add just put 0" required>
            </div>
            <div class="col-sm-3">
                <label for="inputEmail4" class="form-label">Updated Quantiy</label>
                <input type="text" class="form-control"  readonly="readonly" id="up_qty" name="updated_qty" >
            </div>
            <div class="col-sm-3">
                <label for="inputPassword4" class="form-label">Company</label>
                <input type="text" class="form-control" name="company" readonly="readonly" value="<?php echo $company; ?>">
            </div>
            <div class="col-md-2">
                            <label for="inputCity" class="form-label">TYPE</label>
                            <!-- <input type="number" class="form-control" id="pro_qty" name="pro_type" required -->
                            <select id="type" class="col-md-6" name="pro_type"  required>
                                <option value= "<?php echo $type; ?>"><?php echo $type; ?></option>
                                <option value="PC">Pieces</option>
                                <option value="KG">Kilograms</option>
                                <option value="FT">Feet</option>
                                <option value="IN">Inches</option>
                                <option value="GZ">Gauge</option>
                                <!-- <option value="audi">Audi</option> -->
                            </select>
                            
                        </div>
            <div class="col-sm-6">
                <label for="inputPassword4" class="form-label">Description</label>
                <input type="text" class="form-control" id="inputPassword4" name="description" value = "<?php echo $description; ?>">
            </div>
            <div class="col-sm-3">
                <label for="inputAddress" class="form-label">MRP</label>
                <input type="text" class="form-control" id="inputAddress" name="mrp" value= "<?php echo $mrp ?>" >
            </div>
            <div class="col-sm-3">
                <label for="inputAddress" class="form-label">Dealer Price</label>
                <input type="text" class="form-control"  name="d_price" value= "<?php echo $dprice ?>">
            </div>
            <div class="col-sm-3">
                <label for="inputAddress" class="form-label">Buying Price</label>
                <input type="text" class="form-control" id="price"  name="b_price" value="<?php echo $b_price ?>" readonly="readonly">
            </div>
            <div class="col-sm-3">
                <label for="inputAddress" class="form-label">Selling Price</label>
                <input type="text" class="form-control" id="qty" name="s_price" value="<?php echo $s_price ?>">
            </div>
            <div class="col-sm-3">
                <label for="inputAddress" class="form-label">Profit</label>
                <input type="text" class="form-control" id="total" readonly="readonly" name="profit" value="<?php echo $profit ?>">
            </div>
            <div class="col-sm-3">
                <label for="inputAddress" class="form-label">Alert</label>
                <input type="text" class="form-control"  name="low" value="<?php echo $low ?>">
            </div>
           
            <div class="col-12">
               <button type="submit" class="btn btn-outline-success"> Confirm </button>
            </div>
        </form>
    </div>
    
</body>
</html>
<?php

    }
    else{
        header("location:index.php");
    }
?>