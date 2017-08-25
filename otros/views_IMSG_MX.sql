
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
	On u.idusernivelacceso = un.idusernivelacceso and u.idemp = un.idemp;


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
	concat(per.ap_paterno, ' ', per.ap_materno, ' ', per.nombre) as nombre_persona,
	per.tel1,
	per.tel2,
	per.cel1,
	per.cel2,
	per.email1,
	per.email2,
	per.curp,
	per.rfc,
	per.lugar_nacimiento,
	per.fecha_nacimiento,
	DATE_FORMAT(per.fecha_nacimiento, '%d-%m-%Y') as cfecha_nacimiento,
	per.genero,
	per.ocupacion,
	per.status_persona,
	per.domicilio_generico,
	per.calle,
	per.num_ext,
	per.num_int,
	per.colonia,
	per.localidad,
	per.estado,
	per.municipio,
	per.pais,
	per.cp,
	per.lugar_trabajo,
	per.idemp,
	per.idusuario,
	u.username
from cat_personas per
Left Join usuarios u
	On per.idusuario = u.iduser and per.idemp = u.idemp;



Create or Replace View _viMunicipios As
select m.idmunicipio, m.idestado, e.clave as clave_estado,e.estado, m.clave, m.municipio, m.status_municipio, m.idemp
from cat_municipios m
Left Join cat_estados e
	on m.idestado = e.idestado and m.idemp = e.idemp;


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


Create or Replace View _viSolMatEnc As
Select
	sa.idsolicitanteautorizante,
	sa.idautoriza,
	sa.idsolicita,
	ssme.idsolicituddematerial,
	ssme.fecha_solicitud,
	ssme.fecha_autorizacion,
	ssme.fecha_entrega,
	concat(u.apellidos,' ',u.nombres) as solicitante,
	ssme.observaciones,
	ssme.status_solicitud_de_material,
	case ssme.status_solicitud_de_material
	WHEN 0 then 'Sin Surtir'
	WHEN 1 then 'Autorizado'
	WHEN 2 then 'Surtido'
	WHEN 3 then 'Entregado'
	End as cEstatus,
	ssme.idemp
From solicitantes_vs_autorizantes sa
Left Join solicitudes_de_material ssme
	On sa.idsolicita = ssme.idsolicita and sa.idemp = ssme.idemp
Left Join _viUsuarios u
	On ssme.idsolicita = u.iduser and sa.idemp = u.idemp


Create or Replace View _viSolMatDet As
Select
	ssmd.idsolicituddematerialdetalle,
	ssmd.idsolicituddematerial,
	prod.idproveedor,
	prod.proveedor,
	ssmd.idproducto,
	prod.producto,
	trim(prod.medida1) as medida1,
	ssmd.idsolicita,
	concat(sol.apellidos,' ',sol.nombres) as solicitante,
	ssmd.idautoriza,
	concat(aut.apellidos,' ',aut.nombres) as autorizante,
	ssmd.identrega,
	concat(ent.apellidos,' ',ent.nombres) as entregante,
	ssmd.cantidad_solicitada,
	ssmd.costo_unitario,
	ssmd.importe_solicitado,
	ssmd.cantidad_autorizada,
	ssmd.importe_autorizado,
	ssmd.cantidad_entregado,
	ssmd.importe_entregado,
	ssmd.idcolor,
	col.color,
	col.codigo_color_hex,
	ssmd.fecha_solicitud,
	ssmd.fecha_autorizacion,
	ssmd.fecha_entrega,
	ssmd.observaciones_solicitud,
	ssmd.observaciones_autorizacion,
	ssmd.observaciones_entrega,
	ssmd.status_solicitud_de_materiales,
	ssme.status_solicitud_de_material,
	ssmd.idemp
From solicitudes_de_material_detalles ssmd
Left Join solicitudes_de_material ssme
	On ssmd.idsolicituddematerial = ssme.idsolicituddematerial and ssmd.idemp = ssme.idemp
Left Join _viProductos prod
	On ssmd.idproducto = prod.idproducto and ssmd.idemp = prod.idemp
Left Join _viUsuarios sol
	On ssmd.idsolicita = sol.iduser and ssmd.idemp = sol.idemp
Left Join _viUsuarios aut
	On ssmd.idautoriza = aut.iduser and ssmd.idemp = aut.idemp
Left Join _viUsuarios ent
	On ssmd.identrega = ent.iduser and ssmd.idemp = ent.idemp
Left Join cat_colores col
	On ssmd.idcolor = col.idcolor and ssmd.idemp = col.idemp

Create or Replace View _viSupervisorSolMat As
Select
	supsm.idsupervisorsolmat,
	supsm.idusersupervisorsolmat,
	concat(u.apellidos,' ',u.nombres) as autorizan,
	supsm.status_supervisor_sol_mat,
	supsm.idemp
From cat_supervisores_sol_mat supsm
lEFT jOIN _viUsuarios u
	On supsm.idusersupervisorsolmat = u.iduser and supsm.idemp = u.idemp



Create or Replace View _viSupervisorEntrega As
Select
	supe.idsupervisorentrega,
	supe.idusersupervisorentrega,
	concat(u.apellidos,' ',u.nombres) as entregan,
	supe.status_supervisor_entrega,
	supe.idemp
From cat_supervisores_entrega supe
lEFT jOIN _viUsuarios u
	On supe.idusersupervisorentrega = u.iduser and supe.idemp = u.idemp



Create or Replace View _viSolAut As
select
	solaut.idsolicitanteautorizante,
	solaut.idautoriza,
	concat(u0.apellidos,' ',u0.nombres) as autorizan,
	solaut.idsolicita,
	concat(u1.apellidos,' ',u1.nombres) as solicitan,
	solaut.status_solicita_autoriza,
	solaut.idemp
from solicitantes_vs_autorizantes solaut
Left Join _viUsuarios u0
	on solaut.idautoriza = u0.iduser and solaut.idemp = u0.idemp
Left Join _viUsuarios u1
	on solaut.idsolicita = u1.iduser and solaut.idemp = u1.idemp

Create or Replace View _viComMensajes As
Select
	msj.idcommensaje,
	msj.iduserpropietario,
	concat(userprop.apellidos,' ',userprop.nombres) as nombre_propietario,
	userprop.foto,
	userprop.nivel_de_acceso,
	msj.titulo_mensaje,
	msj.mensaje,
	msj.fecha,
	DATE_FORMAT(msj.fecha, '%d-%m-%Y') as cfecha,
	msj.lecturas,
	msj.respuestas,
	msj.lecturas_nuevas,
	msj.respuestas_nuevas,
	msj.archivos,
	msj.destinatarios,
	msj.status_mensaje,
	msj.idciclo,
	msj.idemp
From com_mensajes msj
Left Join _viUsuarios userprop
	On msj.iduserpropietario = userprop.iduser and msj.idemp = userprop.idemp



Create or Replace View _viComMensajeDestinatarios As
Select
	gd.idcommensajedestinatario,
	gd.idcomgrupo,
	msj.titulo_mensaje,
	msj.fecha,
	msj.lecturas,
	msj.respuestas,
	gpo.grupo,
	gd.idcommensaje,
	gd.isleida,
	gd.fecha_leida,
	gd.isrespuesta,
	gd.fecha_respuesta,
	gd.iteracciones,
	gd.archivos,
	gd.status_mensaje_destinatario,
	gd.idremitente,
	concat(rem.apellidos,' ',rem.nombres) as nombre_remitente,
	rem.foto as foto_remitente,
	rem.nivel_de_acceso as nivel_de_acceso_remitente,
	gd.iddestinatario,
	concat(dest.apellidos,' ',dest.nombres) as nombre_destinatario,
	dest.foto as foto_destinatario,
	dest.nivel_de_acceso as nivel_de_acceso_destinatario,
	msj.status_mensaje,
	gd.idemp
From com_mensaje_dest gd
Left Join com_grupos gpo
	On gd.idcomgrupo = gpo.idcomgrupo and gd.idemp = gpo.idemp
Left Join com_mensajes msj
	On gd.idcommensaje = msj.idcommensaje and gd.idemp = msj.idemp
Left Join _viUsuarios rem
	On gd.idremitente = rem.iduser and gd.idemp = rem.idemp
Left Join _viUsuarios dest
	On gd.iddestinatario = dest.iduser and gd.idemp = dest.idemp



Create or Replace View _viComGpoUser As
Select
	aug.idcomuserasocgpo,
	aug.idcomgrupo,
	g.grupo,
	aug.iduser,
	concat(u.apellidos,' ',u.nombres) as usuario,
	aug.status_com_usuario_asoc_grupo,
	aug.idemp
From com_usuarios_asoc_grupos aug
Left Join com_grupos g
	On aug.idcomgrupo = g.idcomgrupo and aug.idemp = g.idemp
Left Join _viUsuarios u
	On aug.iduser = u.iduser and aug.idemp = u.idemp



Create or Replace View _viComMenDestResp As
Select
	mr.idcommensajedestinatariorespuesta,
	mr.idcommensajedestinatario,
	mr.respuesta,
	mr.fecha_respuesta,
	mr.idparent,
	dest.username as username_destinatario,
	dest.apellidos as apellidos_destinatario,
	dest.nombres as nombres_destinatario,
	dest.foto as foto_destinatario,
	dest.nivel_de_acceso,
	mr.status_mensaje_destinatario_respuesta,
	mr.idemp
From com_mensaje_dest_respuestas mr
Left Join _viUsuarios dest
	On mr.idparent = dest.iduser and mr.idemp = dest.idemp


Create or Replace View _viPDFs as
Select
	btns.idpdf,
	btns.idnivel,
	CASE WHEN btns.idnivel = 0 THEN 'TODOS' ELSE cn.nivel END AS nivel,
	btns.pdf,
	btns.ruta,
	btns.fecha,
	btns.categoria_pdf,
	btns.status_pdf,
	btns.idciclo,
	cc.ciclo,
	btns.idemp
	From cat_pdfs btns
Left Join cat_niveles cn
	On btns.idnivel = cn.idnivel and btns.idemp = cn.idemp
Left Join cat_ciclos cc
	On btns.idciclo = cc.idciclo and btns.idemp = cc.idemp
