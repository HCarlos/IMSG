<?php

include("includes/metas.php");

require_once("../oFunctions.php");
$F = oFunctions::getInstance();

require_once("../oCentura.php");
$f = oCentura::getInstance();

$user = $_POST['user'];
$idequipocategoria  = $_POST['idequipocategoria'];

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
					EqCats
				</a>
			</li>

		</ul>

		<div class="tab-content">

			<div id="general" class="tab-pane active">

				<div class="form-group ">
			    	<label for="equipo_categoria" class="col-lg-4 control-label">Categoría del Equipo</label>
			    	<div class="col-lg-8">
				    	<input type="text" class="form-control altoMoz" id="equipo_categoria" name="equipo_categoria" required >
		      		</div>
			    </div>

				<div class="form-group ">
			    	<label for="status_equipo_categoria" class="col-lg-4 control-label">Status</label>
			    	<div class="col-lg-8">
                        <input name="status_equipo_categoria" id="status_equipo_categoria" class="ace ace-switch ace-switch-6" type="checkbox" checked >
                        <span class="lbl"></span>
		      		</div>
			    </div>

			</div>

		</div>

	    <input type="hidden" name="idequipocategoria" id="idequipocategoria" value="<?php echo $idequipocategoria; ?>">
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

	var idequipocategoria = <?php echo $idequipocategoria ?>;

	if (idequipocategoria<=0){ // Nuevo Registro
		$("#title").html("Nuevo registro");
	}else{ // Editar Registro
		$("#title").html("Editando el registro: "+idequipocategoria);
		getEqCat(idequipocategoria);
	}

	function getEqCat(IdEqCat){
		$.post(obj.getValue(0) + "data/", {o:7, t:13, c:IdEqCat, p:55, from:0, cantidad:0,s:''},
			function(json){
				if (json.length>0){
					$("#equipo_categoria").val(json[0].equipo_categoria);
                    $("#status_equipo_categoria").prop("checked",json[0].status_equipo_categoria==1?true:false);
				}
		},'json');
	}

    $("#frmData").unbind("submit");
	$("#frmData").on("submit",function(event){
		event.preventDefault();

		$("#preloaderPrincipal").show();

	    var queryString = $(this).serialize();

		if (validForm()){
			var IdEqCat = (idequipocategoria==0?0:1)
            $.post(obj.getValue(0) + "data/", {o:7, t:IdEqCat, c:queryString, p:52, from:0, cantidad:0, s:''},
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

		if($("#equipo_categoria").val().length <= 0){
			alert("Faltan la Categoría del Equipo");
			$("#equipo_categoria").focus();
			return false;
		}

		return true;

	}




});

</script>
