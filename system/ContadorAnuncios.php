<?php
class ContadorAnuncios{
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

    public function crearContador($id_anuncio, $id_anunciante){
        $this->security->applySecurityToObj($id_anuncio);
        $this->security->applySecurityToObj($id_anunciante);
        if ($this->con->connect()){
            $sql = "INSERT INTO tblcontadoranuncios(id_anuncio_ca,id_anunciante_ca,reproducciones) VALUES ($id_anuncio,$id_anunciante,0)";
            if($this->con->query($sql)){
                return true;
            }
            return false;
        }
        return false;
    }
}