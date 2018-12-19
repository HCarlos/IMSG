<?php

include("includes/metas.php");

require_once("../oFunctions.php");
$F = oFunctions::getInstance();

require_once("../oCentura.php");
$f = oCentura::getInstance();

$de       = $_POST['user'];
$idcontrolmaster       = $_POST['idcontrolmaster'];
$frmA = $_POST['frmA'];
$frmB = $_POST['frmB'];

?>
<div  class="row-fluid">
	<table class="ui-pg-table navtable" style="float:left;table-layout:auto;" border="0" cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td data-original-title="Add new row" id="addGridTbl01" title="" class="ui-pg-button ui-corner-all">
					<div class="ui-pg-div" id="btnAddComments01" >
						<span class="ui-icon icon-plus-sign purple"></span>
					</div>
				</td>
				<td title="" data-original-title="" class="ui-pg-button ui-state-disabled" style="width:4px;">
					<span class="ui-separator marginLeft1em"></span>
				</td>
				<td data-original-title="Reload Grid" id="refGridTbl" title="" class="ui-pg-button ui-corner-all">
					<div class="ui-pg-div" id="btnRefComments01">
						<span class="ui-icon icon-refresh green"></span>
					</div>
				</td>
			</tr>
	        <span class="widget-toolbar">
	                <h5 class="label label-inverse arrowed-in-right arrowed closeFormUpload" style="cursor: pointer;" >Regresar</h5>
	        </span>
		</tbody>
	</table>
</div>

<div class="borderTopContainer">
	<div id="CommentsPro01" class="user-profile row-fluid">
			<div id="tblComments01Wrp" class="dataTables_wrapper" role="grid">
				<table aria-describedby="tblComments01_info" id="tblComments01" class="table table-striped table-bordered table-hover dataTable">
					<thead>
						<tr role="row">
							<th aria-label="idcontrolcomentario: activate to sort column ascending" style="width: 80px;" aria-controls="tblComments01" tabindex="0" role="columnheader" class="sorting" >ID</th>
							<th aria-label="idcontrolmaster: activate to sort column ascending" style="width: 80px;" aria-controls="tblComments01" tabindex="1" role="columnheader" class="sorting" >NÚM. ORDEN</th>
							<th aria-label="username: activate to sort column ascending" style="width: 80px;" aria-controls="tblComments01" tabindex="2" role="columnheader" class="sorting">USERNAME</th>
							<th aria-label="comentario: activate to sort column ascending" style="width: 200px;" aria-controls="tblComments01" tabindex="3" role="columnheader" class="sorting">COMENTARIO</th>
							<th aria-label="fecha: activate to sort column ascending" style="width: 80px;" aria-controls="tblComments01" tabindex="4" role="columnheader" class="sorting">FECHA</th>
							<th aria-label="" style="width: 200px;" role="columnheader" class="sorting_disabled"></th>
						</tr>
					</thead>
					<tbody aria-relevant="all" aria-live="polite" role="alert"></tbody>
				</table>
			</div>
	</div>
</div>

<div id="inline2">

</div>
<!--PAGE CONTENT ENDS-->

<script typy="text/javascript">

jQuery(function($) {

	var oTable;
	var IdControlMaster = <?= $idcontrolmaster; ?>;
    var frmA = "<?= $frmA ?>";
    var frmB = "<?= $frmB ?>";

	function getTable(){

		oTable = $('#tblComments01').dataTable({
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
		var nc = "u="+localStorage.nc+"&idcontrolmaster="+IdControlMaster;
		$.post(obj.getValue(0) + "data/", {o:70, t:27, c:nc, p:54, from:0, cantidad:0,s:''},
			function(json){
					$.each(json, function(i, item) {
                    	// d = new Date();
                    	// var clr = 'style="background-color:'+item.codigo_color_hex+' !important;"';
						tB +=' 			<tr>';
						tB +='';
						tB +='				<td>';
						tB +='					<a href="#" >'+padl(item.idcontrolcomentario,4)+'</a>';
						tB +='				</td>';
						tB +='				<td>'+item.idcontrolmaster+'</td>';
						tB +='				<td>'+item.nombre_persona+' ('+item.username+')</td>';
						tB +='				<td>'+item.comentario+'</td>';
						tB +='				<td>'+item.fecha+'</td>';
						tB +='				<td>';
						tB +='					<div class="visible-desktop action-buttons">';
						tB +='';
						if (localStorage.ClaveNivelAcceso == 1){
							tB +='						<a class="green editCME" href="#" id="modCME-'+item.idcontrolcomentario+'-'+item.idcontrolmaster+'" >';
							tB +='							<i class="icon-pencil bigger-130"></i>';
							tB +='						</a>';
							tB +='';
							tB +='						<a class="red delCME" href="#"  id="delCME-'+item.idcontrolcomentario+'" >';
							tB +='							<i class="icon-trash bigger-130"></i>';
							tB +='						</a>';
						}
						tB +='					</div>';
						tB +='				</td>';
						tB +='			</tr>';
					});
					// alert(tB);	
					$('#tblComments01 > tbody').html(tB);
					$("#preloaderPrincipal").hide();

					$(".editCME").on("click",function(event){
						event.preventDefault();
						var arr = event.currentTarget.id.split('-');
						obj.setIsTimeLine(false);
						getControlComentario(arr[1],arr[2]);
					});

					$(".delCME").on("click",function(event){
						event.preventDefault();
						$("#iconSaveCommentResp").show();
						var resp =  confirm("Desea eliminar este registro?");
						if (resp){
							var arr = event.currentTarget.id.split('-');
							//alert(arr[1]);
							obj.setIsTimeLine(false);
				            $.post(obj.getValue(0) + "data/", {o:70, t:12, c:arr[1], p:52, from:0, cantidad:0, s:''},
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


	$("#btnRefComments01").on("click",function(event){
		event.preventDefault();
		onClickFillTable();
	})

	function onClickFillTable(){
		if(oTable != null){
			oTable.fnDestroy();
			$('#tblComments01 > tbody').empty();
			init = true;
		}
		fillTable();
	}


	$("#btnAddComments01").on("click",function(event){
		event.preventDefault();

		obj.setIsTimeLine(false);
		getControlComentario(0,IdControlMaster);

	})

	function getControlComentario(IdControlComentario, IdControlMaster){
        $("#divUploadImage").empty();
        var nc = localStorage.nc;
	        $.post(obj.getValue(0) + "orden-comments-prop/", {
				user: nc,
				idcontrolcomentario: IdControlComentario,
				idcontrolmaster: IdControlMaster
	            },
	            function(html) {
	                $("#divUploadImage").html(html);
	                $("#divUploadImage").modal('toggle');
	        }, "html");
	}

	$(".closeFormUpload").on("click",function(event){
		event.preventDefault();
		$("#preloaderPrincipal").hide();
		$(frmB).hide(function(){
			$(frmB).empty();
			$(frmA).show();
		});
		resizeScreen();
		return false;
	});



});



</script>
