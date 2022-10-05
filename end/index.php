<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noor Wares Market</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .hd-bkg{
            height: auto;
            /* background-color: #92b7c3; */
        }
        .hd-bkg #hd {
            margin: 0 auto;
            width: 73.12em;
            background-color: transparent;
            background-image: none;
        }
        .hd-bkg #hd #at-header {
    height: auto;
    margin: 0 0 0 -109px;
    padding: 0 0 0 109px;
    background-color: transparent;
    background-repeat: no-repeat;
    background-position: 100px 0;
}
#at-banner {
    height: auto;
    position: relative;
    overflow: hidden;
    /* background: #9a0a01 repeat-x; */
    background-position: top;
}

    </style>
</head>
<body>
    <?php
        if(@$_GET['Empty'] == true){
    ?>
        <div class="container-fluid alert text-danger text-center py-3 fw-bold">
            <?php echo $_GET['Empty']; ?>
        </div>
    <?php
        }
    ?>

    <?php
        if(@$_GET['Invalid'] == true){
    ?>
        <div class="container-fluid alert text-danger text-center py-3 fw-bold">
            <?php echo $_GET['Invalid']; ?>
        </div>
    <?php
        }
    ?>
<div class="container-fluid">

<div class="hd-bkg">
    <div id="hd" role="banner">
        <div id="at-header">
            <div id="at-banner" class="text-center mx-auto">
                <img src="img/111.png" width="450px" height="150px" alt="noor wares market">
            </div>
        </div>
    </div>
</div>

    <div class="d-flex justify-content-center align-item-center w-50 mx-auto m-3 p-3 shadow bg-body rounded">

        <form class="container-fluid mt-5" id="form1" method="post" action="login.php">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username">
            
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                
            </div>
            <button type="submit" class="btn btn-primary" name="login">Login</button>
        </form>
    </div>
</div>
   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>