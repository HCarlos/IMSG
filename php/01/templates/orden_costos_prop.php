<?php

include("includes/metas.php");

$user = $_POST['user'];
$idimporte  = $_POST['idimporte'];
$idcontrolmaster  = $_POST['idcontrolmaster'];

?>
<div class="row-fluid">
<div class="span12" style="padding-left: 1em; padding-right: 1em;">
<div class="tabbable">

	<h3 class="header smaller lighter blue" id="title">COSTOS</h3>
	<form id="frmCImporte" role="form">
		<table>
            <tr>
                <td><label for="cantidad" class="col-lg-4 control-label textRightl">CANTIDAD</label></td>
                <td>
					<input type="number" class="form-control altoMoz" id="cantidad" name="cantidad" min="1" max="1000" value="1" required >
                </td>
            </tr>
            <tr>
                <td><label for="idprecio" class="col-lg-4 control-labe textRightl">CÓDIGO</label></td>
                <td>
					<select class="form-control wd90prc"  name="idprecio" id="idprecio" size="1" />
                </td>
            </tr>
            <tr>
                <td><label for="precio_unitario" class="col-lg-4 control-label textRight">Precio</label></td>
                <td>
			    	<input type="text" 
			    			class="form-control altoMoz" id="precio_unitario" 
			    			name="precio_unitario" 
			    			pattern="[0-9]+(\.[0-9]{0,2})?%?"
								title="Debe ser un numero de 2 decimales y / ó %"  
						>
                </td>
            </tr>
            <tr>
                <td><label for="subtotal" class="col-lg-4 control-label textRight">Subtotal</label></td>
                <td>
			    	<input type="text" class="form-control altoMoz" id="subtotal" name="subtotal" readonly  >
                </td>
            </tr>
            <tr>
                <td><label for="viaticos" class="col-lg-4 control-label textRight">Viáticos</label></td>
                <td>
			    	<input type="text" 
			    			class="form-control altoMoz" id="viaticos" 
			    			name="viaticos" 
			    			pattern="[0-9]+(\.[0-9]{0,2})?%?"
								title="Debe ser un numero de 2 decimales y / ó %"  
								value="0" 
						>
                </td>
            </tr>
            <tr>
                <td><label for="importe" class="col-lg-4 control-label textRight">Importe</label></td>
                <td>
			    	<input type="text" class="form-control altoMoz" id="importe" name="importe" readonly  >
                </td>
            </tr>
            <tr>
                <td><label for="observaciones" class="col-lg-4 control-label textRight">Observaciones</label></td>
                <td>
			    	<input type="text" class="form-control altoMoz" id="observaciones" name="observaciones"  >
                </td>
            </tr>			
            <tr>
                <td><label for="is_iva" class="marginLeft2em textRight">Inc IVA:</label></td>
                <td>
                    <input name="is_iva" id="is_iva" class="ace ace-switch ace-switch-6" type="checkbox" checked readonly>
                    <span class="lbl"></span>
                </td>
            </tr>

            <tr>
                <td><label for="status_importe" class="marginLeft2em textRight">Status:</label></td>
                <td>
                    <input name="status_importe" id="status_importe" class="ace ace-switch ace-switch-6" type="checkbox" checked readonly>
                    <span class="lbl"></span>
                </td>
            </tr>

		</table>

	    <input type="hidden" name="idimporte" id="idimporte" value="<?= $idimporte; ?>">
	    <input type="hidden" name="idcontrolmaster" id="idcontrolmaster" value="<?= $idcontrolmaster; ?>">
	    <input type="hidden" name="codigo" id="codigo" value="">
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
    var idimporte = <?= $idimporte ?>;
    var arrPrecios = [];

	$("#preloaderPrincipal").hide();
	$("#cantidad").focus();

	function getCImporte(IdImporte){
		$.post(obj.getValue(0) + "data/", {o:70, t:20, c:IdImporte, p:54, from:0, cantidad:0,s:''},
			function(json){
				if (json.length>0){

					$("#cantidad").val(json[0].cantidad);
					$("#idprecio").val(json[0].idprecio);
					$("#codigo").val(json[0].codigo);
					$("#precio_unitario").val(json[0].precio_unitario);
					$("#subtotal").val(json[0].subtotal);
					$("#viaticos").val(json[0].viaticos);
					$("#importe").val(json[0].importe);
					$("#observaciones").val(json[0].observaciones);
                    $("#is_iva").prop("checked",json[0].is_iva==1?true:false);
                    $("#status_importe").prop("checked",json[0].status_importe==1?true:false);

				}
		},'json');
	}

    $("#frmCImporte").unbind("submit");
	$("#frmCImporte").on("submit",function(event){
		event.preventDefault();

		$("#preloaderPrincipal").show();

	    var queryString = $(this).serialize();

	    // alert(queryString)
	    // return false;

		var data = new FormData();

		if (validForm()){
			var IdImporte = (idimporte==0?8:9)
            $.post(obj.getValue(0) + "data/", {o:70, t:IdImporte, c:queryString, p:52, from:0, cantidad:0, s:''},
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

		if($("#cantidad").val().length <= 0){
			alert("Faltan el Cantidad");
			$("#cantidad").focus();
			return false;
		}

		if($("#codigo").val().length <= 0){
			alert("Faltan la Codigo");
			$("#codigo").focus();
			return false;
		}

		if($("#precio_unitario").val().length <= 0){
			alert("Faltan la Precio Unitario");
			$("#precio_unitario").focus();
			return false;
		}

		return true;

	}

	function getPrecios(){
        var nc = "u="+localStorage.nc;
        arrPrecios = [];
        $("#idprecio").empty();
        $("#idprecio").append('<option value="-1">Seleccione un opción</option>');
        $.post(obj.getValue(0)+"data/", { o:10, t:85, p:51,c:nc,from:0,cantidad:0, s:"" },
            function(json){
               $.each(json, function(i, item) {
                    $("#idprecio").append('<option value="'+item.data+'"> '+item.label+'</option>');
                    arrPrecios[item.data]={idprecio:item.data,codigo:item.codigo,precio_unitario:item.precio_unitario,is_iva:item.is_iva};
                });
				if (idimporte<=0){
					$("#title").html("Nuevo registro");
				}else{ // Editar Registro
					$("#title").html("Editando el registro: "+idimporte);
					getCImporte(idimporte);
				}
            }, "json"
        );
	}

	$("#idprecio").on("change",function(event){
		event.preventDefault();
		var id = $(this).val();
		$("#codigo").val(arrPrecios[id].codigo);
		$("#precio_unitario").val(arrPrecios[id].precio_unitario);
		// $("#is_iva").val(arrPrecios[id].is_iva);
        $("#is_iva").prop("checked",arrPrecios[id].is_iva==1?true:false);
	});

	getPrecios();

});

</script>
