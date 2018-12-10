<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include_once '../system/users.php';
$users = UsersFunctions::getInstance();
$response=$users->login($_POST['email'],$_POST['password']);

if($response=='ep'){
    header("LOCATION:../../login.php?code=ep");
}
else if($response=='ee'){
    header("LOCATION:../../login.php?code=ee");
}
else if($response=='ec'){
    header("LOCATION:../../login.php?code=ec");
}
else if($response>0){
    header("LOCATION:../../?code=true");
}
else{
    echo 'error';
}
?>