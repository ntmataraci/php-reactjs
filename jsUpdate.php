<?php
header('Access-Control-Allow-Origin: *');
include ("functions.php");
$updateData=file_get_contents("php://input");
$updaterequest=json_decode($updateData);
$id=$updaterequest->id;
$baslik=$updaterequest->baslik;
$aciklama=$updaterequest->aciklama;
$tip=$updaterequest->tip;
$crud->jsUpdate($baslik,$aciklama,$tip,$id)

?>