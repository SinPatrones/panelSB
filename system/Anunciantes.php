<?php
include_once 'connection.php';
include_once 'security.php';

class Anunciantes{
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

    public function insertAnunciantesDatos($id, $nombre, $app, $apm, $num_contacto, $sexo, $fech_nacimiento, $fech_registro){
        if ($this->con->connect()){
            $this->security->applySecurityToObj($id);
            $this->security->applySecurityToObj($nombre);
            $this->security->applySecurityToObj($app);
            $this->security->applySecurityToObj($apm);
            $this->security->applySecurityToObj($num_contacto);
            $this->security->applySecurityToObj($sexo);
            $this->security->applySecurityToObj($fech_nacimiento);
            $this->security->applySecurityToObj($fech_registro);

            $this->con->realescape($id);
            $this->con->realescape($nombre);
            $this->con->realescape($app);
            $this->con->realescape($apm);
            $this->con->realescape($num_contacto);
            $this->con->realescape($sexo);
            $this->con->realescape($fech_nacimiento);
            $this->con->realescape($fech_registro);

            $sql = "INSERT INTO tblanunciantes(id_anunciante,nombres,ap_paterno,ap_materno,num_contacto,sexo,fech_nacimiento,fech_registro) VALUES ($id,'$nombre','$app','$apm','$num_contacto','$sexo','$fech_nacimiento','$fech_registro')";

            $result = $this->con->query($sql);

            if ($result){
                $this->con->close();
                return true;
            }
            $this->con->close();
            return false;
        }
    }

    public function obtenerDatos($id){
        if($this->con->connect()){
            $this->security->applySecurityToObj($id);
            $this->con->realescape($id);

            $sql = "SELECT * FROM tblanunciantes WHERE id_anunciante=".$id;

            $result = $this->con->query($sql);

            if($this->con->getnumrows($result) > 0){
                $this->con->close();
                return $this->con->getarray($result);
            }else{
                $this->con->close();
                return false;
            }
        }
        return false;
    }

    public function obtenerNomApeSex($id){
        if ($this->con->connect()){
            $this->security->applySecurityToObj($id);
            $this->con->realescape($id);

            $sql = "SELECT nombres,ap_paterno,ap_materno,sexo FROM tblanunciantes WHERE id_anunciante=".$id;

            $result = $this->con->query($sql);

            if($this->con->getnumrows($result) > 0){
                $this->con->close();
                return $this->con->getarray($result);
            }else{
                $this->con->close();
                return false;
            }
        }
        return false;
    }
}