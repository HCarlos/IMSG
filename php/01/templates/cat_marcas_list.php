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
			<div id="sample-table-2_wrapper" class="dataTables_wrapper" role="grid">

				<table aria-describedby="sample-table-2_info" id="sample-table-2" class="table table-striped table-bordered table-hover dataTable">

					<thead>
						<tr role="row">
							<th aria-label="IdMarca: activate to sort column ascending" style="width: 80px;" colspan="1" rowspan="1" aria-controls="sample-table-2" tabindex="0" role="columnheader" class="sorting" >ID</th>
							<th aria-label="marca: activate to sort column ascending" style="width: 200px;" colspan="1" rowspan="1" aria-controls="sample-table-2" tabindex="1" role="columnheader" class="sorting">Marca</th>
							<th aria-label="logo: activate to sort column ascending" style="width: 100px;" colspan="1" rowspan="1" aria-controls="sample-table-2" tabindex="2" role="columnheader" class="sorting"></th>
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

		oTable = $('#sample-table-2').dataTable({
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
			"aoColumns": [ null, null, { "bSortable": false },  { "bSortable": false }],
			"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
			"bRetrieve": true,
			"bDestroy": false
	 	});
	}

	function fillTable(){

		var tB = "";

		$("#preloaderPrincipal").show();
		var nc = "u="+localStorage.nc;
		$.post(obj.getValue(0) + "data/", {o:5, t:10, c:nc, p:54, from:0, cantidad:0,s:''},
			function(json){

					$.each(json, function(i, item) {

                    	var strx = item.imagen.split(".");
                    	var imgPath = obj.getValue(0) + "up_empresa/"+strx[0]+"."+strx[1];
                    	d = new Date();
						tB +=' 			<tr class="odd">';
						tB +='';
						tB +='				<td>';
						tB +='					<a href="#" >'+padl(item.idmarca,4)+'</a>';
						tB +='				</td>';
						tB +='				<td>'+item.marca+'</td>';
						tB +='				<td><img src="'+imgPath+"?timestamp="+d.getTime()+'" width="100" height="80" /></td>';
						tB +='				<td>';
						tB +='					<div class="visible-desktop action-buttons">';
						tB +='';
						tB +='						<a class="green modMarcaPro" href="#" id="IdMarca-'+item.idmarca+'" >';
						tB +='							<i class="icon-pencil bigger-130"></i>';
						tB +='						</a>';
						tB +='';
						tB +='						<a class="red delMarca" href="#"  id="delMarca-'+item.idmarca+'-'+item.imagen+'" >';
						tB +='							<i class="icon-trash bigger-130"></i>';
						tB +='						</a>';
						tB +='';
						tB +='						<a class="orange modMarcaImg" href="#" id="IdMarca-'+item.idmarca+'" >';
						tB +='							<i class="fa fa-picture-o bigger-130" aria-hidden="true"></i>';
						tB +='						</a>';
						tB +='					</div>';
						tB +='				</td>';
						tB +='			</tr>';
					});

					$('#sample-table-2 > tbody').html(tB);
					$("#preloaderPrincipal").hide();

					$(".modMarcaPro").on("click",function(event){
						event.preventDefault();
						var arr = event.currentTarget.id.split('-');
						obj.setIsTimeLine(false);
						getPropMarca(arr[1],1);
					});

					$(".modMarcaImg").on("click",function(event){
						event.preventDefault();
						var arr = event.currentTarget.id.split('-');
						obj.setIsTimeLine(false);
						getPropMarca(arr[1],2);
					});

					$(".delMarca").on("click",function(event){
						event.preventDefault();
						$("#iconSaveCommentResp").show();
						var resp =  confirm("Desea eliminar este registro?");
						if (resp){
							var arr = event.currentTarget.id.split('-');
							obj.setIsTimeLine(false);
							var data = new FormData();
							var dt = "idmarca="+arr[1]+"&img="+arr[2];
							data.append('data', dt);

							$.ajax({
							    url:obj.getValue(0)+"fu-marca-01-delete/",
							    data: data,
							    cache: false,
							    contentType: false,
							    processData: false,
							    dataType: 'json',
							    type: 'POST',
							    success: function(json){
							        alert(json.message);			           
							    	if (json.status=="OK"){
										onClickFillTable();
							       	}
							       	$("#preloaderPrincipal").hide();
							    }
							});

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
			$('#sample-table-2 > tbody').empty();
			init = true;
		}
		fillTable();
	}


	$("#btnAddRegistry").on("click",function(event){
		event.preventDefault();

		obj.setIsTimeLine(false);
		getPropMarca(0,0);

	})

	function getPropMarca(IdMarca,tEvent){
		var nc = localStorage.nc;
		var url = "";
		switch(tEvent){
			case 0:
					url = "cat-marcas-prop-new/";
					break;
			case 1:
					url = "cat-marcas-prop-edit/";
					break;
			case 2:
					url = "cat-marcas-prop-image-change/";
					break;
		}
		$.post(obj.getValue(0) + url, {
				user: nc,
				idmarca: IdMarca
			},
			function(html) {
				$("#divUploadImage").html(html);
				$("#divUploadImage").modal('toggle');
		}, "html");

	}

});



</script>
