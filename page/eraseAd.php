<?php
include_once "../system/Anuncios.php";

$anuncio = Anuncios::getInstance();

$anuncio->eliminarAnuncio($_POST['delete']);

header("LOCATION: ../ad-active.php");
