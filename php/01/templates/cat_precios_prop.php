<?php

include("includes/metas.php");

require_once("../oFunctions.php");
$F = oFunctions::getInstance();

require_once("../oCentura.php");
$f = oCentura::getInstance();

$user = $_POST['user'];
$idprecio  = $_POST['idprecio'];

?>

<h3 class="header smaller lighter blue">
    <span id="title"></span>
    <a class="label label-info arrowed-in-right arrowed closeFormUpload pull-right">Regresar</a>
</h3>

<form id="frmPrecios"  class="form">

<div class="row-fluid">
<div class="span12" style="padding-left: 1em; padding-right: 1em;">

                <table>

                    <tr>
                        <td class="wd10prc"><label for="codigo" class="textRight">CODIGO</label></td>
                        <td class="wd90prc">
                            <input class="altoMoz" name="codigo" id="codigo" type="text" autofocus>
                      </td>
                    </tr>

                    <tr>
                        <td><label for="concepto" class="textRight">CONCEPTO</label></td>
                        <td>
                            <input class="altoMoz wd62prc" name="concepto" id="concepto" type="text" required>
                        </td>
                    </tr>

                    <tr>
                        <td><label for="idunidadmedida" class="textRight">MEDIDA</label></td>
                        <td>
                            <select class="form-control wd90prc"  name="idunidadmedida" id="idunidadmedida" size="1" />
                        </td>
                    </tr>

                    <tr>
                        <td><label for="precio_unitario" class="textRight">PRECIO</label></td>
                        <td>
                            <input class="altoMoz" name="precio_unitario" id="precio_unitario" type="text" autofocus>
                      </td>
                    </tr>

                    <tr>
                        <td><label for="tipo" class="textRight">TIPO</label></td>
                        <td>
                            <input class="altoMoz" name="tipo" id="tipo" type="text" autofocus>
                      </td>
                    </tr>

                    <tr>
                        <td><label for="idpreciocategoria" class="textRight">CATEORIA</label></td>
                        <td>
                            <select class="form-control wd90prc"  name="idpreciocategoria" id="idpreciocategoria" size="1" />
                        </td>
                    </tr>

                    <tr>
                        <td><label for="is_iva" class="marginLeft2em textRight">Inc IVA:</label></td>
                        <td>
                            <input name="is_iva" id="is_iva" class="ace ace-switch ace-switch-6" type="checkbox" >
                            <span class="lbl"></span>
                        </td>
                    </tr>

                    <tr>
                        <td><label for="status_precio_unitario" class="marginLeft2em textRight">Estatus</label></td>
                        <td>
                            <input name="status_precio_unitario" id="status_precio_unitario" class="ace ace-switch ace-switch-6" type="checkbox" checked>
                            <span class="lbl"></span>
                        </td>
                    </tr>



                </table>


    <input type="hidden" name="idprecio" id="idprecio" value="<?php echo $idprecio; ?>">
    <input type="hidden" name="user" id="user" value="<?php echo $user; ?>">
    <div class="form-group w96" style='margin-right: 3em; margin-top: 1em;'>
    	<button type="submit" class="btn btn-primary pull-right" style='margin-right: 4em;'><i class="icon-save"></i>Guardar</button>
	</div>

</form>

</div>
</div>

<!--PAGE CONTENT ENDS-->

<script typy="text/javascript">

jQuery(function($) {

	$("#preloaderPrincipal").hide();

    $("#codigo").focus();

	var IdPrecio = <?php echo $idprecio ?>;

    $("#frmPrecios").unbind("submit");
	$("#frmPrecios").on("submit",function(event){
		event.preventDefault();

		if (validForm()){

		    var queryString = $(this).serialize();

            // alert(queryString);


			var IdPre = (IdPrecio==0?0:1)
            $.post(obj.getValue(0) + "data/", {o:10, t:IdPre, c:queryString, p:52, from:0, cantidad:0, s:''},
            function(json) {
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
        			}
        	}, "json");
		}else{
			$("#preloaderPrincipal").hide();
		}
	});

	function getPre(IdPre){
		$("#preloaderPrincipal").show();
		$.post(obj.getValue(0) + "data/", {o:10, t:26, c:IdPre, p:54, from:0, cantidad:0,s:''},
			function(json){
				if (json.length>0){

					IdPrecio = json[0].IdPrecio;
					$("#codigo").val(json[0].codigo);
					$("#concepto").val(json[0].concepto);
                    $("#precio_unitario").val(json[0].precio_unitario);
					$("#tipo").val(json[0].tipo);
                    $("#idunidadmedida").val(json[0].idunidadmedida);
					$("#idpreciocategoria").val(json[0].idpreciocategoria);
                    $("#is_iva").prop("checked",json[0].is_iva==1?true:false);
                    $("#status_precio_unitario").prop("checked",json[0].status_precio_unitario==1?true:false);

                    $("#title").html("Reg: " + json[0].IdPrecio);

					$("#preloaderPrincipal").hide();

                    $("#codigo").focus();

				}
		},'json');

	}

	// close Form
	$(".closeFormUpload").on("click",function(event){
		event.preventDefault();
		$("#preloaderPrincipal").hide();
		$("#contentProfile").hide(function(){
			$("#contentProfile").empty();
			$("#contentMain").show();
		});
		resizeScreen();
		return false;
	});

	function validForm(){

		if($("#codigo").val().length <= 0){
			alert("Faltan el RFC");
			$("#codigo").focus();
			return false;
		}

		return true;

	}

    function getUnidadMedida(){
        var nc = "u="+localStorage.nc;
        $("#idunidadmedida").empty();
        $.post(obj.getValue(0)+"data/", { o:10, t:83, p:51,c:nc,from:0,cantidad:0, s:"" },
            function(json){
               $.each(json, function(i, item) {
                    $("#idunidadmedida").append('<option value="'+item.data+'"> '+item.label+'</option>');
                });
                getPreciosCategorias();
            }, "json"
        );        
    }

    function getPreciosCategorias(){
        var nc = "u="+localStorage.nc;
        $("#idpreciocategoria").empty();
        $.post(obj.getValue(0)+"data/", { o:10, t:84, p:51,c:nc,from:0,cantidad:0, s:"" },
            function(json){
               $.each(json, function(i, item) {
                    $("#idpreciocategoria").append('<option value="'+item.data+'"> '+item.label+'</option>');
                });

                if (IdPrecio<=0){ // Nuevo Registro
                    $("#title").html("Nuevo registro");
                    $("#codigo").focus();
                }else{ // Editar Registro
                    $("#title").html("Editando el registro: "+IdPrecio);
                    getPre(IdPrecio);
                }

            }, "json"
        );        
    }

    getUnidadMedida();

});
</script>
