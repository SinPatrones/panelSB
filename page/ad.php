<?php
include_once '../system/ad.php';
$ad  = AdFunctions::getInstance();
$response = $ad->insert($_POST['content'],$_POST['priority'],$_POST['status']);
if($response != "") header("LOCATION:../../ad.php?code=".$response);
else header("LOCATION:../../ad.php?code=void");
?>