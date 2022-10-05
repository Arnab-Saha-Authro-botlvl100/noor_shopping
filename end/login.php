<?php
require_once('connection.php');
session_start();
 
 if(isset($_POST['login'])){
    if(empty($_POST['username']) || empty($_POST['password'])){
        header('location:index.php?Empty= "Please Fill The Blanks"');
    }

    else{
        if($_POST['username'] == "admin@gmail.com" && $_POST['password'] == "admin123"){
            $_SESSION['User'] = $_POST['username'];
            header('location:dashboard.php');
        }

        elseif($_POST['username'] != "admin@gmail.com" && $_POST['password'] != "admin123"){
            $sql = "SELECT * FROM user WHERE email = '".$_POST['username']."' and password = '".$_POST['password']."';";
            $result = mysqli_query($conn, $sql);
            if(mysqli_fetch_assoc($result)){
                $_SESSION['User'] = $_POST['username'];
                header('location:dashboard2.php');
            }
        }
        else{
            header('location:index.php?Invalid= Please Enter Correct Username & Password');
        }
    }
 }


?>