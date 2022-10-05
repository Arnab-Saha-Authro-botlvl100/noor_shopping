<?php
    session_start();
    if(isset($_SESSION['User'])){
?>

<?php
    require_once('connection.php');
    // $conn = new mysqli("localhost", "aurexaac_buja", "bu!ja4#20,38?kd", "aurexaac_anan") or die("cannot connect database");
    $sql = "SELECT * FROM product;";
    $result = mysqli_query($conn, $sql) or die("cannot execute query");
    $dd = mysqli_num_rows($result);
    // echo $dd." ";
    $result_per_page = 50;
    $number_of_pages = ceil($dd / $result_per_page);
    // echo $number_of_pages;

    if(!isset($_GET['page'])){
        $page = 1;
    }
    else{
        $page = $_GET['page'];
    }

    $this_page_first_result = ($page-1)*$result_per_page;
    $sqlpage = "SELECT * FROM product LIMIT $this_page_first_result, $result_per_page";
    $resultpage = mysqli_query($conn, $sqlpage) or die("cannot execute product by page");

?>

<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
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
});

        const randomcode = () => {
            var j = Math.random().toString(17).substr(2, 7);
            const code = document.getElementById("pro_code");
            console.log(j);
            code.value = j;
        }
</script>
<script src="js/getdate.js"></script>
<link rel="stylesheet" href="stylefooter.css">
</head>

<body onload="randomcode();">
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="dashboard.php">Noor Wares Market</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="dashboard.php">Dashboard</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="product.php">Product</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="displayajex.php">Company</a>
              </li>
            
              <li class="nav-item">
                <a class="nav-link" href="billing2.php">Billing</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" onclick="movetodatebysearch()">Total Bill</a>
              </li>
              
            </ul>
          </div>
          <a class="btn btn-danger" href="logout.php?logout">Log-Out</a>
        </div>
    </nav>

    <?php

        if (isset($_SESSION['message'])):
        ?>
        <div class="alert mt-5 mb-5 alert-<?=$_SESSION['msg_type']?>">

        <?php 
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        ?>
        </div>
    <?php endif; ?>

    <section class="add_delete_search mt-5 container-fluid">

        <div class="btngrp d-flex container-fluid">
             <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary mt-3 me-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add Product
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Products</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form class="row g-3" method="post" action="productadd.php">
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">Code</label>
                            <input type="text" class="form-control" id="pro_code" name="pro_code" required readonly= "readonly">
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword4" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="pro_name" name="pro_name" required>
                        </div>
                        <div class="col-12">

                            <label for="inputAddress" class="form-label">Company Name</label>
                           
                            <input type="text"  class="form-select" List="namegiven" size="50px" id="inputname" placeholder="Search here..." name="pro_company" required> 
                                <datalist id="namegiven">
                                    
                                    <?php
                                        $sql1 = "SELECT DISTINCT Company_name FROM `company`;";
                                        $result1 = mysqli_query($conn, $sql1) or die("cannot execute sql1");
                                    
                                        $dd1 = mysqli_num_rows($result1);
                                        // echo $dd1;
                                        if($dd1>0){
                                            $i = 1;
                                            while( $row1 = mysqli_fetch_assoc($result1)){
                                    ?>
                                        <option><?php echo $row1['Company_name'];?></option>
                                    <?php
                                        }
                                    }
                                        ?>
                                </datalist>
                                <!-- <button type="submit" class="btn btn-success text-white fw-bold">Select</button> -->
                               
                            <!-- <input type="text" class="form-control" id="pro_company" name="pro_company" required> -->
                        </div>
                        <div class="col-12">
                            <label for="inputAddress2" class="form-label">Description</label>
                            <input type="text" class="form-control" id="pro_decs" name="pro_desc">
                        </div>
                        <div class="col-md-6">
                            <label for="inputCity" class="form-label">Quantity</label>
                            <input type="text" class="form-control" id="pro_qty" name="pro_qty" required>
                        </div>
                        <div class="col-md-6">
                            <label for="inputCity" class="form-label">TYPE</label>
                            <!-- <input type="number" class="form-control" id="pro_qty" name="pro_type" required -->
                            <select id="type" class="col-md-6" name="pro_type" required>
                                <option value="PC">Pieces</option>
                                <option value="KG">Kilograms</option>
                                <option value="FT">Feet</option>
                                <option value="IN">Inches</option>
                                <option value="GZ">Gauge</option>
                                <!-- <option value="audi">Audi</option> -->
                            </select>
                            
                        </div>
                        <div class="col-md-6">
                            <label for="inputCity" class="form-label">MRP</label>
                            <input type="text" class="form-control" id="MRP" name="mrp" >
                        </div>
                        <div class="col-md-6">
                            <label for="inputCity" class="form-label">Dealer Price</label>
                            <input type="text" class="form-control" id="dlr" name="dlr" >
                        </div>
                        <div class="col-md-6 ">
                            <label for="inputCity" class="form-label">Buying Price</label>
                            <input type="text" class="form-control prc" id="price" name="bpl" required>
                        </div>
                        <div class="col-md-6">
                            <label for="inputCity" class="form-label">Selling Price</label>
                            <input type="text" class="form-control prc" id="qty" name="spl">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="inputCity" class="form-label">Profit</label>
                            <input type="text" class="form-control" id="total" name="profit" readonly="readonly">
                        </div>
                        <div class="col-md-6">
                            <label for="inputCity" class="form-label">Alert</label>
                            <input type="text" class="form-control" id="alert" name="alert">
                        </div>
                    
                    
                        <div class="col-12">
                            <button type="submit" class="btn btn-success">Add</button>
                        </div>
                </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
            </div>

            
            <div class="input-group mt-3 w-50 me-3">
                <form class="w-100"  method="get" action="searchbycompany.php">
                   <div class="input-group">
                    <select id="inputState" class="form-select" name="companygiven">
                        <?php
                            $sql1 = "SELECT DISTINCT Company_name FROM `company`;";
                            $result1 = mysqli_query($conn, $sql1) or die("cannot execute sql1");
                        
                            $dd1 = mysqli_num_rows($result1);
                            if($dd1>0){
                                $i = 1;
                                while( $row1 = mysqli_fetch_assoc($result1)){
                        ?>
                            <option><?php echo $row1['Company_name'];?></option>
                        <?php
                            }
                        }
                        ?>
                        </select>
                        <button type="submit" class="btn btn-success text-white fw-bold">Search</button>
                   </div>  
                </form>
            </div>

            <div class="input-group mt-3 w-50 me-3">
                <form class="w-100"  method="get" action="searchbycompany.php">
                   <div class="input-group">
                   <input type="text"class="form-select" List="namegiven1" size="50px" placeholder="Search here..." name="namegiven1"> 
                    <datalist id="namegiven1" >
                        <select>
                        <?php
                            $sql2  = "SELECT * FROM `product`;";
                            $result2 = mysqli_query($conn, $sql2) or die("cannot execute sql1");
                        
                            $dd2 = mysqli_num_rows($result2);
                            // echo $dd1;
                            if($dd2>0){
                                $j = 1;
                                while( $row2 = mysqli_fetch_assoc($result2)){
                        ?>
                            <option><?php echo $row2['product_name'];?></option>
                        <?php
                            }
                        }
                        ?>
                        </select>
                    </datalist>
                        <button type="submit" class="btn btn-success text-white fw-bold">Search</button>
                   </div>  
                </form>
            </div>
        </div>
       
       


        <div class="tablediv mt-5 table-responsive">
            <h1 class="text-danger text-center mb-5">All Products</h1>
                <table class="table table-striped table-hover">
                    <thead >  
                            <tr>
                                <th scope="col">Sl</th>
                                <th scope="col">Code</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Company</th>
                                <th scope="col">Description</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Type</th>
                                <th scope="col">MRP</th>
                                <th scope="col">Dealer Price</th>
                                <th scope="col">Buying Price</th>
                                <th scope="col">Selling Price</th>
                                <th scope="col">Profit</th>
                                <th scope="col">Alert</th>
                                <th scope="col" colspan="2" class="text-center">Action</th>
                            
                            </tr>
                        </thead>
                    <tbody>

                        <?php
                            if($dd>0){
                                $i = 1;
                                while($row = mysqli_fetch_assoc($resultpage)){
                                   $qty = $row['qty'];
                                   $alt = $row['low_alert'];
                        ?>
                                <tr 
                                
                                <?php 
                                    if($qty <= $alt){
                                        echo 'class="bg-danger fw-bold "';
                                    }
                                ?>
                                
                                >
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row['product_code']; ?></td>
                                    <td><?php echo $row['product_name']; ?></td>
                                    <td><?php echo $row['company']; ?></td>
                                    <td><?php echo $row['description']; ?></td>
                                    <td><?php echo $row['qty']; ?></td>
                                    <td><?php echo $row['type']; ?></td>
                                    <td><?php echo $row['mrp']; ?></td>
                                    <td><?php echo $row['dealer_price']; ?></td>
                                    <td><?php echo $row['buying_price']; ?></td>
                                    <td><?php echo $row['selling_price']; ?></td>
                                    <td><?php echo $row['net_profit']; ?></td>
                                    <td><?php echo $row['low_alert']; ?></td>
                                    <td> <a href= "edit.php?pname=<?php echo $row['product_name']; ?>&qty=<?php echo $row['qty'];?>&
                                    company=<?php echo $row['company'];?>&dprice=<?php echo $row['dealer_price'];?>
                                    &bprice=<?php echo $row['buying_price'];?>&sprice=<?php echo $row['selling_price'];?>
                                    &low_alert=<?php echo $row['low_alert'];?>&des=<?php echo $row['description'];?>
                                    &bprice=<?php echo $row['buying_price'];?>&PCODE=<?php echo $row['product_code'];?>&mrp=<?php echo $row['mrp'];?>&profit=<?php echo $row['net_profit'];?>&type=<?php echo $row['type']; ?>  
                                    "
                                        class= "btn btn-primary">Edit</a> </td>
                                        <td> <a href= "dlt.php?delete=<?php echo $row['product_name']; ?>&PCODE=<?php echo $row['product_code'];?>
                                    &qty=<?php echo $row['qty'];?>&
                                    company=<?php echo $row['company'];?>&bprice=<?php echo $row['buying_price'];?>
                                    "
                                        class= "btn btn-warning"  >Delete</a> </td>
                                </tr>

                        <?php
                             $i = $i+1;
                           
                                }
                               
                                
                            }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="container_fluid w-50 mx-auto">
                <div class="row">
                    <?php
                    for($page = 1; $page <= $number_of_pages; $page++) {
                    ?>
                    <div class="col fw-bold mx-auto text-center">
                        <?php
                            echo '<a href="product.php?page=' . $page . '">' . $page . '</a>'; 
                        ?>
                    </div>
                    <?php
                    }
                    ?>
                </div>
               
            </div>
    </section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>


<?php

    }
    else{
        header("location:index.php");
    }
?>