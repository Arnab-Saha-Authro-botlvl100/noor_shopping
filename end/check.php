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
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href ="style1.css" rel="stylesheet">
    <style>
        .recipt{
            background-color: rgba(0,5,2,0.2) !important;
        }
        .dltbtn{
            padding: 0.1rem 0.5rem;
            background-color: blue !important;
            margin-top: 7px;
        }
        #listid{
            display: none;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
        function myfun(data){
            // alert(data);
            if (data == ""){
                document.getElementById("recipt2").innerHTML = "";
                
                return;
            }
            else {
                var xmlhttp = new XMLHttpRequest();
             
                xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    
                    document.getElementById("recipt2").innerHTML = this.responseText;
                }
                };
                xmlhttp.open("GET","responce.php?q="+data,true);
                xmlhttp.send();
               
            }
           
        }

        const loadvalue = () => {
            const x = document.getElementById("namec").value;
            const y = document.getElementById("address").value;
            const z = document.getElementById("phone").value;
            const btn = document.getElementById("save");
            // console.log(x,y,z);
            btn.style.display = "none";
        }
        const initBill = () => {
            var j = Math.random().toString(16).substr(2, 5);
            const uid = document.getElementById("uid");
            uid.value = j;
        }
        
        

</script>

</head>
<body onload="initBill();">

    <nav class="navbar  navbar-expand-lg navbar-light bg-light">
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
                <a class="nav-link"  href="product.php">Product</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="displayajex.php">Company</a>
              </li>              
              <li class="nav-item">
                <a class="nav-link" href="billing2.php">Billing</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="totalbilling.php"> Total Billing</a>
              </li>             
            </ul>
          </div>
          <a class="btn btn-danger" href="logout.php?logout">Log-Out</a>
        </div>
    </nav>
        <div id="error">

        </div>
    <section class="container-fluid mt-2">
        <h1 class="text-center text-danger p-3">Billing</h1>

        <div class="d-flex  container-fluid" style="justify-content:space-between; ">
            <div class="formgrp col-sm-4">
                <h3 class="text-center text-primary mb-3">Customer Info</h3>
                <div class="row g-3">
                   
                    <div class="col">
                        <label for="inputCity" class="form-label"> Order ID Of Customer</label>
                        <input type="text" class="form-control bg-dark fw-bold text-secondary" placeholder="Customer Name" aria-label="Customer Name" id="uid" value="">
                    </div>
                    <div class="col">
                        <label for="inputCity" class="form-label"> Customer Name</label>
                        <input type="text" class="form-control" placeholder="Customer Name" aria-label="Customer Name" id="namec" >
                    </div>
                    <div class="col">
                        <label for="inputCity" class="form-label"> Customer Address</label>
                        <input type="text" class="form-control" placeholder="Address" aria-label="Last name" id="address">
                    </div>
                    <div class="col">
                    <label for="inputCity" class="form-label"> Customer Phone</label>
                        <input type="text" class="form-control" placeholder="Phone" aria-label="phn" id="phone">
                    </div>
                    <button class="btn btn-primary" onclick="showalert()">Save</button>
                </div>
            </div>

            <div class=" col-sm-8 row g-4 container-fluid">
                    <div class="col-sm-6">
                        <form class = "billing-form"  id="listid">
                            <label for="inputEmail4" class="form-label">Product Name</label>
                            <div class="input-group">
                            <input type="text"  class="form-select" List="namegiven" size="50px" id="inputname" placeholder="Search here..." name="product_name" onchange="myfun(this.value)"> 
                                <datalist id="namegiven">
                                    
                                    <?php
                                        $sql1 = "SELECT DISTINCT product_name FROM `product`;";
                                        $result1 = mysqli_query($conn, $sql1) or die("cannot execute sql1");
                                    
                                        $dd1 = mysqli_num_rows($result1);
                                        // echo $dd1;
                                        if($dd1>0){
                                            $i = 1;
                                            while( $row1 = mysqli_fetch_assoc($result1)){
                                    ?>
                                        <option><?php echo $row1['product_name'];?></option>
                                    <?php
                                        }
                                    }
                                        ?>
                                </datalist>
                                <!-- <button type="submit" class="btn btn-success text-white fw-bold">Select</button> -->
                            </div>   
                        </form>
                    </div>
                    <div id="recipt2">

                    </div>
                
            </div> 
        </div>
        

        <div class="container-fluid mt-5" >
            <div class="container=fluid recipt text-white" >
                <!-- <div class="d-flex p-3 bg-dark" style="justify-content: space-between;">
                    <h5  class="fw-bold ">Product</h1>
                    <h5  class="fw-bold ">Product ID</h1>
                    <h5 class="fw-bold ">Quantity</h1>
                    <h5 class="fw-bold">Selling</h1>
                    <h5 class="fw-bold ">Profit</h1>
                    <h5 class="fw-bold ">Total Profit</h1>
                    <h5 class="fw-bold ">Tk</h1>
                    <h5 class="fw-bold ">Date</h1>
                    <h5 class="fw-bold ">Time</h1>

                    <h5 class="fw-bold ">Action</h1>
                </div> -->
              
                <div class="table-responsive">
                <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Product ID</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Selling</th>
                            <th scope="col">Profit</th>
                            <th scope="col">Total Profit</th>
                            <th scope="col">Total Sold</th>
                            <th scope="col">Date</th>
                            <!-- <th scope="col">Time</th> -->
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id ="recipt" >
                            
                        </tbody>
                        </table>
                </div>

                
            </div>
            <div class="save-btn">
                    <button class="btn btn-success mt-3" onclick="addtoinvoice()">Save</button>
             </div>
        </div>
        
    </section>
    
    <script type="text/javascript">
                   
        const dltrow = (a, pname, date, amount, iid) => {
        //    console.log("hi");
            const pro_id = document.getElementById(pname).innerHTML;
            
           const row = document.getElementById(a);
           row.innerHTML ='';
           
            pro_name = pname;
            dt = date;
            qt = amount;
            uid = iid;
            console.log(pro_id);
            console.log(pro_name);
            console.log(date);
            console.log(amount);
            console.log(qt);
            console.log(uid);
           
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET","dltbilling.php?id="+uid+"&pname="+pro_name+"&dt="+dt+"&qt="+qt+"&pid="+pro_id,true);
            xmlhttp.send();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                
               return;
                
            }
            };
           
            // window.location.href ="dltbilling.php?id="+uid+"&pname="+pro_name+"&dt="+dt+"&qt="+qt+"&pid="+pro_id; 
        }
       
        const showalert = () =>
        {
        const x = document.getElementById("namec").value;
        const y = document.getElementById("phone").value;
        if(x == "" && y == ""){
            Swal.fire({
            icon: 'error',
            title: '! Error Adding Products !',
            text: 'Please Provide Customer Details.',
            });
           
        }
        else{
            const list = document.getElementById("listid");
            list.style.display = 'block';
            console.log("hoy na");
            console.log(x,y);
        }
       
        }
        
        const addtoinvoice = () => {
            const today = new Date();
            const dt = today.getDate();
            const mn = today.getMonth()+1;
            const yr = today.getFullYear();
            const date = (yr+"-"+mn+"-"+dt);
            console.log(date);
            window.location.href = `datebysearch.php?search=${date}`;
        }

    </script>
    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/load.js"></script>
    <!-- <script src="js/invoiceadd.js"></script> -->
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</body>
</html>

<?php
 }
 else{
   header("location:index.php");
 }
?>