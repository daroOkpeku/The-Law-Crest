<?php
if(isset($_REQUEST['name'])){
    session_start();
   session_unset();
   session_destroy();
 header("location:login.php");
 echo "<script>window.open('login.php')</script>";
}