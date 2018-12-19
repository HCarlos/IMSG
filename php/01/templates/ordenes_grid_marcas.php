<?php

include("includes/metas.php");

require_once("../oFunctions.php");
$F = oFunctions::getInstance();

require_once("../oCentura.php");
$f = oCentura::getInstance();

$de       = $_POST['user'];

?>

<div class="borderTopContainer">
	<div id="user-profile-1" class="user-profile row-fluid">
		<div id="tblGridOrd01_wrapper" class="dataTables_wrapper" role="grid">
			<table aria-describedby="tblGridOrd01_info" id="tblGridOrd01" class="table table-striped table-bordered table-hover dataTable">
				<caption style="background-color: gray; height: 3em; color: white; font-weight: bolder; line-height: 3em; ">DIAS TRANSCURRIDOS</caption>
				<thead>
					<tr role="row">
						<th aria-label="marca: activate to sort column ascending" style="width: 80px;" colspan="1" rowspan="1" aria-controls="tblGridOrd01" tabindex="0" role="columnheader" class="sorting" >MARCAS</th>
						<th aria-label="uno: activate to sort column ascending" style="width: 10px;" colspan="1" rowspan="1" aria-controls="tblGridOrd01" tabindex="0" role="columnheader" class="sorting center" >1</th>
						<th aria-label="dos: activate to sort column ascending" style="width: 10px;" colspan="1" rowspan="1" aria-controls="tblGridOrd01" tabindex="0" role="columnheader" class="sorting center" >2</th>
						<th aria-label="tres: activate to sort column ascending" style="width: 10px;" colspan="1" rowspan="1" aria-controls="tblGridOrd01" tabindex="0" role="columnheader" class="sorting center" >3</th>
						<th aria-label="cuatro: activate to sort column ascending" style="width: 10px;" colspan="1" rowspan="1" aria-controls="tblGridOrd01" tabindex="0" role="columnheader" class="sorting center" >4</th>
						<th aria-label="cinco: activate to sort column ascending" style="width: 10px;" colspan="1" rowspan="1" aria-controls="tblGridOrd01" tabindex="0" role="columnheader" class="sorting center" >5</th>
						<th aria-label="seis: activate to sort column ascending" style="width: 10px;" colspan="1" rowspan="1" aria-controls="tblGridOrd01" tabindex="0" role="columnheader" class="sorting center" >6</th>
						<th aria-label="siete: activate to sort column ascending" style="width: 10px;" colspan="1" rowspan="1" aria-controls="tblGridOrd01" tabindex="0" role="columnheader" class="sorting center" >7</th>
						<th aria-label="ocho: activate to sort column ascending" style="width: 10px;" colspan="1" rowspan="1" aria-controls="tblGridOrd01" tabindex="0" role="columnheader" class="sorting center" >8</th>
						<th aria-label="nueve: activate to sort column ascending" style="width: 10px;" colspan="1" rowspan="1" aria-controls="tblGridOrd01" tabindex="0" role="columnheader" class="sorting center" >9</th>
						<th aria-label="diez: activate to sort column ascending" style="width: 10px;" colspan="1" rowspan="1" aria-controls="tblGridOrd01" tabindex="0" role="columnheader" class="sorting center" >10</th>
						<th aria-label="+diez: activate to sort column ascending" style="width: 10px;" colspan="1" rowspan="1" aria-controls="tblGridOrd01" tabindex="0" role="columnheader" class="sorting center" >+10</th>
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

		oTable = $('#tblGridOrd01').dataTable({
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
	        "aaSorting": [[ 0, "asc" ]],
			"aoColumns": [ null, null,null, null,null, null, null, null,null, null,null, null,  { "bSortable": false }],
			"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
			"bRetrieve": true,
			"bDestroy": false
	 	});
	}

	function fillTable(){

		var tB = "";

		$("#preloaderPrincipal").show();
		var nc = "u="+localStorage.nc+"&CNA="+localStorage.ClaveNivelAcceso+"&iduser="+localStorage.IdUser;
		$.post(obj.getValue(0) + "data/", {o:70, t:30, c:nc, p:56, from:0, cantidad:0,s:''},
			function(json){
					$.each(json, function(i, item) {
						tB +=' 			<tr>';
						tB +='';
						tB +='				<td class="left">'+item.marca+'</td>';
						tB +='				<td class="center"><a href="#" class="editGM" id="editGM-'+item.marca+'-1">'+item.uno+'</a></td>';
						tB +='				<td class="center"><a href="#" class="editGM" id="editGM-'+item.marca+'-2">'+item.dos+'</a></td>';
						tB +='				<td class="center"><a href="#" class="editGM" id="editGM-'+item.marca+'-3">'+item.tres+'</a></td>';
						tB +='				<td class="center"><a href="#" class="editGM" id="editGM-'+item.marca+'-4">'+item.cuatro+'</a></td>';
						tB +='				<td class="center"><a href="#" class="editGM" id="editGM-'+item.marca+'-5">'+item.cinco+'</a></td>';
						tB +='				<td class="center"><a href="#" class="editGM" id="editGM-'+item.marca+'-6">'+item.seis+'</a></td>';
						tB +='				<td class="center"><a href="#" class="editGM" id="editGM-'+item.marca+'-7">'+item.siete+'</a></td>';
						tB +='				<td class="center"><a href="#" class="editGM" id="editGM-'+item.marca+'-8">'+item.ocho+'</a></td>';
						tB +='				<td class="center"><a href="#" class="editGM" id="editGM-'+item.marca+'-9">'+item.nueve+'</a></td>';
						tB +='				<td class="center"><a href="#" class="editGM" id="editGM-'+item.marca+'-10">'+item.diez+'</a></td>';
						tB +='				<td class="center"><a href="#" class="editGM" id="editGM-'+item.marca+'-11">'+item.masdiez+'</a></td>';
						tB +='				<td>';
						tB +='				</td>';
						tB +='			</tr>';
					});
					// alert(tB);	
					$('#tblGridOrd01 > tbody').html(tB);
					$("#preloaderPrincipal").hide();

					$(".editGM").on("click",function(event){
						event.preventDefault();
						var arr = event.currentTarget.id.split('-');
						obj.setIsTimeLine(false);
						getGMDetalles(arr[1],arr[2]);

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


	function onClickFillTable(){
		if(oTable != null){
			oTable.fnDestroy();
			$('#tblGridOrd01 > tbody').empty();
			init = true;
		}
		fillTable();
	}


	function getGMDetalles(Marca, Numero){
        $("#contentProfile").empty();
        $("#contentMain").hide(function(){
	        $("#preloaderPrincipal").show();
	        obj.setIsTimeLine(false);
	        var nc = localStorage.nc;
	        $.post(obj.getValue(0) + "ordenes-grid-marca-ordenes/", {
				user: nc,
				marca: Marca,
				numero: Numero
	            },
	            function(html) {
	                $("#contentProfile").html(html).show('slow',function(){
		                $('#breadcrumb').html(getBar('Inicio, Órden de Trabajo'));
	                });
	            }, "html");
        });
        return false;
	}


});



</script>
