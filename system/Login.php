<?php
include_once '../assets/connection.php';
include_once '../assets/security.php';

class Login{
    private $security =null;
    private $con = null;
    private static $instance = null;
    private function __construct(){
        $this->security = Security::getInstance();
        $this->con = ConnectionDb::getInstance();
        $this->con->connect();
    }

    public static function getInstance(){
        if (self::$instance == null)
            self::$instance = new self();
        return self::$instance;
    }

    public function insertNewLogin($email, $pass){
        if ($this->con->connect()){
            $this->security->applySecurityToObj($email);
            $this->security->applySecurityToObj($pass);

            $this->con->realescape($email);
            $this->con->realescape($pass);

            $sql = "INSERT INTO tbllogin(email, pass, token) VALUE ('$email','$pass','-')";
            $this->con->query($sql);
            return true;
        }
        return false;
    }
}