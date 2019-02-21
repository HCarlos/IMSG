<?php

$arr = array();

$data = $_POST['data'];
parse_str($data);

require_once("../oCenturaPDO.php");
$f = oCenturaPDO::getInstance();
$baseImg = "../../../";
$dirImg  = "up_control_images/";

$arr = array();

$save_path = $baseImg.$dirImg.$img;
			
if  (file_exists($save_path)) {
	unlink($save_path);

	$query = "Delete from control_imagenes where idcontrolimagen = ".$idcontrolimagen;
	$result = $f->guardarDatos($query);

}

$arr['status'] = 'OK';
$arr['message'] = 'Imagen '.$img.' eliminada satisfactoriamente!';
$arr['image'] = $img;
$arr['thumb'] = '';

echo json_encode($arr);


?>