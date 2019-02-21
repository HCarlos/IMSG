<?php

include("includes/metas.php");

require_once("../oFunctions.php");
$F = oFunctions::getInstance();

require_once("../oCentura.php");
$f = oCentura::getInstance();

$user                = $_POST['user'];
$idcotizacion        = $_POST['idcotizacion'];
$idcotizaciondetalle = $_POST['idcotizaciondetalle'];
$origen              = $_POST['origen'];
$destino             = $_POST['destino'];

?>

<div class="widget-box" id="wdCotDet">

    <div class="widget-header header-color-blue">
        <h4 class="pull-left" id="title"></h4>
        <span class="widget-toolbar">
                <h5 class="label label-inverse arrowed-in-right arrowed closeL3" style="cursor: pointer;" >Regresar</h5>
        </span>
    </div>

    <div class="widget-body">
        <div class="widget-main">
            <div class="row-fluid">

                <form id="frmCotDet01"  class="form wd100prc">

                    <table class="wd100prc">

                        <tr>
                            <td class="wd10prc"><label for="idmoneda">Moneda</label></td>
                            <td colspan="7" class="wd70prc">
                                <select class="form-control wd50prc" name="idmoneda" id="idmoneda" size="1" />
                            </td>
                        </tr>

                        <tr>
                            <td class="wd10prc"><label for="tipo_cambio">Tipo de Cambio</label></td>
                            <td colspan="7" class="wd70prc">
                                <input type="text" id="tipo_cambio" name="tipo_cambio" value="0" class="form-control altoMoz" pattern="^\s*(?=.*[1-9])\d*(?:\.\d{1,2})?\s*$" />
                            </td>
                        </tr>

                        <tr>
                            <td class="wd10prc"><label for="persona">Lote</label></td>
                            <td colspan="7" class="wd50prc">
                                <input type="text" id="lote" name="lote" class="form-control altoMoz" />
                            </td>
                        </tr>

                        <tr>
                            <td class="wd10prc"><label for="cantidad">Cantidad</label></td>
                            <td colspan="7" class="wd70prc">
                                <input type="text" id="cantidad" name="cantidad" value="0" class="form-control altoMoz" pattern="^\s*(?=.*[1-9])\d*(?:\.\d{1,2})?\s*$" />
                            </td>
                        </tr>

                        <tr>
                            <td class="wd10prc"><label for="idunidadmedida">Medida</label></td>
                            <td colspan="7" class="wd70prc">
                                <select class="form-control wd50prc" name="idunidadmedida" id="idunidadmedida" size="1" />
                            </td>
                        </tr>

                        <tr>
                            <td class="wd10prc"><label for="descripcion">Descripcion</label></td>
                            <td colspan="7" class="wd70prc">
                                <textarea id="descripcion" name="descripcion" class="form-control wd100prc" cols="1" rows="4"></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td class="wd10prc"><label for="precio_unitario">Precio Unitario</label></td>
                            <td colspan="7" class="wd70prc">
                                <input type="text" id="precio_unitario" name="precio_unitario" value="0" class="form-control altoMoz" pattern="^\s*(?=.*[1-9])\d*(?:\.\d{1,2})?\s*$" />
                            </td>
                        </tr>

                        <tr>
                            <td class="wd10prc"><label for="idporcentajeutilidad">% Util</label></td>
                            <td colspan="7" class="wd70prc">
                                <select class="form-control wd50prc" name="idporcentajeutilidad" id="idporcentajeutilidad" size="1" />
                            </td>
                        </tr>

                        <tr>
                            <td class="wd10prc"><label for="flete">Flete</label></td>
                            <td colspan="7" class="wd70prc">
                                <input type="text" id="flete" name="flete" value="0" class="form-control altoMoz" pattern="^\s*(?=.*[0-9])\d*(?:\.\d{1,2})?\s*$" />
                            </td>
                        </tr>

                        <tr>
                            <td class="wd10prc"><label for="precio_venta">Precio Venta</label></td>
                            <td colspan="7" class="wd70prc">
                                <input type="text" id="precio_venta" name="precio_venta" value="0" class="form-control altoMoz" pattern="^\s*(?=.*[1-9])\d*(?:\.\d{1,2})?\s*$" disabled />
                            </td>
                        </tr>

                        <tr>
                            <td class="wd10prc"><label for="importe">Importe</label></td>
                            <td colspan="7" class="wd70prc">
                                <input type="text" id="importe" name="importe" value="0" class="form-control altoMoz" pattern="^\s*(?=.*[1-9])\d*(?:\.\d{1,2})?\s*$" disabled />
                            </td>
                        </tr>

                    </table>

                    <input type="hidden" name="idmoneda2" id="idmoneda2" value="1">
                    <input type="hidden" name="idcotizaciondetalle" id="idcotizaciondetalle" value="<?= $idcotizaciondetalle; ?>">
                    <input type="hidden" name="idcotizacion" id="idcotizacion" value="<?= $idcotizacion; ?>">
                    <input type="hidden" name="user" id="user" value="<?php echo $user; ?>">
                    <div class="form-group w96" style='margin-right: 3em; margin-top: 1em;'>
                    	<button type="submit" class="btn btn-primary pull-right " style='margin-right: 4em;'><i class="icon-save"></i>Guardar</button>
                	</div>

                </form>

            </div>
        </div>
    </div>
</div>
<hr></hr>
<div class="row-fluid">
<h5 class="label label-inverse arrowed-in-right arrowed closeL3 pull-right" style="cursor: pointer;" >Regresar</h5>
</div>
<hr></hr>
<a href="#" id="btn-scroll-up-03" class="btn-scroll-up btn btn-small btn-inverse">
    <i class="icon-double-angle-up icon-only bigger-110"></i>
</a>

<script typy="text/javascript">

jQuery(function($) {

	$("#preloaderPrincipal").show();

    var arrTC = [];

	var idcotizacion = <?= $idcotizacion ?>;
    var idcotizaciondetalle = <?= $idcotizaciondetalle ?>;

    var Origen =  "<?= $origen ?>";
    var Destino =  "<?= $destino ?>";

    $("#frmCotDet01").unbind("submit");
	$("#frmCotDet01").on("submit",function(event){
		event.preventDefault();

		if (validForm()){

            var arr = $("#idmoneda").val().split('-');
            $("#idmoneda").val(arr[0]);

		    var queryString = $(this).serialize();

            // alert(queryString);

			var IdCotDet = (idcotizaciondetalle==0?0:1)
            $.post(obj.getValue(0) + "data/", {o:72, t:IdCotDet, c:queryString, p:62, from:0, cantidad:0, s:''},
            function(json) {
            		if ( (idcotizaciondetalle > 0) || (json[0].msg == "OK") ){
            			alert("Datos guardados con éxito.");
                        $("#preloaderPrincipal").hide();
                        Regresar();
        			}else{
						$("#preloaderPrincipal").hide();
        				alert(json[0].msg);
        			}
        	}, "json");
		}else{
			$("#preloaderPrincipal").hide();
		}
	});


	function getCotizacion(idcotizaciondetalle){
		$("#preloaderPrincipal").show();
		$.post(obj.getValue(0) + "data/", {o:72, t:37, c:idcotizaciondetalle, p:54, from:0, cantidad:0,s:''},
			function(json){
				if (json.length>0){
                    
					$("#idmoneda").val(json[0].idmoneda);
                    $("#tipo_cambio").val(json[0].tipo_cambio);
                    $("#lote").val(json[0].lote);
                    $("#cantidad").val(json[0].cantidad);
                    $("#idunidadmedida").val(json[0].idunidadmedida);
                    $("#descripcion").val(json[0].descripcion);
                    $("#precio_unitario").val(json[0].precio_unitario);
                    $("#idporcentajeutilidad").val(json[0].idporcentajeutilidad);
                    $("#flete").val(json[0].flete);
                    $("#precio_venta").val(json[0].precio_venta);
                    $("#importe").val(json[0].importe);
                    
                    $("#title").html("Reg: " + json[0].idcotizacion);
					$("#preloaderPrincipal").hide();
                    $("#lote").focus();
                    
				}
		},'json');

	}


	$(".closeL3").on("click",function(event){
		event.preventDefault();
        Regresar();
	});

    function Regresar(){
        $("#preloaderPrincipal").hide();
        $(Destino).hide(function(){
            $(Destino).empty();
            $(Origen).show();
        });
        resizeScreen();
        return false;        
    }

	function validForm(){

        if( isNaN(parseInt($("#tipo_cambio").val())) ){
            alert("Faltan el Tipo de Cambio");
            $("#tipo_cambio").focus();
            return false;
        }

		if( isNaN(parseInt($("#cantidad").val())) ){
			alert("Faltan la Cantidad");
			$("#cantidad").focus();
			return false;
		}

        if( parseInt( $("#idunidadmedida").val(),0) <= 0){
            alert("Seleccione la Unidad de Medida");
            $("#idunidadmedida").focus();
            return false;
        }

        if( $("#descripcion").val().length <= 0){
            alert("Faltan la Descripción");
            $("#descripcion").focus();
            return false;
        }

        if( isNaN(parseInt( $("#precio_unitario").val())) ){
            alert("Faltan el Precio Unitario");
            $("#precio_unitario").focus();
            return false;
        }

        if( isNaN(parseInt( $("#idporcentajeutilidad").val()) ) ){
            alert("Seleccione el Porcentaje de Utilidad");
            $("#idporcentajeutilidad").focus();
            return false;
        }


		return true;

	}

    function getTipoCambio(){
        var nc = "u="+localStorage.nc;
        $("#idmoneda").empty();
        $.post(obj.getValue(0)+"data/", { o:10, t:87, p:51,c:nc,from:0,cantidad:0, s:"" },
            function(json){
                var init = true;
               $.each(json, function(i, item) {
                    var sel = item.predeterminado==1 ? "selected":"";
                    var tc  = item.predeterminado==1 ? item.tipo_cambio : 0.00;
                    $("#idmoneda").append('<option value="'+item.data+'" '+sel+'> '+item.label+' - '+item.tipo_cambio+'</option>');
                    if (init && tc > 0){
                        $("#tipo_cambio").val(tc);
                        init = false;
                    }
                });
                    getUnidadMedidas();
            }, "json"
        );
    }

    $("#idmoneda").on("change",function(event){
        event.preventDefault();
        var arr = $("#idmoneda option:selected").text().split('-');
        if ( $("#tipo_cambio").val() != arr[1] ){
            if ( !confirm("Desea cambiar el tipo de cambio "+$("#tipo_cambio").val()+" por este otro "+arr[1]+" ?") ){
                return false;
            }
        }
        $("#tipo_cambio").val(arr[1]);
    });

    function getUnidadMedidas(){
        var nc = "u="+localStorage.nc;
        $("#idunidadmedida").empty();
        $("#idunidadmedida").append('<option value="-1">Seleccione una opción</option>');
        $.post(obj.getValue(0)+"data/", { o:10, t:83, p:51,c:nc,from:0,cantidad:0, s:"" },
            function(json){
               $.each(json, function(i, item) {
                    $("#idunidadmedida").append('<option value="'+item.data+'"> '+item.label+'</option>');
                });
                    getPorcentajeutilidad();
            }, "json"
        );
    }

    function getPorcentajeutilidad(){
        var nc = "u="+localStorage.nc;
        $("#idporcentajeutilidad").empty();
        $("#idporcentajeutilidad").append('<option value="-1">Seleccione una opción</option>');
        $.post(obj.getValue(0)+"data/", { o:10, t:86, p:51,c:nc,from:0,cantidad:0, s:"" },
            function(json){
               $.each(json, function(i, item) {
                    var sel = item.predeterminado==1 ? "selected":"";
                    $("#idporcentajeutilidad").append('<option value="'+item.data+'" '+sel+'> '+item.label+'</option>');
                });
                if (idcotizaciondetalle<=0){
                    $("#title").html("Nuevo registro");
                    $("#lote").focus();
                }else{
                    $("#title").html("Editando el registro: "+idcotizaciondetalle);
                    getCotizacion(idcotizaciondetalle);
                }
                $("#preloaderPrincipal").hide();
            }, "json"
        );
    }

getTipoCambio();



});
</script>
