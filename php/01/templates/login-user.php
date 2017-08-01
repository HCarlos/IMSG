<?php

include("includes/metas.php");

require_once("../oCentura.php");
$f = oCentura::getInstance();
$arg   = $_POST['data'];
$ret = array();


$ret = $f->getCombo(0,$arg,0,0,0);
if (count($ret)>0){
	// $ret[0]->msg = "OK";
	$ret[0] = array("msg" => "OK");
}else{
	// $ret[0]->msg = "Username o Password incorrectos";
	$ret[0] = array("msg" => "Username o Password incorrectos");
}
$m = json_encode($ret);
echo $m;

?>
