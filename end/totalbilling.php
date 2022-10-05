<?php
    session_start();
    if(isset($_SESSION['User'])){
?>


<?php
    require_once('connection.php');
    // $conn = new mysqli("localhost", "aurexaac_buja", "bu!ja4#20,38?kd", "aurexaac_anan") or die("cannot connect database");
    $sql = "SELECT * FROM invoice;";
    $result = mysqli_query($conn, $sql) or die("cannot execute query");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Summary</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="js/getdate.js"></script>
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
                <a class="nav-link" onclick="movetodatebysearch()"> Total Billing</a>
              </li>             
            </ul>
          </div>
          <a class="btn btn-danger" href="logout.php?logout">Log-Out</a>
        </div>
    </nav>


        <section class="list_bill container-fluid mt-5">

          <div class="container">
            <h1>Search by Date</h1>
            <form method="get" action="datebysearch.php" class="row g-3 mb-5">
                <input type="date" class="form-control w-25" name="search">
                <button type="submit" class="ms-4 w-25 btn btn-primary"> Search</button>
            </form>

          </div>

            <div class="table-responsive">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Order ID</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Customer Phone</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                          while ($row = mysqli_fetch_assoc($result)){

                          
                      ?>
                        <tr>
                              <td><?php echo $row['date']; ?></td>
                              <td><?php echo $row['uid']; ?></td>
                              <td><?php echo $row['cust_name']; ?></td>
                              <td><?php echo $row['phn']; ?></td>
                              <td><?php echo $row['pro_name']; ?></td>
                              <td><?php echo $row['qty']; ?></td>
                              <td><?php echo $row['total']; ?></td>
                              
                        </tr>
                       <?php

                          }
                          ?>
                    </tbody>
                </table>
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