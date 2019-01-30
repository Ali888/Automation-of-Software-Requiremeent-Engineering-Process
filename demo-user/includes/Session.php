<?php



class Session
{
    private $logged_in=false;
    public $user;
    public $password;
    public $name;
    public $participant_id;


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
            $this->user            = $_SESSION['demo_user']     = $user->username;
            $this->password        = $_SESSION['demo_password'] = $user->password ;
            $this->name            = $_SESSION['demo_name']     = $user->p_name ;
            $this->participant_id  = $_SESSION['demo_part_id']       = $user->p_id;
            $this->logged_in  = true;
        }
    }

    private function check_login() {
        if(isset($_SESSION['demo_user'])  && isset($_SESSION['demo_password']) ) {
            $this->user      = $_SESSION['demo_user'];
            $this->password  = $_SESSION['demo_password'];
            $this->logged_in = true;
        } else {
            unset($this->user);
            unset($this->password);
            $this->logged_in = false;
        }
    }

    public function logout() {
        unset($_SESSION['demo_password']);
        unset($_SESSION['demo_user']);
        unset($_SESSION['demo_proj_proj']);
        unset($this->user);
        unset($this->password);
        $this->logged_in = false;
    }

    public function message(){
        if(!isset($_SESSION['demo_proj_proj'])){
            return false;
        }
        else{
            $this->message = $_SESSION['demo_proj_proj'];
            return $_SESSION['demo_proj_proj'];
        }
    }
}
$session = new Session();