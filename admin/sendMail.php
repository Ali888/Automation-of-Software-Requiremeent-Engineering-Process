<?php 

include_once('../mailSend.php');

function send(){
    $email = new PHPMAILER();
    $email->FromName  = "Ali Hussain";
    $email->From  = "sulehry888@gmail.com";
    $email->AddAddress("sulehry888@gmail.com","Junk");
    $email->Subject  = "Test";
    $email->Body  = "Test";
    $r = $email->Send();
    echo $r ? 'a' : 'error';
}
send();
?>