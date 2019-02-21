<?php

include("includes/metas.php");

$user = $_POST['user'];
$idcontrolmaster  = $_POST['idcontrolmaster'];

?>
<div class="row-fluid">
<div class="span12" style="padding-left: 1em; padding-right: 1em;">
<div class="tabbable">

	<h3 class="header smaller lighter blue" id="title"></h3>
	<form id="frmCImagen" role="form">

		<ul class="nav nav-tabs" id="myTab">

			<li class="active">
				<a data-toggle="tab" href="#general">
					<i class="red icon-picture bigger-110"></i>
					Imagen
				</a>
			</li>

		</ul>

		<div class="tab-content">

			<div id="general" class="tab-pane active">

				<div class="form-group ">
					<label for="foto"  class="col-lg-4 control-label">Imagen</label>
			    	<div class="col-lg-8">
						<input id="foto" name="foto" class="form-control file " style="width: 100%;" type="file" >
		      		</div>
				</div>	

				<div class="form-group ">
			    	<div class="col-lg-12">
						<div style="position: relative; display: block; width: 100% !important; height: 1em !important;"></div>
		      		</div>
			    </div>

				<div class="form-group ">
			    	<label for="descripcion" class="col-lg-4 control-label">Descripción</label>
			    	<div class="col-lg-8">
				    	<input type="text" class="form-control altoMoz" id="descripcion" name="descripcion"  >
		      		</div>
			    </div>

			</div>

		</div>

	    <input type="hidden" name="idcontrolmaster" id="idcontrolmaster" value="<?= $idcontrolmaster; ?>">
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

<script typy="text/javascript">

jQuery(function($) {

	var User = "<?= $user; ?>";

	$("#preloaderPrincipal").hide();

    $("#frmCImagen").unbind("submit");
	$("#frmCImagen").on("submit",function(event){
		event.preventDefault();

		$("#preloaderPrincipal").show();

	    var queryString = $(this).serialize();	

		if (validForm()){
	    
		    var data = new FormData();

			jQuery.each($('input[type=file]')[0].files, function(i, file) {
			    data.append('foto', file);
			});

			data.append('data', queryString);

			$.ajax({
			    url:obj.getValue(0)+"fu-cimg/",
			    data: data,
			    cache: false,
			    contentType: false,
			    processData: false,
			    dataType: 'json',
			    type: 'POST',
			    success: function(json){
			    	if (json.status!="OK"){
			           alert(json.message);
			       	} else{
			       		var msg = json.message;	
			       		alert(msg);
						$("#preloaderPrincipal").hide();
						$("#divUploadImage").modal('hide');
			       	}
			    }
			});

		}

	});

	$("#closeProp").on("click",function(event){
		$("#preloaderPrincipal").hide();
		$("#divUploadImage").modal('hide');
	});

	function validForm(){

		return true;

	}


});

</script>
