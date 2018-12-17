<?php
include_once "connection.php";
include_once "security.php";

class Anuncios{
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

    public function crearAnuncio($id_anunciante, $palabra_clave, $contenido, $lat, $lon, $alcance, $estado, $fecha_creacion){
        if ($this->con->connect()){
            $this->security->applySecurityToObj($id_anunciante);
            $this->security->applySecurityToObj($contenido);
            $this->security->applySecurityToObj($lat);
            $this->security->applySecurityToObj($lon);
            $this->security->applySecurityToObj($alcance);
            $this->security->applySecurityToObj($estado);
            $this->security->applySecurityToObj($fecha_creacion);

            $this->con->realescape($id_anunciante);
            $this->con->realescape($contenido);
            $this->con->realescape($lat);
            $this->con->realescape($lon);
            $this->con->realescape($alcance);
            $this->con->realescape($estado);
            $this->con->realescape($fecha_creacion);

            $sql = "INSERT INTO tblanuncios(id_anunciante,contenido,palabra_clave,pos_latitud,pos_longitud,tipo_alcance,estado,fecha_creacion) VALUES($id_anunciante,'$contenido', '$palabra_clave','$lat','$lon','$alcance','$estado','$fecha_creacion')";

            $result = $this->con->query($sql);
            if($result){
                $this->con->close();
                return true;
            }
            $this->con->close();
            return false;
        }
        return false;
    }

    // OBTIENE TODA LA LISTA DE ANUNCIOS DE UN USUARIO ESPECIFICO
    public function obtenerInfoAnuncios($id, &$count = 0){
        if($this->con->connect()){
            $this->security->applySecurityToObj($id);
            $this->con->realescape($id);

            $sql = "SELECT * FROM tblanuncios WHERE id_anunciante=".$id;
            $sql2 = "";

            $result = $this->con->query($sql);

            if($this->con->getnumrows($result) > 0){
                $this->con->close();
                $count = $this->con->getnumrows($result);
                return $result;
            }else{
                $this->con->close();
                return false;
            }
        }
        return false;
    }

    public function obtenerAnunciosPorEstado($idUser, $estado, &$count=0){
        if($this->con->connect()){
            $this->security->applySecurityToObj($id);
            $this->con->realescape($id);

            $sql = "SELECT * FROM tblanuncios WHERE id_anunciante=".$idUser." AND estado='".$estado."'";

            $result = $this->con->query($sql);

            if($this->con->getnumrows($result) > 0){
                $this->con->close();
                $count = $this->con->getnumrows($result);
                return $result;
            }else{
                $this->con->close();
                return false;
            }
        }
        return false;
    }

    public function obtenerDatosAnuncio($idAnuncio){
        if($this->con->connect()){
            $this->security->applySecurityToObj($id);
            $this->con->realescape($id);

            $sql = "SELECT * FROM tblanuncios WHERE id_anuncio=".$idAnuncio;

            $result = $this->con->query($sql);

            if($this->con->getnumrows($result) > 0){
                $this->con->close();
                return $result;
            }else{
                $this->con->close();
                return false;
            }
        }
        return false;
    }

    public function editarAnuncio($idAnuncio, $contenido, $palabra_clave, $lat, $lon, $alcance, $estado){
        if ($this->con->connect()){
            $this->security->applySecurityToObj($idAnuncio);
            $this->security->applySecurityToObj($contenido);
            $this->security->applySecurityToObj($lat);
            $this->security->applySecurityToObj($lon);
            $this->security->applySecurityToObj($alcance);
            $this->security->applySecurityToObj($estado);

            $this->con->realescape($idAnuncio);
            $this->con->realescape($contenido);
            $this->con->realescape($lat);
            $this->con->realescape($lon);
            $this->con->realescape($alcance);
            $this->con->realescape($estado);

            $sql = "UPDATE tblanuncios SET contenido='$contenido', palabra_clave='$palabra_clave', pos_latitud='$lat', pos_longitud='$lon', tipo_alcance='$alcance', estado='$estado' WHERE id_anuncio=".$idAnuncio;

            if ($this->con->query($sql)){
                return true;
            }
            return false;
        }
        return false;
    }

    public function eliminarAnuncio($idAnuncio){
        if ($this->con->connect()){
            $this->security->applySecurityToObj($idAnuncio);
            $this->con->realescape($idAnuncio);

            $sql = "DELETE FROM tblanuncios WHERE id_anuncio=".$idAnuncio;

            if ($this->con->query($sql)){
                $this->con->close();
                return true;
            }
            $this->con->close();
            return false;
        }
        return false;
    }
}