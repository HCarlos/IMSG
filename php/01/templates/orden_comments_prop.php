<?php

include("includes/metas.php");

$user = $_POST['user'];
$idcontrolcomentario  = $_POST['idcontrolcomentario'];
$idcontrolmaster  = $_POST['idcontrolmaster'];

?>
<div class="row-fluid">
<div class="span12" style="padding-left: 1em; padding-right: 1em;">
<div class="tabbable">

	<h3 class="header smaller lighter blue" id="title"></h3>
	<form id="frmCComentario" role="form">

		<ul class="nav nav-tabs" id="myTab">

			<li class="active">
				<a data-toggle="tab" href="#general">
					<i class="orange icon-comment bigger-110"></i>
					COMENTARIO
				</a>
			</li>

		</ul>

		<div class="tab-content">

			<div id="general" class="tab-pane active">

				<div class="form-group ">
			    	<div class="col-lg-12">
                        <textarea class="form-control wd100prc" rows="4" id="comentario" name="comentario"></textarea>
		      		</div>
			    </div>

			</div>

		</div>

	    <input type="hidden" name="idcontrolcomentario" id="idcontrolcomentario" value="<?= $idcontrolcomentario; ?>">
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

    var IdControlComentario = <?= $idcontrolcomentario ?>;

	$("#preloaderPrincipal").hide();
	$("#comentario").focus();

	function getCComentario(IdControlComentario){
		$.post(obj.getValue(0) + "data/", {o:70, t:28, c:IdControlComentario, p:54, from:0, cantidad:0,s:''},
			function(json){
				if (json.length>0){
					$("#comentario").val(json[0].comentario);
				}
		},'json');
	}

    $("#frmCComentario").unbind("submit");
	$("#frmCComentario").on("submit",function(event){
		event.preventDefault();

		$("#preloaderPrincipal").show();

	    var queryString = $(this).serialize();

		var data = new FormData();

		if (validForm()){
			var IdCComentario = (IdControlComentario==0?10:11)
            $.post(obj.getValue(0) + "data/", {o:70, t:IdCComentario, c:queryString, p:52, from:0, cantidad:0, s:''},
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

		if($("#comentario").val().length <= 0){
			alert("Faltan la Codigo");
			$("#comentario").focus();
			return false;
		}

		return true;

	}

	getCComentario(IdControlComentario);


});

</script>
