<?php
session_start();
include_once "../system/Anuncios.php";

$anuncio = Anuncios::getInstance();

$id_user = $_SESSION["user"]["id"];
$scope = $_POST['scope'];
$status = $_POST['status'];
$latitud = $_POST['latitud'];
$longitud = $_POST['longitud'];
$content = $_POST['content'];

date_default_timezone_set('America/Lima');
$rpta = $anuncio->crearAnuncio($id_user, $content, $latitud, $longitud, $scope, $status, date("Y-m-d"));

if ($rpta){
    echo  '<script language="javascript">alert("Nuevo anuncio insertado.");</script>';
}else{
    echo  '<script language="javascript">alert("No se pudo insertar nuevo anuncio.");</script>';
}
header("LOCATION: ../ad.php");
