<?php
include_once "system/Anunciantes.php";

$anun = Anunciantes::getInstance();
$rpta = $anun->obtenerNomApeSex(1);

echo $rpta['nombres']."<br>";
echo $rpta['ap_paterno']."<br>";
echo $rpta['ap_materno']."<br>";