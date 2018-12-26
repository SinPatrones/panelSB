<?php
include_once "../system/Login.php";

$login = Login::getInstance();

if (isset($_POST['email'])){
    $email = $_POST['email'];

    if ($login->emailExists($email)){
        echo "El correo: $email, ya esta registrado.";
    }else{
        echo "";
    }
}else{
    echo "Faltan datos.";
}
