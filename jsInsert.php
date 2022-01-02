<?php
header('Access-Control-Allow-Origin: *');
include ("functions.php");
$postData=file_get_contents("php://input");
$request=json_decode($postData);

$a=$request->baslik;
$b=$request->aciklama;
$c=$request->tip;
$crud->jsInsert($a,$b,$c);
?>