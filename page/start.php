<?php
    session_start();
    if(isset($_SESSION["user"]["fullname"])==null){
        header("LOCATION:login.php");
        die('<a href="../login.php">INICIAR SESIÓN</a>');
    }
?>