<?php
     //$conn =  mysqli_connect("localhost", "aurexaac_buja", "bu!ja4#20,38?kd", "aurexaac_anan");
    $conn = mysqli_connect("localhost", "root", "", "aurexaac_anan1");
    if(!$conn){
        die("Please Check Connection". mysqli_error($conn). " ". $conn);
    }

?>