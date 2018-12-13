<?php
include_once "../system/Anuncios.php";

$anuncios = Anuncios::getInstance();

$id_anuncio = $_POST['id_anuncio'];
$scope = $_POST['scope'];
$status = $_POST['status'];
$latitud = $_POST['latitud'];
$longitud = $_POST['longitud'];
$content = $_POST['content'];

$rpta = $anuncios->editarAnuncio($id_anuncio, $content, $latitud, $longitud, $scope, $status);

if ($rpta){
    echo  '<script language="javascript">alert("Se modifico el anuncio correctamente.");</script>';
}else{
    echo  '<script language="javascript">alert("No se pudo modificar el anuncio.");</script>';
}
header("LOCATION: ../ad-active.php");