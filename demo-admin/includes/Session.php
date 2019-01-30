<?php

include_once('database.php');

class Session
{
    private $logged_in=false;
    public $admin_user;
    public $admin_password;
    public $message;


    public function __construct()
    {
        session_start();
        $this->check_login();
    }

    public function is_logged_in() {
        return $this->logged_in;
    }

    public function login($user) {
        if($user){
            $this->admin_user       = $_SESSION['demo_admin_user']     = $user->name;
            $this->admin_password   = $_SESSION['demo_admin_password'] = $user->pass ;
            $this->logged_in        = true;
        }
    }

    private function check_login() {
        if(isset($_SESSION['demo_admin_user'])  && isset($_SESSION['demo_admin_password']) ) {
            $this->admin_user      = $_SESSION['demo_admin_user'];
            $this->admin_password  = $_SESSION['demo_admin_password'];
            $this->logged_in = true;
        } else {
            unset($this->admin_user);
            unset($this->admin_password);
            $this->logged_in = false;
        }
    }

    public function logout() {
        unset($_SESSION['demo_admin_password']);
        unset($_SESSION['demo_admin_user']);
        unset($_SESSION['demo_proj']);
        unset($this->admin_user);
        unset($this->admin_password);
        $this->logged_in = false;
    }

    public function message(){
        if(!isset($_SESSION['demo_proj'])){
            return false;
        }
        else{
            $this->message = $_SESSION['demo_proj'];
            return $_SESSION['demo_proj'];
        }
    }


}
$session = new Session();