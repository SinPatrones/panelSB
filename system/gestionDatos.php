<?php
include_once "connection.php";

class gestionDatos{
    // SELECT tblreportes.id_reporte_anuncio, tblreportes.reproducciones, tblanuncios.palabra_clave FROM tblreportes INNER JOIN tblanuncios ON tblanuncios.id_anuncio = tblreportes.id_reporte_anuncio ORDER BY tblanuncios.fecha_creacion DESC
    private $con = null;
    private static $instance = null;
    private function __construct(){
        $this->con = ConnectionDb::getInstance();
        $this->con->connect();
    }

    public static function getInstance(){
        if (self::$instance == null)
            self::$instance = new self();
        return self::$instance;
    }

    public function obtenerDatosGraficos($id_user, &$labels_array, &$values_array, &$id_reproducciones){
        if ($this->con->connect()){
            $sql = "SELECT tblreportes.id_reporte_anuncio, tblreportes.id_anunciante_reporte, tblreportes.reproducciones, tblanuncios.palabra_clave FROM tblreportes INNER JOIN tblanuncios ON tblanuncios.id_anuncio = tblreportes.id_reporte_anuncio WHERE tblreportes.id_anunciante_reporte=".$id_user." ORDER BY tblanuncios.fecha_creacion DESC";

            $tmp_labels = array();
            $tmp_values = array();
            $tmp_id_rpd = array();

            $result = $this->con->query($sql);
            $this->con->close();

            if ($this->con->getnumrows($result) < 1)
                return false;

            while($row = mysqli_fetch_array($result)){
                array_push($tmp_labels, $row['palabra_clave']);
                array_push($tmp_values, $row['reproducciones']);
                $tmp_id_rpd[$row['id_reporte_anuncio']] = $row['reproducciones'];
            }

            $labels_array = $tmp_labels;
            $values_array = $tmp_values;
            $id_reproducciones = $tmp_id_rpd;
            return true;
        }
        return false;
    }


}