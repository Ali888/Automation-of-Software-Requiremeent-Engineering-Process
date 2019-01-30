<?php 
include_once('../includes/functions1.php');

if(isset($_SESSION['name']) || isset($_SESSION['pass']) )
{
    unset($_SESSION['user']);
    unset($_SESSION['password']);
    unset($_SESSION['name']);

    header("location:../");
   
    
}

?>