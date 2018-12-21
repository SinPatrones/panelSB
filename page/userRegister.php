<?php
include_once "../system/Login.php";
include_once "../system/Anunciantes.php";


if (isset($_POST['email']) and isset($_POST['pass']) and isset($_POST['lastnamem']) and isset($_POST['lastnamep']) and isset($_POST['numbers']) and isset($_POST['sex']) and isset($_POST['birth_day']) and isset($_POST['email'])){
    $login = Login::getInstance();
    $anunciantes = Anunciantes::getInstance();

    date_default_timezone_set('America/Lima');
    $fecha_inscrito = date("y-m-d");

    $log = $login->insertNewLogin($_POST['email'], $_POST['pass'], $myId);
    $anu = $anunciantes->insertAnunciantesDatos($myId, $_POST['name'], $_POST['lastnamep'], $_POST['lastnamem'], $_POST['numbers'], $_POST['sex'], $_POST['birth_day'], $fecha_inscrito);

    header("LOCATION: ../index.php");
}
