<?php

$arr = array();

$data = $_POST['data'];
parse_str($data);

require_once("../oCenturaPDO.php");
$f = oCenturaPDO::getInstance();

$arr = array();

$query = "Delete from cat_marcas where idmarca = ".$idmarca;
$result = $f->guardarDatos($query);

$save_path = '../../../up_empresa/'.$img;

			
if  (file_exists($save_path)) {
	unlink($save_path);
}

$arr['status'] = 'OK';
$arr['message'] = 'Archivo eliminado satisfactoriamente!';
$arr['image'] = $img;
$arr['thumb'] = '';

echo json_encode($arr);


?>