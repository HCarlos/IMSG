<?php

include("includes/metas.php");

$user = $_POST['user'];
$iddetalle  = $_POST['iddetalle'];
$idcontrolmaster  = $_POST['idcontrolmaster'];

?>
<div class="row-fluid">
<div class="span12" style="padding-left: 1em; padding-right: 1em;">
<div class="tabbable">

	<h3 class="header smaller lighter blue" id="title"></h3>
	<form id="frmCDetalle" role="form">

		<ul class="nav nav-tabs" id="myTab">

			<li class="active">
				<a data-toggle="tab" href="#general">
					<i class="red icon-cog bigger-110"></i>
					EQUIPO
				</a>
			</li>

		</ul>

		<div class="tab-content">

			<div id="general" class="tab-pane active">

				<div class="form-group ">
			    	<label for="idequipocategoria" class="col-lg-4 control-label">Equipo</label>
			    	<div class="col-lg-8">
                          <select class="form-control altoMoz"  name="idequipocategoria" id="idequipocategoria" size="1" style="width: 120px !important;"></select>
		      		</div>
			    </div>

				<div class="form-group ">
			    	<label for="idmarca" class="col-lg-4 control-label">Marca</label>
			    	<div class="col-lg-8">
                          <select class="form-control altoMoz"  name="idmarca" id="idmarca" size="1" style="width: 120px !important;"></select>
		      		</div>
			    </div>

				<div class="form-group ">
			    	<label for="modelo" class="col-lg-4 control-label">Modelo</label>
			    	<div class="col-lg-8">
				    	<input type="text" class="form-control altoMoz" id="modelo" name="modelo"  >
		      		</div>
			    </div>

				<div class="form-group ">
			    	<label for="serie" class="col-lg-4 control-label">Serie</label>
			    	<div class="col-lg-8">
				    	<input type="text" class="form-control altoMoz" id="serie" name="serie"  >
		      		</div>
			    </div>

				<div class="form-group ">
			    	<label for="no_parte" class="col-lg-4 control-label">No. Parte</label>
			    	<div class="col-lg-8">
				    	<input type="text" class="form-control altoMoz" id="no_parte" name="no_parte"  >
		      		</div>
			    </div>

				<div class="form-group ">
			    	<label for="version" class="col-lg-4 control-label">Versión</label>
			    	<div class="col-lg-8">
				    	<input type="text" class="form-control altoMoz" id="version" name="version"  >
		      		</div>
			    </div>

				<div class="form-group ">
			    	<label for="submodelo" class="col-lg-4 control-label">Submodelo</label>
			    	<div class="col-lg-8">
				    	<input type="text" class="form-control altoMoz" id="submodelo" name="submodelo"  >
		      		</div>
			    </div>

				<div class="form-group ">
			    	<label for="num_pedido" class="col-lg-4 control-label">N° Pedido</label>
			    	<div class="col-lg-8">
				    	<input type="text" class="form-control altoMoz" id="num_pedido" name="num_pedido"  >
		      		</div>
			    </div>

				<div class="form-group ">
			    	<label for="status_detalle" class="col-lg-4 control-label">Status</label>
			    	<div class="col-lg-8">
						<select class="form-control input-lg"  name="status_detalle" id="status_detalle" size="1">
							<option value="0">Inactivo</option>
							<option value="1" selected >Activo</option>
						</select>
		      		</div>
			    </div>

			</div>

		</div>

	    <input type="hidden" name="equipo" id="equipo" value="">
	    <input type="hidden" name="marca" id="marca" value="">
	    <input type="hidden" name="iddetalle" id="iddetalle" value="<?= $iddetalle; ?>">
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
    var iddetalle = <?= $iddetalle ?>;

	$("#preloaderPrincipal").hide();
	$("#equipo").focus();

	function getCDetalle(IdDetalle){
		$.post(obj.getValue(0) + "data/", {o:70, t:18, c:IdDetalle, p:54, from:0, cantidad:0,s:''},
			function(json){
				if (json.length>0){

					$("#idequipocategoria").val(json[0].idequipocategoria);
					$("#equipo").val(json[0].equipo);
					$("#idmarca").val(json[0].idmarca);
					$("#marca").val(json[0].marca);
					$("#modelo").val(json[0].modelo);
					$("#serie").val(json[0].serie);
					$("#no_parte").val(json[0].no_parte);
					$("#version").val(json[0].version);
					$("#submodelo").val(json[0].submodelo);
					$("#num_pedido").val(json[0].num_pedido);
					$("#status_detalle").val(json[0].status_detalle);

				}
		},'json');
	}

    $("#frmCDetalle").unbind("submit");
	$("#frmCDetalle").on("submit",function(event){
		event.preventDefault();

		$("#preloaderPrincipal").show();

	    var queryString = $(this).serialize();

	   // alert(queryString)
	    // return false;

		var data = new FormData();

		if (validForm()){
			var IdDetalle = (iddetalle==0?3:4)
            $.post(obj.getValue(0) + "data/", {o:70, t:IdDetalle, c:queryString, p:52, from:0, cantidad:0, s:''},
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

		if( parseInt($("#idequipocategoria").val(),0) <= 0){
			alert("Faltan el Equipo");
			$("#idequipocategoria").focus();
			return false;
		}

		if( parseInt($("#idmarca").val(),0) <= 0){
			alert("Faltan la Marca");
			$("#idmarca").focus();
			return false;
		}

		return true;

	}

    function getMarcas(){
        var nc = "u="+localStorage.nc;
        $("#idmarca").empty();
        $("#idmarca").append('<option value="0">Seleccione una Marca</option>');
        $.post(obj.getValue(0)+"data/", { o:1, t:80, p:51,c:nc,from:0,cantidad:0, s:"" },
            function(json){
               $.each(json, function(i, item) {
                    $("#idmarca").append('<option value="'+item.data+'"> '+item.label+'</option>');
                });
				getEquipos();
            }, "json"
        );
    }

    function getEquipos(){
        var nc = "u="+localStorage.nc;
        $("#idequipocategoria").empty();
        $("#idequipocategoria").append('<option value="0">Seleccione un Equipo</option>');
        $.post(obj.getValue(0)+"data/", { o:1, t:82, p:51,c:nc,from:0,cantidad:0, s:"" },
            function(json){
               $.each(json, function(i, item) {
                    $("#idequipocategoria").append('<option value="'+item.data+'"> '+item.label+'</option>');
                });
				if (iddetalle<=0){ // Nuevo Registro
					$("#title").html("Nuevo registro");
				}else{ // Editar Registro
					$("#title").html("Editando el registro: "+iddetalle);
					getCDetalle(iddetalle);
				}
            }, "json"
        );
    }

	$("#idmarca").on("change",function(event){
		event.preventDefault();
		var txtVal = $("#idmarca option:selected").text();
		$("#marca").val( txtVal );
	});

	$("#idequipocategoria").on("change",function(event){
		event.preventDefault();
		var txtVal = $("#idequipocategoria option:selected").text();
		$("#equipo").val( txtVal );
	});


	getMarcas();


});

</script>
