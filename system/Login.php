<?php
include_once "connection.php";
include_once "security.php";
include_once "Anunciantes.php";

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

    public function insertNewLogin($email, $pass, &$newId){
        if ($this->con->connect()){
            $this->security->applySecurityToObj($email);
            $this->security->applySecurityToObj($pass);

            $this->con->realescape($email);
            $this->con->realescape($pass);

            $this->security->encryptObj($pass);

            $sql = "INSERT INTO tbllogin(email, pass, token) VALUE ('$email','$pass','-')";
            $this->con->query($sql);
            $newId = $this->con->lastid();
            $this->con->close();
            return true;
        }
        $this->con->close();
        return false;
    }

    public function logIn($email, $pass){
        $this->security->applySecurityToObj($email);
        $this->security->applySecurityToObj($pass);

        if($this->con->connect()){
            $this->con->realescape($email);
            $this->con->realescape($pass);
            $sql = "SELECT * FROM tbllogin WHERE email='".$email."'";
            $result = $this->con->query($sql);
            if($this->con->getnumrows($result) > 0){
                $result = $this->con->getarray($result);
                if ($this->security->verifyEncryptObj($pass, $result['pass'])){
                    // pass correcta
                    // GUARDANDO DATOS DE SESION EN EL SERVIDOR
                    $anunciantes = Anunciantes::getInstance();
                    $datosExtras = $anunciantes->obtenerNomApeSex($result['id_login']);

                    session_start();
                    $_SESSION["user"] = array();
                    $_SESSION["user"]["id"] = $result['id_login'];
                    $_SESSION["user"]["fullname"] = $datosExtras['nombres']." ".$datosExtras['ap_paterno']." ".$datosExtras['ap_materno'];

                    //DEVOLVIENDO VALOR
                    return true;
                }
                // no es la clave
                return false;
            }
            // sin registros
            return false;
        }
        // sin conexion
        return false;
    }

    public function emailExists($email){
        if($this->con->connect()){
            $this->security->applySecurityToObj($email);
            $this->con->realescape($email);
            $sql = "SELECT email FROM tbllogin WHERE email='".$email."'";
            $result = $this->con->query($sql);
            if ($this->con->getnumrows($result) > 0){
                return true;
            }
            return false;
        }
        return false;
    }
}