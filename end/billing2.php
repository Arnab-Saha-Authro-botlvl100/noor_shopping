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
    <script src="js/jquery-3.5.0.min.js"></script>

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
<script>
    	$(document).ready(function(){
    	// Get value on keyup funtion
    	$("#total_bill, #discount").keyup(function(){

    	var total=0;    	
    	var x = document.getElementById("total_bill").innerHTML;
        //  x = ParseFloat(x);
    	var y = Number($("#discount").val());
        //  y = ParseFloat(y);
    	var total=x - y;  

    	$('#dtotal').val(total);
        var z = document.getElementById("dtotal");
        console.log(z);
        z.value = total;
    });
});
    	$(document).ready(function(){
    	// Get value on keyup funtion
    	$("#dtotal, #due").keyup(function(){

    	var total=0;    	
    	var x = document.getElementById("dtotal").value;

    	var y = Number($("#due").val());
    	var see=x - y;  

    	$('#due_see').val(see);
        var zx = document.getElementById("due_see");
        console.log(zx);
        zx.value = see;
    });
});
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
                <a class="nav-link"target="blank" href="dashboard.php">Dashboard</a>
              </li>
              <li class="nav-item">
                <a class="nav-link"target="blank"  href="product.php">Product</a>
              </li>
              <li class="nav-item">
                <a class="nav-link"target="blank" href="displayajex.php">Company</a>
              </li>              
              <li class="nav-item">
                <a class="nav-link"target="blank" href="billing2.php">Billing</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" onclick="movetodatebysearch()">Total Bill</a>
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
                        <label for="inputCity" class="form-label"> Order ID </label>
                        <input type="text" class="form-control bg-dark fw-bold text-secondary" placeholder="Customer Name" aria-label="Customer Name" id="uid" value="">
                    </div>
                    <div class="col">
                        <label for="inputCity" class="form-label"> Customer Name</label>
                        <input type="text" class="form-control" placeholder="Customer Name" aria-label="Customer Name" id="namec" >
                    </div>
                    <div class="col">
                        <label for="inputCity" class="form-label"> Address</label>
                        <input type="text" class="form-control" placeholder="Address" aria-label="Last name" id="address">
                    </div>
                    <div class="col">
                    <label for="inputCity" class="form-label"> Phone</label>
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
               
                <div class="table-responsive">
                <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Product ID</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Company</th>
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
            <div class="row">
                <div class="save-btn col-md-4">
                        <!-- <button class="btn btn-success mt-3" onclick="addtoinvoice()">Save</button> -->
                </div>
                <div class="row container-fluid my-3">
                    <div class="col-md-3">
                    <label for="inputEmail4" class="form-label">Total Taka</label>
                    <div type="number" class="form-control bg-danger text-white fw-bold p-3" id="total_bill" > </div>
                    </div>
                    <div class="col-md-3">
                    <label for="inputEmail4" class="form-label">Total Profit</label>
                    <div type="number" class="form-control bg-danger text-white fw-bold p-3" id="add_profit" > </div>
                    </div>
                    <div class="col-md-3">
                    <label for="inputEmail4" class="form-label">Discount</label>
                    <input type="number" class="form-control fw-bold" id="discount" > 
                    </div>
                    <div class="col-md-3">
                    <label for="inputEmail4" class="form-label">Price after Discount</label>
                    <input type="number" class="form-control fw-bold" id="dtotal" readonly="readonly"> 
                    </div>
                    <div class="col-md-3">
                    <label for="inputEmail4" class="form-label">Due Taka</label>
                    <input type="number" class="form-control fw-bold" id="due" > 
                    </div>
                    <div class="col-md-3">
                    <label for="inputEmail4" class="form-label">Total Tk Including Due</label>
                    <input type="number" class="form-control fw-bold" id="due_see" readonly="readonly" > 
                    </div>
                    <div class="col-md-3">
                    <!-- <label for="inputEmail4" class="form-label">Due Taka</label> -->
                    <button type="button" class="btn btn-primary fw-bold mt-4" onclick="adjust()">Confirm</button> 
                    </div>
                </div>
            </div>
            
        </div>
        
    </section>
    
    <script type="text/javascript">
                   
        const dltrow = (a, pname, comname, sprice, date, amount, iid, totaltk, totalp) => {
          // console.log("total Profit" + totalp);
            const pro_id = document.getElementById(pname).innerHTML;
            
           const row = document.getElementById(a);
           row.innerHTML ='';
           
            pro_name = pname;
            comp_name = comname;
            sell_price = sprice;
            dt = date;
            qt = amount;
            uid = iid;
            totalpro = totalp;
            console.log(pro_id+" product id");
            console.log(pro_name+" product name");
            console.log(comp_name+" company name");
            console.log(sell_price+" selling price");
            console.log(date+" date");
            console.log(amount+" amount");
            console.log(qt+" quantity");
            console.log(uid+" uid");
            console.log(totaltk+" total tk");
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET","dltbilling.php?id="+uid+"&pname="+pro_name+"&cname="+comp_name+"&sprice="+sell_price+"&dt="+dt+"&qt="+qt+"&pid="+pro_id+"&totalprofit="+totalp,true);
            xmlhttp.send();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                
               return;
                
            }
            };
           let currenttk = document.getElementById("total_bill").innerHTML;
           currenttk = parseFloat(currenttk);
           if(isNaN(currenttk)) {
            document.getElementById("total_bill").innerHTML = 0;
           }
           else{
               let recenttk = currenttk - totaltk;
               document.getElementById("total_bill").innerHTML = recenttk;
           }
           var profitshow = parseFloat(document.getElementById("add_profit").innerHTML);
           if(isNaN(profitshow)){
                document.getElementById("add_profit").innerHTML = 0;
           }
           else{
               var newprofit = profitshow - totalpro;
               document.getElementById("add_profit").innerHTML = newprofit;
           }
           var dc = document.getElementById("discount").value;
            var du = document.getElementById("due").value;
            if (dc == ''){ dc = 0;}
            if(du == ''){ du =0;}
            var totaltk2 = document.getElementById("total_bill").innerHTML;
            totaltk = totaltk + dc;
            totaltk2 = parseInt(totaltk2);
            document.getElementById("total_bill").innerHTML = totaltk2;
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
            // console.log("hoy na");
            // console.log(x,y);
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

        const adjust = () => {
            var oid = document.getElementById("uid").value;
            var name = document.getElementById("namec").value;
            var profitshow = parseFloat(document.getElementById("add_profit").innerHTML);
            console.log(profitshow);
            let today = new Date();
            let month = today.getMonth()+1;
            let date = today.getDate();
            if(month>=1 && month<10){
                month = month.toString();
                month = '0'+month
            }
            if(date>=1 && date<10){
                date = date.toString();
                date = '0'+date;
            }
            let year = today.getFullYear();
            let fd = year+"-"+month+"-"+date;
            fd = fd.toString();
            const monthsname = ["check", "January","February","March","April","May","June","July","August","September","October","November","December"];
            let namemonth = monthsname[today.getMonth()+1];
            var totaltk = document.getElementById("dtotal").value;
            var discount = document.getElementById("discount").value;
            var due = document.getElementById("due").value;
            // console.log(oid + " " + fd + " " + totaltk + " " + discount + " " + due);
            var xmlhttp = new XMLHttpRequest();
                
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                
                // document.getElementById(`${product_content}`).innerHTML = this.responseText; 
                console.log(this.responseText);
            }
            };
            xmlhttp.open("GET","addtoorder.php?orderid="+oid+"&dt="+fd+"&tk="+totaltk+"&dis="+discount+"&due="+due+"&nm="+name+"&nameofmonth="+namemonth+"&yearof="+year+"&profitshow="+profitshow,true);
            xmlhttp.send();

            window.location.href = `billing2.php`;


        }

    </script>
    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/load.js"></script>
    <script src = "js/getdate.js"></script>
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