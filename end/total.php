<?php
    $q = $_GET['q'];
    
    $p = $_GET['p'];
    $tt = $_GET['tot'];
    $recent = $q * $p;
    $update = $tt + $recent;
    return $update;
    
       
?>