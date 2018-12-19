    <div class="row">

        <div class="span4">
            <div class="panel panel-success">
              <div class="panel-heading">Personas</div>
              <div class="panel-body" style="height: 30em !important; ">
                    <select class="lstPersonas " name="lstPersonas" id="lstPersonas" multiple="multiple" style="width:100% !important; height: 95% !important;" >
                    </select>
                    <span class="label label-large label-yellow arrowed-right pull-left" id="lbl02"></span>
                    <div class="span3 pull-right">
                        <label>
                            <input name="chkAllGru" id="chkAllGru" class="ace ace-switch" type="checkbox">
                            <span class="lbl"></span>
                        </label>
                    </div>
               </div>
            </div>
        </div>

        <div class="span2">
            <div class="panel panel-default"  style="height: 33em;">
                <div class="panel-body" style="padding-top: 12em;">
                        <button id="AddItem" name="btnAsig" class="btnAsig btn btn-primary btn-lg" >
                            Asignar <span class="glyphicon glyphicon-chevron-right"></span></button><br/><br/>
                        <button id="DeleteItem" name="DeleteItem" class="btnDel btn btn-primary btn-lg" >
                            <span class="glyphicon glyphicon-chevron-left"></span>Quitar</button>
                </div>
            </div>
             <div class="div1em"></div>
        </div>

        <div class="span4">
            <div class="panel panel-primary">
              <div class="panel-heading">Empresas</div>
              <div class="panel-body" style="height: 30em !important; ">
                    <label for="selEmpresas" class="lblH2cmb">Lista de Empresas </label>
                    <select name="selEmpresas" id="selEmpresas" size="1" style="width:100% !important;" >
                    </select>

                    <label for="lstReptteLegals" class="lblH2">Contactos Asignados:</label>
                    <select class="lstReptteLegals" name="lstReptteLegals" id="lstReptteLegals" multiple="multiple" style="width:100% !important; height: 69% !important;" >
                    </select>
                    <span class="label label-large label-yellow arrowed pull-right" id="lbl01"></span>

               </div>
            </div>
        </div>

    </div>

<script type="text/javascript">

function getEmpresas(){
    var nc = "u="+localStorage.nc;
    $("#selEmpresas").empty();
    $.post(obj.getValue(0)+"data/", { o:30, t:100, p:51, c:nc,from:0,cantidad:0, s:"" },
        function(json){
           $.each(json, function(i, item) {
                $("#selEmpresas").append('<option value="'+item.data+'"> '+item.label+'</option>');
            });
            getPersonas();
        }, "json"
    );
}

function getPersonas(){
    var nc = "u="+localStorage.nc;
    $.post(obj.getValue(0)+"data/", { o:30, t:101, p:51, c:nc,from:0,cantidad:0, s:"" },
        function(json){
            var nc;
           $.each(json, function(i, item) {
                //alert(item.label);
                nc = item.label.split("@");
                $("#lstPersonas").append('<option value="'+item.data+'"> '+item.label+'</option>');
            });
            $("#lbl02").html(commaSeparateNumber(json.length)+" Contactos")
            $("#preloaderPrincipal").hide();
            getReptteLegalsEmp();

        }, "json"
    );
}

function getReptteLegalsEmp(){
    var nc = "u="+localStorage.nc;
    $("#lstReptteLegals").empty();
    var y = $('select[name="selEmpresas"] option:selected').val();
    $.post(obj.getValue(0)+"data/", {o:30, t:102, p:51,c:nc,from:0,cantidad:0, s:y },
        function(json){
           $.each(json, function(i, item) {
                $("#lstReptteLegals").append('<option value="'+item.data+'"> '+item.label+'</option>');
            });
            $("#lbl01").html(commaSeparateNumber(json.length)+" Contactos");
        }, "json"
    );
}

$("#chkAllGru").on("click",function(event){
    var checked =$(this).is(":checked")
    if (checked) {
        $("#lstPersonas option").each(function(){
            $(this).prop('selected', true);
        });
    } else {
        $("#lstPersonas option").each(function(){
            $(this).prop('selected', false);
        });
    }
});


$("#selEmpresas").on("change",function(event){
    event.preventDefault();
    getReptteLegalsEmp();
});


$("#AddItem").on("click",function(event){
    $("#preloaderPrincipal").show();

    // Opciones asignadas a un determinado Profesore
    var x = $('.lstPersonas option:selected').val();
    var y = $('select[name="selEmpresas"] option:selected').val();

    if (isDefined(x)){
        $("#preloaderPrincipal").hide();
        alert("Seleccione una opción disponible");
        return false;
    }else{
        x='';
        $(".lstPersonas option:selected").each(function () {
                x += $(this).val() + "|";
          });

    }
    if (isDefined(parseInt(y)) || y <= 0){
        $("#preloaderPrincipal").hide();
        alert("Seleccione un Profesore");
        return false;
    }
    var d = x+'.'+y;

    //alert(d);

    var nc = "u="+localStorage.nc;

    $.post(obj.getValue(0)+"data/", { o:30, c:d, t:10, p:53, s:nc, from:0, cantidad:0 },
        function(json){
            //alert( json[0].msg);
            if (json.length<=0 && json[0].msg=="Error") { return false;}
                getReptteLegalsEmp();
                $("#preloaderPrincipal").hide();
    }, "json");
});

$("#DeleteItem").on("click",function(event){
    $("#preloaderPrincipal").show();

    var x = $('.lstReptteLegals option:selected').val();

    if (isDefined(parseInt(x))){
        $("#preloaderPrincipal").hide();
        alert("Seleccione una opción disponible");
        return false;
    }else{
        x='';
        $(".lstReptteLegals option:selected").each(function () {
                x += $(this).val() + "|";
          });

    }

    //alert(x);
    var nc = "u="+localStorage.nc;

    $.post(obj.getValue(0)+"data/", { o:30, c:x, t:20, p:53, s:nc, from:0, cantidad:0 },
        function(json){
            //alert(json[0].msg)
            if (json.length<=0 && json[0].msg=="Error") { return false;}
                //getEmpresas();
                getReptteLegalsEmp();
                $("#preloaderPrincipal").hide();
    }, "json");
});

getEmpresas();

</script>
