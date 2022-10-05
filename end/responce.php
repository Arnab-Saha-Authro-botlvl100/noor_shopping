<?php
        $q = $_GET['q'];
        $pro = $q;
        require_once('connection.php');
        // $conn = new mysqli("localhost", "aurexaac_buja", "bu!ja4#20,38?kd", "aurexaac_anan") or die("cannot connect database");
        $sql1 = "SELECT * FROM product WHERE product_name = '$q';";
        $result = mysqli_query($conn, $sql1) or die("cannot execute query");
        
       
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />

  <script type="text/javascript">
    function EnableDisable(txtPassportNumber) {
        //Reference the Button.
        var btnSubmit = document.getElementById("btnSubmit");
 
        //Verify the TextBox value.
        if (txtPassportNumber.value.trim() != "") {
            //Enable the TextBox when TextBox has value.
            btnSubmit.disabled = false;
        } else {
            //Disable the TextBox when TextBox is empty.
            btnSubmit.disabled = true;
        }
    };
</script>
</head>
<body>
    <div class=" container-fluid">
        <?php
         while ($row = mysqli_fetch_assoc($result)){
             $check =  $row['qty'];
             if($check == 0) {
               
                echo '<h4 class="animate__animated animate__shakeX fw-bold text-danger">Product Quantity 0</h4>';
                break;
             }
            ?>
            <div class="row g-2">
                <div class="col-sm-3">
                    <label for="inputEmail4" class="form-label">Selected Product</label>
                    <div type="text" id="checkproductname" class="form-control bg-danger text-white fw-bold"> <?php echo $row['product_name']; ?></div>
                </div>

                <div class="col-sm-2">
                    <label for="inputEmail4" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="productqty"  placeholder="<?php echo $row['qty']; ?>" onkeyup="EnableDisable(this)" required>
                </div>
                <div class="col-sm-2">
                    <label for="inputEmail4" class="form-label">Company</label>
                    <div type="text" class="form-control" id="productcompany"  ><?php echo $row['company']; ?></div>
                </div>
            

                <div class="col-sm-2">
                <fieldset disabled>
                    <label for="inputEmail4" class="form-label">MRP</label>
                    <div type="number" class="form-control bg-danger text-white fw-bold" id="mrp" > <?php echo $row['mrp']; ?></div>
                </div>

                <div class="col-sm-3">
                    <fieldset disabled>
                    <label for="inputEmail4" class="form-label">Buying Price</label>
                    <div type="text" class="form-control bg-danger text-white fw-bold" id="buy"><?php echo $row['buying_price']; ?></div>
                </div>

                <div class="col-sm-3">
                    <fieldset disabled>
                    <label for="inputEmail4" class="form-label">Selling Price</label>
                    <div type="text" class="form-control bg-danger text-white fw-bold" id="sell"> <?php echo $row['selling_price']; ?></div>
                </div>
            

                <div class="col-sm-3">
                    <label for="inputEmail4" class="form-label">Final Price</label>
                    <input type="number" class="form-control" id="sellyou"  onkeyup="EnableDisable(this)" required >
                </div>

                <div class="col-sm-4">
                <fieldset disabled>
                    <label for="inputEmail4" class="form-label">Description</label>
                    <input type="number" class="form-control bg-dark fw-bold" id="description" placeholder="<?php echo $row['description']; ?>">
                </div>

                <?php
           

         }
         ?>
            </div>
                <div class="button mt-2">
                    <button class="btn btn-primary" onclick="loadjs()" id="btnSubmit" >Add</button>
                </div>


    </div>
    <script src="js/load.js"></script>
</body>
</html>