<?php
    session_start();
    if(isset($_SESSION['User'])){
?>


<?php
    require_once('connection.php');
    // $conn = new mysqli("localhost", "aurexaac_buja", "bu!ja4#20,38?kd", "aurexaac_anan") or die("cannot connect database");
    $date = $_POST['search'];
    
    $strdate = strval($date);
    // echo $strdate;
    $sql = "SELECT *,COUNT(*), SUM(`total`) AS asb FROM invoice WHERE year = '$strdate' GROUP BY `uid`";
    $result = mysqli_query($conn, $sql) or die("cannot execute query");
    // echo $result;
    $sql2 = "SELECT SUM(`total`) AS sum FROM `invoice` WHERE `year`='$strdate';";
    $result2 = mysqli_query($conn, $sql2) or die("cannot execute query2");
    $totaltk = 0;
    while($row2 = mysqli_fetch_assoc($result2)){
        $totaltk += $row2['sum'];
    }

    $btnid = "";
    // echo $totaltk;
    $sqldc = "SELECT SUM(`discount`) AS discsum FROM orders WHERE `year` = '$strdate';";
    $resultdc = mysqli_query($conn, $sqldc) or die(" cannot collect sum of discount");
    $sumdc = 0;
    while($rowdc = mysqli_fetch_assoc($resultdc)){
      $sumdc += $rowdc['discsum'];
    }

    $afterdc = $totaltk - $sumdc;
    $sqlprofit = "SELECT SUM(`total_profit`) AS prosum FROM invoice WHERE `year` = '$strdate';";
    $resultprofit = mysqli_query($conn, $sqlprofit) or die("cannot collect profit");
    $profitdate = 0;
    while($rowpro = mysqli_fetch_assoc($resultprofit)){
      $profitdate += $rowpro['prosum'];
    }
    $afterprofit = $profitdate - $sumdc;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Summary</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="js/getdate.js"></script>
  </head>
<body>
    


    <nav class="navbar  navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" dashboard.php>Noor Wares Market</a>
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

    <section class="list_bill container-fluid mt-5">

<div class="container ">
  <div class="row">
  <div class="col">
    <level class="fw-bold mb-3">Search By Date</level>
    <form method="post" action="datebysearch2.php" class="row g-3 mb-5">
        <input type="date" class="w-50 form-control" name="search">
        <button type="submit" class="ms-1 w-25 btn btn-outline-primary"> Search</button>
    </form>
  </div>
  <div class="col">
    <level class="fw-bold mb-3">Search By Month</level>
    <form method="post" action="monthbysearch.php" class="row g-3 mb-5">
        <select class="form-select w-50 form-control " name="search">
          <option>January</option>
          <option>February</option>
          <option>March</option>
          <option>April</option>
          <option>May</option>
          <option>June</option>
          <option>July</option>
          <option>August</option>
          <option>September</option>
          <option>October</option>
          <option>November</option>
          <option>December</option>
        </select>
        <button type="submit" class="ms-1 w-25 btn btn-outline-primary"> Search</button>
    </form>
  </div>
  <div class="col">
    <level class="fw-bold mb-3">Search By Year</level>
    <form method="post" action="yearbysearch.php" class="row g-3 mb-5">
        <input type="text" class="w-50 form-control" name="search">
        <button type="submit" class="ms-1 w-25 btn btn-outline-primary"> Search</button>
    </form>
  </div>
  <div class="col">
    <level class="fw-bold mb-3">Search By OrderID</level>
    <form method="post" action="orderidsearch.php" class="row g-3 mb-5">
        <input type="text" class="w-50 form-control" name="search">
        <button type="submit" class="ms-1 w-25 btn btn-outline-primary"> Search</button>
    </form>
  </div>

  </div>
  
</div>

  <div class="table-responsive">
      <table class="table">
          <thead class="table-dark">
              <tr>
              <th scope="col">Seq</th>
              <th scope="col">Date</th>
              <th scope="col">Order ID</th>
              <th scope="col">Order Number</th>
              <th scope="col">Customer Name</th>
              <th scope="col">Customer Phone</th>
              <th scope="col">Product Name</th>
              <th scope="col">Quantity</th>
              <th scope="col">Price</th>
              </tr>
          </thead>
          <tbody>
            <?php
            $i=1;
                while ($row = mysqli_fetch_assoc($result)){

                
            ?>
              <tr>
                <td> <?php echo $i ?> </td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['uid']; ?></td>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['cust_name']; ?></td>
                    <td><?php echo $row['phn']; ?></td>
                    <td><?php echo $row['pro_name']; ?></td>
                    <td><?php echo $row['qty']; ?></td>
                    <td><?php echo $row['asb']; ?></td>
                    <td>
                      <a  href="sortlist.php?id=<?php echo $row['uid'];?>&dt=<?php echo $row['date'];?>" >
                    <button type="button" class="btn btn-primary">
                      View
                    </button>
                       </a>
                    </td>

                    <?php
                    $i++;
                  } ?>
                </tr>

            <tr class="bg-light">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="2" align="center" class="fw-bolder text-danger">Total Amount</td>
                    
                    <td class="fw-bolder text-danger"><?php echo $totaltk; ?></td>
                    
              </tr>
              <tr class="bg-light">
                    <td></td>
                    <td></td>
                    
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="2" align="center" class="fw-bolder text-danger">Total Discount</td>
                    
                    <td class="fw-bolder text-danger"><?php echo $sumdc; ?></td>
                    
              </tr>
            <tr class="bg-light">
                    <td></td>
                    <td></td>
                    
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="2" align="center" class="fw-bolder text-danger">Total TK After Discount</td>
                    
                    <td class="fw-bolder text-danger"><?php echo $afterdc; ?></td>
                    
              </tr>
              <tr class="bg-light">
                    <td></td>
                    <td></td>
                    <td></td>
                   
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="2" align="center" class="fw-bolder text-success">Total Profit</td>
                    
                    <td class="fw-bolder text-danger"><?php echo $profitdate; ?></td>
                    
              </tr>
            <tr class="bg-light">
                    <td></td>
                    <td></td>
                    <td></td>
                   
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="2" align="center" class="fw-bolder text-success">Total Profit After Discount</td>
                    
                    <td class="fw-bolder text-danger"><?php echo $afterprofit; ?></td>
                    
              </tr>
          </tbody>
      </table>
  </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>

<?php

    }
    else{
        header("location:index.php");
    }
?>