<?php


$data = $_POST['data'];
parse_str($data);

require_once("../vo/voConnPDO.php");
require_once("../oCenturaPDO.php");
$f = oCenturaPDO::getInstance();

$idusr = $f->getPubIdUser($user);
$idemp = $f->getPubIdEmp($user);

$ip=$_SERVER['REMOTE_ADDR']; 
$host=gethostbyaddr($_SERVER['REMOTE_ADDR']);//$_SERVER["REMOTE_HOST"]; 

$baseImg = "../../../";
$dirImg  = "up_control_images/";

$isExistUser = $f->isExistUserFromEmp($user);

$arr = array();

$isFiles = false;

if ( $isExistUser <= 0 ){

	$arr['status'] = 'Error';
	$arr['message'] = 'No se ha podido conectar al servidor!';
	$arr['image'] = 'none';

}else{

	$file = $_FILES['foto'];

	$isFiles = true;
	$res2 = saveFileImage($file,$descripcion,$idusr,$idcontrolmaster,$idemp,$baseImg,$dirImg);
	if ( $res2['status'] == "OK" ){

		require_once("../oCenturaPDO.php");
		$f = oCenturaPDO::getInstance();

        $data .="&idcontrolmaster=".$idcontrolmaster
        	   ."&root=".$f->urlCImg.$dirImg
        	   ."&imagen=".$res2['image']
        	   ."&descripcion=".$descripcion
        	   ."&idemp=".$idemp
        	   ."&user=".$user;	

		$res = $f->saveDataPDO(70,$data,0,0,14);
		
	}

	$arr = $res2;
	echo json_encode($arr);

	if ( !$isFiles ){

		$arr['status'] = 'ERR';
		$arr['message'] = 'No proporcionó ningún archivo!';
		$arr['image'] = 'none';
		echo json_encode($arr);

	}

}






function saveFileImage($file,$descripcion="sin descripción",$idusr,$idcontrolmaster,$idemp,$baseImg,$dirImg){
	if( isset($file) ){
		if(!preg_match('/\.(jpe?g|gif|png|pdf|doc|docx|xls|xlsx|ppt|pptx|txt)$/' , $file['name'])
			
		) {
		
			$arr['status'] = 'ERR';
			$x = end(explode(".", $file['name']));
			$arr['message'] = 'Formato incorrecto de archivo: '.$x;
		
		} else {

			$i=0;
			$name = $file['name'];
			//$nameFile = md5($name).time();
			$nameFile = "img_".$idcontrolmaster.'_'.$idusr.'_'.$idemp.'_'.$i;
			// $ext = end(explode(".", $name));
			$ext0 = explode(".", $name);
			$ext = strtolower($ext0[count($ext0)-1]);

			if ($ext == "php" || $ext == "PHP"){
			
					$arr['status'] = 'ERR';
					$arr['message'] = 'El archivo no se pudo subir!';
					$arr['image'] = $img0 == "" ? $nFle : $img0;
			
			}else{

					$nFle   = $nameFile.".".strtolower($ext);//$file['name']."_|_".$curp."_|_";
					$save_path = $baseImg.$dirImg.$nFle;
					while (file_exists($save_path)) {

						$y = ++$i;
						$nameFile = "img_".$idcontrolmaster.'_'.$idusr.'_'.$idemp.'_'.$y;
						$nFle   = $nameFile.".".$ext;

						$save_path = $baseImg.$dirImg.$nFle;

					}
					$obj = move_uploaded_file($file['tmp_name'] , $save_path);
					if( ! $obj){
						$arr['status'] = 'ERR';
						$arr['message'] = 'El archivo no se pudo subir!';
						$arr['image'] = $nFle;
					}else{
						$arr['status'] = 'OK';
						$arr['message'] = 'Archivo subido satisfactoriamente!';
						$arr['image'] = $nFle;
					}


			}


		}
		
	}else{
				$arr['status'] = 'ERR';
				$arr['message'] = 'Archivo no encontrado!';
				$arr['image'] = $objeto;
				$arr['thumb'] = '';

	}
	
	return $arr;

}





?>