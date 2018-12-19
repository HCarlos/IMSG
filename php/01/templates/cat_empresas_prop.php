<?php

include("includes/metas.php");

require_once("../oFunctions.php");
$F = oFunctions::getInstance();

require_once("../oCentura.php");
$f = oCentura::getInstance();

$user = $_POST['user'];
$idempresa  = $_POST['idempresa'];

?>

<h3 class="header smaller lighter blue">
    <span id="title"></span>
    <a class="label label-info arrowed-in-right arrowed closeFormUpload pull-right">Regresar</a>
</h3>

<form id="frmData"  class="form">

<div class="row-fluid">
<div class="span12" style="padding-left: 1em; padding-right: 1em;">

                <table>

                    <tr>
                        <td><label for="rfc" class="textRight">RFC</label></td>
                        <td>
                            <span class="add-on"><i class="icon-asterisk red"></i></span>
                            <input class="altoMoz" name="rfc" id="rfc" type="text" autofocus>

                      </td>

                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td><label for="razon_social" class="textRight">Razón Social</label></td>
                        <td colspan="5">
                            <span class="add-on"><i class="icon-asterisk red"></i></span>
                            <input class="altoMoz wd62prc" name="razon_social" id="razon_social" type="text" required>
                        </td>
                    </tr>

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
                        <td><label for="estado" class="textRight">Estado</label></td>
                        <td>
                            <span class="add-on"><i class="icon-asterisk red"></i></span>
                            <input class="altoMoz" name="estado" id="estado" value="" type="text" required>
                        </td>
                        <td><label for="pais" class="marginLeft2em textRight">Pais</label></td>
                        <td>
                            <span class="add-on"><i class="icon-asterisk red"></i></span>
                            <input class="altoMoz" name="pais" id="pais" value="México" type="text" required>
                        </td>
                        <td><label for="cp" class="marginLeft2em textRight">CP</label></td>
                        <td>
                            <input class="altoMoz" name="cp" id="cp" type="text" >
                        </td>
                    </tr>

                    <tr>
                        <td><label for="emails" class="textRight">EMails</label></td>
                        <td colspan="3">
                            <span class="add-on"><i class="icon-asterisk red"></i></span>
                            <input class="altoMoz" name="emails" id="emails" type="text" >
                        </td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td><label for="is_email" class="textRight">Rec Mail</label></td>
                        <td colspan="3">
                            <input name="is_email" id="is_email" class="ace ace-switch ace-switch-6" type="checkbox">
                            <span class="lbl"></span>
                        </td>
                        <td><label for="status_empresa" class="marginLeft2em textRight">Estatus</label></td>
                        <td>
                            <input name="status_empresa" id="status_empresa" class="ace ace-switch ace-switch-6" type="checkbox" checked>
                            <span class="lbl"></span>
                        </td>
                    </tr>

                </table>


    <input type="hidden" name="idempresa" id="idempresa" value="<?php echo $idempresa; ?>">
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

    $("#rfc").focus();

	var idempresa = <?php echo $idempresa ?>;

    $("#frmData").unbind("submit");
	$("#frmData").on("submit",function(event){
		event.preventDefault();

		if (validForm()){

		    var queryString = $(this).serialize();

			var IdEmpresa = (idempresa==0?0:1)

            // alert(IdEmpresa);
            // alert(queryString);

            $.post(obj.getValue(0) + "data/", {o:4, t:IdEmpresa, c:queryString, p:52, from:0, cantidad:0, s:''},
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

	function getRegFis(idempresa){
		$("#preloaderPrincipal").show();
        var nc = "u="+localStorage.nc+"&idempresa="+idempresa;
		$.post(obj.getValue(0) + "data/", {o:4, t:8, c:nc, p:54, from:0, cantidad:0,s:''},
			function(json){
				if (json.length>0){

					idempresa = json[0].idempresa;
					$("#rfc").val(json[0].rfc);
					$("#razon_social").val(json[0].razon_social);
					$("#calle").val(json[0].calle);
					$("#num_ext").val(json[0].num_ext);
					$("#num_int").val(json[0].num_int);
					$("#colonia").val(json[0].colonia);
					$("#localidad").val(json[0].localidad);
					$("#estado").val(json[0].estado);
					$("#pais").val(json[0].pais);
                    $("#cp").val(json[0].cp);
					$("#emails").val(json[0].emails);

                    $("#is_email").prop("checked",json[0].is_email==1?true:false);
                    $("#status_empresa").prop("checked",json[0].status_empresa==1?true:false);

                    $("#title").html("Reg: " + json[0].idempresa);

					$("#preloaderPrincipal").hide();

                    $("#rfc").focus();

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

		if($("#rfc").val().length <= 0){
			alert("Faltan el RFC");
			$("#rfc").focus();
			return false;
		}

		return true;

	}


	// getPisos();
	// getAplanados();
	// getPlafones();

	// //getMemberFam(idempresa);

	// getUsoSuelo();
	// getNiveles();
	// getCimentaciones();
	// getEstructuras();
	// getMuros();
	// getEntrepisos();


	if (idempresa<=0){ // Nuevo Registro
		$("#title").html("Nuevo registro");
        $("#rfc").focus();
	}else{ // Editar Registro
		$("#title").html("Editando la RegFis: "+idempresa);
		getRegFis(idempresa);
	}

});
</script>
