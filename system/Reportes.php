<?php
include_once "connection.php";
include_once "security.php";

class Reportes{
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

    public function obtenerReportesDe($idAnuncianteReporte){
        if ($this->con->connect()){
            $this->security->applySecurityToObj($idAnuncianteReporte);
            $this->con->realescape($idAnuncianteReporte);

            $sql = "SELECT * FROM tblreportes WHERE id_anunciante_reporte=".$idAnuncianteReporte;

            $result = $this->con->query($sql);

            $this->con->close();

            if ($result){
                return $result;
            }
            return false;
        }
        return false;
    }
}