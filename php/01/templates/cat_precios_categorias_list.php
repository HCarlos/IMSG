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
			<div id="tbl_tcat_wrapper" class="dataTables_wrapper" role="grid">

				<table aria-describedby="tbl_tcat_info" id="tbl_tcat" class="table table-striped table-bordered table-hover dataTable">

					<thead>
						<tr role="row">
							<th aria-label="idpreciocategoria: activate to sort column ascending" style="width: 80px;" aria-controls="tbl_tcat" tabindex="0" role="columnheader" class="sorting" >ID</th>
							<th aria-label="clave: activate to sort column ascending" style="width: 80px;" colspan="1" aria-controls="tbl_tcat" tabindex="1" role="columnheader" class="sorting">CODIGO</th>
							<th aria-label="precio_categoria: activate to sort column ascending" style="width: 200px;" aria-controls="tbl_tcat" tabindex="2" role="columnheader" class="sorting">DESCRIPCION </th>
							<th aria-label="" style="width: 100px;" colspan="1" rowspan="1" role="columnheader" class="sorting_disabled"></th>
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

		oTable = $('#tbl_tcat').dataTable({
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
			"aoColumns": [ null, null, null,  { "bSortable": false }],
			"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
			"bRetrieve": true,
			"bDestroy": false
	 	});
	}

	function fillTable(){

		var tB = "";

		$("#preloaderPrincipal").show();
		var nc = "u="+localStorage.nc;
		$.post(obj.getValue(0) + "data/", {o:8, t:21, c:nc, p:55, from:0, cantidad:0,s:''},
			function(json){

					$.each(json, function(i, item) {

						tB +=' 			<tr class="odd">';
						tB +='';
						tB +='				<td>';
						tB +='					<a href="#" >'+padl(item.idpreciocategoria,4)+'</a>';
						tB +='				</td>';
						tB +='				<td >'+item.clave+'</td>';
						tB +='				<td >'+item.precio_categoria+'</td>';
						tB +='				<td>';
						tB +='					<div class="hidden-phone visible-desktop action-buttons">';
						tB +='';
						tB +='						<a class="green modPreCatPro" href="#" id="idpreciocategoria-'+item.idpreciocategoria+'" >';
						tB +='							<i class="icon-pencil bigger-130"></i>';
						tB +='						</a>';
						tB +='	';
						tB +='						<a class="red delPreCat" href="#"  id="delPreCat-'+item.idpreciocategoria+'" >';
						tB +='							<i class="icon-trash bigger-130"></i>';
						tB +='						</a>';
						tB +='					</div>';
						tB +='';
						tB +='				</td>';
						tB +='			</tr>';
					});

					$('#tbl_tcat > tbody').html(tB);

					$("#preloaderPrincipal").hide();

					$(".modPreCatPro").on("click",function(event){
						event.preventDefault();
						var arr = event.currentTarget.id.split('-');
						obj.setIsTimeLine(false);
						getPropPreCat(arr[1]);
					});

					$(".delPreCat").on("click",function(event){
						event.preventDefault();
						$("#iconSaveCommentResp").show();
						var resp =  confirm("Desea eliminar este registro?");
						//alert(resp);
						//return false;
						if (resp){
							var arr = event.currentTarget.id.split('-');
							//alert(arr[1]);
							obj.setIsTimeLine(false);
				            $.post(obj.getValue(0) + "data/", {o:8, t:2, c:arr[1], p:52, from:0, cantidad:0, s:''},
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
			$('#tbl_tcat > tbody').empty();
			init = true;
		}
		fillTable();
	}


	$("#btnAddRegistry").on("click",function(event){
		event.preventDefault();

		obj.setIsTimeLine(false);
		getPropPreCat(0);

	})

	function getPropPreCat(IdPreCat){
		var nc = localStorage.nc; //.split("@");
		$.post(obj.getValue(0) + "cat-precio_categoria-prop/", {
				user: nc,
				idpreciocategoria: IdPreCat
			},
			function(html) {
				$("#divUploadImage").html(html);
				$("#divUploadImage").modal('toggle');
		}, "html");

	}

});



</script>
