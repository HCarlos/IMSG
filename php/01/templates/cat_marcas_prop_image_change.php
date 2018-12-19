<?php

include("includes/metas.php");

require_once("../oFunctions.php");
$F = oFunctions::getInstance();

require_once("../oCentura.php");
$f = oCentura::getInstance();

$user = $_POST['user'];
$idmarca  = $_POST['idmarca'];
$param1 = md5($user.$idmarca);

?>
<div class="row-fluid">
<div class="span12" style="padding-left: 1em; padding-right: 1em;">
<div class="tabbable">

	<h3 class="header smaller lighter blue" id="title"></h3>
	<form id="frmData" role="form">

		<ul class="nav nav-tabs" id="myTab">

			<li class="active">
				<a data-toggle="tab" href="#general">
					<i class="red icon-home bigger-110"></i>
					Marcas
				</a>
			</li>

		</ul>

		<div class="tab-content">

			<div id="general" class="tab-pane active">

				<table class="wd100prc">
					<tr>
						<td></td>
						<td>
							<img id="imgView0" src="" width="400" height="200" />
						</td>
					</tr>
					<tr>
						<td><label for="file_0" class="control-label">Imagen</label></td>
						<td>
							<input id="file_0" name="file_0" type="file" class="filex" required>
								<i class="icon-pic"></i>
						</td>
					</tr>
				</table>

			</div>

		</div>

	    <input type="hidden" name="idmarca" id="idmarca" value="<?php echo $idmarca; ?>">
		<input type="hidden" id="iduser" name="iduser" value="">
		<input type="hidden" id="img0" name="img0" value="">
	    <input type="hidden" name="user" id="user" value="<?php echo $user; ?>">
        <input type="hidden" name="v2" id="v2" value="<?php echo $param1; ?>">
	    <div class="form-groupw96" style='margin-right: 3em; margin-top: 1em;'>
	    	<button type="button" class="btn btn-default pull-right" data-dismiss="modal" id="closeFormUpload"><i class="icon-signout"></i>Cerrar</button>
	    	<span class="muted"></span>
	    	<button type="submit" class="btn btn-primary pull-right" style='margin-right: 4em;'><i class="icon-save"></i>Guardar</button>
		</div>

	</form>

</div>




</div>
</div>
<!--PAGE CONTENT ENDS-->

<script typy="text/javascript">

jQuery(function($) {

	$("#preloaderPrincipal").hide();

	$("#iduser").val(localStorage.IdUser);
	$("#marca").focus();

	var IdMarca = <?php echo $idmarca ?>;

	$("#title").html("Editando el registro: "+IdMarca);
	getMarca(IdMarca);

	function getMarca(IdMarca){
		$.post(obj.getValue(0) + "data/", {o:5, t:11, c:IdMarca, p:54, from:0, cantidad:0,s:''},
			function(json){
				if (json.length>0){
					$("#img0").val(json[0].imagen);
                	var strx = json[0].imagen.split(".");
                	var imgPath = obj.getValue(0) + "up_empresa/"+strx[0]+"."+strx[1];
                	var src = imgPath+"?timestamp="+d.getTime();
                	$("#imgView0").attr('src',src);
					$("#file_0").val(json[0].imagen);
				}
		},'json');
	}
	
	$("#frmData").on("submit",function(event){
		event.preventDefault();

	    var queryString = $(this).serialize();	
	    // alert(queryString);

		if (validForm()){
	    
		    $("#preloaderPrincipal").show();

		    var data = new FormData();

			jQuery.each($('input[type=file]')[0].files, function(i, file) {
			    data.append('file_'+i, file);
			});

			data.append('data', queryString);

			$.ajax({
			    url:obj.getValue(0)+"fu-marca-edit-01/",
			    data: data,
			    cache: false,
			    contentType: false,
			    processData: false,
			    dataType: 'json',
			    type: 'POST',
			    success: function(json){
			        alert(json.message);			           
			    	if (json.status=="OK"){
						$("#preloaderPrincipal").hide();
						$("#divUploadImage").modal('hide');
			       	}
			       	$("#preloaderPrincipal").hide();
			    }
			});

		}

	});


	$("#closeProp").on("click",function(event){
		$("#preloaderPrincipal").hide();
		$("#divUploadImage").modal('hide');
	});

	function validForm(){

		if($("#file_0").val().length <= 0){
			alert("Faltan la Imagen");
			$("#file_0").focus();
			return false;
		}

		return true;

	}

    $('.filex').ace_file_input({
        no_file:'Sin Archivo ...',
        btn_choose:'Seleccione un archivo',
        btn_change:'Cambiar',
        droppable:false,
        onchange:null,
        thumbnail:true, //| true | large
        whitelist:'gif|png|jpg|jpeg|pdf|doc|docx|xls|xlsx|ppt|pptx|txt',
        blacklist:'exe|php|odt'
        //onchange:''
        //
    });




});

</script>
