<?php


ini_set('display_errors', '0');     # don't show any errors...
error_reporting(E_ALL | E_STRICT);  # ...but do log them

error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);



date_default_timezone_set('America/Mexico_City');

require_once('vo/voConnPDO.php');
require_once('vo/voEmpty.php');

define('CLAVE_TECNICO', 3);

class oCenturaPDO
{
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
    public $urlCImg;



    // Constructor
    private function __construct()
    {
        $this->Nav      = "Ninguno";
        $this->IdUser   = 0;
        $this->User     = "";
        $this->Pass     = "";
        $this->iva      = 0.16;
        $this->URL      = "http://imsg.mx/";
        $this->urlCImg  = "http://imsg.mx/";
    }

    // Get Instance
    public static function getInstance()
    {
        if (!self::$instancia instanceof self) {
            self::$instancia = new self;
        }
        return self::$instancia;
    }

    // Obtiene el ID del Usuario a partir de su Alias
    private function getIdUserFromAlias($str)
    {
        $query = "select iduser from usuarios WHERE username = '$str' AND status_usuario = 1";

        $Conn = new voConnPDO();
        $result = $Conn->queryFetchAllAssocOBJ($query);

        if (!$result) {
            $ret=0;
        } else {
            $ret= $result[0]->iduser;
        }

        $Conn = null;

        return $ret;
    }

    // Obtiene el ID de la Empresa a partir de su Alias
    private function getIdEmpFromAlias($str)
    {
        $query = "select idemp from usuarios WHERE username = '$str' AND status_usuario = 1";

        $Conn = new voConnPDO();
        $result = $Conn->queryFetchAllAssocOBJ($query);

        if (!$result) {
            $ret=0;
        } else {
            $ret= $result[0]->idemp;
        }

        $Conn = null;

        return $ret;
    }

    // Valida si existen usuarios conectados
    private function IsExistUserConnect($iduser, $idemp)
    {
        $query = "select iduser from usuarios_conectados WHERE iduser = $iduser AND idemp = $idemp limit 1";

        $Conn = new voConnPDO();
        $result = $Conn->queryFetchAllAssocOBJ($query);

        if (!$result) {
            $ret=0;
        } else {
            $ret= $result[0]->iduser;
        }
        $Conn = null;
        return $ret;
    }

    // Valida si usuario esta conectado
    private function IsConnectUser($iduser, $idemp)
    {
        $query = "select iduser from usuarios_conectados WHERE iduser = $iduser AND idemp = $idemp AND isconectado = 1 limit 1";
        $Conn = new voConnPDO();
        $result = $Conn->queryFetchAllAssocOBJ($query);

        if (!$result) {
            $ret=0;
        } else {
            $ret= $result[0]->iduser;
        }
        $Conn = null;
        return $ret;
    }

    public function getLogoEmp($idemp)
    {
        $query = "select valor from config WHERE llave = 'logo-emp-rep' AND idemp = $idemp";

        $Conn = new voConnPDO();
        $result = $Conn->queryFetchAllAssocOBJ($query);

        if (!$result) {
            $ret=0;
        } else {
            $ret= $result[0]->valor;
        }
        $Conn = null;
        return $ret;
    }

    public function getNombreEmp($idemp)
    {
        $query = "select rs from empresa WHERE idemp = $idemp";
        $Conn = new voConnPDO();
        $result = $Conn->queryFetchAllAssocOBJ($query);

        if (!$result) {
            $ret=0;
        } else {
            $ret= $result[0]->rs;
        }
        $Conn = null;
        return $ret;
    }

    public function getPubIdEmp($user="")
    {
        $idemp = $this->getIdEmpFromAlias($user);
        return $idemp;
    }

    public function getPubIdUser($user="")
    {
        $idusr = $this->getIdUserFromAlias($user);
        return $idusr;
    }

    public function isExistUserFromEmp($user="")
    {
        $idemp = $this->getPubIdEmp($user);
        $query = "select iduser from usuarios where username = '$user' and status_usuario = 1 and idemp = ".$idemp." limit 1";
       
        $Conn = new voConnPDO();
        $result = $Conn->queryFetchAllAssocOBJ($query);

        if (!$result) {
            $ret=0;
        } else {
            $ret= $result[0]->iduser;
        }
        $Conn = null;
        return $ret;

    }

    public function guardarDatos($query="")
    {
        $Conn = new voConnPDO();
        $result = $Conn->exec($query);

        if (!$result) {
            $rt  = $Conn->errorInfo();
            $ret = is_null($rt[2]) ? "OK" : $rt[2];
        } else {
            $ret = "OK";
        }

        $Conn = null;
        return $ret;
    }

    public function getLastID($query=""){
        $Conn = new voConnPDO();
        $result = $Conn->queryFetchAllAssocOBJ($query);
        if (!$result) {
            $ret=0;
        } else {
            $ret= $result[0]->Id;
        }
        $Conn = null;
        return $ret;
    }

    public function guardarDatosOrden($query="",$id="",$table="")
    {
        $Conn = new voConnPDO();
        $result = $Conn->exec($query);
        $qry = "SELECT MAX( $id ) AS Id FROM $table";

        if (!$result) {
            $rt  = $Conn->errorInfo();
            if (is_null($rt[2]) ) {
                $ret = $this->getLastID($qry);
            }else{
                $ret = -1;                
            }
            // $ret = is_null($rt[2]) ? "OK" : $rt[2];
        } else {
               $ret = $this->getLastID($qry);
         }
        $Conn = null;
        return $ret;
    }

    public function getArray($query)
    {
        $rs=0;
        $Conn = new voConnPDO();
        $rst = $Conn->queryFetchAllAssocOBJ($query);
        $Conn = null;
        return $rst;
    }

    public function execQuery($query)
    {
        $vRet = "OK";
        $Conn = new voConnPDO();
        $result = $Conn->query($query);
        $query="SELECT @X AS outvar;";
        $rt = $Conn->query($query);
        foreach ($rt as $x) {
            $vRet= is_null($x['outvar']) ? 'Operación no permitida, contacte al administrador' : $x['outvar'];
        }
        $Conn = null;
        return $vRet;
    }

    // Obtiene una lista de elementos Llave => Valor
    public function getComboPDO($index=0, $arg="", $pag=0, $limite=0, $tipo=0, $otros="")
    {
        $query="";
        switch ($tipo) {

                    case -4:

                        parse_str($arg);
                        $idemp = $this->getIdEmpFromAlias($u);
                        $query = "SELECT estado as label, idestado as data, predeterminado
                                FROM cat_estados WHERE idemp = $idemp AND status_estado = 1
                                AND idsucursal = $otros 
                                Order By data asc ";
                        break;

                    case -3:

                        parse_str($arg);
                        $idemp = $this->getIdEmpFromAlias($u);
                        $query = "SELECT sucursal as label, idsucursal as data
                                FROM cat_sucursales Order By data asc ";
                        break;

                    case -2:

                        parse_str($arg);
                        $idemp = $this->getIdEmpFromAlias($u);
                        $query = "SELECT municipio as label, idmunicipio as data, predeterminado
								FROM cat_municipios WHERE idestado = $otros AND status_municipio = 1 AND idemp = $idemp
								Order By data asc ";
                        break;

                    case -1:

                        parse_str($arg);
                        $idemp = $this->getIdEmpFromAlias($u);
                        $query = "SELECT estado as label, idestado as data, predeterminado
								FROM cat_estados WHERE idemp = $idemp AND status_estado = 1
								Order By data asc ";
                        break;

                    case 0:

                        parse_str($arg);
                        $pass = md5($passwordL);
                        $query = "SELECT username as label, concat(iduser,'|',password,'|',idemp,'|',empresa,'|',idusernivelacceso,'|',registrosporpagina,'|',clave,'|',param1,'|',nombre_completo_usuario,'|',idpersona,'|',idsucursal,'|',sucursal) as data
								FROM  _viPersonas WHERE username = '$username' AND password = '$pass' AND status_usuario = 1";
                        break;

                    case 76:
                        parse_str($arg);
                        $idemp = $this->getIdEmpFromAlias($u);
                        $query = "SELECT *
                                        FROM cat_colores
                                    Where idemp = $idemp order by idcolor asc";
                        break;

                    case 77:
                        $query = "SELECT *
                                        FROM cat_colores
                                    where idcolor = $arg ";
                        break;

                    case 78:
                        $query = "SELECT idrepresentantelegal as data, reptte_legal as label
                                        FROM _viEmpresaRepteLegal
                                    where idempresa = $arg ";
                        break;

                    case 79:
                        $query = "SELECT idtecnico as data, tecnico as label
                                        FROM _viEmpresaTecnico
                                    where idempresa = $arg ";
                        break;

                    case 80:
                        parse_str($arg);
                        $idemp = $this->getIdEmpFromAlias($u);
                        $query = "SELECT idmarca as data, marca as label
                                        FROM cat_marcas
                                    where idemp = $idemp ";
                        break;

                    case 81:
                        parse_str($arg);
                        $idemp = $this->getIdEmpFromAlias($u);
                        $query = "SELECT idcolor as data, descripcion as label, codigo_color_hex
                                        FROM cat_colores
                                    where idemp = $idemp ";
                        break;

                    case 82:
                        parse_str($arg);
                        $idemp = $this->getIdEmpFromAlias($u);
                        $query = "SELECT idequipocategoria as data, equipo_categoria as label
                                        FROM cat_equipos_categorias
                                    where idemp = $idemp 
                                    ORDER BY equipo_categoria ASC";
                        break;

                    case 83:
                        parse_str($arg);
                        $idemp = $this->getIdEmpFromAlias($u);
                        $query = "SELECT idunidadmedida as data, unidad_medida as label
                                        FROM cat_unidades_medidas
                                    where idemp = $idemp ";
                        break;

                    case 84:
                        parse_str($arg);
                        $idemp = $this->getIdEmpFromAlias($u);
                        $query = "SELECT idpreciocategoria as data, precio_categoria as label
                                        FROM cat_precios_categorias
                                    where idemp = $idemp ";
                        break;

                    case 85:
                        parse_str($arg);
                        $idemp = $this->getIdEmpFromAlias($u);
                        $query = "SELECT idprecio as data, concat(codigo,' - ',concepto,' - ',precio_unitario) as label,codigo,precio_unitario,is_iva
                                        FROM cat_precios
                                    where idemp = $idemp ";
                        break;

                    case 86:
                        parse_str($arg);
                        $idemp = $this->getIdEmpFromAlias($u);
                        $query = "SELECT idporcentajeutilidad as data, descripcion as label, predeterminado
                                        FROM cat_porcentaje_utilidad
                                    where idemp = $idemp ";
                        break;

                    case 87:
                        parse_str($arg);
                        $idemp = $this->getIdEmpFromAlias($u);
                        $query = "SELECT idmoneda as data, moneda as label, tipo_cambio, predeterminado
                                        FROM cat_moneda";
                        break;

                    case 100:
                        parse_str($arg);
                        $idemp = $this->getIdEmpFromAlias($u);
                        $query = "SELECT razon_social as label, idempresa as data
								FROM  _viEmpresas
                                WHERE idemp = $idemp AND status_empresa = 1
                                ORDER By razon_social ASC";
                        break;

                    case 101:
                        parse_str($arg);
                        $idemp = $this->getIdEmpFromAlias($u);
                        $query = "SELECT nombre_persona as label, idpersona as data
								FROM  _viPersonas
                                WHERE idemp = $idemp AND 
                                         idusernivelacceso IN (1,2,4,5) AND 
                                        status_persona = 1
                                ORDER BY nombre_persona ASC";
                        break;

                    case 102:
                        parse_str($arg);
                        $idemp = $this->getIdEmpFromAlias($u);
                        $query = "SELECT reptte_legal as label, idempresarepresentantelegal as data
								FROM  _viEmpresaRepteLegal
                                WHERE idemp = $idemp AND 
                                      idempresa = $otros AND 
                                      status_empresa_reptte_legal = 1
                                ORDER BY reptte_legal ASC";
                        break;

                    case 103:
                        parse_str($arg);
                        $idemp = $this->getIdEmpFromAlias($u);
                        $clave = CLAVE_TECNICO;
                        $query = "SELECT nombre_persona as label, idpersona as data
								FROM  _viPersonas
                                WHERE idemp = $idemp AND
                                        clave = $clave AND
                                        idusernivelacceso = 3 AND 
                                        status_persona = 1
                                ORDER BY nombre_persona ASC";
                        break;

                    case 104:
                        parse_str($arg);
                        $idemp = $this->getIdEmpFromAlias($u);
                        $query = "SELECT tecnico as label, idempresatecnico as data
								FROM  _viEmpresaTecnico
                                WHERE idemp = $idemp AND
                                      idempresa = $otros AND 
                                     status_empresa_tecnico = 1
                                ORDER BY tecnico ASC";
                        break;

                    case 2:
                        parse_str($arg);
                        $idemp = $this->getIdEmpFromAlias($u);
                        $query = "SELECT nivel_de_acceso as label,idusernivelacceso as data
								FROM usuarios_niveldeacceso WHERE idemp = $idemp
								Order By idusernivelacceso asc ";
                        break;

            }

        $Conn = new voConnPDO();
        $result = $Conn->queryFetchAllAssocOBJ($query);

        $Conn = null;

        return $result;
    }

    // Realiza una consulta SQL
    public function getQueryPDO($tipo=0, $cad="", $type=0, $from=0, $cant=0, $ar=array(), $otros="", $withPag=1)
    {
        $query="";
        switch ($tipo) {
            case -3:
                parse_str($cad);
                $idemp = $this->getIdEmpFromAlias($u);
                $query = "SELECT llave,valor
								FROM config
							WHERE idemp = $idemp";
                break;

            case -2:
                $query = "SELECT *
								FROM _viUsuarios
							WHERE iduser = $cad  AND status_usuario = 1  AND idusernivelacceso <= 100";
                break;

            case -1:
                parse_str($cad);
                $iduser = $this->getIdUserFromAlias($u);
                $idemp = $this->getIdEmpFromAlias($u);

                $query = "SELECT iduser, username, apellidos, nombres, foto, nivel_de_acceso
							FROM _viUsuarios
							WHERE  idemp = $idemp AND status_usuario = 1  AND idusernivelacceso <= 100
							Order by iduser desc";
                break;

            case 0:
                    $query="SELECT *
							from _viUsuarios
							WHERE username LIKE ('$cad%')  AND status_usuario = 1  AND idusernivelacceso <= 1000 ";
                    break;

            case 1:
                parse_str($cad);
                $idemp = $this->getIdEmpFromAlias($u);
                $query = "SELECT *
								FROM _viEstados
							WHERE idemp = $idemp order by idestado desc";
                break;
            case 2:
                $query = "SELECT  *
								FROM cat_estados
							WHERE idestado = $cad ";
                break;

            case 3:
                parse_str($cad);
                $idemp = $this->getIdEmpFromAlias($u);
                $query = "SELECT *
								FROM _viMunicipios
							WHERE idemp = $idemp AND status_municipio = 1 order by idmunicipio desc";
                break;

            case 4:
                $query = "SELECT  *
								FROM _viMunicipios
							WHERE idmunicipio = $cad ";
                break;

            case 5:
                parse_str($cad);
                $rngQry = intval($rngQry);
                $qry = "";
                switch ($rngQry) {
                    case 0:
                        $qry = " AND ( SUBSTR(TRIM(nombre_persona),1,1) IN ('A','B') ) ";
                        break;
                    case 1:
                        $qry = " AND ( SUBSTR(TRIM(nombre_persona),1,1) IN ('C','D','E') ) ";
                        break;
                    case 2:
                        $qry = " AND ( SUBSTR(TRIM(nombre_persona),1,1) IN ('F','H','H','I','J') ) ";
                        break;
                    case 3:
                        $qry = " AND ( SUBSTR(TRIM(nombre_persona),1,1) IN ('K','L','M','N','O') ) ";
                        break;
                    case 4:
                        $qry = " AND ( SUBSTR(TRIM(nombre_persona),1,1) IN ('P','Q','R') ) ";
                        break;
                    case 5:
                        $qry = " AND ( SUBSTR(TRIM(nombre_persona),1,1) IN ('S','T','U','V','W','X','Y','Z') ) ";
                        break;
                }
                $qry = " ";
                $idemp = $this->getIdEmpFromAlias($u);
                $query = "SELECT idpersona, nombre_persona, username
								FROM _viPersonas
							WHERE idemp = $idemp ".$qry." ORDER BY nombre_persona ASC ";
                break;

            case 6:
                $query = "SELECT *
								FROM _viPersonas
							WHERE idpersona = $cad ";
                break;

            case 7:
                parse_str($cad);
                $idemp = $this->getIdEmpFromAlias($u);
                $query = "SELECT idempresa, rfc, razon_social, cp, is_email
                        FROM _viEmpresas WHERE idemp = $idemp and status_empresa = 1
                        Order By razon_social asc ";
                break;

            case 8:
                parse_str($cad);
                $idemp = $this->getIdEmpFromAlias($u);
                $query = "SELECT *
                        FROM _viEmpresas WHERE idempresa = $idempresa AND idemp = $idemp AND status_empresa = 1";
                break;

            case 9:
                parse_str($cad);
                $idemp = $this->getIdEmpFromAlias($u);
                $query = "SELECT idpersona, nombre_persona, username
								FROM _viPersonas
							WHERE idemp = $idemp AND clave = '$clave' ORDER BY nombre_persona ASC ";
                break;

            case 10:
                parse_str($cad);
                $idemp = $this->getIdEmpFromAlias($u);
                $query = "SELECT *
								FROM cat_marcas
							WHERE idemp = $idemp order by idmarca desc";
                break;
            case 11:
                $query = "SELECT  *
								FROM cat_marcas
							WHERE idmarca = $cad ";
                break;

            case 12:
                parse_str($cad);
                $idemp = $this->getIdEmpFromAlias($u);
                $query = "SELECT *
                                FROM cat_equipos_categorias
                            WHERE idemp = $idemp order by idequipocategoria desc";
                break;

            case 13:
                $query = "SELECT  *
                                FROM cat_equipos_categorias
                            WHERE idequipocategoria = $cad ";
                break;

            case 14:
                parse_str($cad);
                $idemp = $this->getIdEmpFromAlias($u);
                if ($CNA == 0 || $CNA == 1){
                    $query = "SELECT *
                                    FROM _viControlMaster
                                WHERE idemp = $idemp order by idcontrolmaster desc";

                }else if ($CNA == 3){
                    $query = "SELECT *
                                    FROM _viControlMaster
                                WHERE idemp = $idemp AND 
                                    idtecnico = $idper 
                                ORDER BY idcontrolmaster DESC";
                }else {
                    $query = "SELECT *
                                FROM _viControlMaster
                                WHERE idemp = $idemp 
                                ORDER BY idcontrolmaster DESC 
                                LIMIT 1";
                    
                }

                break;

            case 15:
                $query = "SELECT  *
                                FROM _viControlMaster
                            WHERE idcontrolmaster = $cad ";
                break;

            case 16:
                parse_str($cad);
                $idemp = $this->getIdEmpFromAlias($u);
                $query = "SELECT DISTINCT empresa, idempresa
                                FROM _viEmpresaRepteLegal
                            WHERE idemp = $idemp order by empresa asc";
                break;

            case 17:
                parse_str($cad);
                $idemp = $this->getIdEmpFromAlias($u);
                $query = "SELECT  *
                                FROM control_detalle
                            WHERE idcontrolmaster = $idcontrolmaster AND idemp = $idemp ";
                break;

            case 18:
                $query = "SELECT  *
                                FROM control_detalle
                            WHERE iddetalle = $cad ";
                break;

            case 19:
                parse_str($cad);
                $idemp = $this->getIdEmpFromAlias($u);
                $query = "SELECT  *
                                FROM control_importe
                            WHERE idcontrolmaster = $idcontrolmaster AND idemp = $idemp ";
                break;

            case 20:
                $query = "SELECT  *
                                FROM control_importe
                            WHERE idimporte = $cad ";
                break;

            case 21:
                parse_str($cad);
                $idemp = $this->getIdEmpFromAlias($u);
                $query = "SELECT *
                                FROM cat_precios_categorias
                            WHERE idemp = $idemp order by idpreciocategoria desc";
                break;

            case 22:
                $query = "SELECT  *
                                FROM cat_precios_categorias
                            WHERE idpreciocategoria = $cad ";
                break;

            case 23:
                parse_str($cad);
                $idemp = $this->getIdEmpFromAlias($u);
                $query = "SELECT *
                                FROM cat_unidades_medidas
                            WHERE idemp = $idemp order by idunidadmedida desc";
                break;

            case 24:
                $query = "SELECT  *
                                FROM cat_unidades_medidas
                            WHERE idunidadmedida = $cad ";
                break;

            case 25:
                parse_str($cad);
                $idemp = $this->getIdEmpFromAlias($u);
                $query = "SELECT *
                                FROM cat_precios
                            WHERE idemp = $idemp order by idprecio desc";
                break;

            case 26:
                $query = "SELECT  *
                                FROM cat_precios
                            WHERE idprecio = $cad ";
                break;

            case 27:
                parse_str($cad);
                $idemp = $this->getIdEmpFromAlias($u);
                $query = "SELECT *
                                FROM _viControlComentarios
                            WHERE idcontrolmaster = $idcontrolmaster AND idemp = $idemp ORDER BY idcontrolcomentario DESC";
                break;

            case 28:
                $query = "SELECT  *
                                FROM _viControlComentarios
                            WHERE idcontrolcomentario = $cad ";
                break;

            case 29:
                $query = "SELECT idclienterecibioentrega, idtecnicoentrego, fsalida
                                FROM control_master
                            WHERE idcontrolmaster = $cad ";
                break;

            case 30:
                parse_str($cad);
                $idemp = $this->getIdEmpFromAlias($u);
                    $query = "
                            SELECT *
                            FROM _viConlMasDifFec
                            WHERE idemp = $idemp 
                            ORDER BY dias_dif_enteros_orden DESC, idcontrolmaster ASC 
                            LIMIT 0, 50";

                break;

            case 31:
                parse_str($cad);
                $idemp = $this->getIdEmpFromAlias($u);
                    $query = "
                            SELECT *
                            FROM _viConlMasDifFec
                            WHERE idemp = $idemp 
                            ORDER BY dias_dif_enteros_orden DESC, idcontrolmaster ASC 
                            LIMIT 0, 50";

                break;

            case 32:
                parse_str($cad);
                $idemp = $this->getIdEmpFromAlias($u);
                $cad = $numero > 10 ? ' dias_dif_enteros_orden > 10 ' : ' dias_dif_enteros_orden = '.$numero;
                    $query = "
                            SELECT *
                            FROM _viConlMasDifFec
                            WHERE 
                                idemp = $idemp AND  
                                TRIM(marca_det) = '$marca' AND 
                                $cad     
                            ORDER BY idcontrolmaster ASC";

                break;

            case 33:
                parse_str($cad);
                $idemp = $this->getIdEmpFromAlias($u);
                $query = "SELECT  *
                                FROM control_imagenes
                            WHERE idcontrolmaster = $idcontrolmaster AND idemp = $idemp 
                            ORDER BY idcontrolimagen DESC";
                break;

            case 34:
                parse_str($cad);
                $idemp = $this->getIdEmpFromAlias($u);
                    $query = "SELECT *
                                FROM cotizacion_encab
                                WHERE idemp = $idemp 
                                ORDER BY idcotizacion DESC 
                                LIMIT 1";
                break;

            case 35:
                $query = "SELECT  *
                                FROM cotizacion_encab
                            WHERE idcotizacion = $cad ";
                break;

            case 36:
                parse_str($cad);
                $idemp = $this->getIdEmpFromAlias($u);
                $query = "SELECT  *
                                FROM _viCotizacion_Detalle
                            WHERE idcotizacion = $idcotizacion AND idemp = $idemp 
                                ORDER BY idcotizaciondetalle desc";
                break;

            case 37:
                $query = "SELECT  *
                                FROM cotizacion_detalles
                            WHERE idcotizaciondetalle = $cad ";
                break;

            case 38:
                $query = "SELECT  subtotal,iva,total
                                FROM cotizacion_encab
                            WHERE idcotizacion = $cad ";
                break;

            case 39:
                $query = "SELECT  *
                                FROM _viCotizacion_Detalle
                            WHERE idcotizacion = $cad 
                                ORDER BY idcotizaciondetalle asc";
                break;

            case 4000:
                parse_str($cad);
                $idemp = $this->getIdEmpFromAlias($u);
                $query = "SELECT *
						FROM _viUsuariosConectados WHERE idemp = $idemp AND isconectado = 1 ";
                break;

        }

        $Conn = new voConnPDO();
        $result = $Conn->queryFetchAllAssocOBJ($query);

        $Conn = null;

        return $result;
    }

    // Asocia elementos de una tabla A con una tabla B
    public function setAsocia($tipo=0, $arg="", $pag=0, $limite=0, $var2=0, $otros="")
    {
        $query="";
        $vRet = "Error";

        $ip=$_SERVER['REMOTE_ADDR'];
        $host=gethostbyaddr($_SERVER['REMOTE_ADDR']);

        switch ($tipo) {
                case 30:
                    switch ($var2) {
                        case 10:
                            // parse_str($arg);
                            parse_str($otros);
                            $iduser = $this->getIdUserFromAlias($u);
                            $idemp = $this->getIdEmpFromAlias($u);

                            $ar = explode(".", $arg);
                            $ar0 = explode("|", $ar[0]);
                            // $ar[1];
                            foreach ($ar0 as $i=>$valor) {
                                if ((int)($ar0[$i])>0) {
                                    $query = "INSERT INTO empresas_reptte_legal(idrepresentantelegal,idempresa,idemp,ip,host,creado_por,creado_el)
                                                                        VALUES($ar0[$i],$ar[1],$idemp,'$ip','$host',$iduser,NOW())";
                                    $vRet = $this->guardarDatos($query);
                                }
                            }
                            break;
                        case 20:
                            // parse_str($arg);
                            $ar = explode("|", $arg);
                            foreach ($ar as $i=>$valor) {
                                if ((int)($ar[$i])>0) {
                                    $query = "DELETE FROM empresas_reptte_legal WHERE idempresarepresentantelegal = ".$ar[$i];
                                    $vRet = $this->guardarDatos($query);
                                }
                            }
                            break;
                    } // 30
                    break;

                case 31:
                    switch ($var2) {
                        case 10:
                            // parse_str($arg);
                            parse_str($otros);
                            $iduser = $this->getIdUserFromAlias($u);
                            $idemp = $this->getIdEmpFromAlias($u);

                            $ar = explode(".", $arg);
                            $ar0 = explode("|", $ar[0]);
                            // $ar[1];
                            foreach ($ar0 as $i=>$valor) {
                                if ((int)($ar0[$i])>0) {
                                    $query = "INSERT INTO empresas_tecnicos(idtecnico,idempresa,idemp,ip,host,creado_por,creado_el)
                                                                        VALUES($ar0[$i],$ar[1],$idemp,'$ip','$host',$iduser,NOW())";
                                    $vRet = $this->guardarDatos($query);
                                }
                            }
                            break;
                        case 20:
                            // parse_str($arg);
                            $ar = explode("|", $arg);
                            foreach ($ar as $i=>$valor) {
                                if ((int)($ar[$i])>0) {
                                    $query = "DELETE FROM empresas_tecnicos WHERE idempresatecnico = ".$ar[$i];
                                    $vRet = $this->guardarDatos($query);
                                }
                            }
                            break;
                    } // 30
                    break;

                case 51:
                    switch ($var2) {
                        case 10:
                            parse_str($arg);
                            $iduser = $this->getIdUserFromAlias($u);
                            $idemp = $this->getIdEmpFromAlias($u);
                            $ar = explode("|", $dests);
                            foreach ($ar as $i=>$valor) {
                                if ((int)($ar[$i])>0) {
                                    $query = "INSERT INTO pase_salida_alumnos(idpsa,idalumno,idciclo,clave_nivel,idgrupo,idemp,ip,host,creado_por,creado_el)
																		VALUES($idpsa,$ar[$i],$idciclo,$clave_nivel,$idgrupo,$idemp,'$ip','$host',$iduser,NOW())";

                                    $result = $Conn->exec($query);

                                    if ($result != 1) {
                                        $vR = $Conn->errorInfo();
                                        $vRet = 'Hey'; //var_dump($vR[2]);
                                    } else {
                                        $vRet = "OK";
                                    }
                                }
                            }
                            break;
                        case 20:
                            parse_str($arg);
                              $ar = explode("|", $dests);
                            foreach ($ar as $i=>$valor) {
                                if ((int)($ar[$i])>0) {
                                    $query = "DELETE FROM pase_salida_alumnos WHERE idpsaalumno = ".$ar[$i];

                                    $result = $Conn->exec($query);

                                    if ($result != 1) {
                                        $vR = $Conn->errorInfo();
                                        $vRet = var_dump($vR[2]);
                                    } else {
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
    public function saveDataPDO($index=0, $arg="", $pag=0, $limite=0, $tipo=0, $cadena2="")
    {
        $query="";
        $vRet = "Error";

        $ip=$_SERVER['REMOTE_ADDR'];
        $host=gethostbyaddr($_SERVER['REMOTE_ADDR']);

        switch ($index) {

            case 0:
                switch ($tipo) {
                    case 0:
                        parse_str($arg);
                        $arr = array("alu","pro","per");
                        if (!in_array(substr($username, 0, 3), $arr)) {
                            $pass = md5($password1);
                            $idusr = $this->getIdUserFromAlias($user);
                            $idemp = $this->getIdEmpFromAlias($user);
                            $query = "INSERT INTO usuarios(username,password,apellidos,nombres,
															correoelectronico,idusernivelacceso,
															status_usuario,
															idemp,ip,host,creado_por,creado_el)
										VALUES( '$username','$pass','$apellidos','$nombres',
												'$correoelectronico',$idusernivelacceso,
												$status_usuario,
											    $idemp,'$ip','$host',$idusr,NOW())";

                            $vRet = $this->guardarDatos($query);
                        } else {
                            $vRet = "Error: No puede usar ese prefijo en el Nombre de Usuario";
                        }
                        break;
                    case 1:
                        parse_str($arg);
                        $idusr = $this->getIdUserFromAlias($user);
                        $idemp = $this->getIdEmpFromAlias($user);
                        if (isset($idusernivelacceso)) {
                            $idnivacc = " idusernivelacceso = $idusernivelacceso, ";
                        } else {
                            $idnivacc = "";
                        }
                        //$query = "UPDATE usuarios SET username = '$username',
                        $query = "UPDATE usuarios SET apellidos = '$apellidos',
														nombres = '$nombres',
														correoelectronico = '$correoelectronico',
														".$idnivacc."
														status_usuario = $status_usuario,
														ip = '$ip',
														host = '$host',
														modi_por = $idusr,
														modi_el = NOW()
								WHERE iduser = $iduser";

                        $vRet = $this->guardarDatos($query);

                        break;
                    case 2:
                        $query = "DELETE FROM usuarios WHERE iduser = ".$arg;
                        $vRet = $this->guardarDatos($query);
                        break;
                    case 3:
                        parse_str($arg);
                        $pass = md5($password1);
                        $query = "UPDATE usuarios SET password = '$pass',
														ip = '$ip',
														host = '$host',
														modi_por = $iduser2,
														modi_el = NOW()
								WHERE iduser = $iduser";

                        $vRet = $this->guardarDatos($query);

                        break;
                    case 100:

                        parse_str($arg);
                        $tel = trim(utf8_decode($celular));
                        $pass = md5($password);
                        $query = "INSERT INTO usuarios(username,password,nombres,celular,idF,latitud,longitud,ip,host,creado_el)
											VALUES('$username','$pass','$nombre','$tel','$idF','$latitud','$longitud','$ip','$host',NOW())";

                        $vRet = $this->guardarDatos($query);

                        break;
                    case 101:

                        parse_str($arg);
                        $query = "UPDATE usuarios SET valid = 1 WHERE username='$username'";
                        $vRet = $this->guardarDatos($query);

                        break;
                    case 200:

                        parse_str($arg);
                        $pass = md5($password);
                        $query = "INSERT INTO usuarios(username,password,ip,host,creado_el)
											VALUES('$username','$pass','$ip','$host',NOW())";

                        $vRet = $this->guardarDatos($query);

                        break;
                    case 203:

                        parse_str($arg);

                        if (isset($idusernivelacceso)) {
                            $idnivacc = " idusernivelacceso = $idusernivelacceso, ";
                        } else {
                            $idnivacc = "";
                        }

                        $token_validated = $token == $token_source ? 1 : 0;
                        $token = intval($token_validated) == 1? $token :"";

                        $query = "UPDATE usuarios SET
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
												WHERE username LIKE ('$username2%')";

                        $vRet = $this->guardarDatos($query);

                        break;

                    case 204:

                        parse_str($arg);
                        $query = "UPDATE usuarios SET foto = '$foto',
													 ip = '$ip',
													 host = '$host'
													 WHERE username LIKE ('$username%')";

                        $vRet = $this->guardarDatos($query);

                        break;

                    case 205:

                        parse_str($arg);
                        $pass = md5($password);

                        $query = "UPDATE usuarios SET
													 password = '$pass',
													 ip = '$ip',
													 host = '$host'
												WHERE username LIKE ('$username2%')";

                        $vRet = $this->guardarDatos($query);

                        break;

                }
                break;

            case 1:
                switch ($tipo) {
                    case 0:
                        parse_str($arg);
                        $idusr = $this->getIdUserFromAlias($user);
                        $idemp = $this->getIdEmpFromAlias($user);
                        if ( intval($predeterminado) == 1 ){
                            $q = "UPDATE cat_estados SET predeterminado = 0 WHERE idsucursal = $idsucursal AND predeterminado = 1 AND idemp = $idemp";
                            $r = $this->guardarDatos($q);
                        }
                        $query = "INSERT INTO cat_estados(clave,estado,status_estado,idsucursal,predeterminado,idemp,ip,host,creado_por,creado_el)
									VALUES( '$clave','$estado',
										    $status_estado,$idsucursal,$predeterminado,$idemp,'$ip','$host',$idusr,NOW())";

                        $vRet = $this->guardarDatos($query);

                        break;
                    case 1:
                         //$ar = $this->unserialice_force($arg);
                        parse_str($arg);
                        $idusr = $this->getIdUserFromAlias($user);
                        $idemp = $this->getIdEmpFromAlias($user);
                        if ( intval($predeterminado) == 1 ){
                            $q = "UPDATE cat_estados SET predeterminado = 0 WHERE idsucursal = $idsucursal AND predeterminado = 1 AND idemp = $idemp";
                            $r = $this->guardarDatos($q);
                        }
                        $query = "UPDATE cat_estados SET clave = '$clave',
													  	estado = '$estado',
                                                        idsucursal = $idsucursal,    
                                                        predeterminado = $predeterminado,
													  	status_estado = $status_estado,
														ip = '$ip',
														host = '$host',
														modi_por = $idusr,
														modi_el = NOW()
								WHERE idestado = $idestado";

                        $vRet = $this->guardarDatos($query);

                        break;
                    case 2:
                        $query = "DELETE FROM cat_estados WHERE idestado = ".$arg;

                        $vRet = $this->guardarDatos($query);

                        break;
                }
                break;

            case 2:
                switch ($tipo) {
                    case 0:
                        parse_str($arg);
                        $idusr = $this->getIdUserFromAlias($user);
                        $idemp = $this->getIdEmpFromAlias($user);
                        if ( intval($predeterminado) == 1 ){
                            $q = "UPDATE cat_municipios SET predeterminado = 0 WHERE idestado = $idestado AND idsucursal = $idsucursal AND predeterminado = 1 AND idemp = $idemp";
                            $r = $this->guardarDatos($q);                        
                        }
                        $query = "INSERT INTO cat_municipios(idestado,clave,municipio,status_municipio,idsucursal,predeterminado,idemp,ip,host,creado_por,creado_el)
									VALUES( $idestado, '$clave','$municipio',
										    $status_municipio,$idsucursal,$predeterminado,$idemp,'$ip','$host',$idusr,NOW())";

                        $vRet = $this->guardarDatos($query);

                        break;
                    case 1:
                         //$ar = $this->unserialice_force($arg);
                        parse_str($arg);
                        $idusr = $this->getIdUserFromAlias($user);
                        $idemp = $this->getIdEmpFromAlias($user);
                        if ( intval($predeterminado) == 1 ){
                            $q = "UPDATE cat_municipios SET predeterminado = 0 WHERE idestado = $idestado AND idsucursal = $idsucursal AND predeterminado = 1 AND idemp = $idemp";
                            $r = $this->guardarDatos($q);                        
                        }
                        $query = "UPDATE cat_municipios SET idestado = $idestado,
                                                        idsucursal = $idsucursal,
                                                        predeterminado = $predeterminado,
														clave = '$clave',
													  	municipio = '$municipio',
													  	status_municipio = $status_municipio,
														ip = '$ip',
														host = '$host',
														modi_por = $idusr,
														modi_el = NOW()
								WHERE idmunicipio = $idmunicipio";

                        $vRet = $this->guardarDatos($query);

                        break;
                    case 2:
                        $query = "DELETE FROM cat_municipios WHERE idmunicipio = ".$arg;
                        $vRet = $this->guardarDatos($query);
                        break;
                }
                break;

            case 3: // 3
                switch ($tipo) {
                    case 0:
                        parse_str($arg);
                        $idusr = $this->getIdUserFromAlias($user);
                        $idemp = $this->getIdEmpFromAlias($user);
                        $email1 = strtolower($email1);
                        $idempresa = 0;
                        if ( $isaddempresa == 0 ){

                            $rfc = "";
                            $razon_social = "";
                        
                        }else{

                            $is_email = 1;
                            $status_empresa = 1;
                            $query = "INSERT INTO cat_empresas(
                                                                rfc,
                                                                razon_social,
                                                                calle,
                                                                num_ext,
                                                                num_int,
                                                                colonia,
                                                                localidad,
                                                                estado,
                                                                pais,
                                                                cp,
                                                                emails,
                                                                is_email,
                                                                status_empresa,
                                                                idemp,ip,host,creado_por,creado_el)
                                        VALUES(
                                                                '".strtoupper($rfc)."',
                                                                '".strtoupper($razon_social)."',
                                                                '".strtoupper($calle)."',
                                                                '".strtoupper($num_ext)."',
                                                                '".strtoupper($num_int)."',
                                                                '".strtoupper($colonia)."',
                                                                '".strtoupper($localidad)."',
                                                                '".strtoupper($estado)."',
                                                                '".strtoupper($pais)."',
                                                                '".strtoupper($cp)."',
                                                                '".strtolower($email1)."',
                                                                $is_email,
                                                                $status_empresa,
                                                                $idemp,'$ip','$host',$idusr,NOW() )";

                            $idempresa = $this->guardarDatosOrden($query,'idempresa','cat_empresas');

                        }

                        $query = "INSERT INTO cat_personas(
															ap_paterno,
															ap_materno,
															nombre,
															email1,
															tel1,
															cel1,
															genero,
                                                            rfc,
                                                            razon_social,
															calle,
															num_ext,
															num_int,
															colonia,
															localidad,
															pais,
															cp,
                                                            idsucursal,
                                                            isaddempresa,
                                                            idestado,
                                                            idmunicipio,
                                                            idempresa,
															status_persona,
															idemp,ip,host,creado_por,creado_el)
									VALUES(
															'$ap_paterno',
															'$ap_materno',
															'$nombre',
															'$email1',
															'$tel1',
															'$cel1',
															$genero,
															'".mb_strtoupper($rfc, 'UTF-8')."',
                                                            '".mb_strtoupper($razon_social, 'UTF-8')."',
                                                            '".mb_strtoupper($calle, 'UTF-8')."',
															'".mb_strtoupper($num_ext, 'UTF-8')."',
															'".mb_strtoupper($num_int, 'UTF-8')."',
															'".mb_strtoupper($colonia, 'UTF-8')."',
															'".mb_strtoupper($localidad, 'UTF-8')."',
															'".mb_strtoupper($pais, 'UTF-8')."',
															'".mb_strtoupper($cp, 'UTF-8')."',
                                                            $idsucursal,
                                                            $isaddempresa,
                                                            $idestado,
                                                            $idmunicipio,
                                                            $idempresa,
                                                            $status_persona,
															$idemp,'$ip','$host',$idusr,NOW())";

                        $idpersona = $this->guardarDatosOrden($query,"idpersona","cat_personas");
                        $vRet = $this->generarUsuario($idpersona);
                        $vRet = $this->setAsocia(30, "$idpersona.$idempresa", 0, 0, 10, "u=$user");
                        $vRet = "OK";
                        break;

                    case 1:
                         //$ar = $this->unserialice_force($arg);
                        parse_str($arg);
                        $idusr = $this->getIdUserFromAlias($user);
                        $email1 = strtolower($email1);
                        if ( $isaddempresa == 0 ){
                            $rfc = "";
                            $razon_social = "";
                        }else{

                            $query = "UPDATE cat_empresas SET
                                                            rfc = '".strtoupper($rfc)."',
                                                            razon_social = '".strtoupper($razon_social)."',
                                                            calle = '".strtoupper($calle)."',
                                                            num_ext = '".strtoupper($num_ext)."',
                                                            num_int = '".strtoupper($num_int)."',
                                                            colonia = '".strtoupper($colonia)."',
                                                            localidad = '".strtoupper($localidad)."',
                                                            estado = '".strtoupper($estado)."',
                                                            pais = '".strtoupper($pais)."',
                                                            cp = '".strtoupper($cp)."',
                                                            emails = '".strtolower($email1)."',
                                                            ip = '$ip',
                                                            host = '$host',
                                                            modi_por = $idusr,
                                                            modi_el = NOW()
                                    WHERE idempresa = ".$idempresa;
                            $vRet = $this->guardarDatos($query);

                        }

                        $query = "UPDATE cat_personas SET
														ap_paterno = '$ap_paterno',
														ap_materno = '$ap_materno',
														nombre = '$nombre',
														email1 = '$email1',
														tel1 = '$tel1',
														cel1 = '$cel1',
														rfc = '".mb_strtoupper($rfc, 'UTF-8')."',
                                                        razon_social = '".mb_strtoupper($razon_social, 'UTF-8')."',
                                                        calle = '".mb_strtoupper($calle, 'UTF-8')."',
														num_ext = '".mb_strtoupper($num_ext, 'UTF-8')."',
														num_int = '".mb_strtoupper($num_int, 'UTF-8')."',
														colonia = '".mb_strtoupper($colonia, 'UTF-8')."',
														localidad = '".mb_strtoupper($localidad, 'UTF-8')."',
														pais = '".mb_strtoupper($pais, 'UTF-8')."',
														cp = '".mb_strtoupper($cp, 'UTF-8')."',
														genero = $genero,
                                                        isaddempresa = $isaddempresa,
                                                        idsucursal = $idsucursal,
                                                        idestado = $idestado,
                                                        idmunicipio = $idmunicipio,
                                                        idempresa = $idempresa,
												  		status_persona = $status_persona,
														ip = '$ip',
														host = '$host',
														modi_por = $idusr,
														modi_el = NOW()
								WHERE idpersona = $idpersona";

                        $vRet = $this->guardarDatos($query);

                        break;
                    case 2:
                        $query = "DELETE FROM cat_personas WHERE idpersona = ".$arg;
                        $vRet = $this->guardarDatos($query);
                        break;
                } // 3
                break;

            case 4:
                switch ($tipo) {
                    case 0:
                        parse_str($arg);
                        $idusr = $this->getIdUserFromAlias($user);
                        $idemp = $this->getIdEmpFromAlias($user);
                        $is_email = !isset($is_email)?0:1;

                        $status_empresa = !isset($status_empresa)?0:1;
                        $query = "INSERT INTO cat_empresas(
                                                            rfc,
                                                            razon_social,
                                                            calle,
                                                            num_ext,
                                                            num_int,
                                                            colonia,
                                                            localidad,
                                                            estado,
                                                            pais,
                                                            cp,
                                                            emails,
                                                            is_email,
                                                            status_empresa,
                                                            idemp,ip,host,creado_por,creado_el)
                                    VALUES(
                                                            '".strtoupper($rfc)."',
                                                            '".strtoupper($razon_social)."',
                                                            '".strtoupper($calle)."',
                                                            '".strtoupper($num_ext)."',
                                                            '".strtoupper($num_int)."',
                                                            '".strtoupper($colonia)."',
                                                            '".strtoupper($localidad)."',
                                                            '".strtoupper($estado)."',
                                                            '".strtoupper($pais)."',
                                                            '".strtoupper($cp)."',
                                                            '".strtolower($emails)."',
                                                            $is_email,
                                                            $status_empresa,
                                                            $idemp,'$ip','$host',$idusr,NOW() )";
                        $vRet = $this->guardarDatos($query);
                        break;
                    case 1:
                        parse_str($arg);
                        $idusr = $this->getIdUserFromAlias($user);
                        $is_email = !isset($is_email)?0:1;
                        $status_empresa = !isset($status_empresa)?0:1;

                        $query = "UPDATE cat_empresas SET
                                                        rfc = '".strtoupper($rfc)."',
                                                        razon_social = '".strtoupper($razon_social)."',
                                                        calle = '".strtoupper($calle)."',
                                                        num_ext = '".strtoupper($num_ext)."',
                                                        num_int = '".strtoupper($num_int)."',
                                                        colonia = '".strtoupper($colonia)."',
                                                        localidad = '".strtoupper($localidad)."',
                                                        estado = '".strtoupper($estado)."',
                                                        pais = '".strtoupper($pais)."',
                                                        cp = '".strtoupper($cp)."',
                                                        emails = '".strtolower($emails)."',
                                                        is_email = $is_email,
                                                        status_empresa = $status_empresa,
                                                        ip = '$ip',
                                                        host = '$host',
                                                        modi_por = $idusr,
                                                        modi_el = NOW()
                                WHERE idempresa = $idempresa";
                        $vRet = $this->guardarDatos($query);
                        break;
                    case 2:
                        $query = "DELETE FROM cat_empresas WHERE idempresa = ".$arg;
                        $vRet = $this->guardarDatos($query);
                        break;
                }
                break;

            case 5: // 5
                switch ($tipo) {
                    case 0:
                        parse_str($arg);
                        $idusr = $this->getIdUserFromAlias($user);
                        $idemp = $this->getIdEmpFromAlias($user);
                        $marca  = strtoupper($marca);
                        $is_cat = !isset($is_cat)?0:1;
                        $status_marca = !isset($status_marca)?0:1;
                        $query = "INSERT INTO cat_marcas(marca,imagen,is_cat,status_marca,idemp,ip,host,creado_por,creado_el)
									VALUES( '$marca','$imagen',$is_cat,$status_marca,$idemp,'$ip','$host',$idusr,NOW())";

                        $vRet = $this->guardarDatos($query);

                        break;
                    case 1:
                        parse_str($arg);
                        $idusr = $this->getIdUserFromAlias($user);
                        $marca  = strtoupper($marca);
                        $is_cat = !isset($is_cat)?0:1;
                        $status_marca = !isset($status_marca)?0:1;
                                                        // imagen = '$imagen',
                        $query = "UPDATE cat_marcas SET marca = '$marca',
													  	is_cat = $is_cat,
                                                        status_marca = $status_marca,
														ip = '$ip',
														host = '$host',
														modi_por = $idusr,
														modi_el = NOW()
								WHERE idmarca = $idmarca";

                        $vRet = $this->guardarDatos($query);

                        break;
                    case 2:
                        $query = "DELETE FROM cat_marcas WHERE idmarca = ".$arg;
                        $vRet = $this->guardarDatos($query);
                        break;
                    case 3:
                        parse_str($arg);
                        $idusr = $this->getIdUserFromAlias($user);
                        $query = "UPDATE cat_marcas SET imagen = '$imagen',
                                                        ip = '$ip',
                                                        host = '$host',
                                                        modi_por = $idusr,
                                                        modi_el = NOW()
                                WHERE idmarca = $idmarca";

                        $vRet = $this->guardarDatos($query);

                        break;

                }
                break; // 5

            case 6:
                switch ($tipo) {
                    case 0:
                        parse_str($arg);
                        $idusr = $this->getIdUserFromAlias($user);
                        $idemp = $this->getIdEmpFromAlias($user);
                        $visualizar = !isset($visualizar)?0:1;
                        $query = "Insert Into cat_colores(color,codigo_color_hex,visualizar,status_color,
                                                            idemp,ip,host,creado_por,creado_el)
                                    value('$color','$codigo_color_hex',$visualizar,$status_color,
                                            $idemp,'$ip','$host',$idusr,NOW())";
                        $vRet = $this->guardarDatos($query);
                        break;
                    case 1:
                         //$ar = $this->unserialice_force($arg);
                        parse_str($arg);
                        $idusr = $this->getIdUserFromAlias($user);
                        $visualizar = !isset($visualizar)?0:1;
                        $query = "update cat_colores set
                                                        color = '$color',
                                                        codigo_color_hex = '$codigo_color_hex',
                                                        status_color = $status_color,
                                                        visualizar = $visualizar,
                                                        ip = '$ip',
                                                        host = '$host',
                                                        modi_por = $idusr,
                                                        modi_el = NOW()
                                Where idcolor = $idcolor";
                        $vRet = $this->guardarDatos($query);
                        break;
                    case 2:
                        $query = "delete from cat_colores Where idcolor = ".$arg;
                        $vRet = $this->guardarDatos($query);
                        break;
                }
                break; // 6


            case 7:
                switch ($tipo) {
                    case 0:
                        parse_str($arg);
                        $idusr = $this->getIdUserFromAlias($user);
                        $idemp = $this->getIdEmpFromAlias($user);
                        $status_equipo_categoria = !isset($status_equipo_categoria)?0:1;
                        $query = "INSERT INTO cat_equipos_categorias(equipo_categoria,status_equipo_categoria,idemp,ip,host,creado_por,creado_el)
                                    VALUES( '$equipo_categoria',$status_equipo_categoria ,$idemp,'$ip','$host',$idusr,NOW())";

                        $vRet = $this->guardarDatos($query);

                        break;
                    case 1:
                         //$ar = $this->unserialice_force($arg);
                        parse_str($arg);
                        $idusr = $this->getIdUserFromAlias($user);
                        $status_equipo_categoria = !isset($status_equipo_categoria)?0:1;
                        $query = "UPDATE cat_equipos_categorias SET    
                                                        equipo_categoria = '$equipo_categoria',
                                                        status_equipo_categoria = $status_equipo_categoria,
                                                        ip = '$ip',
                                                        host = '$host',
                                                        modi_por = $idusr,
                                                        modi_el = NOW()
                                WHERE idequipocategoria = $idequipocategoria";

                        $vRet = $this->guardarDatos($query);

                        break;
                    case 2:
                        $query = "DELETE FROM cat_equipos_categorias WHERE idequipocategoria = ".$arg;

                        $vRet = $this->guardarDatos($query);

                        break;
                }
                break; // 7

            case 8:
                switch ($tipo) {
                    case 0:
                        parse_str($arg);
                        $idusr = $this->getIdUserFromAlias($user);
                        $idemp = $this->getIdEmpFromAlias($user);
                        $status_precio_categoria = !isset($status_precio_categoria)?0:1;
                        $query = "INSERT INTO cat_precios_categorias(clave,precio_categoria,status_precio_categoria,idemp,ip,host,creado_por,creado_el)
                                    VALUES('$clave', '$precio_categoria',$status_precio_categoria ,$idemp,'$ip','$host',$idusr,NOW())";

                        $vRet = $this->guardarDatos($query);

                        break;
                    case 1:
                         //$ar = $this->unserialice_force($arg);
                        parse_str($arg);
                        $idusr = $this->getIdUserFromAlias($user);
                        $status_precio_categoria = !isset($status_precio_categoria)?0:1;
                        $query = "UPDATE cat_precios_categorias SET    
                                                        clave = '$clave',
                                                        precio_categoria = '$precio_categoria',
                                                        status_precio_categoria = $status_precio_categoria,
                                                        ip = '$ip',
                                                        host = '$host',
                                                        modi_por = $idusr,
                                                        modi_el = NOW()
                                WHERE idpreciocategoria = $idpreciocategoria";

                        $vRet = $this->guardarDatos($query);

                        break;
                    case 2:
                        $query = "DELETE FROM cat_precios_categorias WHERE idpreciocategoria = ".$arg;

                        $vRet = $this->guardarDatos($query);

                        break;
                }
                break; // 8

            case 9:
                switch ($tipo) {
                    case 0:
                        parse_str($arg);
                        $idusr = $this->getIdUserFromAlias($user);
                        $idemp = $this->getIdEmpFromAlias($user);
                        $status_unidad_medida = !isset($status_unidad_medida)?0:1;
                        $query = "INSERT INTO cat_unidades_medidas(clave,unidad_medida,status_unidad_medida,idemp,ip,host,creado_por,creado_el)
                                    VALUES('$clave', '$unidad_medida',$status_unidad_medida ,$idemp,'$ip','$host',$idusr,NOW())";

                        $vRet = $this->guardarDatos($query);

                        break;
                    case 1:
                         //$ar = $this->unserialice_force($arg);
                        parse_str($arg);
                        $idusr = $this->getIdUserFromAlias($user);
                        $status_unidad_medida = !isset($status_unidad_medida)?0:1;
                        $query = "UPDATE cat_unidades_medidas SET    
                                                        clave = '$clave',
                                                        unidad_medida = '$unidad_medida',
                                                        status_unidad_medida = $status_unidad_medida,
                                                        ip = '$ip',
                                                        host = '$host',
                                                        modi_por = $idusr,
                                                        modi_el = NOW()
                                WHERE idunidadmedida = $idunidadmedida";

                        $vRet = $this->guardarDatos($query);

                        break;
                    case 2:
                        $query = "DELETE FROM cat_unidades_medidas WHERE idunidadmedida = ".$arg;

                        $vRet = $this->guardarDatos($query);

                        break;
                }
                break; // 9

            case 10:
                switch ($tipo) {
                    case 0:
                        parse_str($arg);
                        $idusr = $this->getIdUserFromAlias($user);
                        $idemp = $this->getIdEmpFromAlias($user);
                        $status_precio_unitario = !isset($status_precio_unitario)?0:1;
                        $is_iva = !isset($is_iva)?0:1;
                        $query = "INSERT INTO cat_precios(
                                                        codigo,
                                                        concepto,
                                                        idunidadmedida,
                                                        precio_unitario,
                                                        idpreciocategoria,
                                                        tipo,
                                                        is_iva,
                                                        status_precio_unitario,
                                                        idemp,ip,host,creado_por,creado_el)
                                                VALUES(
                                                        '$codigo', 
                                                        '$concepto',
                                                        $idunidadmedida,
                                                        $precio_unitario,
                                                        $idpreciocategoria,
                                                        '$tipo',
                                                        $is_iva,
                                                        $status_precio_unitario,
                                                        $idemp,'$ip','$host',$idusr,NOW())";

                        $vRet = $this->guardarDatos($query);

                        break;
                    case 1:
                         //$ar = $this->unserialice_force($arg);
                        parse_str($arg);
                        $idusr = $this->getIdUserFromAlias($user);
                        $status_precio_unitario = !isset($status_precio_unitario)?0:1;
                        $is_iva = !isset($is_iva)?0:1;
                        $query = "UPDATE cat_precios SET    
                                                        codigo = '$codigo',
                                                        concepto = '$concepto',
                                                        idunidadmedida = $idunidadmedida,
                                                        precio_unitario = $precio_unitario,
                                                        idpreciocategoria = $idpreciocategoria,
                                                        tipo = '$tipo',
                                                        is_iva = $is_iva,
                                                        status_precio_unitario = $status_precio_unitario,
                                                        ip = '$ip',
                                                        host = '$host',
                                                        modi_por = $idusr,
                                                        modi_el = NOW()
                                WHERE idprecio = $idprecio";

                        $vRet = $this->guardarDatos($query);

                        break;
                    case 2:
                        $query = "DELETE FROM cat_precios WHERE idprecio = ".$arg;

                        $vRet = $this->guardarDatos($query);

                        break;
                }
                break; // 10

            case 49: //49
                switch ($tipo) {
                    case 0:
                        parse_str($arg);
                        $idusr = $this->getIdUserFromAlias($u);
                        $idemp = $this->getIdEmpFromAlias($u);
                        $IsConnect = $this->IsExistUserConnect($idusr, $idemp);
                        if (intval($IsConnect) <= 0) {
                            $query = "INSERT INTO usuarios_conectados(
															iduser,
															username,
															isconectado,
															ultima_conexion,
															idemp,
															ip,
															host,
															creado_por,
															creado_el)
													VALUES(
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
                        } else {
                            $IsConnect = $this->IsConnectUser($idusr, $idemp);
                            if (intval($IsConnect) <= 0) {
                                $query = "UPDATE usuarios_conectados SET
																isconectado = 1,
																ultima_conexion = NOW(),
																ip = '$ip',
																host = '$host',
																modi_por = $idusr,
																modi_el = NOW()
										WHERE iduser = $idusr AND idemp = $idemp AND isconectado = 0";

                                $vRet = $this->guardarDatos($query);
                            } else {
                                $vRet = "OK";
                            }
                        }

                        break;

                    case 1:
                        parse_str($arg);

                        $idusr = $this->getIdUserFromAlias($u);
                        $idemp = $this->getIdEmpFromAlias($u);
                        $IsConnect = $this->IsConnectUser($idusr, $idemp);
                        if (intval($IsConnect) > 0) {
                            $query = "UPDATE usuarios_conectados SET
															isconectado = 0,
															ultima_conexion = NOW(),
															ip = '$ip',
															host = '$host',
															modi_por = $idusr,
															modi_el = NOW()
									WHERE iduser = $idusr AND idemp = $idemp AND isconectado = 1";

                            $vRet = $this->guardarDatos($query);
                        } else {
                            $vRet = "OK";
                        }

                        break;
                } //49
                break;

            case 70:
                switch ($tipo) {
                    case 0:
                        parse_str($arg);
                        $idusr = $this->getIdUserFromAlias($user);
                        $idemp = $this->getIdEmpFromAlias($user);
                        $tipox = !isset($tipox)?0:1;
                        $mantto = !isset($mantto)?0:1;
                        $garantia = !isset($garantia)?0:1;
                        $contrato = !isset($contrato)?0:1;
                        $status_master = !isset($status_master)?0:1;
                        $query = "INSERT INTO control_master(
                                                            idempresa,
                                                            idmodulo,
                                                            idcliente,
                                                            idtecnico,
                                                            idrecibio,
                                                            tipo,
                                                            mantto,
                                                            garantia,
                                                            contrato,
                                                            status,
                                                            folmod,
                                                            status_master,
                                                            idemp,ip,host,creado_por,creado_el)
                                    VALUES(
                                                            $idempresa,
                                                            $idmodulo,
                                                            $idcliente,
                                                            $idtecnico,
                                                            $idrecibio,
                                                            $tipox,
                                                            $mantto,
                                                            $garantia,
                                                            $contrato,
                                                            $status,
                                                            '$folmod',
                                                            $status_master,
                                                            $idemp,'$ip','$host',$idusr,NOW() )";
                        $vRet = $this->guardarDatosOrden($query,"idcontrolmaster","control_master");
                        break;
                    case 1:
                        parse_str($arg);
                        $idusr = $this->getIdUserFromAlias($user);
                        $tipox = !isset($tipox)?0:1;
                        $mantto = !isset($mantto)?0:1;
                        $garantia = !isset($garantia)?0:1;
                        $contrato = !isset($contrato)?0:1;
                        $status_master = !isset($status_master)?0:1;

                        $query = "UPDATE control_master SET
                                                            idempresa = $idempresa,
                                                            idmodulo = $idmodulo,
                                                            idcliente = $idcliente,
                                                            idtecnico = $idtecnico,
                                                            idrecibio = $idrecibio,
                                                            garantia = $garantia,
                                                            contrato = $contrato,
                                                            tipo = $tipox,
                                                            mantto = $mantto,
                                                            status = $status,
                                                            folmod = '$folmod',
                                                            status_master = $status_master,
                                                            ip = '$ip',
                                                            host = '$host',
                                                            modi_por = $idusr,
                                                            modi_el = NOW()
                                WHERE idcontrolmaster = $idcontrolmaster";
                        $vRet = $this->guardarDatos($query);
                        break;
                    case 2:
                        $query = "DELETE FROM control_master WHERE idcontrolmaster = ".$arg;
                        $vRet = $this->guardarDatos($query);
                        break;

                    case 3:
                        parse_str($arg);
                        $idusr = $this->getIdUserFromAlias($user);
                        $idemp = $this->getIdEmpFromAlias($user);
                        //$status_detalle = !isset($status_detalle)?0:1;
                        $query = "INSERT INTO control_detalle(
                                                            idcontrolmaster,
                                                            idequipocategoria,
                                                            equipo,
                                                            idmarca,
                                                            marca,
                                                            modelo,
                                                            serie,
                                                            no_parte,
                                                            version,
                                                            submodelo,
                                                            num_pedido,
                                                            status_detalle,
                                                            idemp,ip,host,creado_por,creado_el)
                                    VALUES(
                                                            $idcontrolmaster,
                                                            $idequipocategoria,
                                                            '$equipo',
                                                            $idmarca,
                                                            '$marca',
                                                            '$modelo',
                                                            '$serie',
                                                            '$no_parte',
                                                            '$version',
                                                            '$submodelo',
                                                            '$num_pedido',
                                                            $status_detalle,
                                                            $idemp,'$ip','$host',$idusr,NOW() )";
                        $vRet = $this->guardarDatos($query);
                        break;

                    case 4:
                        parse_str($arg);
                        $idusr = $this->getIdUserFromAlias($user);
                        //$status_detalle = !isset($status_detalle)?0:1;

                        $query = "UPDATE control_detalle SET
                                                            idequipocategoria = $idequipocategoria,
                                                            equipo = '$equipo',
                                                            idmarca = $idmarca,
                                                            marca = '$marca',
                                                            modelo = '$modelo',
                                                            serie = '$serie',
                                                            no_parte = '$no_parte',
                                                            version = '$version',
                                                            submodelo = '$submodelo',
                                                            num_pedido = '$num_pedido',
                                                            status_detalle = $status_detalle,
                                                            ip = '$ip',
                                                            host = '$host',
                                                            modi_por = $idusr,
                                                            modi_el = NOW()
                                WHERE iddetalle = $iddetalle";
                        $vRet = $this->guardarDatos($query);
                        break;
                    
                    case 5:
                        $query = "DELETE FROM control_detalle WHERE iddetalle = ".$arg;
                        $vRet = $this->guardarDatos($query);
                        break;

                    case 6:
                        parse_str($arg);
                        $idusr = $this->getIdUserFromAlias($u);
                        // comment = '$comment',
                        
                        $query = "UPDATE control_master SET
                                                            falla = '$falla',
                                                            accesorios = '$accesorios',
                                                            observaciones = '$observaciones',
                                                            trabajo = '$trabajo',
                                                            ip = '$ip',
                                                            host = '$host',
                                                            modi_por = $idusr,
                                                            modi_el = NOW()
                                WHERE idcontrolmaster = $idcontrolmaster";
                        $vRet = $this->guardarDatos($query);
                        break;
                    
                    case 7:
                        $query = "DELETE FROM control_importe WHERE idimporte = ".$arg;
                        $vRet = $this->guardarDatos($query);
                        break;

                    case 8:
                        parse_str($arg);
                        $idusr = $this->getIdUserFromAlias($user);
                        $idemp = $this->getIdEmpFromAlias($user);
                        $is_iva = !isset($is_iva)?0:1;
                        $status_importe = !isset($status_importe)?0:1;
                        $viaticos = floatval($viaticos);

                        $query = "INSERT INTO control_importe(
                                                            idcontrolmaster,
                                                            cantidad,
                                                            idprecio,
                                                            codigo,
                                                            precio_unitario,
                                                            viaticos,
                                                            observaciones,
                                                            is_iva,
                                                            status_importe,
                                                            idemp,ip,host,creado_por,creado_el)
                                    VALUES(
                                                            $idcontrolmaster,
                                                            $cantidad,
                                                            $idprecio,
                                                            '$codigo',
                                                            $precio_unitario,
                                                            $viaticos,
                                                            '$observaciones',
                                                            $is_iva,
                                                            $status_importe,
                                                            $idemp,'$ip','$host',$idusr,NOW() )";
                        $vRet = $this->guardarDatos($query);
                        break;

                    case 9:
                        parse_str($arg);
                        $idusr = $this->getIdUserFromAlias($user);
                        $is_iva = !isset($is_iva)?0:1;
                        $status_importe = !isset($status_importe)?0:1;

                        $query = "UPDATE control_importe SET
                                                            cantidad        = $cantidad,
                                                            idprecio        = $idprecio,
                                                            codigo          = '$codigo',
                                                            precio_unitario = $precio_unitario,
                                                            viaticos        = $viaticos,
                                                            observaciones   = '$observaciones',
                                                            is_iva          = $is_iva,
                                                            status_importe  = $status_importe,
                                                            ip = '$ip',
                                                            host = '$host',
                                                            modi_por = $idusr,
                                                            modi_el = NOW()
                                WHERE idimporte = $idimporte";
                        $vRet = $this->guardarDatos($query);
                        break;

                    case 10:
                        parse_str($arg);
                        $idusr = $this->getIdUserFromAlias($user);
                        $idemp = $this->getIdEmpFromAlias($user);
                        $query = "INSERT INTO control_comentarios(
                                                            idcontrolmaster,
                                                            iduser,
                                                            comentario,
                                                            fecha,
                                                            idemp,ip,host,creado_por,creado_el)
                                    VALUES(
                                                            $idcontrolmaster,
                                                            $idusr,
                                                            '$comentario',
                                                            NOW(),
                                                            $idemp,'$ip','$host',$idusr,NOW() )";
                        $vRet = $this->guardarDatos($query);
                        break;

                    case 11:
                        parse_str($arg);
                        $idusr = $this->getIdUserFromAlias($user);

                        $query = "UPDATE control_comentarios SET
                                                            comentario = '$comentario',
                                                            fecha = NOW(),
                                                            ip = '$ip',
                                                            host = '$host',
                                                            modi_por = $idusr,
                                                            modi_el = NOW()
                                WHERE idcontrolcomentario = $idcontrolcomentario";
                        $vRet = $this->guardarDatos($query);
                        break;

                    case 12:
                        $query = "DELETE FROM control_comentarios WHERE idcontrolcomentario = ".$arg;
                        $vRet = $this->guardarDatos($query);
                        break;
                    case 13:
                        parse_str($arg);
                        $idusr = $this->getIdUserFromAlias($user);
                        
                        $now = date("Y-m-d H:i:s");

                        $fsalida = substr($fsalida, 0,2)=="00" ? $now : $fsalida;

                        $query = "UPDATE control_master SET
                                                            idclienterecibioentrega = $idclienterecibioentrega,
                                                            idtecnicoentrego = $idtecnicoentrego,
                                                            fsalida = '$fsalida',
                                                            ip = '$ip',
                                                            host = '$host',
                                                            modi_por = $idusr,
                                                            modi_el = NOW()
                                WHERE idcontrolmaster = $idcontrolmaster";
                        $vRet = $this->guardarDatos($query);
                        break;
                    case 14:
                        parse_str($arg);
                        $idusr = $this->getIdUserFromAlias($user);
                        
                        $query = "INSERT INTO control_imagenes(
                                                            idcontrolmaster,
                                                            root,
                                                            imagen,
                                                            descripcion,
                                                            idemp,
                                                            ip,
                                                            host,
                                                            creado_por,
                                                            creado_el
                                                        )values(
                                                            $idcontrolmaster,
                                                            '$root',
                                                            '$imagen',
                                                            '$descripcion',
                                                            $idemp,
                                                            '$ip',
                                                            '$host',
                                                            $idusr,
                                                            NOW()
                                                        )";
                        $vRet = $this->guardarDatos($query);
                        break;
                } // 70
                break;

            case 71:
                switch ($tipo) {
                    case 0:
                        parse_str($arg);
                        $idusr = $this->getIdUserFromAlias($user);
                        $idemp = $this->getIdEmpFromAlias($user);
                        $query = "INSERT INTO cotizacion_encab(
                                                            persona,
                                                            empresa,
                                                            fecha,
                                                            idemp,ip,host,creado_por,creado_el)
                                    VALUES(
                                                            '$persona',
                                                            '$empresa',
                                                            '$fecha',
                                                            $idemp,'$ip','$host',$idusr,NOW() )";
                        $vRet = $this->guardarDatos($query);
                        break;
                    case 1:
                        parse_str($arg);
                        $idusr = $this->getIdUserFromAlias($user);

                        $query = "UPDATE cotizacion_encab SET
                                                            persona = '$persona',
                                                            empresa = '$empresa',
                                                            fecha = '$fecha',
                                                            ip = '$ip',
                                                            host = '$host',
                                                            modi_por = $idusr,
                                                            modi_el = NOW()
                                WHERE idcotizacion = $idcotizacion";
                        $vRet = $this->guardarDatos($query);
                        break;
                    case 2:
                        $query = "DELETE FROM cotizacion_encab WHERE idcotizacion = ".$arg;
                        $vRet = $this->guardarDatos($query);
                        break;

                  } // 71
                  break;

            case 72:
                switch ($tipo) {
                    case 0:
                        parse_str($arg);
                        $idusr = $this->getIdUserFromAlias($user);
                        $idemp = $this->getIdEmpFromAlias($user);
                        $query = "INSERT INTO cotizacion_detalles(
                                                            idcotizacion,
                                                            idmoneda,
                                                            tipo_cambio,
                                                            lote,
                                                            cantidad,
                                                            idunidadmedida,
                                                            descripcion,
                                                            precio_unitario,
                                                            idporcentajeutilidad,
                                                            flete,
                                                            idemp,ip,host,creado_por,creado_el)
                                    VALUES(
                                                            $idcotizacion,
                                                            $idmoneda,
                                                            $tipo_cambio,
                                                            '$lote',
                                                            $cantidad,
                                                            $idunidadmedida,
                                                            '$descripcion',
                                                            $precio_unitario,
                                                            $idporcentajeutilidad,
                                                            $flete,
                                                            $idemp,'$ip','$host',$idusr,NOW() )";
                        $vRet = $this->guardarDatos($query);
                        break;
                    case 1:
                        parse_str($arg);
                        $idusr = $this->getIdUserFromAlias($user);

                        $query = "UPDATE cotizacion_detalles SET
                                                            idcotizacion         = $idcotizacion,
                                                            idmoneda             = $idmoneda,
                                                            tipo_cambio          = $tipo_cambio,
                                                            lote                 = '$lote',
                                                            cantidad             = $cantidad,
                                                            idunidadmedida       = $idunidadmedida,
                                                            descripcion          = '$descripcion',
                                                            precio_unitario      = $precio_unitario,
                                                            idporcentajeutilidad = $idporcentajeutilidad,
                                                            flete                = $flete,
                                                            ip = '$ip',
                                                            host = '$host',
                                                            modi_por = $idusr,
                                                            modi_el = NOW()
                                WHERE idcotizaciondetalle = $idcotizaciondetalle";
                        $vRet = $this->guardarDatos($query);
                        break;
                    case 2:
                        $query = "DELETE FROM cotizacion_detalles WHERE idcotizaciondetalle = ".$arg;
                        $vRet = $this->guardarDatos($query);
                        break;
                    case 3:
                        parse_str($arg);
                        $idusr = $this->getIdUserFromAlias($user);
                        $arrIdCotDets = explode('|', $IdCotDets);
                        foreach ($arrIdCotDets as $i => $value) {
                            $query = "UPDATE cotizacion_detalles 
                                        SET idmoneda = $idmoneda,
                                            tipo_cambio = $tipo_cambio 
                                        WHERE idcotizaciondetalle = $arrIdCotDets[$i]";
                            $vRet = $this->guardarDatos($query);
                        }
                        break;    

                  } // 72
                  break;





        }

        return $vRet;
    }

    // Genera un Username y Password
    public function generarUsuario($iddato=0)
    {
        $Conn = new voConnPDO();
        $query = "SET @X = Generar_Usuario(".$iddato.")";
        $result = $Conn->exec($query);
        if (!$result) {
            $ret=0;
        } else {
            $ret= $result[0]->iduser;
        }
        $Conn = null;
        return $ret;
    }


    public function genAnalisisMarcas(){
        $Conn = new voConnPDO();
        $ret = [];
        $query = "select marca from cat_marcas order by idmarca asc";
        $r = $Conn->queryFetchAllAssocOBJ($query);
        $c = 0;
        foreach ($r as $i => $value) {
            $l1 = $l2 = $l3 = $l4 = $l5 = $l6 = $l7 = $l8 = $l9 = $l10 = $lM = 0;
            $tieneMov = false;
            $q = "select dias_dif_enteros_orden as ddeo from _viConlMasDifFec WHERE trim(marca_det) = '".$r[$i]->marca."' ";
            $r1 = $Conn->queryFetchAllAssocOBJ($q);
            foreach ($r1 as $j => $value) {

                if ( $r1[$j]->ddeo == 1 ) {++$l1; $tieneMov = true;}
                if ( $r1[$j]->ddeo == 2 ) {++$l2; $tieneMov = true;}
                if ( $r1[$j]->ddeo == 3 ) {++$l3; $tieneMov = true;}
                if ( $r1[$j]->ddeo == 4 ) {++$l4; $tieneMov = true;}
                if ( $r1[$j]->ddeo == 5 ) {++$l5; $tieneMov = true;}
                if ( $r1[$j]->ddeo == 6 ) {++$l6; $tieneMov = true;}
                if ( $r1[$j]->ddeo == 7 ) {++$l7; $tieneMov = true;}
                if ( $r1[$j]->ddeo == 8 ) {++$l8; $tieneMov = true;}
                if ( $r1[$j]->ddeo == 9 ) {++$l9; $tieneMov = true;}
                if ( $r1[$j]->ddeo == 10 ) {++$l10; $tieneMov = true;}
                if ( $r1[$j]->ddeo >  10 ) {++$lM; $tieneMov = true;}

            }

            if ($tieneMov){
                $ret[$c] = [
                            'marca' => $r[$i]->marca, 
                            'uno' => $l1!=0?$l1:'',
                            'dos' => $l2!=0?$l2:'',
                            'tres' => $l3!=0?$l3:'',
                            'cuatro' => $l4!=0?$l4:'',
                            'cinco' => $l5!=0?$l5:'',
                            'seis' => $l6!=0?$l6:'',
                            'siete' => $l7!=0?$l7:'',
                            'ocho' => $l8!=0?$l8:'',
                            'nueve' => $l9!=0?$l9:'',
                            'diez' => $l10!=0?$l10:'',
                            'masdiez' => $lM!=0?$lM:'',
                            ];
                ++$c;                            
            } 
        }
        $Conn = null;
        return $ret;

    }


}
