<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('America/Mexico_City');

header("application/json; charset=utf-8");  
header("Cache-Control: no-cache");

$data =$_POST['data'];
parse_str($data);

$from0  = 'From: Colegio Arjí A.C. <rpublicas@arji.edu.mx>';
$sender = '';


// Para enviar un correo HTML mail, la cabecera Content-type debe fijarse
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=ISO-8859-1' . "\r\n";

// Cabeceras adicionales
// $cabeceras .= 'To: $para'. "\r\n";

$cabeceras .= utf8_decode($from0) . "\r\n";

// $cabeceras .= 'Cc: manager@logydes.com.mx' . "\r\n";
$titulo = utf8_decode($titulo);

$body = "<html>
  <head>
    <meta http-equiv='content-type' content='text/html; charset=utf-8'>
    <title>".utf8_decode($titulo)."</title>
  </head>
  <body style='font-size: 10pt; font-family: Verdana,Geneva,sans-serif'
    bgcolor='#FFFFFF' text='#000000'>
     <p>
".utf8_decode(nl2br($mensaje))."</p>
  </body>
</html>";

$retorno = mail($para,$titulo,$body,$cabeceras);

$ret = array();
$ret[0]->msg =  "OK";
$ret[0]->retorno =  $retorno;

if ( $retorno ){

  require_once("../oCenturaPDO.php");
  $fp = oCenturaPDO::getInstance();

  $fp->saveDataPDO(60,$data,0,0,3,"");


}

$m = json_encode($ret);
echo $m;


?>

