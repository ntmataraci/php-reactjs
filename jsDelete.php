<?php
header('Access-Control-Allow-Origin: *');
include ("functions.php");
$deleteData=file_get_contents("php://input");
$delrequest=json_decode($deleteData);
$id=$delrequest->id;
$crud->jsDelete($id)

?>