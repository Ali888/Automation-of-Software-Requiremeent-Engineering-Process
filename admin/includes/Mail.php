<?php

        require_once("mail/class.phpmailer.php");
        require_once("mail/class.smtp.php");
        require_once("mail/language/phpmailer.lang-am.php");


class Mail
{
    public $from_name;
    public $receiver_name;
    public $receiver_mail;

    public $messsage;
    public $subject;

    public $username;
    public $password;

    public $header;
    public $sender;

    public function sendEmail(){

        $mail = new PHPMailer();
        $this->from_name = "Ali Hussain";

        // Can use SMTP
        // comment out this section and it will use PHP mail() instead
        $mail->IsSMTP();
        $mail->Host     = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = 'sulehry888@gmail.com';
        $mail->Password = 'Sajjad888';

        $this->messsage  ="Hello ".$this->receiver_name."\n\n";
        $this->messsage .="Dear ".$this->receiver_name."\n\n";
        $this->messsage .="You are invited to a project. Your account Infromarion is ";
        $this->messsage .="Username   ".$this->username;
        $this->messsage .="     Password   ".$this->password;
       $this->messsage .="\n\n";
        $this->messsage .="Please Login To Yoour Account For Further Information.";
        $this->messsage .="\n\n";
        $this->messsage .="Thanks  ";

        $this->subject = "Invitation for A Project";
        $mail->From     = "sulehry888@gmail.com";
        $mail->AddAddress("sulehry888@gmail.com", "Ali");
        $mail->Subject  = $this->subject;
        $mail->Body     = $this->messsage;
        $result = $mail->Send();
        return $result ? true : false;
 }
}
$mail1 = new Mail();