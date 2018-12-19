<?php

include("includes/metas.php");

require_once("../oFunctions.php");
$F = oFunctions::getInstance();

require_once("../oCentura.php");
$f = oCentura::getInstance();

$user = $_POST['user'];
$idpersona  = $_POST['idpersona'];

?>
<div class="row-fluid">
<div class="span12" style="padding-left: 1em; padding-right: 1em;">
<div class="tabbable">

	<h3 class="header smaller lighter blue" id="title"></h3>
	<form id="frmData" role="form">

		<ul class="nav nav-tabs" id="myTab">

			<li class="active">
				<a data-toggle="tab" href="#general">
					<i class="red icon-home bigger-110"></i>
					Generales
				</a>
			</li>

			<li >
				<a data-toggle="tab" href="#especificos">
					<i class="blue icon-cog bigger-110"></i>
					Específicos
				</a>
			</li>

			<li >
				<a data-toggle="tab" href="#domicilio">
					<i class="green fa fa-envelope bigger-110"></i>
					Domicilio
				</a>
			</li>

		</ul>

		<div class="tab-content">

			<div id="general" class="tab-pane active">
				<table>
					<?php if ( $idpersona>0 ) { ?>
					<tr>
						<td class="col-sm-2"><label for="username" class="control-label textRight">Username</label></td>
						<td class="col-sm-10">
					    	<input type="text" class="col-sm-10 altoMoz" id="username" name="username" disabled >
						    <button class="btn btn-link col-sm-2" id="btnGenPerUser">Generar</button>
						</td>
					</tr>
					<?php } ?>
	
					<tr>
						<td class="col-sm-2"><label for="nombre" class="control-label">Nombre</label></td>
						<td class="col-sm-10">
	                        <span class="add-on"><i class="icon-asterisk red"></i></span>
					    	<input type="text" class="wd90prc altoMoz" id="nombre" name="nombre" required >
						</td>
					</tr>
	
					<tr>						
						<td class="col-sm-2"><label for="ap_paterno" class="control-label">Ap. Paterno</label></td>
						<td class="col-sm-10">
	                        <span class="add-on"><i class="icon-asterisk red"></i></span>
					    	<input type="text" class="wd90prc altoMoz" id="ap_paterno" name="ap_paterno" required >							
						</td>
					</tr>
	
					<tr>
						<td class="col-sm-2"><label for="ap_materno" class="control-label">Ap. Materno</label></td>
						<td class="col-sm-10">
	                        <span class="add-on"><i class="icon-asterisk red"></i></span>
					    	<input type="text" class="wd90prc altoMoz" id="ap_materno" name="ap_materno" required >
						</td>
					</tr>

					<tr>
						<td class="col-sm-2"><label for="email1" class="control-label">E-Mails</label></td>
						<td class="col-sm-10">
	                        <span class="add-on"><i class="icon-asterisk red"></i></span>
					    	<input type="text" class="wd90prc altoMoz" id="email1" name="email1" required >
						</td>
					</tr>

					<tr>
						<td class="col-sm-2"><label for="status_persona" class="control-label">Status</label></td>
						<td class="col-sm-3">
	                        <span class="add-on"><i class="icon-ok white"></i></span>
							<select class="altoMoz" name="status_persona" id="status_persona" size="1">
								<option value="0">Inactivo</option>
								<option value="1" selected >Activo</option>
							</select>							
						</td>
					</tr>

				</table>

			</div>

			<div id="especificos" class="tab-pane">
                <table>
                    <tr>
                        <td><label for="tel1" class="textRight">Teléfono</label></td>
                        <td>
	                        <span class="add-on"><i class="icon-asterisk red"></i></span>
							<input class=" altoMoz" id="tel1" name="tel1" type="text" required >
						</td>
                        <td><label for="cel1" class="textRight">Celular</label></td>
                        <td>
	                        <span class="add-on"><i class="icon-asterisk red"></i></span>
							<input class=" altoMoz" id="cel1" name="cel1" type="text" required >
						</td>
					</tr>				
                    <tr>
                        <td><label for="genero" class="textRight">Género</label></td>
                        <td>
	                        <span class="add-on"><i class="icon-ok white"></i></span>
							<select class="altoMoz " name="genero" id="genero" size="1">
								<option value="0">Mujer</option>
								<option value="1">Hombre</option>
							</select>
						</td>
                        <td><label for="isaddempresa" class="textRight marginLeft2em">Agregar a Empresa</label></td>
                        <td>
	                        <span class="add-on"><i class="icon-ok white"></i></span>
							<select class="altoMoz" name="isaddempresa" id="isaddempresa" size="1">
								<option value="0" selected>No</option>
								<option value="1">Si</option>
							</select>
						</td>
					</tr>				
                    <tr class="IsAddEmpresa">
                        <td><label for="rfc" class="textRight">RFC</label></td>
                        <td>
                            <span class="add-on"><i class="icon-asterisk red"></i></span>
                            <input class="altoMoz" name="rfc" id="rfc" type="text" required>
                        </td>
                        <td><label for="razon_social" class="marginLeft2em textRight">Razon Social</label></td>
                        <td colspan="3">
                            <span class="add-on"><i class="icon-asterisk red"></i></span>
                            <input class="altoMoz tbl400W" name="razon_social" id="razon_social" type="text" required>
                        </td>
                    </tr>

				</table>
					
			</div>

			<div id="domicilio" class="tab-pane">

				<div class="form-group ">

	                <table>

	                    <tr>
	                        <td><label for="calle" class="textRight">Calle</label></td>
	                        <td>
	                            <span class="add-on"><i class="icon-asterisk red"></i></span>
	                            <input class="altoMoz" name="calle" id="calle" type="text" required>
	                        </td>
	                        <td><label for="num_ext" class="marginLeft2em textRight">Num Ext</label></td>
	                        <td>
	                            <span class="add-on"><i class="icon-asterisk red"></i></span>
	                            <input class="altoMoz" name="num_ext" id="num_ext" type="text" required>
	                        </td>
	                        <td><label for="num_int" class="marginLeft2em textRight">Num Int</label></td>
	                        <td>
		                        <span class="add-on"><i class="icon-ok white"></i></span>
	                            <input class="altoMoz" name="num_int" id="num_int" type="text" >
	                        </td>
	                    </tr>

	                    <tr>
	                        <td><label for="colonia" class="textRight">Colonia</label></td>
	                        <td>
	                            <span class="add-on"><i class="icon-asterisk red"></i></span>
	                            <input class="altoMoz" name="colonia" id="colonia" type="text" required>
	                        </td>
	                        <td><label for="localidad" class="marginLeft2em textRight">Localidad</label></td>
	                        <td>
	                            <span class="add-on"><i class="icon-asterisk red"></i></span>
	                            <input class="altoMoz" name="localidad" id="localidad" type="text" required>
	                        </td>
	                        <td></td>
	                        <td></td>
	                    </tr>

	                    <tr>
							<td><label for="idsucursal" class="textRight">Sucursal</label></td>
							<td>
		                        <span class="add-on"><i class="icon-asterisk red"></i></span>
								<select class="altoMoz tbl180W" name="idsucursal" id="idsucursal" size="1"></select>							
							</td>
	                        <td><label for="idestado" class="marginLeft2em textRight">Estado</label></td>
	                        <td>
	                            <span class="add-on"><i class="icon-asterisk red"></i></span>
								<select class="altoMoz tbl180W" name="idestado" id="idestado" size="1"></select>							
		                        </td>
	                        <td><label for="idmunicipio" class="marginLeft2em textRight">Municipio</label></td>
	                        <td>
	                            <span class="add-on"><i class="icon-asterisk red"></i></span>
								<select class="altoMoz tbl180W" name="idmunicipio" id="idmunicipio" size="1"></select>							
	                        </td>
	                    </tr>

	                    <tr>
	                        <td><label for="pais" class="marginLeft2em textRight">Pais</label></td>
	                        <td>
	                            <span class="add-on"><i class="icon-asterisk red"></i></span>
	                            <input class="altoMoz" name="pais" id="pais" value="MÉXICO" type="text" >
	                        </td>
	                        <td><label for="cp" class="marginLeft2em textRight">CP</label></td>
	                        <td>
		                        <span class="add-on"><i class="icon-ok white"></i></span>
	                            <input class="altoMoz" name="cp" id="cp" type="text" >
	                        </td>
	                        <td></td>
	                        <td></td>
	                    </tr>

	                </table>

                </div>

			</div>


		</div>

	    <input type="hidden" name="idpersona" id="idpersona" value="<?php echo $idpersona; ?>">
	    <input type="hidden" name="user" id="user" value="<?php echo $user; ?>">
	    <input type="hidden" name="estado" id="estado" value="">
	    <input type="hidden" name="municipio" id="municipio" value="">
	    <input type="hidden" name="idempresa" id="idempresa" value="0">
	    <div class="form-group w96" style='margin-right: 3em; margin-top: 1em;'>
	    	<button type="button" class="btn btn-default pull-right" data-dismiss="modal" id="closeFormUpload"><i class="icon-signout"></i>Cerrar</button>
	    	<span class="muted"></span>
	    	<button type="submit" class="btn btn-primary pull-right" style='margin-right: 4em;'><i class="icon-save"></i>Guardar</button>
		</div>

	</form>

</div>




</div>
</div>
<!--PAGE CONTENT ENDS-->

<script typy="text/javascript">

jQuery(function($) {

	$("#preloaderPrincipal").hide();

	$("#username").focus();
	$("#btnGenPerUser").hide();
	$(".IsAddEmpresa").hide();
	var Inicio        = true;
	var IdEstado      = 0;
	var IdMunicipio   = 0;
	var IsAddEmpresa  = 0;
	var RFC           = "";
	var Razon_Social  = "";

	var idpersona = <?php echo $idpersona ?>;


	function getPersona(Idpersona){
		$.post(obj.getValue(0) + "data/", {o:3, t:6, c:Idpersona, p:55, from:0, cantidad:0,s:''},
			function(json){
				if (json.length>0){
					$("#username").val(json[0].username);

					$("#ap_paterno").val(json[0].ap_paterno);
					$("#ap_materno").val(json[0].ap_materno);
					$("#nombre").val(json[0].nombre);
					$("#email1").val(json[0].emails_emp);
					$("#cel1").val(json[0].cel1);
					$("#tel1").val(json[0].tel1);
					$("#calle").val(json[0].calle_emp);
					$("#num_ext").val(json[0].num_ext_emp);
					$("#num_int").val(json[0].num_int_emp);
					$("#colonia").val(json[0].colonia_emp);
					$("#localidad").val(json[0].localidad_emp);
					$("#pais").val(json[0].pais_emp);
					$("#cp").val(json[0].cp_emp);
					$("#genero").val(json[0].genero);
					$("#status_persona").val(json[0].status_persona);

					$("#idsucursal").val(json[0].idsucursal);
					IdEstado    = json[0].idestado;
					IdMunicipio = json[0].idmunicipio; 

					$("#idestado").trigger( "change" );

					IsAddEmpresa = json[0].isaddempresa;
					RFC 		 = json[0].rfc_emp;
					Razon_Social = json[0].razon_social_emp;

					if ( json[0].isaddempresa == 1){
						$(".IsAddEmpresa").show();
						$("#isaddempresa").val(IsAddEmpresa);
						$("#rfc").val(RFC);
						$("#razon_social").val(Razon_Social);
					}

					if ( $("#username").val() == "" ){
						$("#btnGenPerUser").show();
					}

					$("#idempresa").val(json[0].idempresa);

					$("#username").focus();

				}
		},'json');
	}

    $("#frmData").unbind("submit");
	$("#frmData").on("submit",function(event){
		event.preventDefault();

		$("#preloaderPrincipal").show();

		if (validForm()){

			$("#estado").val( $("#idestado option:selected").text() );
			$("#municipio").val( $("#idmunicipio option:selected").text() );

			var queryString = $(this).serialize();

			// alert(queryString);

			var IdPersona = (idpersona==0?0:1)
            $.post(obj.getValue(0) + "data/", {o:3, t:IdPersona, c:queryString, p:52, from:0, cantidad:0, s:''},
            function(json) {
            		// alert(json.length);
            		if (json[0].msg=="OK"){
            			alert("Datos guardados con éxito.");
						$("#preloaderPrincipal").hide();
						$("#contentProfile").hide(function(){
							$("#contentProfile").empty();
							$("#contentMain").show();
						});
        			}else{
						$("#preloaderPrincipal").hide();
        				alert(json[0].msg);
        				return false;
        			}
        	}, "json");
		}else{
			$("#preloaderPrincipal").hide();
		}

	});

	$("#closeFormUpload").on("click",function(event){
		event.preventDefault();
		$("#preloaderPrincipal").hide();
		$("#contentProfile").hide(function(){
			$("#contentProfile").empty();
			$("#contentMain").show();
		});
		resizeScreen();
		return false;
	});

	$("#btnGenPerUser").on("click",function(event){
		event.preventDefault();
		genUsername();
	});


	function genUsername(){
		var resp =  confirm("Esto creará un USERNAME a esta Persona?");
		if (resp){
			obj.setIsTimeLine(false);
	        $.post(obj.getValue(0) + "data/", {o:3, t:2, c:idpersona, p:3, from:0, cantidad:0, s:''},
	        function(json) {
	        		if (json[0].msg=="OK"){
						$("#preloaderPrincipal").hide();
						$("#contentProfile").hide(function(){
							$("#contentProfile").empty();
							$("#contentMain").show();
						});
						resizeScreen();
						return false;
	    			}else{
	    				alert(json[0].msg);
	    			}
	    	}, "json");
		}
	}

	function validForm(){

		if ($("#ap_paterno").val().length <= 0){
			alert("Faltan el Apellido Paterno");
			$("#ap_paterno").focus();
			return false;
		}

		if ($("#ap_materno").val().length <= 0){
			alert("Faltan el Apellido Materno");
			$("#ap_materno").focus();
			return false;
		}

		if ($("#nombre").val().length <= 0){
			alert("Faltan el Nombre");
			$("#nombre").focus();
			return false;
		}

		if ($("#email1").val().length <= 0){
			alert("Faltan el E-Mail 1");
			$("#email1").focus();
			return false;
		}

		if ($("#tel1").val().length <= 0){
			alert("Faltan el Teléfono");
			$("#tel1").focus();
			return false;
		}

		if ($("#cel1").val().length <= 0){
			alert("Faltan el Celular");
			$("#cel1").focus();
			return false;
		}

		if ($("#idsucursal").val() <= 0){
			alert("Seleccione una sucursal");
			$("#idsucursal").focus();
			return false;
		}

		if ($("#idestado").val() <= 0){
			alert("Seleccione un estado");
			$("#idestado").focus();
			return false;
		}

		if ($("#idmunicipio").val() <= 0){
			alert("Seleccione un municipio");
			$("#idmunicipio").focus();
			return false;
		}


		return true;

	}

	$('.date-picker').datepicker().next().on(ace.click_event, function(){
					$(this).prev().focus();
	});

	$('#fecha_nacimiento').mask('99-99-9999');
	$('#fecha_nacimiento').val(obj.getDateToday());

	function getEstados(){
	    var nc = "u="+localStorage.nc;
	    var issuc = $("#idsucursal").val() <= 0 ? localStorage.IdSucursal :  $("#idsucursal").val();
	    $("#idestado").empty();
	    $("#idestado").append('<option value="0">Seleccione un estado</option>');
	    $.post(obj.getValue(0)+"data/", { o:2, t:-4, p:51,c:nc,from:0,cantidad:0, s:issuc },
	        function(json){
	           $.each(json, function(i, item) {
	           		if (IdEstado == 0){
		           	    var selected = item.predeterminado==1?' selected ' :'';
	           		}else{
		           	    var selected = item.data==IdEstado?' selected ' :'';
	           		}
	                $("#idestado").append('<option value="'+item.data+'" '+selected+'> '+item.label+'</option>');
	            });
				getMunicipios();
	        }, "json"
	    );
	}

	$("#idestado").on("change",function(event){
		event.preventDefault();
		getMunicipios();
	});

	function getMunicipios(){
	    var nc = "u="+localStorage.nc;
	    $("#idmunicipio").empty();
	    $("#idmunicipio").append('<option value="0">Seleccione un municipio</option>');
	    $.post(obj.getValue(0)+"data/", { o:2, t:-2, p:51,c:nc,from:0,cantidad:0, s:$("#idestado").val() },
	        function(json){
	           $.each(json, function(i, item) {
	           		if (IdMunicipio == 0){
		           	    var selected = item.predeterminado==1?' selected ' :'';
	           		}else{
		           	    var selected = item.data==IdMunicipio?' selected ' :'';
	           		}
	                $("#idmunicipio").append('<option value="'+item.data+'" '+selected+'> '+item.label+'</option>');
	            });
	           if (Inicio){
		           getSucursales();
		           Inicio = false;
	           }
	        }, "json"
	    );
	}

	function getSucursales(){
	    var nc = "u="+localStorage.nc;
	    $("#idsucursal").empty();
	    $("#idsucursal").append('<option value="0">Seleccione una sucursal</option>');
	    $.post(obj.getValue(0)+"data/", { o:2, t:-3, p:51,c:nc,from:0,cantidad:0, s:"" },
	        function(json){
	           $.each(json, function(i, item) {
	                $("#idsucursal").append('<option value="'+item.data+'"> '+item.label+'</option>');
	            });

				if (idpersona<=0){
					$("#title").html("Nuevo registro");
				}else{
					$("#title").html("Editando el registro: "+idpersona);
					getPersona(idpersona);
				}

	        }, "json"
	    );
	}

	$("#idsucursal").on("change",function(event){
		event.preventDefault();
		getEstados();
	});

	$("#isaddempresa").on("change",function(event){
		event.preventDefault();
		if ( $(this).val() == 0 ){
			$(".IsAddEmpresa").hide();
		} else {
			$(".IsAddEmpresa").show();
			$("#rfc").val(RFC);
			$("#razon_social").val(Razon_Social);			
		}

	});

	// getEstados(param0,param1);
	getEstados();

});

</script>


