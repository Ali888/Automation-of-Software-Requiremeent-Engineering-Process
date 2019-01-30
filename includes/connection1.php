<?php 
$con = new mysqli('localhost','root','','fyp_demo');
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
else
     //   echo "Connction Successfull";


?>