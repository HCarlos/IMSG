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
			<div id="tblPrecios_wrapper" class="dataTables_wrapper" role="grid">

				<table aria-describedby="tblPrecios_info" id="tblPrecios" class="table table-striped table-bordered table-hover dataTable">

					<thead>
						<tr role="row">
							<th aria-label="idprecio: activate to sort column ascending" style="width: 40px;" aria-controls="tblPrecios" tabindex="0" role="columnheader" class="sorting" >ID</th>
							<th aria-label="CODIGO: activate to sort column ascending" style="width: 80px;" aria-controls="tblPrecios" tabindex="1" role="columnheader" class="sorting">CODIGO</th>
							<th aria-label="CONCEPTO: activate to sort column ascending" style="width: 200px;" aria-controls="tblPrecios" tabindex="2" role="columnheader" class="sorting">CONCEPTO</th>
							<th aria-label="precio_unitario: activate to sort column ascending" style="width: 80px;" aria-controls="tblPrecios" tabindex="3" role="columnheader" class="sorting">PRECIO</th>
							<th aria-label="viaticos: activate to sort column ascending" style="width: 80px;" aria-controls="tblPrecios" tabindex="3" role="columnheader" class="sorting">VIATICOS</th>
							<th aria-label="tipo: activate to sort column ascending" style="width: 40px;" aria-controls="tblPrecios" tabindex="4" role="columnheader" class="sorting">TIPO</th>
							<th aria-label="" style="width: 200px;" colspan="1" rowspan="1" role="columnheader" class="sorting_disabled"></th>
						</tr>
					</thead>

					<tbody aria-relevant="all" aria-live="polite" role="alert"></tbody>
				</table>

			</div><!--PAGE CONTENT ENDS-->

	</div>
</div>

<div id="inline2">

</div>
<!--PAGE CONTENT ENDS-->

<script typy="text/javascript">

jQuery(function($) {

	var oTable;

	function getTable(){

		oTable = $('#tblPrecios').dataTable({
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
			"aoColumns": [ null, null, null, null, null, null,  { "bSortable": false }],
			"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
			"bRetrieve": true,
			"bDestroy": false
	 	});
	}

	function fillTable(){

		var tB = "";

		$("#preloaderPrincipal").show();
		var nc = "u="+localStorage.nc;
		$.post(obj.getValue(0) + "data/", {o:10, t:25, c:nc, p:55, from:0, cantidad:0,s:'codigo'},
			function(json){

					$.each(json, function(i, item) {

						tB +=' 			<tr class="odd">';
						tB +='';
						tB +='				<td class=" ">';
						tB +='					<a class="modPrePro" href="#" id="idrf2-'+item.idprecio+'">'+padl(item.idprecio,4)+'</a>';
						tB +='				</td>';
						tB +='				<td class="tbl50W" >'+item.codigo+'</td>';
						tB +='				<td class="tbl50W" >'+item.concepto+'</td>';
						tB +='				<td class="tbl50W" >'+item.precio_unitario+'</td>';
						tB +='				<td class="tbl50W" >'+item.viaticos+'</td>';
						tB +='				<td class="tbl50W" >'+item.tipo+'</td>';
						tB +='				<td >';
						tB +='					<div class="hidden-phone visible-desktop action-buttons">';
						tB +='';
						tB +='						<a class="green modPrePro" href="#" id="idprecio-'+item.idprecio+'" >';
						tB +='							<i class="icon-pencil bigger-130"></i>';
						tB +='						</a>';
						tB +='	';
						tB +='						<a class="red delPre" href="#"  id="delPre-'+item.idprecio+'" >';
						tB +='							<i class="icon-trash bigger-130"></i>';
						tB +='						</a>';
						tB +='					</div>';
						tB +='';
						tB +='				</td>';
						tB +='			</tr>';
					});

					$('#tblPrecios > tbody').html(tB);

					$("#preloaderPrincipal").hide();

					$(".modPrePro").on("click",function(event){
						event.preventDefault();
						var arr = event.currentTarget.id.split('-');
						obj.setIsTimeLine(false);
						getPropPre(arr[1]);
					});

					$(".delPre").on("click",function(event){
						event.preventDefault();
						$("#iconSaveCommentResp").show();
						var resp =  confirm("Desea eliminar este registro?");
						//alert(resp);
						//return false;
						if (resp){
							var arr = event.currentTarget.id.split('-');
							//alert(arr[1]);
							obj.setIsTimeLine(false);
				            $.post(obj.getValue(0) + "data/", {o:10, t:2, c:arr[1], p:52, from:0, cantidad:0, s:''},
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
			$('#tblPrecios > tbody').empty();
			init = true;
		}
		fillTable();
	}


	$("#btnAddRegistry").on("click",function(event){
		event.preventDefault();

		obj.setIsTimeLine(false);
		getPropPre(0);

	})

	function getPropPre(IdPre){
        $("#contentProfile").empty();
        $("#contentMain").hide(function(){
	        $("#preloaderPrincipal").show();
	        obj.setIsTimeLine(false);
	        var nc = localStorage.nc;
	        $.post(obj.getValue(0) + "cat-precio-prop/", {
				user: nc,
				idprecio: IdPre
	            },
	            function(html) {
	                $("#contentProfile").html(html).show('slow',function(){
	                	//$("#contentProfile");
		                $('#breadcrumb').html(getBar('Inicio, Catálogo de Precios '));
	                });
	            }, "html");
        });
        return false;


	}

});
</script>
