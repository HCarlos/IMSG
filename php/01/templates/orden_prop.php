<?php

include("includes/metas.php");

require_once("../oFunctions.php");
$F = oFunctions::getInstance();

require_once("../oCentura.php");
$f = oCentura::getInstance();

$user = $_POST['user'];
$idcontrolmaster  = $_POST['idcontrolmaster'];
$idempresa  = $_POST['idempresa'];
$origen  = $_POST['origen'];
$destino  = $_POST['destino'];

?>



<div class="widget-box" id="wdEmerAlu">

    <div class="widget-header header-color-blue">
        <h4 class="pull-left" id="title"></h4>
        <span class="widget-toolbar">
                <h5 class="label label-inverse arrowed-in-right arrowed closeFormUpload" style="cursor: pointer;" >Regresar</h5>
        </span>
    </div>

    <div class="widget-body">
        <div class="widget-main">
            <div class="row-fluid">

                <form id="frmCM01"  class="form wd100prc">

                    <table class="wd100prc">

                        <tr>
                            <td class="wd10prc"><label for="search_empresa">Empresa</label></td>
                            <td colspan="7" class="wd50prc">
                                <span class="add-on"><i class="icon-asterisk red"></i></span>
                                <input class="input-large form-control altoMoz wd90prc" id="search_empresa" name="search_empresa" type="text" placeholder="Empresa" autofocus>
                            </td>
                            <td class="wd05prc ocultaStatus"><label for="status">Status</label></td>
                            <td class="wd35prc ocultaStatus">
                                <select class="form-control altoMoz"  name="status" id="status" size="1" style="width: 120px !important;">
                                </select>
                            </td>
                        </tr>

                        <tr class="bodyFrom">
                            <td class="wd10prc"><label for="idcliente">Contacto</label></td>
                            <td colspan="7" class="wd70prc">
                                <span class="add-on"><i class="icon-asterisk red"></i></span>
                                <select class="form-control wd90prc"  name="idcliente" id="idcliente" size="1" />
                            </td>
                            <td class="wd05prc ocultaStatus"><label>Fecha</label></td>
                            <td class="wd35prc ocultaStatus" id="fechayhora">
                            </td>
                        </tr>

                        <tr class="bodyFrom">
                            <td class="wd10prc"><label for="idtecnico">Técnico</label></td>
                            <td colspan="7" class="wd70prc">
                                <span class="add-on"><i class="icon-asterisk red"></i></span>
                                <select class="form-control wd90prc"  name="idtecnico" id="idtecnico" size="1" />
                            </td>
                            <td class="wd05prc ocultaStatus"><label for="folmod">Fol. Mod.:</label></td>
                            <td class="wd35prc ocultaStatus">
                                <input type="number" id="folmod" name="folmod" class="form-control altoMoz"style="width: 120px !important;" min="1" max="99999">
                            </td>
                        </tr>

                        <tr class="bodyFrom">
                            <td class="wd10prc"><label for="idrecibio">Recibió</label></td>
                            <td colspan="7" class="wd70prc">
                                <span class="add-on"><i class="icon-asterisk red"></i></span>
                                <select class="form-control wd90prc"  name="idrecibio" id="idrecibio" size="1" />
                            </td>
                            <td colspan="2" ></td>
                        </tr>

                        <tr class="bodyFrom">
                            <td class="wd10prc"><label for="idmodulo">Marca</label></td>
                            <td colspan="7" class="wd70prc">
                                <span class="add-on"><i class="icon-asterisk red"></i></span>
                                <select class="form-control wd90prc"  name="idmodulo" id="idmodulo" size="1" />
                            </td>
                            <td colspan="2" ></td>
                        </tr>

                        <tr class="bodyFrom wd100prc borderTopBottom ">
                            <td class="wd05prc"><label for="garantia">Garantía</label></td>
                            <td class="wd15prc">
                                <input name="garantia" id="garantia" class="ace ace-switch ace-switch-6" type="checkbox">
                                <span class="lbl"></span>
                            </td>
                            <td class="wd05prc"><label for="contrato">Contrato</label></td>
                            <td class="wd15prc">
                                <input name="contrato" id="contrato" class="ace ace-switch ace-switch-6" type="checkbox">
                                <span class="lbl"></span>
                            </td>
                            <td class="wd15prc"><label for="tipox">Carry In</label></td>
                            <td class="wd05prc">
                                <input name="tipox" id="tipox" class="ace ace-switch ace-switch-6" type="checkbox" checked>
                                <span class="lbl"></span>
                            </td>
                            <td class="wd15prc"><label for="mantto" class="marginLeft2em textRight">Mto. Correctivo</label></td>
                            <td class="wd05prc">
                                <input name="mantto" id="mantto" class="ace ace-switch ace-switch-6" type="checkbox">
                                <span class="lbl"></span>
                            </td>
                            <td class="wd05prc"><label for="status_master" class="marginLeft2em textRight">Activo</label></td>
                            <td class="wd15prc">
                                <input name="status_master" id="status_master" class="ace ace-switch ace-switch-6" type="checkbox" checked>
                                <span class="lbl"></span>
                            </td>
                        </tr>



                    </table>


                    <input type="hidden" name="idcontrolmaster" id="idcontrolmaster" value="<?= $idcontrolmaster; ?>">
                    <input type="hidden" name="idempresa" id="idempresa" value="<?php echo $idempresa; ?>">
                    <input type="hidden" name="user" id="user" value="<?php echo $user; ?>">
                    <div class="form-group w96" style='margin-right: 3em; margin-top: 1em;'>
                    	<button type="submit" class="btn btn-primary pull-right bodyFrom" style='margin-right: 4em;'><i class="icon-save"></i>Guardar</button>
                	</div>

                </form>

            </div>
        </div>
    </div>
</div>
<hr></hr>
<div class="widget-box wbCDetalle" id="wdCDetalle01">

    <div class="widget-header header-color-orange">
        <h5>EQUIPO(S)</h5>

        <div class="widget-toolbar">
            <a href="#" data-action="settings"  id="btnAddCDetalleProp">
                <i class="icon-plus"></i>
            </a>

            <a href="#" title="" data-original-title="" class="ui-pg-button ui-state-disabled" style="width:5px;">
                <span class="ui-separator marginLeft1em"></span>
            </a>

            <a href="#" data-action="reload" id="btnRefreshCDetalleProp">
                <i class="icon-refresh"></i>
            </a>

            <a href="#" title="" data-original-title="" class="ui-pg-button ui-state-disabled" style="width:5px;">
                <span class="ui-separator marginLeft1em"></span>
            </a>

            <a href="#" data-action="collapse">
                <i class="icon-chevron-up"></i>
            </a>

        </div>
    </div>
    <div class="widget-body">
        <div class="widget-main">
            <div class="row-fluid">
                    <table class="table wd100prc" id="tblCDetalle">
                        <thead>
                            <th>EQUIPO</th>
                            <th>MARCA</th>
                            <th>MODELO</th>
                            <th>SERIE</th>
                            <th>NO. PARTE</th>
                            <th>VERSION</th>
                            <th>SUBMODELO</th>
                            <th>NUM_PEDIDO</th>
                            <th></th>
                        </thead>
                        <tbody></tbody>
                    </table>
            </div>
        </div>
    </div>
</div>
<hr></hr>
<div class="widget-box wbCFallas" id="wdCDetalles02">

    <div class="widget-header header-color-green">
        <h5>DETALLES DEL SERVICIO</h5>

        <div class="widget-toolbar">

            <a href="#" data-action="settings" class="btn btn-minier btn-yellow" id="btnAddCDetalles02Prop">
                Guardar
            </a>
            

            <a href="#" title="" data-original-title="" class="ui-pg-button ui-state-disabled" style="width:5px;">
                <span class="ui-separator marginLeft1em"></span>
            </a>

            <a href="#" data-action="collapse">
                <i class="icon-chevron-up"></i>
            </a>

        </div>
    </div>
    <div class="widget-body">
        <div class="widget-main">
            <div class="row-fluid">
                <div class="form-group">
                    <label for="falla" class="col-lg-2 control-label">Falla</label>
                    <div class="col-lg-10">
                        <textarea class="form-control wd100prc" rows="2" id="falla" name="falla"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="accesorios" class="col-lg-2 control-label">Accesorios</label>
                    <div class="col-lg-10">
                        <textarea class="form-control wd100prc" rows="2" id="accesorios" name="accesorios"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="trabajo" class="col-lg-2 control-label">Trabajo</label>
                    <div class="col-lg-10">
                        <textarea class="form-control wd100prc" rows="2" id="trabajo" name="trabajo"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="observaciones" class="col-lg-2 control-label">Observaciones</label>
                    <div class="col-lg-10">
                        <textarea class="form-control wd100prc" rows="1" id="observaciones" name="observaciones"></textarea>
                    </div>
                </div>
                
                <!--
                <div class="form-group">
                    <label for="comment" class="col-lg-2 control-label">Comentarios</label>
                    <div class="col-lg-10">
                        <textarea class="form-control wd100prc" rows="1" id="comment" name="comment"></textarea>
                    </div>
                </div>
                -->

            </div>
        </div>
    </div>
</div>
<hr></hr>
<div class="widget-box wbCCostos" id="wdCCostos01">

    <div class="widget-header header-color-purple">
        <h5>COSTO DEL SERVICIO</h5>

        <div class="widget-toolbar">
            <a href="#" data-action="settings"  id="btnAddCCostoProp">
                <i class="icon-plus"></i>
            </a>

            <a href="#" title="" data-original-title="" class="ui-pg-button ui-state-disabled" style="width:5px;">
                <span class="ui-separator marginLeft1em"></span>
            </a>

            <a href="#" data-action="reload" id="btnRefreshCCostoProp">
                <i class="icon-refresh"></i>
            </a>

            <a href="#" title="" data-original-title="" class="ui-pg-button ui-state-disabled" style="width:5px;">
                <span class="ui-separator marginLeft1em"></span>
            </a>

            <a href="#" data-action="collapse">
                <i class="icon-chevron-up"></i>
            </a>

        </div>
    </div>
    <div class="widget-body">
        <div class="widget-main">
            <div class="row-fluid">
                    <table class="table wd100prc" id="tblCCosto">
                        <thead>
                            <th class="textRight">CANTIDAD</th>
                            <th>CODIGO</th>
                            <th class="textRight">PRECIO UNITARIO</th>
                            <th class="textRight">SUBTOTAL</th>
                            <th class="textRight">IVA</th>
                            <th class="textRight">VIÁTICOS</th>
                            <th class="textRight">IMPORTE</th>
                            <th></th>
                        </thead>
                        <tbody></tbody>
                        <tfoot style="background-color: #CCCCCC;">
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td class="textRight" ><b>SUBTOTAL:</b></td>
                                <td class="textRight" id="tdSubtotal"></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td class="textRight" ><b>IVA:</b></td>
                                <td class="textRight" id="tdIva"></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td class="textRight" ><b>VIÁTICOS:</b></td>
                                <td class="textRight" id="tdViatico"></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td class="textRight" ><b>TOTAL:</b></td>
                                <td class="textRight" id="tdTotal"></td>
                                <td>&nbsp;</td>
                            </tr>
                        </tfoot>
                    </table>
            </div>
        </div>
    </div>
</div>
<hr></hr>
<div class="row-fluid">
<h5 class="label label-inverse arrowed-in-right arrowed closeFormUpload pull-right" style="cursor: pointer;" >Regresar</h5>
</div>
<hr></hr>
<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
    <i class="icon-double-angle-up icon-only bigger-110"></i>
</a>

<script typy="text/javascript">

jQuery(function($) {

    var data = [];

	$("#preloaderPrincipal").show();
    $(".ocultaStatus").hide();
    $(".wbCDetalle").hide();
    $(".wbCFallas").hide();
    $(".wbCCostos").hide();

	var IdControlMaster = <?= $idcontrolmaster ?>;
    var IdEmpresa = <?= $idempresa ?>;
    var Origen =  "<?= $origen ?>";
    var Destino =  "<?= $destino ?>";

    if ( IdControlMaster == 0  ){
        $("#title").html("Nuevo registro");
        $(".bodyFrom").hide();
        getEmpresas();
        $("#search_empresa").focus();
    }else{
        $( "#search_empresa" ).prop("disabled",true);
        getClientes(IdEmpresa);
    }


    $("#frmCM01").unbind("submit");
	$("#frmCM01").on("submit",function(event){
		event.preventDefault();

		if (validForm()){

            $("#idempresa").val(IdEmpresa);

		    var queryString = $(this).serialize();

			var IdMaster = (IdControlMaster==0?0:1)
            $.post(obj.getValue(0) + "data/", {o:70, t:IdMaster, c:queryString, p:62, from:0, cantidad:0, s:''},
            function(json) {
                    //IdControlMaster = parseInt(json[0].msg,0);
            		if ( (IdControlMaster > 0) || (json[0].msg == "OK") ){
            			alert("Datos guardados con éxito.");
                        $(".wbCDetalle").show();
                        $(".wbCFallas").show();
                        $(".wbCCostos").show();                        
                        getOrdenDetalle(IdControlMaster);
        			}else{
						$("#preloaderPrincipal").hide();
        				alert(json[0].msg);
        			}
        	}, "json");
		}else{
			$("#preloaderPrincipal").hide();
		}
	});

    $("#btnAddCDetalles02Prop").on("click",function(event){
        event.preventDefault();
        $("#preloaderPrincipal").show();

        var cDatos = "u="+localStorage.nc+
                     "&idcontrolmaster="+IdControlMaster+
                     "&falla="+$("#falla").val()+
                     "&accesorios="+$("#accesorios").val()+
                     "&observaciones="+$("#observaciones").val()+
                     "&trabajo="+$("#trabajo").val();

                     // "&comment="+$("#comment").val()

        $.post(obj.getValue(0) + "data/", {o:70, t:6, c:cDatos, p:52, from:0, cantidad:0, s:''},
        function(json) {
            if ( json[0].msg == "OK" ){
                alert("Datos guardados con éxito.");
                $("#preloaderPrincipal").hide();
            }else{
                $("#preloaderPrincipal").hide();
                alert(json[0].msg);
            }
        }, "json");

    });


	function getOrden(IdControlMaster){
		$("#preloaderPrincipal").show();
		$.post(obj.getValue(0) + "data/", {o:70, t:15, c:IdControlMaster, p:54, from:0, cantidad:0,s:''},
			function(json){
				if (json.length>0){
                    
                    $(".wbCDetalle").show();
                    $(".wbCFallas").show();
                    $(".wbCCostos").show();                        
                    $(".ocultaStatus").show();

					$("#search_empresa").val(json[0].empresa);
                    $("#idcliente").val(json[0].idcliente);
                    $("#idtecnico").val(json[0].idtecnico);
                    $("#idrecibio").val(json[0].idrecibio);
                    $("#idmodulo").val(json[0].idmodulo);
                    $("#status").val(json[0].status);
                    //$("#fentrada").html(json[0].fentrada);
                    $("#fechayhora").dateToSpanish(json[0].fentrada,json[0].hora,0);
                    $("#garantia").prop("checked",json[0].garantia==1?true:false);
                    $("#contrato").prop("checked",json[0].contrato==1?true:false);
                    $("#tipox").prop("checked",json[0].tipo==1?true:false);
                    $("#mantto").prop("checked",json[0].mantto==1?true:false);
                    $("#status_master").prop("checked",json[0].status_master==1?true:false);

                    $("#folmod").val(json[0].folmod);
                    $("#falla").val(json[0].falla);
                    $("#accesorios").val(json[0].accesorios);
                    $("#observaciones").val(json[0].observaciones);
                    $("#trabajo").val(json[0].trabajo);
                    
                    // $("#comment").val(json[0].comment);

                    $("#title").html("Reg: " + json[0].idcontrolmaster);
					$("#preloaderPrincipal").hide();
                    getOrdenDetalle(IdControlMaster);
                    getOrdenCostos(IdControlMaster);
                    $("#idcliente").focus();
                    
				}
		},'json');

	}


	// close Form
	$(".closeFormUpload").on("click",function(event){
		event.preventDefault();
		$("#preloaderPrincipal").hide();
		$(Destino).hide(function(){
			$(Destino).empty();
			$(Origen).show();
		});
		resizeScreen();
		return false;
	});

	function validForm(){

		// if($("#rfc").val().length <= 0){
		// 	alert("Faltan el RFC");
		// 	$("#rfc").focus();
		// 	return false;
		// }

		return true;

	}

    $.widget( "custom.catcomplete", $.ui.autocomplete, {
        _renderMenu: function( ul, items ) {
            var that = this,
            currentCategory = "";
            $.each( items, function( index, item ) {
                if ( item.category != currentCategory ) {
                    ul.append( "<li class='ui-autocomplete-category' id='act-"+item.idcliente+"' >" + item.category + "</li>" );
                    currentCategory = item.category;
                }
                that._renderItemData( ul, item );
            });
        }
    
    });

    function getEmpresas(){
        var nc = "u="+localStorage.nc;
        $.ajax({ url: obj.getValue(0)+"data/",
            data: { o:70, t:16, p:54,c:nc,from:0,cantidad:0, s:"" },
            dataType: "json",
            type: "POST",
            success: function(json){
               $.each(json, function(i, item) {
                    // idcliente: item.idrepresentantelegal, 
                    if ( item.empresa == null ){
                        console.log(item.empresa);
                    }else{
                        data[i]={ 
                                label: item.empresa , 
                                category: "Empresa", 
                                idempresa: item.idempresa
                            };
                    };
                });
                $( "#search_empresa" ).catcomplete({
                    delay: 0,
                    source: data,
                    autoFocus: true,
                    select: function(event, ui) { 
                        if (ui.item){

                            IdEmpresa = ui.item.idempresa;
                            $(".bodyFrom").show();
                            $(".ocultaStatus").show();

                            getClientes(IdEmpresa);

                            console.log(ui.item.idrepresentantelegal);
                        }
                    },
                    open: function() {
                        $('.ui-autocomplete-categorya').next('.ui-menu-item').addClass('ui-first');
                    }                   
                });
                $("#search_empresa").focus();
                $("#preloaderPrincipal").hide();
            }
        });
    
    }


    function getClientes(IdEmpresa){
        var nc = "u="+localStorage.nc;
        $("#idcliente").empty();
        $.post(obj.getValue(0)+"data/", { o:1, t:78, p:51,c:IdEmpresa,from:0,cantidad:0, s:"" },
            function(json){
               $.each(json, function(i, item) {
                    $("#idcliente").append('<option value="'+item.data+'"> '+item.label+'</option>');
                });
                getTecnicos(IdEmpresa);
            }, "json"
        );
    }

    function getTecnicos(IdEmpresa){
        var nc = "u="+localStorage.nc;
        $("#idtecnico").empty();
        $.post(obj.getValue(0)+"data/", { o:1, t:79, p:51,c:IdEmpresa,from:0,cantidad:0, s:"" },
            function(json){
               $.each(json, function(i, item) {
                    $("#idtecnico").append('<option value="'+item.data+'"> '+item.label+'</option>');
                });
                getRecibio(IdEmpresa);
            }, "json"
        );
    }

    function getRecibio(IdEmpresa){
        var nc = "u="+localStorage.nc;
        $("#idrecibio").empty();
        $.post(obj.getValue(0)+"data/", { o:1, t:79, p:51,c:IdEmpresa,from:0,cantidad:0, s:"" },
            function(json){
               $.each(json, function(i, item) {
                    $("#idrecibio").append('<option value="'+item.data+'"> '+item.label+'</option>');
                });
                getMarcas(IdEmpresa);
            }, "json"
        );
    }

    function getMarcas(IdEmpresa){
        var nc = "u="+localStorage.nc;
        $("#idmodulo").empty();
        $.post(obj.getValue(0)+"data/", { o:1, t:80, p:51,c:nc,from:0,cantidad:0, s:"" },
            function(json){
               $.each(json, function(i, item) {
                    $("#idmodulo").append('<option value="'+item.data+'"> '+item.label+'</option>');
                });
                getColores(IdEmpresa);
            }, "json"
        );
    }

    function getColores(IdEmpresa){
        var nc = "u="+localStorage.nc;
        $("#status").empty();
        $.post(obj.getValue(0)+"data/", { o:1, t:81, p:51,c:nc,from:0,cantidad:0, s:"" },
            function(json){
               $.each(json, function(i, item) {
                    $("#status").append('<option value="'+item.data+'">'+item.label+'</option>');
                });
                if (IdControlMaster > 0){
                    getOrden(IdControlMaster);    
                    getOrdenDetalle(IdControlMaster);    
                    getOrdenCostos(IdControlMaster);    

                }
            }, "json"
        );
    }


// MODULO DE DETALLES 

    function getOrdenDetalle(IdControlMaster){
        var nc = "u="+localStorage.nc+"&idcontrolmaster="+IdControlMaster;
        // alert(nc);
        $("#tblCDetalle > tbody").empty();
        $.post(obj.getValue(0)+"data/", { o:70, t:17, p:54,c:nc,from:0,cantidad:0, s:"" },
            function(json){
                var tbdy = "";
                var totalItem = json.length;

                if ( totalItem >= 3 ){
                    $("#btnAddCDetalleProp").hide();
                }else{
                    $("#btnAddCDetalleProp").show();                    
                }

               $.each(json, function(i, item) {
                    tbdy +='<tr>';
                    tbdy +='    <td>'+item.equipo+'</td>';
                    tbdy +='    <td>'+item.marca+'</td>';
                    tbdy +='    <td>'+item.modelo+'</td>';
                    tbdy +='    <td>'+item.serie+'</td>';
                    tbdy +='    <td>'+item.no_parte+'</td>';
                    tbdy +='    <td>'+item.version+'</td>';
                    tbdy +='    <td>'+item.submodelo+'</td>';
                    tbdy +='    <td>'+item.num_pedido+'</td>';
                    tbdy +='    <td>';
                    tbdy +='        <div class="visible-desktop action-buttons">';
                    tbdy +='            <a class="green modCD" href="#" id="modCD-'+item.iddetalle+'" >';
                    tbdy +='                <i class="icon-pencil bigger-130"></i>';
                    tbdy +='            </a>';
                    if (totalItem > 1){
                        tbdy +='';
                        tbdy +='            <a class="red delCD" href="#"  id="delCD-'+item.iddetalle+'" >';
                        tbdy +='                <i class="icon-trash bigger-130"></i>';
                        tbdy +='            </a>';
                    }
                    tbdy +='        </div>';
                    tbdy +='    </td>';
                    tbdy +='</tr>';
                });
                $('#tblCDetalle > tbody').html(tbdy);

                $(".modCD").on("click",function(event){
                    event.preventDefault();
                    var arr = event.currentTarget.id.split('-');
                    getCDetalleProp(arr[1],IdControlMaster);
                });

                $(".delCD").on("click",function(event){
                    event.preventDefault();
                    var resp =  confirm("Desea eliminar este registro?");
                    if (resp){
                        var arr = event.currentTarget.id.split('-');
                        //alert(arr[1]);
                        $.post(obj.getValue(0) + "data/", {o:70, t:5, c:arr[1], p:52, from:0, cantidad:0, s:''},
                        function(json) {
                                if (json[0].msg=="OK"){
                                    getOrdenDetalle(IdControlMaster);
                                }else{
                                    alert(json[0].msg);
                                }
                        }, "json");
                    }

                });


            }, "json"
        );
    }

    $("#btnRefreshCDetalleProp").on("click",function(event){
        event.preventDefault();
        getOrdenDetalle(IdControlMaster);
    })

    $("#btnAddCDetalleProp").on("click",function(event){
        event.preventDefault();
        getCDetalleProp(0,IdControlMaster);
    })

    function getCDetalleProp(IdDetalle, IdControlMaster){
        $("#divUploadImage").empty();
        var nc = localStorage.nc;
        $.post(obj.getValue(0) + "orden-detalle-prop/", {
                user: nc,
                iddetalle: IdDetalle,
                idcontrolmaster: IdControlMaster
            },
            function(html) {
                $("#divUploadImage").html(html);
                $("#divUploadImage").modal('toggle');
        }, "html");
    }


// MODULO DE COSTOS 


    function getOrdenCostos(IdControlMaster){
        var nc = "u="+localStorage.nc+"&idcontrolmaster="+IdControlMaster;
        $("#tblCCosto > tbody").empty();
        $.post(obj.getValue(0)+"data/", { o:70, t:19, p:54,c:nc,from:0,cantidad:0, s:"" },
            function(json){

                var lSubtotal = 0.00; 
                var lIva = 0.00; 
                var lViatico = 0.00; 
                var lTotal = 0.00;
                var tbdy = "";
                var totalItem = json.length;

                if ( totalItem >= 4 ){
                    $("#btnAddCCostoProp").hide();
                }else{
                    $("#btnAddCCostoProp").show();                    
                }

               $.each(json, function(i, item) {
                    tbdy +='<tr>';
                    tbdy +='    <td class="textRight">'+commaSeparateNumber( parseFloat(item.cantidad).toFixed(2) )+'</td>';
                    tbdy +='    <td>'+item.codigo+'</td>';
                    tbdy +='    <td class="textRight">'+commaSeparateNumber( parseFloat(item.precio_unitario).toFixed(2) )+'</td>';
                    tbdy +='    <td class="textRight">'+commaSeparateNumber( parseFloat(item.subtotal).toFixed(2) )+'</td>';
                    tbdy +='    <td class="textRight">'+commaSeparateNumber( parseFloat(item.iva).toFixed(2) )+'</td>';
                    tbdy +='    <td class="textRight">'+commaSeparateNumber( parseFloat(item.viaticos).toFixed(2) )+'</td>';
                    tbdy +='    <td class="textRight">'+commaSeparateNumber( parseFloat(item.importe).toFixed(2) )+'</td>';
                    tbdy +='    <td class="textRight">';
                    tbdy +='        <div class="visible-desktop action-buttons">';
                    tbdy +='            <a class="green modCC" href="#" id="modCC-'+item.idimporte+'" >';
                    tbdy +='                <i class="icon-pencil bigger-130"></i>';
                    tbdy +='            </a>';
                    if (totalItem > 1){
                        tbdy +='';
                        tbdy +='            <a class="red delCC" href="#"  id="delCC-'+item.idimporte+'" >';
                        tbdy +='                <i class="icon-trash bigger-130"></i>';
                        tbdy +='            </a>';
                    }
                    tbdy +='        </div>';
                    tbdy +='    </td>';
                    tbdy +='</tr>';

                    lSubtotal += parseFloat(item.subtotal);
                    lIva      += parseFloat(item.iva);
                    lViatico  += parseFloat(item.viaticos);
                    lTotal    += parseFloat(item.importe);

                });
                $('#tblCCosto > tbody').html(tbdy);

                $("#tdSubtotal").html( commaSeparateNumber(lSubtotal.toFixed(2)) );
                $("#tdIva").html( commaSeparateNumber(lIva.toFixed(2)) );
                $("#tdViatico").html( commaSeparateNumber(lViatico.toFixed(2)) );
                $("#tdTotal").html("<h5><b>" + commaSeparateNumber(lTotal.toFixed(2)) + "</b></h5>" );

                $(".modCC").on("click",function(event){
                    event.preventDefault();
                    var arr = event.currentTarget.id.split('-');
                    getCCostoProp(arr[1],IdControlMaster);
                });

                $(".delCC").on("click",function(event){
                    event.preventDefault();
                    var resp =  confirm("Desea eliminar este registro?");
                    if (resp){
                        var arr = event.currentTarget.id.split('-');
                        //alert(arr[1]);
                        $.post(obj.getValue(0) + "data/", {o:70, t:7, c:arr[1], p:52, from:0, cantidad:0, s:''},
                        function(json) {
                                if (json[0].msg=="OK"){
                                    getOrdenCostos(IdControlMaster);
                                }else{
                                    alert(json[0].msg);
                                }
                        }, "json");
                    }

                });


            }, "json"
        );
    }

    $("#btnRefreshCCostoProp").on("click",function(event){
        event.preventDefault();
        getOrdenCostos(IdControlMaster);
    })

    $("#btnAddCCostoProp").on("click",function(event){
        event.preventDefault();
        getCCostoProp(0,IdControlMaster);
    })

    function getCCostoProp(IdImporte, IdControlMaster){
        $("#divUploadImage").empty();
        var nc = localStorage.nc;
        $.post(obj.getValue(0) + "orden-costo-prop/", {
                user: nc,
                idimporte: IdImporte,
                idcontrolmaster: IdControlMaster
            },
            function(html) {
                $("#divUploadImage").html(html);
                $("#divUploadImage").modal('toggle');
        }, "html");
    }


});
</script>
