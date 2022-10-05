<?php
    session_start();
    if(isset($_SESSION['User'])){
?>

<?php
    require_once('connection.php');
    // $conn = new mysqli("localhost","aurexaac_buja","bu!ja4#20,38?kd", "aurexaac_anan") or die ("cannot connect database at companyadd");
    $sql = "SELECT * FROM company;";
    $result = mysqli_query($conn,$sql) or die("cannot execute query");
    $dd = mysqli_num_rows($result);
    // $row = mysqli_fetch_assoc($result);
    $sql2 = "SELECT SUM(`total_amount`) AS sum FROM `company`;";
    $result2 = mysqli_query($conn, $sql2) or die("cannot execute query2");
    $totaltk = 0;
    while($row2 = mysqli_fetch_assoc($result2)){
        $totaltk += $row2['sum'];
    }
    $sql3 = "SELECT SUM(`total_sell`) AS sum_pro FROM company;";
    $result3 = mysqli_query($conn, $sql3) or die("cannot execute query3");
    $totaltk1 = 0;
    while($row3 = mysqli_fetch_assoc($result3)){
        $totaltk1 += $row3['sum_pro'];
    }
    $sql9 = "SELECT SUM(`total_profit`) AS sum_profit FROM company;";
    $result9 = mysqli_query($conn, $sql9) or die("cannot execute query9");
    $totaltk2 = 0;
    while($row9 = mysqli_fetch_assoc($result9)){
        $totaltk2 = $row9['sum_profit'];
    }
    $sql8 = "SELECT SUM(`discount`) AS sum_discount FROM `orders`;";
    $discount = 0;
    $result8 = mysqli_query($conn, $sql8) or die ("cannot collect discount sum");
    while($row8 = mysqli_fetch_assoc($result8)){
        $discount += $row8['sum_discount'];
    }
    $sellafter =  $totaltk1 - $discount;
    $profitafter = $totaltk2 - $discount;
    $duetk=0;
    $sql10 = "SELECT SUM(`due_tk`) AS sum_due FROM `orders`;";
    $result10 = mysqli_query($conn, $sql10) or die("cannot collect due sum");
    while($row10 = mysqli_fetch_assoc($result10)){
        $duetk += $row10['sum_due'];
    }
    $duetotal = $totaltk - $duetk;
    $duesell = $sellafter - $duetk;
    $dueprofit = $profitafter - $duetk;
?>
<!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Company</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src ="js/getdate.js"></script>
  </head>

  <body>
   
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
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

      <div class="container-fluid mt-3">
          <div class=  "d-flex " >
              <div class="add me-3">
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  Add New Company
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                  <form class="row g-3" method="post" action="companyadd.php">
                                      <div class="col-md-6">
                                          <label for="inputEmail4" class="form-label">Company Name</label>
                                          <input type="text" class="form-control" id="inputEmail4" name="companyname">
                                      </div>
                                    
                                      <div class="col-12">
                                          <label for="inputAddress2" class="form-label">Number</label>
                                          <!-- <label for="inputAddress2" class="form-label text-danger">Must start with next digit. Like if number is 017 start with 17</label> -->
                                          <input type="text" class="form-control" id="inputAddress2" name="companynumber">
                                      </div>
                                      <div class="col-12">
                                          <button type="submit" class="btn btn-success">Add</button>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
                  <div class="show">
                      <!-- Button trigger modal -->
                      <button type="button" class="btn btn-primary" id="loaddata" onclick="loaddata()">
                      Show Company Details
                      </button>
                  </div>
          </div>
          <div class="container-fluid mt-5 tablediv" id="companyshow">
              <table class="table table-hover table-success table-striped">
                      <thead>
                          <tr>
                          <th scope="col"> Seq </th>
                          <th scope="col">Company Name</th>
                          <th scope="col">Phone Number</th>
                          <th scope="col">Total Buy</th>
                          <th scope="col">Total Sell</th>
                          <th scope="col">Total Profit</th>
                          <th scope="col">Action </th>
                          </tr>
                      </thead>
                      <tbody id="tablebody">
                            <?php
                                if($dd>0){
                                    $i = 1;
                                    while($row = mysqli_fetch_assoc($result)){
                            ?>  
                                <tr>
                                    <td> <?php echo $i; ?> </td>
                                    <td> <?php echo $row['Company_name']; ?></td>
                                    <td> <?php echo $row['company_number']; ?></td>
                                    <td> <?php echo $row['total_amount']; ?></td>
                                    <td> <?php echo $row['total_sell']; ?></td>
                                    <td> <?php echo $row['total_profit']; ?></td>
                                    <td> 
                                        <a class="btn btn-primary" href="editcompany.php?compname=<?php echo $row['Company_name'];?>&phn=<?php echo $row['company_number'];?>&buy=<?php echo $row['total_amount'];?>"> Edit </a>
                                        <!----<a class="btn btn-danger" href="dltcompany.php?compname=<?php echo $row['Company_name'];?>&phn=<?php echo $row['company_number'];?>&buy=<?php echo $row['total_amount'];?>"> Delete </a>
                                    ---->
                                    </td>
                                </tr

                            <?php

                                    $i++;

                                    }
                                    
                                }
                            ?>
                                <tr class="bg-dark">
                                    <td class="text-danger fw-bold">
                                        Total Amount From all Company
                                    </td>
                                    <td >
                                        
                                    </td>
                                    <td >
                                        
                                    </td>
                                    <td class="text-danger fw-bold">
                                        <?php echo $totaltk;?>
                                    </td>
                                    <td class="text-danger fw-bold">
                                        <?php echo $totaltk1;?>
                                    </td>
                                    <td class="text-danger fw-bold">
                                        <?php echo $totaltk2;?>
                                    </td>
                                </tr>
                                <tr class="bg-dark">
                                    <td class="text-danger fw-bold">
                                        Total Discount
                                    </td>
                                    <td >
                                        
                                    </td>
                                    <td >
                                        
                                    </td>
                                    <td class="text-danger fw-bold">
                                        
                                    </td>
                                    <td class="text-success fw-bold">
                                        <?php echo $discount;?>
                                    </td>
                                    <td class="text-success fw-bold">
                                        <?php echo $discount;?>
                                    </td>
                                  
                                </tr>
                                <tr class="bg-dark">
                                    <td class="text-danger fw-bold">
                                        Total Sell Including Discount
                                    </td>
                                    <td >
                                        
                                    </td>
                                    <td >
                                        
                                    </td>
                                    <td class="text-danger fw-bold">
                                        
                                    </td>
                                    <td class="text-danger fw-bold">
                                        <?php echo $sellafter;?>
                                    </td>
                                    <td class="text-danger fw-bold">
                                        <?php echo $profitafter;?>
                                    </td>
                                </tr>
                                <tr class="bg-dark">
                                    <td class="text-primary fw-bold">
                                        Total Sell Includes Due 
                                    </td>
                                    <td >
                                        
                                    </td>
                                    <td class="text-success fw-bold">
                                        Total Due <?php echo $duetk?>
                                    </td>
                                    <td class="text-primary fw-bold">
                                        <?php echo $totaltk; ?>
                                    </td>
                                    <td class="text-primary fw-bold">
                                        <?php echo $duesell; ?>
                                    </td>
                                    <td class="text-primary fw-bold">
                                        <?php echo $dueprofit; ?>
                                    </td>
                                    
                                </tr
                      </tbody>
              </table>
          </div>
          
      </div>
      <script type="text/javascript">
          const loaddata = function () {
            window.location.href = "displayajex.php";
          }
      </script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
      
  </body>

  </html>


<?php

}
else{
    header("location:index.php");
}
?>