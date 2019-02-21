Create or Replace View  _viUsuarios As
select u.iduser,
		u.username,
		u.password,
		u.apellidos,
		u.nombres,
		concat(apellidos,' ',nombres) as nombre_completo_usuario,
		u.foto,
		u.username as user,
		u.registro,
		u.especialidad,
		u.domicilio,
		u.colonia,
		u.idmunicipio,
		u.idestado,
		u.teloficina,
		u.telpersonal,
		u.telfax,
		u.correoelectronico,
		edo.estado,
		mun.municipio,
		u.idemp,
		e.rs as empresa,
		e.logo as logoempresa,
		u.idusernivelacceso,
		un.nivel_de_acceso,
		CASE WHEN un.clave IS NOT NULL THEN un.clave ELSE 0 END AS clave,
		u.idsucursal,
		suc.sucursal,
		u.status_usuario,
		u.token,
		u.token_source,
		u.token_validated,
		u.registrosporpagina,
		u.param1
from usuarios u
Left Join empresa e
	On u.idemp = e.idemp
Left Join cat_estados edo
	On u.idestado = edo.idestado and u.idemp = edo.idemp
Left Join cat_municipios mun
	On u.idmunicipio = mun.idmunicipio and u.idemp = mun.idemp
Left Join usuarios_niveldeacceso un
	On u.idusernivelacceso = un.idusernivelacceso and u.idemp = un.idemp
Left Join cat_sucursales suc
	On u.idsucursal = suc.idsucursal;


Create or Replace View _viUsuariosConectados as
Select
	uc.iduser as iduser2,
	uc.isconectado,
	uc.ultima_conexion,
	u.*
from usuarios_conectados uc
Left Join _viUsuarios u
	On uc.iduser = u.iduser and uc.idemp = u.idemp;


Create or Replace View _viPersonas As
select
	per.idpersona,
	per.ap_paterno,
	per.ap_materno,
	per.nombre,
	concat(UCASE(TRIM(per.nombre)), ' ',UCASE(TRIM(per.ap_paterno)), ' ',UCASE(TRIM(per.ap_materno)) ) as nombre_persona,
	per.tel1,
	concat(TRIM(per.tel1)) as tels_contacto,
	per.cel1,
	concat(TRIM(per.cel1)) as cels_contacto,
	per.email1,
	concat(TRIM(per.email1)) as emails_contacto,
	per.rfc,
	per.razon_social,
	per.genero,
	per.calle,
	per.num_ext,
	per.num_int,
	per.colonia,
	per.localidad,
	per.idestado,
	edo.estado,
	per.idmunicipio,
	mun.municipio,
	per.pais,
	per.cp,
	concat(TRIM(per.calle), ' ', TRIM(per.num_ext), ' ',TRIM(per.num_int), ', ',TRIM(per.colonia), ', ',TRIM(per.localidad), ', ',TRIM(mun.municipio) ) as direccion,
	per.status_persona,
	per.idemp,
	per.idusuario,	
	e.rs as empresa,
	u.iduser,
	u.username,
	u.password,
	u.registrosporpagina,
	u.param1,
	concat(u.apellidos,' ',u.nombres) as nombre_completo_usuario,
	u.status_usuario,
	CASE WHEN nau.clave IS NOT NULL THEN nau.clave ELSE 0 END AS clave,
    nau.idusernivelacceso,
    per.isaddempresa,
    per.idempresa,
	emp.rfc as rfc_emp,
	emp.razon_social as razon_social_emp,
	emp.calle as calle_emp,
	emp.num_ext as num_ext_emp,
	emp.num_int as num_int_emp,
	emp.colonia as colonia_emp,
	emp.localidad as localidad_emp,
	emp.estado as estado_emp,
	emp.ciudad as municipio_emp,
	emp.pais as pais_emp,
	emp.cp as cp_emp,
	emp.emails as emails_emp,
    per.idsucursal,
    s.sucursal
from cat_personas per
Left Join usuarios u
	On per.idusuario = u.iduser and per.idemp = u.idemp
	Left Join empresa e
		On u.idemp = e.idemp	
    Left Join usuarios_niveldeacceso nau
    	On u.idusernivelacceso = nau.idusernivelacceso and u.idemp = nau.idemp
Left Join cat_sucursales s
	On per.idsucursal = s.idsucursal and per.idemp = s.idemp 	
Left Join cat_estados edo
	On per.idestado = edo.idestado and per.idemp = edo.idemp 	
Left Join cat_municipios mun
	On per.idmunicipio = mun.idmunicipio and per.idemp = edo.idemp	
Left Join cat_empresas emp
	On per.idempresa = emp.idempresa and per.idemp = emp.idemp; 	

Create or Replace View _viEstados As
select e.idestado, e.idsucursal, s.sucursal, e.estado, e.predeterminado, e.status_estado, e.idemp
from cat_estados e
Left Join cat_sucursales s
	on e.idsucursal = s.idsucursal and e.idemp = s.idemp;

Create or Replace View _viMunicipios As
select m.idmunicipio, m.idsucursal, s.sucursal, m.idestado, e.clave as clave_estado,e.estado, m.clave, m.municipio, m.predeterminado, m.status_municipio, m.idemp
from cat_municipios m
Left Join cat_estados e
	on m.idestado = e.idestado and m.idemp = e.idemp
Left Join cat_sucursales s
	on m.idsucursal = s.idsucursal and m.idemp = s.idemp;

Create or Replace View _viEmpresas As
select
    e.idempresa,
	e.rfc,
	e.razon_social,
	e.calle,
	e.num_ext,
	e.num_int,
	e.colonia,
	e.localidad,
	e.estado,
	e.pais,
	e.cp,
	e.emails,
	e.is_email,
	e.status_empresa,
	e.idemp
From cat_empresas e;


Create or Replace View _viEmiFis As
select ef.idemisorfiscal,
	ef.rfc,
	ef.razon_social,
	ef.calle,
	ef.num_ext,
	ef.num_int,
	ef.colonia,
	ef.localidad,
	ef.estado,
	ef.pais,
	ef.cp,
	ef.serie,
	ef.status_emisor_fiscal,
	ef.tipo_comprobante,
	CASE WHEN ef.tipo_comprobante = 0 THEN 'FACTURA' ELSE 'RECIBO' END as ctipo_comprobante,
	ef.is_iva,
	ef.idemp
From cat_emisores_fiscales ef


Create or Replace View _viProductos As
Select prod.idproducto,
	prod.idproveedor,
	prov.proveedor,
	prov.contacto,
	prov.tel1,
	prov.email1,
	prod.idmedida,
	med.medida1,
	prod.idcolor,
	col.color,
	col.codigo_color_hex,
	prod.producto,
	prod.costo_unitario,
	prod.iscolor,
	prod.status_producto,
	prod.idemp
From cat_productos prod
Left Join cat_medidas med
	On prod.idmedida = med.idmedida and prod.idemp = med.idemp
Left Join cat_colores col
	On prod.idcolor = col.idcolor and prod.idemp = col.idemp
Left Join cat_proveedores prov
	On prod.idproveedor = prov.idproveedor and prod.idemp = prov.idemp


CREATE OR REPLACE VIEW _viEmpresaRepteLegal AS
SELECT
    rem.idempresarepresentantelegal,
    rem.idrepresentantelegal,
    rem.idempresa,
    per.nombre_persona as reptte_legal,
    per.tels_contacto,
    per.cels_contacto,
    per.emails_contacto,
    per.direccion,
    emp.razon_social as empresa,
    emp.emails as emails_empresa,
    rem.status_empresa_reptte_legal,
    rem.idemp
FROM empresas_reptte_legal rem
LEFT JOIN _viPersonas per
    ON rem.idrepresentantelegal = per.idpersona AND rem.idemp = per.idemp
LEFT JOIN _viEmpresas emp
    ON rem.idempresa = emp.idempresa AND rem.idemp = emp.idemp


CREATE OR REPLACE VIEW _viEmpresaTecnico AS
SELECT
    ete.idempresatecnico,
    ete.idtecnico,
    ete.idempresa,
    emp.razon_social as empresa,
    per.nombre_persona as tecnico,
    ete.status_empresa_tecnico,
    ete.idemp
FROM empresas_tecnicos ete
LEFT JOIN _viPersonas per
    ON ete.idtecnico = per.idpersona AND ete.idemp = per.idemp
LEFT JOIN _viEmpresas emp
    ON ete.idempresa = emp.idempresa AND ete.idemp = emp.idemp


CREATE OR REPLACE VIEW _viControlDetalleUnico AS
SELECT
dti.idcontrolmaster, 
dti.idequipocategoria, 
dti.equipo, 
dti.idmarca, 
dti.marca, 
dti.modelo, 
dti.serie, 
dti.no_parte, 
dti.version, 
dti.submodelo, 
dti.num_pedido, 
dti.contar, 
dti.status_detalle,
dti.idemp
From control_detalle as dti
group by dti.idcontrolmaster
Order by idcontrolmaster asc 


CREATE OR REPLACE VIEW _viControlMaster AS
SELECT
	ord.idcontrolmaster, 
	ord.idempresa,
	ord.idsucursal,
	ord.idmodulo, 
	mar.marca,
	ord.idcliente, 
	cli.reptte_legal,
	cli.empresa,
	cli.tels_contacto,
	cli.cels_contacto,
	cli.emails_contacto,
	cli.direccion,
	ord.idtecnico,
	tec.tecnico, 
	ord.idrecibio, 
	per.nombre_persona, 
	ord.responsable, 
	ord.garantia, 
	ord.contrato, 
	ord.tipo, 
	ord.mantto, 
	ord.fentrada, 
	ord.hora, 
	ord.fsalida, 
	ord.folgen, 
	ord.folmod, 
	ord.cargo, 
	ord.status, 
	col.descripcion,
	col.codigo_color_hex,
	ord.no_venta, 
	ord.no_factura, 
	ord.falla, 
	ord.accesorios, 
	ord.observaciones, 
	ord.trabajo, 
	ord.comment, 
	ord.idclienterecibioentrega,
	per1.nombre_persona as cliente_que_recibio,
	ord.idtecnicoentrego,
	per2.nombre_persona as tecnico_que_entrego,
	dtu.equipo,
	dtu.marca  as marca_det,
	dtu.modelo,
	dtu.serie,
	ord.status_master, 
	suc.sucursal,
	ord.idemp,
	ord.creado_el,
	ord.modi_el
FROM control_master ord 
LEFT JOIN cat_marcas mar 
	ON ord.idmodulo = mar.idmarca AND ord.idemp = mar.idemp 
LEFT JOIN _viEmpresaRepteLegal cli 
	ON ord.idcliente = cli.idrepresentantelegal AND ord.idempresa = cli.idempresa AND ord.idemp = cli.idemp 
LEFT JOIN _viEmpresaTecnico tec 
	ON ord.idtecnico = tec.idtecnico AND ord.idempresa = tec.idempresa AND ord.idemp = tec.idemp 
LEFT JOIN _viPersonas per 
	ON ord.idrecibio = per.idpersona AND ord.idemp = per.idemp 
LEFT JOIN cat_colores col 
	ON ord.status = col.idcolor AND ord.idemp = col.idemp 
LEFT JOIN _viPersonas per1 
	ON ord.idclienterecibioentrega = per1.idpersona AND ord.idemp = per1.idemp 
LEFT JOIN _viPersonas per2 
	ON ord.idtecnicoentrego = per2.idpersona AND ord.idemp = per2.idemp 
LEFT JOIN _viControlDetalleUnico dtu 
	ON ord.idcontrolmaster = dtu.idcontrolmaster AND ord.idemp = dtu.idemp 
LEFT JOIN cat_sucursales suc 
	ON ord.idsucursal = suc.idsucursal AND ord.idemp = suc.idemp; 


CREATE OR REPLACE VIEW _viPrecios AS
SELECT
	pre.idprecio, 
	pre.codigo, 
	pre.concepto, 
	pre.idunidadmedida,
	med.clave AS clave_unidad,
	med.unidad_medida, 
	pre.precio_unitario, 
	pre.idpreciocategoria,
	cat.clave AS clave_categoria,
	cat.precio_categoria, 
	pre.tipo, 
	pre.status_precio_unitario, 
	pre.idemp 
FROM cat_precios pre 
LEFT JOIN cat_unidades_medidas med 
	 ON pre.idunidadmedida = med.idunidadmedida AND pre.idemp = med.idemp 
LEFT JOIN cat_precios_categorias cat 
	 ON pre.idpreciocategoria = cat.idpreciocategoria AND pre.idemp = cat.idemp 


CREATE OR REPLACE VIEW _viControlImporte AS
SELECT
cim.idimporte, 
cim.idcontrolmaster, 
cim.cantidad, 
cim.idprecio, 
cim.codigo, 
cim.precio_unitario, 
cim.importe, 
cim.observaciones,
pre.clave_unidad,
pre.unidad_medida,
pre.clave_categoria,
pre.precio_categoria,
cim.status_importe
FROM control_importe cim 
LEFT JOIN _viPrecios pre 
	ON cim.idprecio = pre.idprecio AND cim.idemp = pre.idemp 


CREATE OR REPLACE VIEW _viControlComentarios AS
SELECT
	cco.idcontrolcomentario, 
	cco.idcontrolmaster, 
	cco.iduser, 
	per.nombre_persona,
	per.username,
	cco.comentario, 
	cco.fecha, 
	cco.idemp 
FROM control_comentarios cco 
LEFT JOIN _viPersonas per 
	ON cco.iduser = per.idusuario AND cco.idemp = per.idemp 

-- LEFT JOIN _viControlMaster cma 
-- 	ON cco.idcontrolmaster = cma.idcontrolmaster AND cco.idemp = cma.idemp 


CREATE OR REPLACE VIEW _viConlMasDifFec AS
SELECT
	ord.idcontrolmaster, 
	ord.idempresa,
	ord.idmodulo, 
	mar.marca,
	ord.idcliente, 
	cli.reptte_legal,
	cli.empresa,
	ord.idtecnico,
	tec.tecnico, 
	ord.idrecibio, 
	per.nombre_persona, 
	ord.responsable, 
	ord.garantia, 
	ord.contrato, 
	ord.tipo, 
	ord.mantto, 
	ord.fentrada, 
	ord.hora, 
	ord.fsalida, 
	ord.folgen, 
	ord.folmod, 
	ord.status, 
	col.descripcion,
	col.codigo_color_hex,
	ord.no_venta, 
	ord.no_factura, 
	ord.falla, 
	ord.accesorios, 
	ord.observaciones, 
	ord.trabajo, 
	ord.comment, 
	ord.idclienterecibioentrega,
	per1.nombre_persona as cliente_que_recibio,
	ord.idtecnicoentrego,
	per2.nombre_persona as tecnico_que_entrego,
	ord.status_master,
	ord.status_anterior,
	ord.status_actual,
	ord.fecha_change_status,
	DATEDIFF(NOW(), ord.fecha_change_status) as dias_dif_enteros, 
	TIMESTAMPDIFF(DAY, ord.fecha_change_status, NOW()) as dias_dif_exactos, 
	DATEDIFF(NOW(), ord.fentrada) as dias_dif_enteros_orden, 
	dtu.marca  as marca_det,
	dtu.modelo,
	dtu.serie,
	ord.idemp,
	ord.creado_el,
	ord.modi_el
FROM control_master ord 
LEFT JOIN cat_marcas mar 
	ON ord.idmodulo = mar.idmarca AND ord.idemp = mar.idemp 
LEFT JOIN _viEmpresaRepteLegal cli 
	ON ord.idcliente = cli.idrepresentantelegal AND ord.idempresa = cli.idempresa AND ord.idemp = cli.idemp 
LEFT JOIN _viEmpresaTecnico tec 
	ON ord.idtecnico = tec.idtecnico AND ord.idempresa = tec.idempresa AND ord.idemp = tec.idemp 
LEFT JOIN _viPersonas per 
	ON ord.idrecibio = per.idpersona AND ord.idemp = per.idemp 
LEFT JOIN cat_colores col 
	ON ord.status = col.idcolor AND ord.idemp = col.idemp AND col.status_color = 1  
LEFT JOIN _viPersonas per1 
	ON ord.idclienterecibioentrega = per1.idpersona AND ord.idemp = per1.idemp 
LEFT JOIN _viPersonas per2 
	ON ord.idtecnicoentrego = per2.idpersona AND ord.idemp = per2.idemp 
LEFT JOIN _viControlDetalleUnico dtu 
	ON ord.idcontrolmaster = dtu.idcontrolmaster AND ord.idemp = dtu.idemp 




CREATE OR REPLACE VIEW _viCotizacion_Encab AS
SELECT
ce.idcotizacion, 
ce.fecha, 
ce.idpersona, 
per.nombre_persona,
ce.idempresa, 
cli.empresa,
ce.reglas, 
ce.observaciones, 
ce.subtotal,
ce.iva,
ce.total,
ce.status_cotizacion, 
ce.idemp 
FROM cotizacion_encab ce 
LEFT JOIN _viPersonas per 
	ON ce.idpersona = per.idpersona AND ce.idemp = per.idemp 
LEFT JOIN _viEmpresaRepteLegal cli 
	ON ce.idempresa = cli.idrepresentantelegal AND ce.idemp = cli.idemp 


CREATE OR REPLACE VIEW _viCotizacion_Detalle AS
SELECT
cd.idcotizaciondetalle, 
cd.idcotizacion, 
cd.lote, 
mon.idmoneda,
mon.tipo_cambio,
cd.cantidad, 
cd.idunidadmedida, 
md.clave,
md.unidad_medida,
cd.descripcion, 
cd.precio_unitario, 
cd.idporcentajeutilidad,
pu.descripcion as porcentaje_utilidad,
pu.porcentaje_inverso,
pu.predeterminado, 
cd.flete, 
cd.precio_venta, 
cd.importe, 
cd.status_cotizacion_detalle, 
cd.idemp 
FROM cotizacion_detalles cd
LEFT JOIN cat_moneda mon
	ON cd.idmoneda = mon.idmoneda
LEFT JOIN cat_unidades_medidas md
	ON cd.idunidadmedida = md.idunidadmedida
LEFT JOIN cat_porcentaje_utilidad pu 
	ON cd.idporcentajeutilidad = pu.idporcentajeutilidad 
