<?php
    include_once 'system/Login.php';

$login = Login::getInstance();

$id = 0;
$login->insertNewLogin("sinpatrones1@gmail.com", "123456", $id);

echo $id;