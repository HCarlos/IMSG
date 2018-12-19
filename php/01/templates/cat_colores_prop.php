<?php

include("includes/metas.php");

require_once("../oFunctions.php");
$F = oFunctions::getInstance();

require_once("../oCentura.php");
$f = oCentura::getInstance();

$user = $_POST['user'];
$idcolor  = $_POST['idcolor'];

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
					Color
				</a>
			</li>

		</ul>

		<div class="tab-content">

			<div id="general" class="tab-pane active">
				<table>
					<tr>
						<td class="col-md-2"><label for="color" class="control-label">Color</label></td>
						<td class="col-md-10"><input type="text" class="form-control altoMoz" id="color" name="color" required ></td>
					</tr>
					<tr>
						<td class="col-md-2"><label for="codigo_color_hex" class="control-label">Código</label></td>
						<td class="col-md-10"><input type="text" class="form-control altoMoz" id="codigo_color_hex" name="codigo_color_hex" required ></td>
					</tr>
					<tr>
						<td class="col-md-2"><label for="visualizar" class="control-label">Visualizar</label></td>
						<td class="col-md-10">
							<input name="visualizar" id="visualizar" class="ace ace-switch ace-switch-6 altoMoz" type="checkbox">
							<span class="lbl"></span>
						</td>
					</tr>
					<tr>
						<td class="col-md-2"><label for="status_color" class="control-label">Status</label></td>
						<td class="col-md-10">
							<select class="form-control altoMoz"  name="status_color" id="status_color" size="1">
								<option value="0">Inactivo</option>
								<option value="1" selected >Activo</option>
							</select>
					</td>
					</tr>
				</table>

			</div>

		</div>

	    <input type="hidden" name="idcolor" id="idcolor" value="<?php echo $idcolor; ?>">
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

	var idcolor = <?php echo $idcolor ?>;

	if (idcolor<=0){ // Nuevo Registro
		$("#title").html("Nuevo registro");
	}else{ // Editar Registro
		$("#title").html("Editando el registro: "+idcolor);
		getColor(idcolor);
	}

	function getColor(IdColor){
		$.post(obj.getValue(0) + "data/", {o:6, t:77, c:IdColor, p:51, from:0, cantidad:0,s:''},
			function(json){
				if (json.length>0){
					$("#color").val(json[0].color);
					$("#codigo_color_hex").val(json[0].codigo_color_hex);
					$("#codigo_color_hex").colorpicker("setValue", json[0].codigo_color_hex);
					$("#status_color").val(json[0].status_color);
                    $("#visualizar").prop("checked",json[0].visualizar==1?true:false);
				}
		},'json');
	}

    $("#frmData").unbind("submit");
	$("#frmData").on("submit",function(event){
		event.preventDefault();

		$("#preloaderPrincipal").show();

	    var queryString = $(this).serialize();

	    //alert(queryString)
	    // return false;

		var data = new FormData();

		if (validForm()){
			var IdColor = (idcolor==0?0:1)
            $.post(obj.getValue(0) + "data/", {o:6, t:IdColor, c:queryString, p:52, from:0, cantidad:0, s:''},
            function(json) {
            		if (json[0].msg=="OK"){
            			alert("Datos guardados con éxito.");
      						$("#preloaderPrincipal").hide();
      						$("#contentProfile").hide(function(){
    							$("#contentProfile").html("");
    							$("#contentMain").show();
      						});
        			}else{
						$("#preloaderPrincipal").hide();
        				alert(json[0].msg);
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
			$("#contentProfile").html("");
			$("#contentMain").show();
		});
		resizeScreen();
		return false;
	});

	function validForm(){

		if ($("#color").val().length <= 0) {
			alert("Faltan el Color");
			$("#color").focus();
			return false;
		}

		if ($("#codigo_color_hex").val().length <= 0) {
			alert("Faltan el Código en Hexagésimal");
			$("#codigo_color_hex").focus();
			return false;
		}

		return true;

	}


	$('#codigo_color_hex').colorpicker();


});

</script>
