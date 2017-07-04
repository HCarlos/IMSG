<?php

ini_set('display_errors', '0');     # don't show any errors...
error_reporting(E_ALL | E_STRICT);  # ...but do log them

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

date_default_timezone_set('America/Mexico_City');
/*
require_once('vo/voConn.php');
require_once('vo/voConnPDO.php');
require_once('vo/voCombo.php');
require_once('vo/voUsuario.php');
*/
require_once('vo/voEmpty.php');

class oCenturaPDO {

	private static $instancia;
	public $IdEmp;
	public $IdUser;
	public $User;
	public $Pass;
	public $Nav;
	public $URL;
	public $defaultMail;
	public $CID;
	public $Mail;
	public $Foto;
	public $iva;

	// Constructor
	private function __construct(){
			$this->Nav      = "Ninguno";
		$this->IdUser    = 0;
		$this->User     = "";
		$this->Pass     = "";
		$this->iva      = 0.16;
		$this->URL      = "http://imsg.mx/";
	}

	// Get Instance
	public static function getInstance(){
			if (  !self::$instancia instanceof self){
				  self::$instancia = new self;
			}
			return self::$instancia;
	}

	// Obtiene el ID del Usuario a partir de su Alias
	private function getIdUserFromAlias($str){

	    $query = "select iduser from usuarios where username = '$str' and status_usuario = 1";

     	$Conn = new voConnPDO();
		$result = $Conn->queryFetchAllAssocOBJ($query);

		if (!$result) {
				$ret=0;
		}else{
			   	$ret= $result[0]->iduser;
		}

		$Conn = null;

	    return $ret;
	 }

	// Obtiene el ID de la Empresa a partir de su Alias
	private function getIdEmpFromAlias($str){

	    $query = "select idemp from usuarios where username = '$str' and status_usuario = 1";

     	$Conn = new voConnPDO();
		$result = $Conn->queryFetchAllAssocOBJ($query);

		if (!$result) {
				$ret=0;
		}else{
				$ret= $result[0]->idemp;
		}

		$Conn = null;

	    return $ret;
	 }

	// Valida si existen usuarios conectados
	private function IsExistUserConnect($iduser,$idemp) {

	    $query = "select iduser from usuarios_conectados where iduser = $iduser and idemp = $idemp limit 1";

     	$Conn = new voConnPDO();
		$result = $Conn->queryFetchAllAssocOBJ($query);

		if (!$result) {
				$ret=0;
		}else{
				$ret= $result[0]->iduser;
		}
	    return $ret;
	 }

	// Valida si usuario esta conectado
	private function IsConnectUser($iduser,$idemp) {

		$query = "select iduser from usuarios_conectados where iduser = $iduser and idemp = $idemp and isconectado = 1 limit 1";
		$Conn = new voConnPDO();
		$result = $Conn->queryFetchAllAssocOBJ($query);

		if (!$result) {
			$ret=0;
		}else{
			$ret= $result[0]->iduser;
		}
		return $ret;

	 }

	 public function getLogoEmp($idemp){

			$query = "select valor from config where llave = 'logo-emp-rep' and idemp = $idemp";

			$Conn = new voConnPDO();
			$result = $Conn->queryFetchAllAssocOBJ($query);

			if (!$result) {
				$ret=0;
			}else{
				$ret= $result[0]->valor;
			}

			return $ret;

	 }

	 public function getNombreEmp($idemp){

		  $query = "select rs from empresa where idemp = $idemp";
		 	$Conn = new voConnPDO();
			$result = $Conn->queryFetchAllAssocOBJ($query);

			if (!$result) {
					$ret=0;
			}else{
					$ret= $result[0]->rs;
			}
			  return $ret;

	 }



	 private function guardarDatos($query=""){

			$Conn = new voConnPDO();
			$ret = array();
			$result = $Conn->exec($query);

			if ($result != 1){
				$ret = $result;
			}else{
				$ret = "OK";
			}

			$Conn = null;
			return $ret;

	 }

	// Obtiene una lista de elementos Llave => Valor
	public function getComboPDO($index=0,$arg="",$pag=0,$limite=0,$tipo=0,$otros=""){

			$query="";
			switch ($tipo){

					case -2:

						parse_str($arg);
						$idemp = $this->getIdEmpFromAlias($u);
						$query = "SELECT municipio as label, idmunicipio as data
								FROM cat_municipios where idestado = $otros and status_municipio = 1 and idemp = $idemp
								Order By data asc ";
						break;

					case -1:

						parse_str($arg);
						$idemp = $this->getIdEmpFromAlias($u);
						$query = "SELECT estado as label, idestado as data
								FROM cat_estados where idemp = $idemp and status_estado = 1
								Order By data asc ";
						break;

					case 0:

						parse_str($arg);
						$pass = md5($passwordL);
						$query = "SELECT username as label, concat(iduser,'|',password,'|',idemp,'|',empresa,'|',idusernivelacceso,'|',registrosporpagina,'|',clave,'|',param1,'|',nombre_completo_usuario) as data
								FROM  _viUsuarios where username = '$username' and password = '$pass' and status_usuario = 1";
						break;

					case 2:
						parse_str($arg);
						$idemp = $this->getIdEmpFromAlias($u);
						$query = "SELECT nivel_de_acceso as label,idusernivelacceso as data
								FROM usuarios_niveldeacceso where idemp = $idemp
								Order By idusernivelacceso asc ";
						break;

			}

			$Conn = new voConnPDO();
			$result = $Conn->queryFetchAllAssocOBJ($query);

			$Conn = null;

			return $result;

		}

	// Realiza una consulta SQL
	public function getQueryPDO($tipo=0,$cad="",$type=0,$from=0,$cant=0,$ar=array(),$otros="",$withPag=1) {
		$query="";
    	switch ($tipo){
			case -3:
				parse_str($cad);
		        $idemp = $this->getIdEmpFromAlias($u);
				$query = "SELECT llave,valor
								FROM config
							where idemp = $idemp";
				break;

			case -2:
				$query = "SELECT *
								FROM _viUsuarios
							where iduser = $cad  and status_usuario = 1  and idusernivelacceso <= 100";
				break;

			case -1:
				parse_str($cad);
				$iduser = $this->getIdUserFromAlias($u);
		        $idemp = $this->getIdEmpFromAlias($u);

				$query = "SELECT iduser, username, apellidos, nombres, foto
							FROM _viUsuarios
							WHERE  idemp = $idemp and status_usuario = 1  and idusernivelacceso <= 100
							Order by iduser desc";
				break;

			case 0:
					$query="SELECT *
							from _viUsuarios
							where username LIKE ('$cad%')  and status_usuario = 1  and idusernivelacceso <= 1000 ";
					break;

			case 1:
				parse_str($cad);
		        $idemp = $this->getIdEmpFromAlias($u);
				$query = "SELECT *
								FROM cat_estados
							Where idemp = $idemp order by idestado desc";
				break;
			case 2:
				$query = "SELECT  *
								FROM cat_estados
							where idestado = $cad ";
				break;

			case 3:
				parse_str($cad);
		        $idemp = $this->getIdEmpFromAlias($u);
				$query = "SELECT *
								FROM _viMunicipios
							Where idemp = $idemp and status_municipio = 1 order by idmunicipio desc";
				break;

			case 4:
				$query = "SELECT  *
								FROM _viMunicipios
							where idmunicipio = $cad ";
				break;

			case 5:
				parse_str($cad);
		        $idemp = $this->getIdEmpFromAlias($u);
				$query = "SELECT idpersona, nombre_persona, username
								FROM _viPersonas
							Where idemp = $idemp order by idpersona desc";
				break;

			case 6:
				$query = "SELECT *
								FROM _viPersonas
							where idpersona = $cad ";
				break;

			case 4000:
				parse_str($cad);
		        $idemp = $this->getIdEmpFromAlias($u);
				$query = "SELECT *
						FROM _viUsuariosConectados where idemp = $idemp and isconectado = 1 ";
				break;

	  	}

     	$Conn = new voConnPDO();
		$result = $Conn->queryFetchAllAssocOBJ($query);

		$Conn = null;

		return $result;

	}

	// Asocia elementos de una tabla A con una tabla B
	public function setAsocia($tipo=0,$arg="",$pag=0,$limite=0,$var2=0, $otros=""){
			 	$query="";
			 	$vRet = "Error";

	  		$ip=$_SERVER['REMOTE_ADDR'];
	  		$host=gethostbyaddr($_SERVER['REMOTE_ADDR']);

	    	switch ($tipo){
				case 51:
					switch($var2){
						case 10:
							parse_str($arg);
							$iduser = $this->getIdUserFromAlias($u);
							$idemp = $this->getIdEmpFromAlias($u);

		          			$ar = explode("|",$dests);
							foreach($ar as $i=>$valor){
								if ((int)($ar[$i])>0){
									$query = "Insert Into pase_salida_alumnos(idpsa,idalumno,idciclo,clave_nivel,idgrupo,idemp,ip,host,creado_por,creado_el)
																		value($idpsa,$ar[$i],$idciclo,$clave_nivel,$idgrupo,$idemp,'$ip','$host',$iduser,NOW())";

									$result = $Conn->exec($query);

									if ($result != 1){
										$vR = $Conn->errorInfo();
										$vRet = 'Hey'; //var_dump($vR[2]);
									}else{
										$vRet = "OK";
									}

								}
							}
							break;
						case 20:
							parse_str($arg);
		          			$ar = explode("|",$dests);
							foreach($ar as $i=>$valor){
								if ((int)($ar[$i])>0){
									$query = "Delete from pase_salida_alumnos where idpsaalumno = ".$ar[$i];

									$result = $Conn->exec($query);

									if ($result != 1){
										$vR = $Conn->errorInfo();
										$vRet = var_dump($vR[2]);
									}else{
										$vRet = "OK";
									}

								}
							}
							break;
					}
					break;
			}

	}

	// Realiza operaciones de tipo ABC
	public function saveDataPDO($index=0,$arg="",$pag=0,$limite=0,$tipo=0,$cadena2=""){
		$query="";
		$vRet = "Error";

	  	$ip=$_SERVER['REMOTE_ADDR'];
	  	$host=gethostbyaddr($_SERVER['REMOTE_ADDR']);

    	switch ($index){

			case 0:
				switch($tipo){
					case 0:
						parse_str($arg);
						$arr = array("alu","pro","per");
						if (!in_array(substr($username, 0,3), $arr)){
							$pass = md5($password1);
							$idusr = $this->getIdUserFromAlias($user);
							$idemp = $this->getIdEmpFromAlias($user);
							$query = "Insert Into usuarios(username,password,apellidos,nombres,
															correoelectronico,idusernivelacceso,
															status_usuario,
															idemp,ip,host,creado_por,creado_el)
										value( '$username','$pass','$apellidos','$nombres',
												'$correoelectronico',$idusernivelacceso,
												$status_usuario,
											    $idemp,'$ip','$host',$idusr,NOW())";

							$vRet = $this->guardarDatos($query);

						}else{
							$vRet = "Error: No puede usar ese prefijo en el Nombre de Usuario";
						}
						break;
					case 1:
						parse_str($arg);
						$idusr = $this->getIdUserFromAlias($user);
						$idemp = $this->getIdEmpFromAlias($user);
						if ( isset($idusernivelacceso) ){
							$idnivacc = " idusernivelacceso = $idusernivelacceso, ";
						}else{
								$idnivacc = "";
						}
						//$query = "update usuarios set username = '$username',
						$query = "update usuarios set apellidos = '$apellidos',
														nombres = '$nombres',
														correoelectronico = '$correoelectronico',
														".$idnivacc."
														status_usuario = $status_usuario,
														ip = '$ip',
														host = '$host',
														modi_por = $idusr,
														modi_el = NOW()
								Where iduser = $iduser";

						$vRet = $this->guardarDatos($query);

						break;
					case 2:
						$query = "delete from usuarios Where iduser = ".$arg;
						$vRet = $this->guardarDatos($query);
						break;
					case 3:
						parse_str($arg);
						$pass = md5($password1);
						$query = "update usuarios set password = '$pass',
														ip = '$ip',
														host = '$host',
														modi_por = $iduser2,
														modi_el = NOW()
								Where iduser = $iduser";

						$vRet = $this->guardarDatos($query);

						break;
					case 100:

						parse_str($arg);
						$tel = trim(utf8_decode($celular));
						$pass = md5($password);
						$query = "Insert Into usuarios(username,password,nombres,celular,idF,latitud,longitud,ip,host,creado_el)
											value('$username','$pass','$nombre','$tel','$idF','$latitud','$longitud','$ip','$host',NOW())";

						$vRet = $this->guardarDatos($query);

						break;
					case 101:

						parse_str($arg);
						$query = "update usuarios set valid = 1 where username='$username'";

						$vRet = $this->guardarDatos($query);

						break;
					case 200:

						parse_str($arg);
						$pass = md5($password);
						$query = "Insert Into usuarios(username,password,ip,host,creado_el)
											value('$username','$pass','$ip','$host',NOW())";

						$vRet = $this->guardarDatos($query);

						break;
					case 203:

						parse_str($arg);

						if ( isset($idusernivelacceso) ){
							$idnivacc = " idusernivelacceso = $idusernivelacceso, ";
						}else{
							$idnivacc = "";
						}

						$token_validated = $token == $token_source ? 1 : 0;
						$token = intval($token_validated) == 1? $token :"";

						$query = "update usuarios set
													 apellidos = '$apellidos',
													 nombres = '$nombres',
													 correoelectronico = '$correoelectronico',
													 ".$idnivacc."
													 teloficina = '$teloficina',
													 telpersonal = '$telpersonal',
													 token = '$token',
													 token_validated = $token_validated,
													 registrosporpagina = $registrosporpagina,
													 param1 = '$param1',
													 ip = '$ip',
													 host = '$host'
												where username LIKE ('$username2%')";

						$vRet = $this->guardarDatos($query);

						break;

					case 204:

						parse_str($arg);
						$query = "update usuarios set foto = '$foto',
													 ip = '$ip',
													 host = '$host'
													 where username LIKE ('$username%')";

						$vRet = $this->guardarDatos($query);

						break;

					case 205:

						parse_str($arg);
						$pass = md5($password);

						$query = "update usuarios set
													 password = '$pass',
													 ip = '$ip',
													 host = '$host'
												where username LIKE ('$username2%')";

						$vRet = $this->guardarDatos($query);

						break;

				}
				break;

			case 1:
				switch($tipo){
					case 0:
						parse_str($arg);
						$idusr = $this->getIdUserFromAlias($user);
						$idemp = $this->getIdEmpFromAlias($user);
						$query = "Insert Into cat_estados(clave,estado,status_estado,idemp,ip,host,creado_por,creado_el)
									value( '$clave','$estado',
										    $status_estado,$idemp,'$ip','$host',$idusr,NOW())";

						$vRet = $this->guardarDatos($query);

						break;
					case 1:
					     //$ar = $this->unserialice_force($arg);
						parse_str($arg);
						$idusr = $this->getIdUserFromAlias($user);
						$query = "update cat_estados set 	clave = '$clave',
													  	estado = '$estado',
													  	status_estado = $status_estado,
														ip = '$ip',
														host = '$host',
														modi_por = $idusr,
														modi_el = NOW()
								Where idestado = $idestado";

						$vRet = $this->guardarDatos($query);

						break;
					case 2:
						$query = "delete from cat_estados Where idestado = ".$arg;

						$vRet = $this->guardarDatos($query);

						break;
				}
				break;
			case 2:
				switch($tipo){
					case 0:
						parse_str($arg);
						$idusr = $this->getIdUserFromAlias($user);
						$idemp = $this->getIdEmpFromAlias($user);
						$query = "Insert Into cat_municipios(idestado,clave,municipio,status_municipio,idemp,ip,host,creado_por,creado_el)
									value( $idestado, '$clave','$municipio',
										    $status_municipio,$idemp,'$ip','$host',$idusr,NOW())";

						$vRet = $this->guardarDatos($query);

						break;
					case 1:
					     //$ar = $this->unserialice_force($arg);
						parse_str($arg);
						$idusr = $this->getIdUserFromAlias($user);
						$query = "update cat_municipios set idestado = $idestado,
														clave = '$clave',
													  	municipio = '$municipio',
													  	status_municipio = $status_municipio,
														ip = '$ip',
														host = '$host',
														modi_por = $idusr,
														modi_el = NOW()
								Where idmunicipio = $idmunicipio";

						$vRet = $this->guardarDatos($query);

						break;
					case 2:
						$query = "delete from cat_municipios Where idmunicipio = ".$arg;
						$vRet = $this->guardarDatos($query);
						break;
				}
				break;

			case 3: // 3
				switch($tipo){
					case 0:
						parse_str($arg);
						$idusr = $this->getIdUserFromAlias($user);
						$idemp = $this->getIdEmpFromAlias($user);

						$fn = explode('-',$fecha_nacimiento);
						$fn = $fn[2].'-'.$fn[1].'-'.$fn[0];

						$query = "Insert Into cat_personas(
															ap_paterno,
															ap_materno,
															nombre,
															email1,
															email2,
															tel1,
															tel2,
															cel1,
															cel2,
															lugar_nacimiento,
															fecha_nacimiento,
															curp,
															genero,
															ocupacion,
															domicilio_generico,
															calle,
															num_ext,
															num_int,
															colonia,
															localidad,
															estado,
															municipio,
															pais,
															cp,
															lugar_trabajo,
															status_persona,
															idemp,ip,host,creado_por,creado_el)
									value(
															'$ap_paterno',
															'$ap_materno',
															'$nombre',
															'$email1',
															'$email2',
															'$tel1',
															'$tel2',
															'$cel1',
															'$cel2',
															'$lugar_nacimiento',
															'$fn',
															'$curp',
															$genero,
															'$ocupacion',
															'".mb_strtoupper($domicilio_generico,'UTF-8')."',
															'".mb_strtoupper($calle,'UTF-8')."',
															'".mb_strtoupper($num_ext,'UTF-8')."',
															'".mb_strtoupper($num_int,'UTF-8')."',
															'".mb_strtoupper($colonia,'UTF-8')."',
															'".mb_strtoupper($localidad,'UTF-8')."',
															'".mb_strtoupper($estado,'UTF-8')."',
															'".mb_strtoupper($municipio,'UTF-8')."',
															'".mb_strtoupper($pais,'UTF-8')."',
															'".mb_strtoupper($cp,'UTF-8')."',
															'".mb_strtoupper($lugar_trabajo,'UTF-8')."',
															$status_persona,
															$idemp,'$ip','$host',$idusr,NOW())";

						$vRet = $this->guardarDatos($query);

						break;

					case 1:
					     //$ar = $this->unserialice_force($arg);
						parse_str($arg);
						$idusr = $this->getIdUserFromAlias($user);

						$fn = explode('-',$fecha_nacimiento);
						$fn = $fn[2].'-'.$fn[1].'-'.$fn[0];

						$query = "update cat_personas set
														ap_paterno = '$ap_paterno',
														ap_materno = '$ap_materno',
														nombre = '$nombre',
														email1 = '$email1',
														email2 = '$email2',
														tel1 = '$tel1',
														tel2 = '$tel2',
														cel1 = '$cel1',
														cel2 = '$cel2',
														lugar_nacimiento = '$lugar_nacimiento',
														fecha_nacimiento = '$fn',
														curp = '$curp',
														calle = '".mb_strtoupper($calle,'UTF-8')."',
														num_ext = '".mb_strtoupper($num_ext,'UTF-8')."',
														num_int = '".mb_strtoupper($num_int,'UTF-8')."',
														colonia = '".mb_strtoupper($colonia,'UTF-8')."',
														localidad = '".mb_strtoupper($localidad,'UTF-8')."',
														estado = '".mb_strtoupper($estado,'UTF-8')."',
														municipio = '".mb_strtoupper($municipio,'UTF-8')."',
														pais = '".mb_strtoupper($pais,'UTF-8')."',
														cp = '".mb_strtoupper($cp,'UTF-8')."',
														genero = $genero,
														ocupacion = '".mb_strtoupper($ocupacion,'UTF-8')."',
														domicilio_generico = '".mb_strtoupper($domicilio_generico,'UTF-8')."',
														lugar_trabajo = '".mb_strtoupper($lugar_trabajo,'UTF-8')."',
												  		status_persona = $status_persona,
														ip = '$ip',
														host = '$host',
														modi_por = $idusr,
														modi_el = NOW()
								Where idpersona = $idpersona";

						$vRet = $this->guardarDatos($query);

						break;
					case 2:
						$query = "delete from cat_personas Where idpersona = ".$arg;
						$vRet = $this->guardarDatos($query);
						break;
				} // 3
				break;

			case 49: //49
				switch($tipo){
					case 0:
						parse_str($arg);
						$idusr = $this->getIdUserFromAlias($u);
				        $idemp = $this->getIdEmpFromAlias($u);
				        $IsConnect = $this->IsExistUserConnect($idusr,$idemp);
				        if (intval($IsConnect) <= 0){
							$query = "insert into usuarios_conectados(
															iduser,
															username,
															isconectado,
															ultima_conexion,
															idemp,
															ip,
															host,
															creado_por,
															creado_el)
													values(
															$idusr,
															'$u',
															1,
															NOW(),
															$idemp,
															'$ip',
															'$host',
															$idusr,
															NOW() )" ;

						$vRet = $this->guardarDatos($query);

						}else{
					        $IsConnect = $this->IsConnectUser($idusr,$idemp);
					        if (intval($IsConnect) <= 0){
								$query = "update usuarios_conectados set
																isconectado = 1,
																ultima_conexion = NOW(),
																ip = '$ip',
																host = '$host',
																modi_por = $idusr,
																modi_el = NOW()
										Where iduser = $idusr and idemp = $idemp and isconectado = 0";

								$vRet = $this->guardarDatos($query);

							}else{
								$vRet = "OK";
							}

						}

						break;

					case 1:
						parse_str($arg);

						$idusr = $this->getIdUserFromAlias($u);
				        $idemp = $this->getIdEmpFromAlias($u);
				        $IsConnect = $this->IsConnectUser($idusr,$idemp);
				        if (intval($IsConnect) > 0){
							$query = "update usuarios_conectados set
															isconectado = 0,
															ultima_conexion = NOW(),
															ip = '$ip',
															host = '$host',
															modi_por = $idusr,
															modi_el = NOW()
									Where iduser = $idusr and idemp = $idemp and isconectado = 1";

							$vRet = $this->guardarDatos($query);

						}else{
							$vRet = "OK";
						}

						break;
				} //49
				break;


	  	}

		return $vRet;
	}

	// Genera un Username y Password
	public function generarUsuario($iddato=0) {

     	$Conn = new voConnPDO();
		$query = "SET @X = Generar_Usuario(".$iddato.")";
		$result = $Conn->queryFetchAllAssocOBJ($query);
		if (!$result) {
				$ret=0;
		}else{
			   	$ret= $result[0]->iduser;
		}
		$Conn = null;


		return $ret;

	}

}

?>
