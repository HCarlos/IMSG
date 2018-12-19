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

$isExistUser = $f->isExistUserFromEmp($user);

$arr = array();

$isFiles = false;

if ( $v2 !== md5($user.$idmarca) ||  $isExistUser <= 0 ){

	$arr['status'] = 'Error';
	$arr['message'] = 'No se ha podido conectar al servidor!';
	$arr['image'] = 'none';

}else{


	$IdMar=$idmarca;

	for($i=0;$i<5;++$i){
		if ( isset($_FILES['file_'.$i])  ){
			$isFiles = true;
			$res2 = saveFileImage($_FILES['file_'.$i],'foto-'.$i,$arr,$idmarca,$IdMar,$idemp,$i,$img0);
			if ( $res2['status'] == "OK" ){

				// $tipo = $img0 == "" ? 0 : 1;
				$data .= "&imagen=".$res2['image'];
                // $result = $f->saveDataPDO(5, $data, 0, 0, $tipo);
                $result = $f->saveDataPDO(5, $data, 0, 0, 0);
				
			}

			$arr = $res2;
			echo json_encode($arr);

		}

	}

	if ( !$isFiles ){

		$arr['status'] = 'ERR';
		$arr['message'] = 'No proporcionó ningún archivo!';
		$arr['image'] = 'none';
		echo json_encode($arr);

	}

}






function saveFileImage($file,$descripcion="",$arr,$objeto,$idmarca,$idemp,$i, $img0){
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
			$nameFile = "marca_".$idmarca.'_'.$idemp.'_'.$i;
			// $ext = end(explode(".", $name));
			$ext0 = explode(".", $name);
			$ext = $ext0[count($ext0)-1];

			if ($ext == "php" || $ext == "PHP"){
			
					$arr['status'] = 'ERR';
					$arr['message'] = 'El archivo no se pudo subir!';
					$arr['image'] = $img0 == "" ? $nFle : $img0;
			
			}else{

				if ($img0 == ""){

					$nFle   = $nameFile.".".strtolower($ext);//$file['name']."_|_".$curp."_|_";
					$save_path = '../../../up_empresa/'.$nFle;
					while (file_exists($save_path)) {

						$name = $file['name'];
						//$nameFile = md5($name).time();
						$y = ++$i;
						$nameFile = "marca_".$idmarca.'_'.$idemp.'_'.$y;
						// $ext = end(explode(".", $name));
						$ext0 = explode(".", $name);
						$ext = $ext0[count($ext0)-1];
						$nFle   = $nameFile.".".strtolower($ext);

						$save_path = '../../../up_empresa/'.$nFle;
					}

				}else{
					$nFle   = $img0;
					$save_path = '../../../up_empresa/'.$nFle;
				}

				if( 
					! move_uploaded_file($file['tmp_name'] , $save_path)
					 
				  )
				{
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