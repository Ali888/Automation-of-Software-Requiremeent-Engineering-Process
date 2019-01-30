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
            $this->user            = $_SESSION['user']     = $user->username;
            $this->password        = $_SESSION['password'] = $user->password ;
            $this->name            = $_SESSION['name']     = $user->p_name ;
            $this->participant_id  = $_SESSION['part_id']       = $user->p_id;
            $this->logged_in  = true;
        }
    }

    private function check_login() {
        if(isset($_SESSION['user'])  && isset($_SESSION['password']) ) {
            $this->user      = $_SESSION['user'];
            $this->password  = $_SESSION['password'];
            $this->logged_in = true;
        } else {
            unset($this->user);
            unset($this->password);
            $this->logged_in = false;
        }
    }

    public function logout() {
        unset($_SESSION['password']);
        unset($_SESSION['user']);
        unset($_SESSION['proj_proj']);
        unset($this->user);
        unset($this->password);
        $this->logged_in = false;
    }

    public function message(){
        if(!isset($_SESSION['proj_proj'])){
            return false;
        }
        else{
            $this->message = $_SESSION['proj_proj'];
            return $_SESSION['proj_proj'];
        }
    }
}
$session = new Session();