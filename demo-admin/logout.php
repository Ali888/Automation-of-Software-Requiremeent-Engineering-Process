<?php
include_once('includes/Session.php');
if($session->is_logged_in()){
    $session->logout();

    header("location:../");
}

if(isset($_SESSION['demo_admin_user']) || isset($_SESSION['demo_admin_password']) )
{
    unset($_SESSION['demo_admin_user']);
    unset($_SESSION['demo_admin_password']);

     //session_destroy();
    header("location:../");


}

?>