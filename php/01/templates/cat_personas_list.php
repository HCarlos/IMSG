<?php

include("includes/metas.php");

require_once("../oFunctions.php");
$F = oFunctions::getInstance();

require_once("../oCentura.php");
$f = oCentura::getInstance();

//$de       = $_POST['user'];

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
				<td style="width:4px;">
					<span class="ui-separator marginLeft1em"></span>
				</td>
				<td data-original-title="Reload Grid" id="refresh_grid-table" title="" class="ui-pg-button ui-corner-all">
					<div class="ui-pg-div" id="btnRefresh">
						<span class="ui-icon icon-refresh green"></span>
					</div>
				</td>
                <td style="width:5em;">
					<span class="ui-separator marginLeft1em"></span>
				</td>
<!--                <td>
        			<label>
        				<input name="ranQry01" id="ranQry01" class="ace ranQry01" type="radio" value="0" checked >
        				<span class="lbl"> A - B</span>
        			</label>
                </td>
                <td style="width:2em;">
					<span class="ui-separator marginLeft1em"></span>
				</td>
                 <td>
        			<label>
        				<input name="ranQry01" id="ranQry01" class="ace ranQry01" type="radio" value="1"  >
        				<span class="lbl"> C - E</span>
        			</label>
                </td>
                <td style="width:2em;">
					<span class="ui-separator marginLeft1em"></span>
				</td>
                <td>
                    <label>
                        <input name="ranQry01" id="ranQry02" class="ace ranQry01" type="radio" value="2">
                        <span class="lbl"> F - J </span>
                    </label>
                </td>
                <td style="width:2em;">
					<span class="ui-separator marginLeft1em"></span>
				</td>
                <td>
                    <label>
                        <input name="ranQry01" id="ranQry03" class="ace ranQry01" type="radio" value="3">
                        <span class="lbl"> K - O</span>
                    </label>
                </td>
                <td style="width:2em;">
					<span class="ui-separator marginLeft1em"></span>
				</td>
                <td>
                    <label>
                        <input name="ranQry01" id="ranQry03" class="ace ranQry01" type="radio" value="4">
                        <span class="lbl"> P - R</span>
                    </label>
                </td>
                <td style="width:2em;">
					<span class="ui-separator marginLeft1em"></span>
				</td> 
                <td>
                    <label>
                        <input name="ranQry01" id="ranQry03" class="ace ranQry01" type="radio" value="5">
                        <span class="lbl"> S - Z</span>
                    </label>
                </td>-->

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
							<th aria-label="idpersona: activate to sort column ascending" style="width: 80px;" colspan="1" rowspan="1" aria-controls="sample-table-2" tabindex="0" role="columnheader" class="sorting" >ID</th>
							<th aria-label="nombre_persona: activate to sort column ascending" style="width: 200px;" colspan="1" rowspan="1" aria-controls="sample-table-2" tabindex="1" role="columnheader" class="sorting">Persona</th>
							<th aria-label="username: activate to sort column ascending" style="width: 200px;" colspan="1" rowspan="1" aria-controls="sample-table-2" tabindex="1" role="columnheader" class="sorting">Username</th>
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
			"aoColumns": [ null, null, null,  { "bSortable": false }],
			"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
			"bRetrieve": true,
			"bDestroy": false
	 	});
	}

	function fillTable(){

		var tB = "";

		$("#preloaderPrincipal").show();
        var rngQry = $('input[name="ranQry01"]:checked').val();
		var nc = "u="+localStorage.nc+"&rngQry="+rngQry;
        // alert(nc);
        // return false;
		$.post(obj.getValue(0) + "data/", {o:3, t:5, c:nc, p:55, from:0, cantidad:0,s:''},
			function(json){

					$.each(json, function(i, item) {

						tB +=' 			<tr class="odd">';
						tB +='';
						tB +='				<td class=" ">';
						tB +='					<a class="modPersonaPro" href="#" id="idprof-'+item.idpersona+'" >'+padl(item.idpersona,4)+'</a>';
						tB +='				</td>';
						tB +='				<td class=" " >'+item.nombre_persona+'</td>';
						tB +='				<td class=" " >'+item.username+'</td>';
						tB +='				<td class=" ">';
						tB +='					<div class="hidden-phone visible-desktop action-buttons">';
						tB +='';
						tB +='						<a class="green modPersonaPro" href="#" id="idpersona-'+item.idpersona+'" >';
						tB +='							<i class="icon-pencil bigger-130"></i>';
						tB +='						</a>';
						tB +='	';
						tB +='						<a class="red delPersona" href="#" id="delPersona-'+item.idpersona+'" >';
						tB +='							<i class="icon-trash bigger-130"></i>';
						tB +='						</a>';
						tB +='					</div>';
						tB +='';
						tB +='				</td>';
						tB +='			</tr>';
					});

					$('#sample-table-2 > tbody').html(tB);

					$("#preloaderPrincipal").hide();

					$(".modPersonaPro").on("click",function(event){
						event.preventDefault();
						var arr = event.currentTarget.id.split('-');
						obj.setIsTimeLine(false);
						getPropPersona(arr[1]);
					});

					$(".delPersona").on("click",function(event){
						event.preventDefault();
						$("#iconSaveCommentResp").show();
						var resp =  confirm("Desea eliminar este registro?");
						//alert(resp);
						//return false;
						if (resp){
							var arr = event.currentTarget.id.split('-');
							//alert(arr[1]);
							obj.setIsTimeLine(false);
				            $.post(obj.getValue(0) + "data/", {o:3, t:2, c:arr[1], p:52, from:0, cantidad:0, s:''},
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
			$('#sample-table-2 > tbody').empty();
			init = true;
		}
		fillTable();
	}


	$("#btnAddRegistry").on("click",function(event){
		event.preventDefault();

		obj.setIsTimeLine(false);
		getPropPersona(0);

	})

	function getPropPersona(IdPersona){
        $("#contentProfile").html("");
        $("#contentMain").hide(function(){
	        $("#preloaderPrincipal").show();
	        obj.setIsTimeLine(false);
	        var nc = localStorage.nc;
	        $.post(obj.getValue(0) + "cat-personas-prop/", {
				user: nc,
				idpersona: IdPersona
	            },
	            function(html) {
	                $("#contentProfile").html(html).show('slow',function(){
	                	//$("#contentProfile");
		                $('#breadcrumb').html(getBar('Inicio, Propiedades de un nuevo Persona '));
	                });
	            }, "html");
        });
        return false;
	}

});



</script>
