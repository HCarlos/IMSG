<?php

error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);
date_default_timezone_set('America/Mexico_City');

header("application/json; charset=utf-8");
header("Cache-Control: no-cache");

require_once("oCentura.php");
$f = oCentura::getInstance();
require_once("oCenturaPDO.php");
$fp = oCenturaPDO::getInstance();

$index    = $_POST['o'];
$var2     = $_POST['t'];
$cad      = $_POST['c'];
$proc     = $_POST['p'];
$from     = $_POST['from'];
$cantidad = $_POST['cantidad'];
$otros    = $_POST['s'];

$ret = array();
switch ($index) {
    case -3:
        switch ($proc) {
            case 0:
                $ret = $f->getDepAreaFromUser($cad);
                $ret[0]->iduser =$ret[0];
                $ret[0]->iddep =$ret[1];
                break;
        }
        break;
    case -2:
        $ret = $f->getPermissions($cad);
        break;
    case -1:
        switch ($proc) {
            case 0:
                $ret = $f->getDepFromUser($cad);
                $ret[0]->iduser =$ret[0];
                $ret[0]->iddep =$ret[1];
                break;
        }
        break;
    case 0:
    case 1: // Estados
    case 2: // Muncipios
    case 3: // Cat Personas
    case 49: // Usuarios Conectados

        switch ($proc) {
            case 0:
                $ret = $f->getCombo($index, $cad, 0, 0, $var2, $otros);
                break;
            case 1:
                $ret[0]->msg = $f->setAsocia($index, $cad, 0, 0, $var2, $otros);
                break;
            case 2:
                $res = $f->setSaveData($index, $cad, 0, 0, $var2);
                $ret[0]->msg = $res;
                if (trim($res)!="OK") {
                    $pos = strpos($res, 'Duplicate');
                    if ($pos !== false) {
                        $ret[0]->msg = $res; // "Valor DUPLICADO";
                    } else {
                        //require_once('core/messages.php');
                        $ret[0]->msg = str_replace("Table 'tecnoint_dbPlatSource.", "", $res);
                        $ret[0]->msg = str_replace("' doesn't exist", "", $ret[0]->msg);
                    }
                }
                break;
            case 3:

                // $res = $f->genUserFromCat($cad,$index);

                $res = $fp->generarUsuario($cad, $index);
                $ret[0] = new StdClass();
                if ($res == 'true') {
                    $ret[0]->msg  = "OK";
                } else {
                    $ret[0]->msg  = $res;
                }
                break;

            case 4:
                $ret = $f->getQuerys($var2, $cad, 0, $from, $cantidad);
                if (count($ret) <= 0) {
                    $ret[0]->razon_social = "No se encontraron datos";
                    $ret[0]->idcli  = -1;
                    $ret[0]->tel1   = "";
                    $ret[0]->cel1   = "";
                    $ret[0]->email  = "";
                } else {
                    $xx = 0;
                    if (intval($var2)==22) {
                        $x = $f->getQuerys($var2, $cad, 0, $from, $cantidad, array(), $otros, 0);
                        $xx = count($x);
                    }
                    foreach ($ret as $i=>$value) {
                        $ret[$i]->registros = $xx;
                    }
                }
                break;
            case 10:
                $ret = $f->getQuerys($var2, $cad, 0, 0, 0);
                break;
            case 11:
                $ret = $f->getQuerys($var2, $cad, 0, 0, 0, array(), $otros);
                break;
            case 12:
                $res = $f->setSaveData($index, $cad, 0, 0, $var2, $otros);
                $ret[0]->msg = $res;
                break;
            case 13:
                $res = $f->genNumListaPorGrupo($cad);
                $ret[0]->msg  = $res;
                break;
            case 14:
                $res = $f->cloneNumEvalFromGruMatConAnterior($cad);
                $ret[0]->msg  = $res;
                break;
            case 15:
                $ar = explode("|", $cad);
                $res = $f->getCountTable($ar[0], $ar[1], $ar[2]);
                $ret[0]->msg  = $res;
                break;
            case 16:
                $res = $f->BuscarMarkbookdeAlumno($cad);
                $ret[0]->msg  = $res;
                break;

            case 17:
                $res = $fp->IsLockGroupAcademico($cad);
                $ret[0]->msg  = $res;
                break;

            case 18:
                    $ret  = $f->getQuerys($var2, $cad, 0, 0, 0, array(), $otros);

                    parse_str($cad);
                    foreach ($ret as $i=>$value) {
                        $c2 = "u=".$u."&idboleta=".$ret[$i]->idboleta."&numval=".$numval;
                        $ret[$i]->nodo = $f->getQuerys(118, $c2, 0, 0, 0, array(), $otros);
                    }

                    // $ret = $r0;

                break;

            case 51:
                $ret = $fp->getComboPDO($index, $cad, 0, 0, $var2, $otros);
                break;

            case 52:

                $res = $fp->saveDataPDO($index, $cad, 0, 0, $var2);
                // $ret[0]->msg = $res;

                if (trim($res)!=="OK") {
                    $pos = strpos($res, 'Duplicate');
                    if ($pos >= 0) {
                        $rmsg = "Valor DUPLICADO";
                    } else {
                        //require_once('core/messages.php');
                        $rmsg = str_replace("Table 'imsg_dbIMSG.", "", $res);
                        $rmsg = str_replace("' doesn't exist", "", $rmsg);
                    }
                    $ret[0] = array("msg" => $rmsg);
                } else {
                    $ret[0] =  array("msg" => "OK");
                }

                //$ret[0] = array("msg" => $res);

                break;

            case 53:
                $ret[0]->msg = $fp->setAsocia($index, $cad, 0, 0, $var2, $otros);
                break;

            case 54:
                $ret = $fp->getQueryPDO($var2, $cad, 0, $from, $cantidad);
                if (count($ret) <= 0) {
                    // $ret[0]->razon_social = "No se encontraron datos";
                        // $ret[0]->idcli  = -1;
                        // $ret[0]->tel1   = "";
                        // $ret[0]->cel1   = "";
                        // $ret[0]->email  = "";
                } else {
                    $xx = 0;
                    if (intval($var2)==22) {
                        $x = $fp->getQueryPDO($var2, $cad, 0, $from, $cantidad, array(), $otros, 0);
                        $xx = count($x);
                    }
                    foreach ($ret as $i=>$value) {
                        $ret[$i]->registros = $xx;
                    }

                    if ($index == 49) {
                        require_once("oFunctions.php");
                        $Q = oFunctions::getInstance();

                        foreach ($ret as $i=>$value) {
                            $ret[$i]->fAgo = $Q->time_stamp($ret[$i]->ultima_conexion);
                        }
                    }
                }
                break;

            case 55:
                $ret = $fp->getQueryPDO($var2, $cad, 0, $from, $cantidad, array(), $otros, 0);
                if (count($ret) > 0) {
                    $ret[0]->msg = count($ret);
                }
                break;

            case 56:
                $res = $fp->refreshVencimientos($cad);
                $ret[0]->msg = $res;
                break;

            case 57:
                $res = $fp->setPreinscripciones($var2, $cad);
                $ret[0]->msg = $res;
                break;

            case 58:
                $res = $fp->setCloneMatConSave($cad);
                $ret[0]->msg = $res;
                break;

            case 59:
                $res = $fp->refreshBoletaPAIBI($cad);
                $ret[0]->msg = $res;
                break;

        }
        break;

}

$m = json_encode($ret);
echo $m;
