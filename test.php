<?php
include_once 'system/users.php';

$users = UsersFunctions::getInstance();

$users->register("sinpatrones@gmail.com", "Armando Hinojosa Ccama", "1", "123456789");
