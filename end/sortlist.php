<?php
    session_start();
    if(isset($_SESSION['User'])){
?>

<?php
    require_once('connection.php');
    // $conn = new mysqli("localhost", "aurexaac_buja", "bu!ja4#20,38?kd", "aurexaac_anan") or die("cannot connect database");
    $id = $_GET['id'];
    $date = $_GET['dt'];
    $sql = "SELECT * FROM invoice where date='$date' and uid='$id';";
    $result = mysqli_query($conn, $sql) or die("cannot execute query");
    $sql2 = "SELECT SUM(total) as total FROM invoice where date='$date' and uid='$id';";
    $result2 = mysqli_query($conn, $sql2) or die("cannot execute query2");
    $totaltk = 0;
    while($row2 = mysqli_fetch_assoc($result2)){
        $totaltk += $row2['total'];
    }
    $discounttk = 0;
    $discount = 0;
    $due = 0;
    $ordertk = 0;
    $sql3 = "SELECT * FROM orders where date='$date' and order_id='$id';";
    $result3 = mysqli_query($conn, $sql3) or die("cannot connect orders");
    while($row3 = mysqli_fetch_assoc($result3)){
      $discounttk += $row3['total_tk'];
      $discount += $row3['discount'];
      $due += $row3['due_tk'];
      $ordertk = $row3['total_tk'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $id." details";?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/jquery-3.5.0.min.js"></script>
    <script src="js/getdate.js"></script>
    <script>
    	$(document).ready(function(){
    	// Get value on keyup funtion
    	$("#orderdiscount").on("keyup", function(){

    	var total=0;    	
    	var x = document.getElementById("total_amount_order").innerHTML;
      // console.log(x);

    	var y = Number($("#orderdiscount").val());
      // console.log(y);
    	var total=x - y;  
      console.log(total);
    	$('#orderdiscounttk').val(total);
        var z = $("#orderdiscounttk").val();
        console.log(z);
        z.value = total;
     });
   });
  </script>
</head>
<body>

    <nav class="navbar  navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="dashboard.php">Noor Wares Market</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="dashboard.php">Deshboard</a>
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
          <a class="btn btn-danger" href="index.html">Log-Out</a>
        </div>
    </nav>

    <section class="list_bill container-fluid mt-5" >
    <div class="table-responsive">
      <table class="table">
          <thead class="table-dark">
              <tr>
              
              <!-- <th scope="col">Seq Number</th> -->
              <th scope="col">Date</th>
              <th scope="col">Order ID</th>
              <th scope="col">Invoice ID</th>
              <th scope="col">Customer Name</th>
              <th scope="col">Customer Phone</th>
              <th scope="col">Product Name</th>
              <th scope="col">Quantity</th>
              <th scope="col">Price</th>
              <th scope="col">Total Profit</th>
              <th scope="col">Action</th>
              </tr>
          </thead>
          <tbody>
            <?php
           
                while ($row = mysqli_fetch_assoc($result)){

                
            ?>
              <tr>
                   
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['uid']; ?></td>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['cust_name']; ?></td>
                    <td><?php echo $row['phn']; ?></td>
                    <td><?php echo $row['pro_name']; ?></td>
                    <td><?php echo $row['qty']; ?></td>
                    <td><?php echo $row['total']; ?></td>
                    <td><?php echo $row['total_profit']; ?></td>
                    <td> <a role="button" class="btn btn-danger" href="invoicedlt.php?id=<?php echo $row['id'];?>&qty=<?php echo $row['qty'];?>&tot=<?php echo $row['total'];?>&pname=<?php echo $row['pro_name'];?>&oid=<?php echo $id; ?>&date=<?php echo $date; ?>&profit=<?php echo $row['total_profit']; ?>
                    ">Delete</a> </td>
                    <td> <a role="button" class="btn btn-primary" href="invoiceedit.php?id=<?php echo $row['id'];?>&qty=<?php echo $row['qty'];?>&tot=<?php echo $row['total'];?>&pname=<?php echo $row['pro_name'];?>&oid=<?php echo $id; ?>&date=<?php echo $date; ?>&profit=<?php echo $row['total_profit']; ?>
                    ">Edit</a> </td>

                    <?php 
                  
                } ?>
                </tr>

            <tr class="bg-light">
                    <td></td>
                    <td></td>
                    <td></td>
                   
                    <td></td>
                    <td></td>
                    <td colspan="2" align="center" class="fw-bolder text-danger">Total Amount</td>
                    
                    <td class="fw-bolder text-danger" id="total_amount_order"><?php echo $totaltk; ?></td>
                    
              </tr>
            <tr class="bg-light">
                   
                    <td>
                        
                          <label for="inputEmail4" class="form-label">Order ID</label>
                          <input type="text" class="form-control fw-bold text-danger" readonly="readonly" name="edit_order_ID"  id="orderid" value="<?php echo $id; ?>" required>
                        
                       
                    </td>
                    <td>
                        
                          <label for="inputEmail4" class="form-label">Date</label>
                          <input type="text" class="form-control fw-bold text-danger" readonly="readonly" name="edit_order_date"  id="orderdate" value="<?php echo $date; ?>" required>
                        
                       
                    </td>

                    <td  align="center">

                          <label for="inputEmail4" class="form-label">Current Amount</label>
                          <input type="text" class="form-control  fw-bold text-danger"  name="edit_order_xurrentttk"  id="ordercurrenttk" value="<?php echo $ordertk; ?>" required>
                        
                    </td>
                 
                    <td colspan="4" align="center">

                          <label for="inputEmail4" class="form-label">Total Amount After Discount:</label>
                          <input type="text" class="form-control  fw-bold text-danger"  name="edit_order_discounttk"  id="orderdiscounttk" placeholder="<?php echo $totaltk; ?>" required>
                        
                    </td>
                    
                    <td  align="center">
                           <label for="edit_order_discount" class="form-label">Discount</label>
                           <input type="text" class="form-control fw-bold text-danger"  name="edit_order_discount"  id="orderdiscount" value="<?php echo $discount; ?>" required>
                    </td>

                    <td  align="center">
                           <label for="edit_order_discount" class="form-label">Due</label>
                           <input type="text" class="form-control fw-bold text-danger"  name="edit_order_due"  id="orderdue" value="<?php echo $due; ?>" required>
                    </td>
                    <td class="fw-bolder text-danger">
                      
                      <label for="edit_order_discount" class="form-label">Action</label><br>
                      <button type="submit" class="btn btn-warning" onclick="adjust()">Save 
                      </button>
                    
                    </td>
                    
              </tr>
          </tbody>
      </table>
  </div>
    </section>
    <script type="text/javascript">
      const adjust = () => {
        var tk = document.getElementById("orderdiscounttk").value;
        var dc = document.getElementById("orderdiscount").value;
        if (dc == "" || tk == ""){
          alert("Please select Discount");
        }else{
        var oid = document.getElementById("orderid").value;
        var dt = document.getElementById("orderdate").value;
        var tk = document.getElementById("orderdiscounttk").value;
        var dc = document.getElementById("orderdiscount").value;
        var due = document.getElementById("orderdue").value;
        // console.log(oid, dt, tk, dc, due);

        var xmlhttp = new XMLHttpRequest();
                
        xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            
            // document.getElementById(${product_content}).innerHTML = this.responseText; 
            console.log(this.responseText);
        }
        };
        xmlhttp.open("GET","editorder2.php?orderid="+oid+"&dt="+dt+"&tk="+tk+"&dis="+dc+"&due="+due,true);
        xmlhttp.send();
        }
        window.location.reload(true);
      }
    </script>
</body>
</html>

<?php

    }
    else{
        header("location:index.php");
    }
?>