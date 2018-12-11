<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include_once '../system/Login.php';
$login = Login::getInstance();
$response=$login->logIn($_POST['email'],$_POST['password']);

if($response){
    header("LOCATION:../index.php");
}else{
    header("LOCATION:../login.php");
}
?>