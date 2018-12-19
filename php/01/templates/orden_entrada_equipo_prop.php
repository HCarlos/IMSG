<?php

include("includes/metas.php");

$user = $_POST['user'];$idcontrolcomentario  = $_POST['idcontrolcomentario'];
$idcontrolmaster  = $_POST['idcontrolmaster'];
$idempresa  = $_POST['idempresa'];
$frmA = $_POST['frmA'];
$frmB = $_POST['frmB'];

?>
<div class="row-fluid">
<div class="span12" style="padding-left: 1em; padding-right: 1em;">
<div class="tabbable">

	<h3 class="header smaller lighter blue" id="title"></h3>

	<form id="frmCM02" role="form">

		<ul class="nav nav-tabs" id="myTab">
			<li class="active">
				<a data-toggle="tab" href="#general">
					<i class="orange icon icon-lock bigger-110"></i>
					CERRAR ORDEN
				</a>
			</li>
		</ul>

		<div class="tab-content">
			<div id="general" class="tab-pane active">

                    <table class="wd100prc">

                        <tr>
                            <td class="wd20prc"><label for="idclienterecibioentrega">Recibio Cliente</label></td>
                            <td colspan="7" class="wd70prc">
                                <select class="form-control wd90prc"  name="idclienterecibioentrega" id="idclienterecibioentrega" size="1" />
                            </td>
                            <td colspan="2" ></td>
                        </tr>

                        <tr>
                            <td class="wd20prc"><label for="idtecnicoentrego">Entregó IMSG</label></td>
                            <td colspan="7" class="wd70prc">
                                <select class="form-control wd90prc"  name="idtecnicoentrego" id="idtecnicoentrego" size="1" />
                            </td>
                            <td colspan="2" ></td>
                        </tr>

                        <tr>
                            <td class="wd20prc"><label for="fsalida ">Fecha y Hora de Salida</label></td>
                            <td colspan="7" class="wd70prc">
                                <input type="text" name="fsalida" id="fsalida" class="form-control wd90prc altoMoz" readonly="" />
                            </td>
                            <td colspan="2" ></td>
                        </tr>

                    </table>

			</div>
		</div>

	    <input type="hidden" name="idcontrolmaster" id="idcontrolmaster" value="<?= $idcontrolmaster; ?>">
	    <input type="hidden" name="user" id="user" value="<?php echo $user; ?>">
	    <div class="form-group w96" style='margin-right: 3em; margin-top: 1em;'>
	    	<button type="button" class="btn btn-default pull-right" data-dismiss="modal" id="closeFormUpload"><i class="icon icon-signout"></i> Salir</button>
	    	<span class="muted"></span>
	    	<button type="submit" class="btn btn-primary pull-right" style='margin-right: 4em;'><i class="icon icon-lock"></i> Cerrar Orden</button>
		</div>

	</form>

</div>

</div>
</div>

<script typy="text/javascript">

jQuery(function($) {

	$("#preloaderPrincipal").show();
	$("#idclienterecibioentrega").focus();

	var IdControlMaster = <?= $idcontrolmaster ?>;
    var IdEmpresa = <?= $idempresa ?>;
    var frmA = "<?= $frmA ?>";
    var frmB = "<?= $frmB ?>";

    $("#frmCM02").unbind("submit");
	$("#frmCM02").on("submit",function(event){
		event.preventDefault();
        $("#preloaderPrincipal").show();

		if (validForm()){

		    var queryString = $(this).serialize();

            $.post(obj.getValue(0) + "data/", {o:70, t:13, c:queryString, p:62, from:0, cantidad:0, s:''},
            function(json) {
                    IdControlMaster = parseInt(json[0].msg,0);
            		if ( (IdControlMaster > 0) || (json[0].msg == "OK") ){
            			alert("Datos guardados con éxito.");
						$("#preloaderPrincipal").hide();
						$(frmB).hide(function(){
							$(frmB).empty();
							$(frmA).show();
						});
        			}else{
						$("#preloaderPrincipal").hide();
        				alert(json[0].msg);
        			}
        	}, "json");
		}else{
			$("#preloaderPrincipal").hide();
		}
	});


	function getOrden(IdControlMaster){
		$("#preloaderPrincipal").show();
		$.post(obj.getValue(0) + "data/", {o:70, t:29, c:IdControlMaster, p:54, from:0, cantidad:0,s:''},
			function(json){
				if (json.length>0){                   
                // alert(json[0].idclienterecibioentrega); 
                    $("#idclienterecibioentrega").val(json[0].idclienterecibioentrega);
                    $("#idtecnicoentrego").val(json[0].idtecnicoentrego);
                    $("#fsalida").dateToSpanish(json[0].fsalida,'',1);
                    $("#preloaderPrincipal").hide();
				}
		},'json');

	}


	// close Form
	$("#closeFormUpload").on("click",function(event){
		event.preventDefault();
		$("#preloaderPrincipal").hide();
		$(frmB).hide(function(){
			$(frmB).empty();
			$(frmA).show();
		});
		resizeScreen();
		return false;
	});

	function validForm(){

		return true;

	}

    function getRecibio(IdEmpresa){
        var nc = "u="+localStorage.nc;
        $("#idclienterecibioentrega").empty();
        $("#idclienterecibioentrega").append('<option value="0" selected>Seleccione un elemento</option>');
        $.post(obj.getValue(0)+"data/", { o:1, t:78, p:51,c:IdEmpresa,from:0,cantidad:0, s:"" },
            function(json){
               $.each(json, function(i, item) {
                    $("#idclienterecibioentrega").append('<option value="'+item.data+'"> '+item.label+'</option>');
                });
                getTecnicos(IdEmpresa);
            }, "json"
        );
    }

    function getTecnicos(IdEmpresa){
        var nc = "u="+localStorage.nc;
        $("#idtecnicoentrego").empty();
        $("#idtecnicoentrego").append('<option value="0" selected>Seleccione un elemento</option>');
        $.post(obj.getValue(0)+"data/", { o:1, t:79, p:51,c:IdEmpresa,from:0,cantidad:0, s:"" },
            function(json){
               $.each(json, function(i, item) {
                    $("#idtecnicoentrego").append('<option value="'+item.data+'"> '+item.label+'</option>');
                });
                getOrden(IdControlMaster);
            }, "json"
        );
    }

	getRecibio(IdEmpresa);

});

</script>
