<?php 
include_once('../includes/functions1.php');

if(isset($_SESSION['demo_name']) || isset($_SESSION['pass']) )
{
    unset($_SESSION['demo_user']);
    unset($_SESSION['demo_password']);
    unset($_SESSION['demo_name']);

    header("location:../");
   
    
}

?>