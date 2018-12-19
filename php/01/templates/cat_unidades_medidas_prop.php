<?php

include("includes/metas.php");

require_once("../oFunctions.php");
$F = oFunctions::getInstance();

require_once("../oCentura.php");
$f = oCentura::getInstance();

$user = $_POST['user'];
$idunidadmedida  = $_POST['idunidadmedida'];

?>
<div class="row-fluid">
<div class="span12" style="padding-left: 1em; padding-right: 1em;">
<div class="tabbable">

	<h3 class="header smaller lighter blue" id="title"></h3>
	<form id="frmDataUniMed" role="form">

		<ul class="nav nav-tabs" id="myTab">

			<li class="active">
				<a data-toggle="tab" href="#general">
					<i class="red icon-home bigger-110"></i>
					UniMeds
				</a>
			</li>

		</ul>

		<div class="tab-content">

			<div id="general" class="tab-pane active">

				<div class="form-group ">
			    	<label for="clave" class="col-lg-4 control-label">Clave</label>
			    	<div class="col-lg-8">
				    	<input type="text" class="form-control altoMoz" id="clave" name="clave" required >
		      		</div>
			    </div>

				<div class="form-group ">
			    	<label for="unidad_medida" class="col-lg-4 control-label">Categoría</label>
			    	<div class="col-lg-8">
				    	<input type="text" class="form-control altoMoz" id="unidad_medida" name="unidad_medida" required >
		      		</div>
			    </div>

				<div class="form-group ">
			    	<label for="status_unidad_medida" class="col-lg-4 control-label">Status</label>
			    	<div class="col-lg-8">
                        <input name="status_unidad_medida" id="status_unidad_medida" class="ace ace-switch ace-switch-6" type="checkbox" checked >
                        <span class="lbl"></span>
		      		</div>
			    </div>

			</div>

		</div>

	    <input type="hidden" name="idunidadmedida" id="idunidadmedida" value="<?php echo $idunidadmedida; ?>">
	    <input type="hidden" name="user" id="user" value="<?php echo $user; ?>">
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

	$("#clave").focus();

	var idunidadmedida = <?php echo $idunidadmedida ?>;

	if (idunidadmedida<=0){ // Nuevo Registro
		$("#title").html("Nuevo registro");
	}else{ // Editar Registro
		$("#title").html("Editando el registro: "+idunidadmedida);
		getUniMed(idunidadmedida);
	}

	function getUniMed(IdUniMed){
		$.post(obj.getValue(0) + "data/", {o:9, t:24, c:IdUniMed, p:55, from:0, cantidad:0,s:''},
			function(json){
				if (json.length>0){
					$("#clave").val(json[0].clave);
					$("#unidad_medida").val(json[0].unidad_medida);
                    $("#status_unidad_medida").prop("checked",json[0].status_unidad_medida==1?true:false);
				}
		},'json');
	}

    $("#frmDataUniMed").unbind("submit");
	$("#frmDataUniMed").on("submit",function(event){
		event.preventDefault();

		$("#preloaderPrincipal").show();

	    var queryString = $(this).serialize();

		if (validForm()){
			var IdUniMed = (idunidadmedida==0?0:1)
            $.post(obj.getValue(0) + "data/", {o:9, t:IdUniMed, c:queryString, p:52, from:0, cantidad:0, s:''},
            function(json) {
            		if (json[0].msg=="OK"){
            			alert("Datos guardados con éxito.");
						$("#preloaderPrincipal").hide();
						$("#divUploadImage").modal('hide');
        			}else{
						$("#preloaderPrincipal").hide();
        				alert(json[0].msg);
        			}
        	}, "json");
		}else{
			$("#preloaderPrincipal").hide();
		}

	});

	$("#closeProp").on("click",function(event){
		$("#preloaderPrincipal").hide();
		$("#divUploadImage").modal('hide');
	});

	function validForm(){

		if($("#clave").val().length <= 0){
			alert("Faltan la Clave");
			$("#clave").focus();
			return false;
		}

		if($("#unidad_medida").val().length <= 0){
			alert("Faltan la Categoría");
			$("#unidad_medida").focus();
			return false;
		}

		return true;

	}




});

</script>
