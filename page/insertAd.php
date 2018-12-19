<?php
session_start();
include_once "../system/Anuncios.php";
include_once "../system/ContadorAnuncios.php";

$contadorAnuncios = ContadorAnuncios::getInstance();
$anuncio = Anuncios::getInstance();

if (isset($_SESSION["user"]["id"]) && isset($_POST['scope']) && isset($_POST['status']) && isset($_POST['latitud']) && isset($_POST['longitud']) && isset($_POST['content'])){

    $id_user = $_SESSION["user"]["id"];
    $scope = $_POST['scope'];
    $status = $_POST['status'];
    $latitud = $_POST['latitud'];
    $longitud = $_POST['longitud'];
    $content = $_POST['content'];
    $palabra_clave = $_POST['keyword'];

    date_default_timezone_set('America/Lima');
    $rpta = $anuncio->crearAnuncio($id_user, $palabra_clave, $content, $latitud, $longitud, $scope, $status, date("Y-m-d"), $new_id_anuncio);

    $contadorAnuncios->crearContador($new_id_anuncio, $_SESSION["user"]["id"]);

    if ($rpta){
        echo  '<script language="javascript">alert("Nuevo anuncio insertado.");</script>';
    }else{
        echo  '<script language="javascript">alert("No se pudo insertar nuevo anuncio.");</script>';
    }
}

header("LOCATION: ../ad.php");
