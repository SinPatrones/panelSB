<?php
    include_once '../system/users.php';
    $users = UsersFunctions::getInstance();
    echo $users->register($_POST['email'],$_POST['fullname'],$_POST['office'],$_POST['password']);
?>