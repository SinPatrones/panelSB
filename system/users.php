<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/assets/connection.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/assets/security.php';

class UsersFunctions{
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
    public function register($email,$fullname,$office,$password){
        if($this->con->connect()){
            $this->security->applySecurityToObj($email);
            $this->security->applySecurityToObj($fullname);
            $this->security->applySecurityToObj($office);
            $this->security->applySecurityToObj($password);
            $fullname = $this->con->realescape($fullname);
            $email = $this->con->realescape($email);
            $office = $this->con->realescape($office);
            $this->security->encryptObj($password);
            $password = $this->con->realescape($password);
            $query = "INSERT INTO users (fullname,id_office) VALUES ('$fullname','$office')";
            if($this->con->query($query)){
                $lastid = $this->con->lastid();
                $query = "INSERT INTO login (email,password,id_user) VALUES ('$email','$password','$lastid')";
                if($this->con->query($query)){
                    $this->con->close();
                    return 'ok';
                }
                else {
                    $this->con->close();
                    return 'ei';
                }
            }
            else {
                $this->con->close();
                return 'ei';
            }
        }
        else {
            $this->con->close();
            return 'ec';
        }
    }
    public function login($email,$password){
        if($this->con->connect()){
            $this->security->applySecurityToObj($email);
            $this->security->applySecurityToObj($password);
            $email = $this->con->realescape($email);
            $password = $this->con->realescape($password);
            $query = "SELECT * FROM login WHERE email='$email'";
            $results = $this->con->query($query);
            if($this->con->getnumrows($results)!=0){
                $obj = $this->con->getobj($results);
                if($this->security->verifyEncryptObj($password,$obj->password)){
                    session_start();
                    $idreturn = $obj->id_user;
                    $_SESSION["user"] = array();
                    $_SESSION["user"]["id"]=$idreturn;
                    $query = "SELECT * FROM users WHERE id_user = '$idreturn'";
                    $results = $this->con->query($query);
                    $obj = $this->con->getobj($results);
                    $_SESSION["user"]["fullname"]=$obj->fullname;
                    $query = "SELECT * FROM office WHERE id_office = '$obj->id_office'";
                    $results = $this->con->query($query);
                    $obj = $this->con->getobj($results);
                    $_SESSION["user"]["officename"]=$obj->name;
                    echo $_SESSION["user"]["fullname"];
                    $this->con->close();
                    return $idreturn;
                }
                else{
                    $this->con->close();
                    return 'ep';
                }
            }
            else{
                $this->con->close();
                return 'ee';
            }
        }
        else {
            $this->con->close();
            return 'ec';
        }
    }
}
?>