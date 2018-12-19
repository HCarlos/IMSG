<?php

include("includes/metas.php");

require_once("../oFunctions.php");
$F = oFunctions::getInstance();

require_once("../oCentura.php");
$f = oCentura::getInstance();

$de       = $_POST['user'];

?>
<div  class="row-fluid">
	<table class="ui-pg-table navtable" style="float:left;table-layout:auto;" border="0" cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td data-original-title="Add new row" id="add_grid-table" title="" class="ui-pg-button ui-corner-all">
					<div class="ui-pg-div" id="btnAddRegistry" >
						<span class="ui-icon icon-plus-sign purple"></span>
					</div>
				</td>
				<td title="" data-original-title="" class="ui-pg-button ui-state-disabled" style="width:4px;">
					<span class="ui-separator marginLeft1em"></span>
				</td>
				<td data-original-title="Reload Grid" id="refresh_grid-table" title="" class="ui-pg-button ui-corner-all">
					<div class="ui-pg-div" id="btnRefresh">
						<span class="ui-icon icon-refresh green"></span>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
</div>

<div class="borderTopContainer">
	<div id="user-profile-1" class="user-profile row-fluid">
		<div id="tblColor_wrapper" class="dataTables_wrapper" role="grid">
			<table aria-describedby="tblColor_info" id="tblColor" class="table table-striped table-bordered table-hover dataTable">
				<thead>
					<tr role="row">
						<th aria-label="Número de Órden: activate to sort column ascending" style="width: 80px;" colspan="1" rowspan="1" aria-controls="tblColor" tabindex="0" role="columnheader" class="sorting" >FOLIO</th>
						<th aria-label="empresa: activate to sort column ascending" style="width: 200px;" colspan="1" rowspan="1" aria-controls="tblColor" tabindex="1" role="columnheader" class="sorting">CLIENTE</th>
						<th aria-label="marca: activate to sort column ascending" style="width: 200px;" colspan="1" rowspan="1" aria-controls="tblColor" tabindex="2" role="columnheader" class="sorting">MARCA</th>
						<th aria-label="modelo: activate to sort column ascending" style="width: 200px;" colspan="1" rowspan="1" aria-controls="tblColor" tabindex="2" role="columnheader" class="sorting">MODELO</th>
						<th aria-label="falla: activate to sort column ascending" style="width: 200px;" colspan="1" rowspan="1" aria-controls="tblColor" tabindex="2" role="columnheader" class="sorting">FALLA</th>
						<th aria-label="" style="width: 200px;" colspan="1" rowspan="1" role="columnheader" class="sorting_disabled"></th>
					</tr>
				</thead>
				<tbody aria-relevant="all" aria-live="polite" role="alert"></tbody>
			</table>
		</div>
	</div>
</div>

<div id="inline2"></div>
<!--PAGE CONTENT ENDS-->

<script typy="text/javascript">

jQuery(function($) {

	var oTable;

	function getTable(){

		oTable = $('#tblColor').dataTable({
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
			"aoColumns": [ null, null, null, null, null,  { "bSortable": false }],
			"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
			"bRetrieve": true,
			"bDestroy": false
	 	});
	}

	function fillTable(){

		var tB = "";

		$("#preloaderPrincipal").show();
		var nc = "u="+localStorage.nc+"&CNA="+localStorage.ClaveNivelAcceso+"&iduser="+localStorage.IdUser+"&idper="+localStorage.IdPersona;
		$.post(obj.getValue(0) + "data/", {o:70, t:14, c:nc, p:54, from:0, cantidad:0,s:''},
			function(json){
					$.each(json, function(i, item) {
                    	// d = new Date();
                    	var clr = 'style="background-color:'+item.codigo_color_hex+' !important;"';
						tB +=' 			<tr>';
						tB +='';
						tB +='				<td '+clr+'>';
						tB +='					<a href="#" class="editCM" id="modCM-'+item.idcontrolmaster+'-'+item.idempresa+'">'+padl(item.idcontrolmaster,4)+'</a>';
						tB +='				</td>';
						tB +='				<td>'+item.empresa+'</td>';
						tB +='				<td>'+item.marca_det+'</td>';
						tB +='				<td>'+item.modelo+'</td>';
						tB +='				<td>'+item.falla+'</td>';
						tB +='				<td>';
						tB +='					<div class="visible-desktop action-buttons">';
						tB +='';
						tB +='						<a class="green editCM" href="#" id="modCM-'+item.idcontrolmaster+'-'+item.idempresa+'" title="Editar" >';
						tB +='							<i class="icon-pencil bigger-130"></i>';
						tB +='						</a>';
						tB +='';
						tB +='						<a class="red delCM" href="#"  id="delCM-'+item.idcontrolmaster+'" title="Eliminar">';
						tB +='							<i class="icon-trash bigger-130"></i>';
						tB +='						</a>';
						tB +='';
						tB +='						<a class="blue ordCM" href="#"  id="ordCM-'+item.idcontrolmaster+'" title="Ver Orden">';
						tB +='							<i class="icon icon-desktop bigger-130"></i>';
						tB +='						</a>';
						tB +=' ';
						tB +='						<a class="purple ordCME" href="#" id="ordCME-'+item.idcontrolmaster+'" title="Comentarios">';
						tB +='							<i class="icon icon-comments bigger-130"></i>';
						tB +='						</a>';
						tB +=' ';
						tB +='						<a class="orange ordEnd" href="#" id="ordEnd-'+item.idcontrolmaster+'-'+item.idempresa+'" title="Cerrar Orden">';
						tB +='							<i class="icon icon-lock bigger-130"></i>';
						tB +='						</a>';
						tB +='					</div>';
						tB +='				</td>';
						tB +='			</tr>';
					});
					// alert(tB);	
					$('#tblColor > tbody').html(tB);
					$("#preloaderPrincipal").hide();

					$(".editCM").on("click",function(event){
						event.preventDefault();
						var arr = event.currentTarget.id.split('-');
						obj.setIsTimeLine(false);
						getControlMaster(arr[1],arr[2]);
					});

					$(".delCM").on("click",function(event){
						event.preventDefault();
						$("#iconSaveCommentResp").show();
						var resp =  confirm("Desea eliminar este registro?");
						if (resp){
							var arr = event.currentTarget.id.split('-');
							//alert(arr[1]);
							obj.setIsTimeLine(false);
				            $.post(obj.getValue(0) + "data/", {o:70, t:2, c:arr[1], p:52, from:0, cantidad:0, s:''},
				            function(json) {
				            		if (json[0].msg=="OK"){
										onClickFillTable();
				        			}else{
				        				alert(json[0].msg);
				        			}
				        	}, "json");
			        	}

					});

					$(".ordCM").on("click",function(event){
						event.preventDefault();
						var arr = event.currentTarget.id.split('-');
						obj.setIsTimeLine(false);
						getOrdenServicio(arr[1],arr[2]);
					});

					$(".ordCME").on("click",function(event){
						event.preventDefault();
						var arr = event.currentTarget.id.split('-');
						obj.setIsTimeLine(false);
						getOrdenCommentarios(arr[1]);
					});

					$(".ordEnd").on("click",function(event){
						event.preventDefault();
						var arr = event.currentTarget.id.split('-');
						obj.setIsTimeLine(false);
						getOrdenCerrar(arr[1],arr[2]);
					});

					if (init==true){
						getTable();
						init = false;
					}else{
						oTable.fnClearTable();
						oTable.fnDraw();
					}

        	},
        'json'
        );

	}

	var init = true;
	fillTable();


	$("#btnRefresh").on("click",function(event){
		event.preventDefault();
		onClickFillTable();
	})

	function onClickFillTable(){
		if(oTable != null){
			oTable.fnDestroy();
			$('#tblColor > tbody').empty();
			init = true;
		}
		fillTable();
	}


	$("#btnAddRegistry").on("click",function(event){
		event.preventDefault();

		obj.setIsTimeLine(false);
		getControlMaster(0,0);

	})

	function getControlMaster(IdControlMaster, IdEmpresa){
        $("#contentProfile").empty();
        $("#contentMain").hide(function(){
	        $("#preloaderPrincipal").show();
	        obj.setIsTimeLine(false);
	        var nc = localStorage.nc;
	        $.post(obj.getValue(0) + "orden-prop/", {
				user: nc,
				idcontrolmaster: IdControlMaster,
				idempresa: IdEmpresa,
				origen: "#contentMain",
				destino: "#contentProfile"
	            },
	            function(html) {
	                $("#contentProfile").html(html).show('slow',function(){
		                $('#breadcrumb').html(getBar('Inicio, Órden de Trabajo'));
	                });
	            }, "html");
        });
        return false;
	}

	function getOrdenServicio(IdControlMaster, IdEmpresa){
		var logoEmp =obj.getConfig(100,0); 
        var url = obj.getValue(0)+"orden-trabajo-01/";
		var nc = "u="+localStorage.nc+"&idcontrolmaster="+IdControlMaster+"&logoEmp="+logoEmp;
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

	function getOrdenCommentarios(IdControlMaster, IdEmpresa){
        $("#contentProfile").empty();
        $("#contentMain").hide(function(){
	        $("#preloaderPrincipal").show();
	        obj.setIsTimeLine(false);
	        var nc = localStorage.nc;
	        $.post(obj.getValue(0) + "orden-comments-list/", {
				user: nc,
				idcontrolmaster: IdControlMaster,
				frmA: "#contentMain",
				frmB: "#contentProfile"
	            },
	            function(html) {
	                $("#contentProfile").html(html).show('slow',function(){
		                $('#breadcrumb').html(getBar('Inicio, Listado de comentarios de esta orden de trabajo'));
	                });
	            }, "html");
        });
        return false;
	}


	function getOrdenCerrar(IdControlMaster, IdEmpresa){
        $("#contentProfile").empty();
        $("#contentMain").hide(function(){
	        $("#preloaderPrincipal").show();
	        obj.setIsTimeLine(false);
	        var nc = localStorage.nc;
	        $.post(obj.getValue(0) + "orden-entrada-equipo-prop/", {
				user: nc,
				idcontrolmaster: IdControlMaster,
				idempresa: IdEmpresa,
				frmA: "#contentMain",
				frmB: "#contentProfile"
	            },
	            function(html) {
	                $("#contentProfile").html(html).show('slow',function(){
		                $('#breadcrumb').html(getBar('Inicio, Cerrar Orden'));
	                });
	            }, "html");
        });
        return false;
	}



});



</script>
