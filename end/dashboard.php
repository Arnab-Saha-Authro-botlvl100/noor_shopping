<?php
 session_start();
 if(isset($_SESSION['User'])){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="stylefooter.css"> 
    <style>
      
.footer-bottom{
    background: #000;
    width: 100vw;
    padding: 0px 0;
    text-align: center;
    margin-bottom: -10px;
}
        @media screen and (max-width: 770px) {
          
          .myfooter{
              position:relative!important;
              margin-top: 2rem!important;
          }
        }
      

    </style>
    
</head>
<body>
   
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light ">
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
        </div>
        
      </nav>
      <h3 class="container-fluid fw-bold text-center mt-5">
        <?php echo 'Welcome '. $_SESSION['User']; ?>
      </h3>
      <section class="deshboard mt-2 container-fluid">
        <div class="row row-cols-1 row-cols-md-3 mt-5 g-4 d-flex justify-content-center ">
            <div class="col">
              <div class="card h-100">
                <div class="d-flex mt-3 justify-content-center align-items center">
                    <a href = "product.php"  class="nav-link d-flex  justify-content-center align-items center">
                        <i class="fa-solid fa-boxes-stacked me-4" style="font-size:90px;"></i>
                    </a>
                </div>
                <div class="card-body">
                  <h5 class="card-title">Product</h5>
                  <p class="card-text">This is a product card where you can add and search your products.</p>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card h-100">
                <div class="d-flex mt-3 justify-content-center align-items center">
                  <a href = "displayajex.php" class="nav-link d-flex  justify-content-center align-items center">
                      <i class="fa-solid fa-warehouse" style="font-size:90px;"></i>
                  </a>
              </div>
                <div class="card-body">
                  <h5 class="card-title">Company</h5>
                  <p class="card-text">This is a company card.</p>
                </div>
              </div>
            </div>
           
            <div class="col">
              <div class="card h-100">
                <div class="d-flex mt-3 justify-content-center align-items center">
                  <a href = "billing2.php"  class="nav-link d-flex  justify-content-center align-items center">
                      <i class="fa-solid fa-dollar-sign" style="font-size:90px;"></i>
                  </a>
              </div>
                <div class="card-body">
                  <h5 class="card-title">Billing</h5>
                  <p class="card-text">Billing card for User</p>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card h-100">
                <div class="d-flex mt-3 justify-content-center align-items center">
                  <a href = "totalbilling.php"  class="nav-link d-flex  justify-content-center align-items center">
                      <i class="fa-solid fa-file-invoice-dollar" style="font-size:90px;"></i>
                  </a>
              </div>
                <div class="card-body">
                  <h5 class="card-title">Total Billing</h5>
                  <p class="card-text">Total Billing Amount.</p>
                </div>
              </div>
            </div>
          </div>
      </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <footer class="fixed-bottom myfooter" >

      

       <div class="footer-bottom">
           <p>copyright &copy;2022 | Noor Wares Market |</p><div>Developed by <h6>Arnab & Amiruzzaman</h6></div>
       </div>
   </footer>


   <script src = "js/getdate.js"></script>

  </body>

</html>

<?php
 }
 else{
   header("location:index.php");
 }
?>
