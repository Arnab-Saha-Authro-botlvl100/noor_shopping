<?php
    session_start();
    if(isset($_SESSION['User'])){
?>

<?php
    $comname = $_GET['compname'];
    $total = $_GET['buy'];
    $phn = $_GET['phn'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit <?php echo $comname; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="js/jquery-3.5.0.min.js"></script>

</head>
<body>
    <div class="container-fluid">
    <h1> Edit <?php echo $comname ?></h1>
    <form method="get" action="editcompany2.php" class="row g-3 container-fluid" >
        <div class="col-sm-3">
            <label for="inputEmail4" class="form-label">Company Previous Name</label>
            <input type="text" class="form-control  text-black fw-bold"  name="prvname" value='<?php echo $comname ?> ' readonly="readonly"> 
        </div>
        <div class="col-sm-3">
            <label for="inputEmail4" class="form-label">Company Previous Phn</label>
            <input type="text" class="form-control  text-black fw-bold"  name="prvphn" value='<?php echo $phn ?> ' readonly="readonly"> 
        </div>
        <div class="col-sm-3">
            <label for="inputEmail4" class="form-label">Company Total</label>
            <input type="text" class="form-control  text-black fw-bold"  name="prvtotal" value='<?php echo $total ?> ' readonly="readonly"> 
        </div>
        <div class="col-sm-3">
            <label for="inputEmail4" class="form-label">Company Name</label>
            <input type="text" class="form-control  text-danger fw-bold"  name="cname" placeholder='<?php echo $comname ?> ' readonly="readonly"> 
        </div>
        <div class="col-sm-3">
            <label for="inputEmail4" class="form-label">Company Phone</label>
            <input type="text" class="form-control  text-danger fw-bold"  name="cphn" placeholder='<?php echo $phn ?> '> 
        </div>
        <div class="col-sm-3">
            <label for="inputEmail4" class="form-label">Company Total</label>
            <input type="text" class="form-control  text-danger fw-bold"  name="ctotal" placeholder='<?php echo $total ?> ' readonly="readonly"> 
        </div>
        <div class="col-sm-3">
            
           <button type="submit" class="btn btn-success mt-4">Save</button>
        </div>
        
    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>


<?php

}
else{
    header("location:index.php");
}
?>