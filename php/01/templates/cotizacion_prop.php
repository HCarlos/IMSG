<?php

include("includes/metas.php");

require_once("../oFunctions.php");
$F = oFunctions::getInstance();

require_once("../oCentura.php");
$f = oCentura::getInstance();

$user         = $_POST['user'];
$idcotizacion = $_POST['idcotizacion'];
$origen       = $_POST['origen'];
$destino      = $_POST['destino'];

?>

<div class="widget-box" id="wdCotiza">

    <div class="widget-header header-color-blue">
        <h4 class="pull-left" id="title"></h4>
        <span class="widget-toolbar">
                <h5 class="label label-inverse arrowed-in-right arrowed closeFormUpload" style="cursor: pointer;" >Regresar</h5>
        </span>
    </div>

    <div class="widget-body">
        <div class="widget-main">
            <div class="row-fluid">

                <form id="frmCot01"  class="form wd100prc">

                    <table class="wd100prc">

                        <tr>
                            <td class="wd10prc"><label for="persona">Empresa</label></td>
                            <td colspan="7" class="wd50prc">
                                <input type="text" id="empresa" name="empresa" class="form-control altoMoz" />
                            </td>
                        </tr>

                        <tr>
                            <td class="wd10prc"><label for="persona">Contacto</label></td>
                            <td colspan="7" class="wd70prc">
                                <input type="text" id="persona" name="persona" class="form-control altoMoz" />
                            </td>
                        </tr>

                        <tr>
                            <td class="wd10prc"><label for="fecha">Fecha</label></td>
                            <td colspan="7" class="wd70prc">
                                <input type="text" id="fecha" name="fecha" class="form-control altoMoz" />
                            </td>
                        </tr>

                    </table>

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
<div class="widget-box" >

    <div class="widget-header header-color-orange">
        <h5>COTIZACIONES MAS RECIENTES</h5>

        <div class="widget-toolbar wdCotizacion action-buttons">
            <a href="#" data-action="settings" id="btnAddCotizacionProp" title="Agregar nuevo item">
                <i class="icon-plus purple bigger-110"></i>
            </a>

            <a href="#" class="ui-pg-button ui-state-disabled" style="width:5px;">
                <span class="ui-separator marginLeft1em"></span>
            </a>

            <a href="#" data-action="reload" id="btnRefreshCCotizacionProp" title="Actualizar tabla">
                <i class="icon-refresh green bigger-110"></i>
            </a>

            <a href="#" class="ui-pg-button ui-state-disabled" style="width:5px;">
                <span class="ui-separator marginLeft1em"></span>
            </a>

            <a href="#" id="btnPrintCot" title="Imprimir Cotización">
                <i class="icon-print cafe bigger-110"></i>
            </a>

            <a href="#" data-action="collapse" title="Minimizar este panel">
                <i class="icon-chevron-up bigger-110"></i>
            </a>

        </div>
    </div>
    <div class="widget-body">
        <div class="widget-main">
            <div class="row-fluid">

                <div class="borderTopContainer">
                    <div id="user-profile-1" class="user-profile row-fluid">
                        <div id="sample-table-2_wrapper" class="dataTables_wrapper" role="grid">
                            <table class="table wd100prc table table-striped table-bordered table-hover dataTable" id="tblCDetalle" aria-describedby="sample-table-2_info">
                                <thead>
                                    <tr role="row">
                                        <th aria-label="id: activate to sort column ascending" style="width: 100px;" colspan="1" rowspan="1" aria-controls="tblCDetalle" tabindex="3" role="columnheader" class="sorting textRight">
                                            <small>
                                                <label class="pull-left">
                                                    <input class="ace" type="checkbox" id="idChK">
                                                    <span class="lbl">  ID</span>
                                                </label>
                                            </small>
                                        </th>
                                        <th aria-label="lote: activate to sort column ascending" style="width: 50px;" colspan="1" rowspan="1" aria-controls="tblCDetalle" tabindex="1" role="columnheader" class="sorting" >LOTE</th>
                                        <th aria-label="tipo_cambio: activate to sort column ascending" style="width: 75px;" colspan="1" rowspan="1" aria-controls="tblCDetalle" tabindex="2" role="columnheader" class="sorting">TC</th>
                                        <th aria-label="cantidad: activate to sort column ascending" style="width: 25px;" colspan="1" rowspan="1" aria-controls="tblCDetalle" tabindex="3" role="columnheader" class="sorting textRight">CANT</th>
                                        <th aria-label="unidad_medida: activate to sort column ascending" style="width: 75px;" colspan="1" rowspan="1" aria-controls="tblCDetalle" tabindex="4" role="columnheader" class="sorting">U.M.</th>
                                        <th aria-label="descripcion: activate to sort column ascending" colspan="1" rowspan="1" aria-controls="tblCDetalle" tabindex="5" role="columnheader" class="sorting">DESCRIPCION</th>
                                        <th aria-label="precio_unitario: activate to sort column ascending" style="width: 75px;" colspan="1" rowspan="1" aria-controls="tblCDetalle" tabindex="3" role="columnheader" class="sorting textRight">P.U</th>
                                        <th aria-label="importe: activate to sort column ascending" style="width: 75px;" colspan="1" rowspan="1" aria-controls="tblCDetalle" tabindex="3" role="columnheader" class="sorting textRight">IMPORTE</th>
                                        <th style="width: 75px;"></th>
                                    </tr>
                                </thead>
                                <tbody aria-relevant="all" aria-live="polite" role="alert"></tbody>
                                <tfoot class="header-color-orange">
                                    <tr>
                                        <th colspan="7">
                                            <span class="pull-left" style="height: 1em; margin-top: -0.25em;">
                                                <form class="form-search" action="#">
                                                    <select name="idmodenaCotProp" id="idmodenaCotProp" size="1" style="width: 100px;" />
                                                    <button type="button" id="btnAplicaTipoCambio" class="btn btn-purple btn-minier">
                                                        Aplicar
                                                        <i class="icon-ok icon-on-right bigger-110"></i>
                                                    </button>
                                                </form>                                
                                            </span>
                                            <span class="pull-right">
                                                SUBTOTAL $
                                            </span>
                                        </th>
                                        <th class="textRight" id="xSubtotal"></th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th colspan="7" class="textRight">IVA 16% $</th>
                                        <th class="textRight" id="xIVA"></th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th colspan="7" class="textRight">TOTAL $</th>
                                        <th class="textRight" id="xTotal"></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>    
                    </div>            
                </div>
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


	$("#preloaderPrincipal").show();

	var idcotizacion = <?= $idcotizacion ?>;
    var Origen       =  "<?= $origen ?>";
    var Destino      =  "<?= $destino ?>";
    var User         =  "<?= $user ?>";


    var oTable;

    function getTable(){

        oTable = $('#tblCDetalle').dataTable({
            "oLanguage": {
                            "sLengthMenu": "_MENU_ registros por página",
                            "oPaginate": {
                                            "sPrevious": "Prev",
                                            "sNext": "Next"
                                         },
                            "sSearch": "Buscar",
                            "sProcessing":"Procesando...",
                            "sLoadingRecords":"Cargando...",
                            "sZeroRecords": "No hay registros",
                            "sInfo": "_START_ - _END_ de _TOTAL_ registros",
                            "sInfoEmpty": "No existen datos",
                            "sInfoFiltered": "(De _MAX_ registros)"
                        },
            "aaSorting": [[ 0, "desc" ]],
            "aoColumns": [ null, null, null, null, null, null, null, null,  { "bSortable": false }],
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
            "bRetrieve": true,
            "bDestroy": false
        });
    }

    var init = true;

    if ( idcotizacion == 0  ){
        $("#title").html("Nuevo registro");
        $("#preloaderPrincipal").hide();

    }else{
        $("#title").html("Editantando la cotiación "+idcotizacion);
        getCotizacion(idcotizacion);
    }

    $("#frmCot01").unbind("submit");
	$("#frmCot01").on("submit",function(event){
		event.preventDefault();

		if (validForm()){

		    var queryString = $(this).serialize();

			var IdCot = (idcotizacion==0?0:1)
            $.post(obj.getValue(0) + "data/", {o:71, t:IdCot, c:queryString, p:62, from:0, cantidad:0, s:''},
            function(json) {
                    //idcotizacion = parseInt(json[0].msg,0);
            		if ( (idcotizacion > 0) || (json[0].msg == "OK") ){
            			alert("Datos guardados con éxito.");
                        $(".wdCotizacion").show();
                        $("#preloaderPrincipal").hide();
        			}else{
						$("#preloaderPrincipal").hide();
        				alert(json[0].msg);
        			}
        	}, "json");
		}else{
			$("#preloaderPrincipal").hide();
		}
	});


	function getCotizacion(idcotizacion){
		$("#preloaderPrincipal").show();
		$.post(obj.getValue(0) + "data/", {o:71, t:35, c:idcotizacion, p:54, from:0, cantidad:0,s:''},
			function(json){
				if (json.length>0){
                    
                    $(".wdCotizacion").show();

					$("#empresa").val(json[0].empresa);
                    $("#persona").val(json[0].persona);
                    $("#fecha").val(json[0].fecha);
                    
                    $("#title").html("Reg: " + json[0].idcotizacion);
					$("#preloaderPrincipal").hide();

                    getCotDetList(idcotizacion);

                    $("#persona").focus();
                    
				}
		},'json');

	}

    function getTotales(idcotizacion){
        $.post(obj.getValue(0) + "data/", {o:71, t:38, c:idcotizacion, p:54, from:0, cantidad:0,s:''},
            function(json){
                if (json.length>0){
                    
                    $("#xSubtotal").html(commaSeparateNumber(json[0].subtotal));
                    $("#xIVA").html(commaSeparateNumber(json[0].iva));
                    $("#xTotal").html(commaSeparateNumber(json[0].total));
                    
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

		if($("#persona").val().length <= 0){
			alert("Faltan el Nombre del Contacto");
			$("#persona").focus();
			return false;
		}

        if($("#empresa").val().length <= 0){
            alert("Faltan el Nombre de la Empresa");
            $("#empresa").focus();
            return false;
        }

		return true;

	}



// MODULO DE DETALLES 
    function getCotDetList(idcotizacion){
        var nc = "u="+localStorage.nc+"&idcotizacion="+idcotizacion;
        // alert(nc);
        $("#tblCDetalle > tbody").empty();
        $.post(obj.getValue(0)+"data/", { o:72, t:36, p:54,c:nc,from:0,cantidad:0, s:"" },
            function(json){
                var tbdy = "";
                var totalItem = json.length;

               $.each(json, function(i, item) {
                    tbdy +='<tr>';
                    tbdy +='    <td>';
                    tbdy +='        <label>'
                    tbdy +='        <input class="ace chkCot" type="checkbox" id="id-'+item.idcotizacion+'-'+item.idcotizaciondetalle+'" >'
                    tbdy +='        <span class="lbl textRight">        '+item.idcotizaciondetalle+'</span>'
                    tbdy +='        </label>'                                    
                    tbdy +='    </td>';
                    tbdy +='    <td>'+item.lote+'</td>';
                    tbdy +='    <td>'+item.tipo_cambio+'</td>';
                    tbdy +='    <td class="textRight">'+commaSeparateNumber(item.cantidad)+'</td>';
                    tbdy +='    <td>'+item.unidad_medida+'</td>';
                    tbdy +='    <td>'+item.descripcion+'</td>';
                    tbdy +='    <td class="textRight">'+commaSeparateNumber(item.precio_venta)+'</td>';
                    tbdy +='    <td class="textRight">'+commaSeparateNumber(item.importe)+'</td>';
                    tbdy +='    <td>';
                    tbdy +='        <div class="visible-desktop action-buttons">';
                    tbdy +='            <a class="green modCD" href="#" id="modCD-'+item.idcotizacion+'-'+item.idcotizaciondetalle+'" >';
                    tbdy +='                <i class="icon-pencil bigger-130"></i>';
                    tbdy +='            </a>';
                    tbdy +='';
                    tbdy +='            <a class="red delCD" href="#"  id="delCD-'+item.idcotizacion+'-'+item.idcotizaciondetalle+'" >';
                    tbdy +='                <i class="icon-trash bigger-130"></i>';
                    tbdy +='            </a>';
                    tbdy +='        </div>';
                    tbdy +='    </td>';
                    tbdy +='</tr>';
                });
                $('#tblCDetalle > tbody').html(tbdy);
                getTotales(idcotizacion);

                $(".modCD").on("click",function(event){
                    event.preventDefault();
                    var arr = event.currentTarget.id.split('-');
                    getCDetalleProp(arr[1],arr[2]);
                });

                $(".delCD").on("click",function(event){
                    event.preventDefault();
                    var resp =  confirm("Desea eliminar este registro?");
                    if (resp){
                        var arr = event.currentTarget.id.split('-');
                        //alert(arr[1]);
                        $.post(obj.getValue(0) + "data/", {o:72, t:2, c:arr[2], p:52, from:0, cantidad:0, s:''},
                        function(json) {
                                if (json[0].msg=="OK"){
                                    onClickFillTable();
                                }else{
                                    alert(json[0].msg);
                                }
                        }, "json");
                    }

                });

                if (init==true){
                    getTable();
                    init = false;
                }else{
                    oTable.fnClearTable();
                    oTable.fnDraw();
                }

            }, "json"
        );
    }

    function onClickFillTable(){
        if(oTable != null){
            oTable.fnDestroy();
            $('#sample-table-2 > tbody').empty();
            init = true;
        }
        getCotDetList(idcotizacion);
    }

    $("#btnRefreshCCotizacionProp").on("click",function(event){
        event.preventDefault();
        getCotDetList(idcotizacion);
    })

    $("#btnAddCotizacionProp").on("click",function(event){
        event.preventDefault();
        getCDetalleProp(idcotizacion,0);
    })

    function getCDetalleProp(IdCotizacion, IdCotizacionDetalle){
        $("#contentLevel3").empty();        
        $("#contentProfile").hide(function(){
            $("#preloaderPrincipal").show();
            obj.setIsTimeLine(false);
            var nc = localStorage.nc;
            $.post(obj.getValue(0) + "cotizacion-detalle-prop/", {
                user: nc,
                idcotizacion: IdCotizacion,
                idcotizaciondetalle: IdCotizacionDetalle,
                origen: "#contentProfile",
                destino: "#contentLevel3"
                },
                function(html) {
                    $("#contentLevel3").html(html).show('slow',function(){
                        $('#breadcrumb').html(getBar('Inicio, Cotización Detalle'));
                    });
                }, "html");
        });
        return false;
    }

    $("#idChK").on("change",function(event){
        event.preventDefault();

        if ( $(this).prop('checked') ) {
            $(".chkCot").prop('checked',true);
        } else {
            $(".chkCot").prop('checked',false);
        }

    });


    function selectObject(){

        // var url, cad, nRep, email, fam;
        var IdCots, IdCotDets;
        IdCots = IdCotDets = "";
        $(".chkCot").each(function(i,item){
            if ($(this).is(':checked') ){
                var ids = item.id.split('-');
                var isexist = IdCotDets.indexOf(ids[2]);
                if (isexist == -1){
                    IdCots += IdCots == "" ? ids[1] : "|"+ids[1];
                    IdCotDets += IdCotDets == "" ? ids[2] : "|"+ids[2];
                }
            }
        }); 
        var arr = $("#idmodenaCotProp option:selected").text().split('-');
        var nc = "user="+User+"&IdCots="+IdCots+"&IdCotDets="+IdCotDets+"&idmoneda="+$("#idmodenaCotProp").val()+"&tipo_cambio="+arr[1];
        // alert(nc);
        $.post(obj.getValue(0) + "data/", {o:72, t:3, c:nc, p:52, from:0, cantidad:0, s:''},
            function(json) {
                if (json[0].msg=="OK"){
                    onClickFillTable();
                }else{
                    alert(json[0].msg);
                }
            }, 
        "json");


    }


    $("#btnAplicaTipoCambio").on("click",function(event){
        event.preventDefault();
        selectObject();
    });

    function getTipoCambio(){
        var nc = "u="+localStorage.nc;
        $("#idmodenaCotProp").empty();
        $.post(obj.getValue(0)+"data/", { o:10, t:87, p:51,c:nc,from:0,cantidad:0, s:"" },
            function(json){
                var init = true;
                $.each(json, function(i, item) {
                    var sel = item.predeterminado==1 ? "selected":"";
                    var tc  = item.predeterminado==1 ? item.tipo_cambio : 0.00;
                    $("#idmodenaCotProp").append('<option value="'+item.data+'" '+sel+'> '+item.label+'-'+item.tipo_cambio+'</option>');
                    if (init && tc > 0){
                        $("#tipo_cambio").val(tc);
                        init = false;
                    }
                });
                getUnidadMedidas();
            }, "json"
        );
    }

    $("#btnPrintCot").on('click',function(event){
        event.preventDefault();
        ImprimirCotizacion();
    });

    function ImprimirCotizacion(){
        var logoEmp =obj.getConfig(100,0); 
        var url = obj.getValue(0)+"cotizacion-detalle-01/";
        var nc = "u="+localStorage.nc+"&IdContizacion="+idcotizacion+"&logoEmp="+logoEmp;
        var PARAMS = {data:nc};

        var temp=document.createElement("form");
        temp.action=url;
        temp.method="POST";
        temp.target="_blank";
        temp.style.display="none";
        for(var x in PARAMS) {
            var opt=document.createElement("textarea");
            opt.name=x;
            opt.value=PARAMS[x];
            temp.appendChild(opt);
        }
        document.body.appendChild(temp);
        temp.submit();
        return temp;
    }

    getTipoCambio();

});
</script>
