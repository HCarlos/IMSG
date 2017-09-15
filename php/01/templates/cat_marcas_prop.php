<?php

include("includes/metas.php");

require_once("../oFunctions.php");
$F = oFunctions::getInstance();

require_once("../oCentura.php");
$f = oCentura::getInstance();

$user = $_POST['user'];
$idmarca  = $_POST['idmarca'];

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
					Marcas
				</a>
			</li>

		</ul>

		<div class="tab-content">

			<div id="general" class="tab-pane active">

				<div class="form-group ">
			    	<label for="marca" class="col-lg-2 control-label">Marca</label>
			    	<div class="col-lg-10">
				    	<input type="text" class="form-control altoMoz" id="marca" name="marca" required >
		      		</div>
			    </div>

				<div class="form-group ">
			    	<label for="status_marca" class="col-lg-2 control-label">Status</label>
			    	<div class="col-lg-10">
						<select class="form-control input-lg"  name="status_marca" id="status_marca" size="1">
							<option value="0">Inactivo</option>
							<option value="1" selected >Activo</option>
						</select>
		      		</div>
			    </div>

			</div>

		</div>

	    <input type="hidden" name="idmarca" id="idmarca" value="<?php echo $idmarca; ?>">
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

	$("#marca").focus();

	var IdMarca = <?php echo $idmarca ?>;

	if (IdMarca<=0){ // Nuevo Registro
		$("#title").html("Nuevo registro");
	}else{ // Editar Registro
		$("#title").html("Editando el registro: "+idmarca);
		getMarca(IdMarca);
	}

	function getMarca(IdMarca){
		$.post(obj.getValue(0) + "data/", {o:5, t:11, c:IdMarca, p:54, from:0, cantidad:0,s:''},
			function(json){
				if (json.length>0){
					$("#marca").val(json[0].marca);
					$("#status_marca").val(json[0].status_marca);
				}
		},'json');
	}

    $("#frmData").unbind("submit");
	$("#frmData").on("submit",function(event){
		event.preventDefault();

		$("#preloaderPrincipal").show();

	    var queryString = $(this).serialize();

		if (validForm()){
			var idmarca = (IdMarca==0?0:1)
            $.post(obj.getValue(0) + "data/", {o:5, t:idmarca, c:queryString, p:52, from:0, cantidad:0, s:''},
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

		if($("#marca").val().length <= 0){
			alert("Faltan el Marca");
			$("#marca").focus();
			return false;
		}

		return true;

	}

});

</script>
