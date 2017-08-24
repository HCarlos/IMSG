
                <li class="transparent">

                    <a data-toggle="dropdown" href="#" class="dropdown-toggle ajusteliMenuMain transparent" >
                        <img class="nav-user-photo" id="imgFoto"/>
                        <span class="user-info transparent" id="nameuser"></span>
                        <i class="icon-caret-down"></i>
                    </a>

                    <ul class="user-menu pull-right dropdown-menu dropdown-blue dropdown-caret dropdown-closer ">
                        <li>
                            <a href="#" id="profileUserPWD">
                                <i class="icon-key"></i>
                                Cambiar Password
                            </a>
                        </li>

                        <li>
                            <a href="#" id="profileUserFoto">
                                <i class="icon-picture"></i>
                                Cambiar Foto
                            </a>
                        </li>

                        <li>
                            <a href="#" id="profileUser">
                                <i class="icon-user"></i>
                                Perfil
                            </a>
                        </li>

                        <li class="divider"></li>

                        <li>
                            <a href="#" id="closeSession">
                                <i class="icon-off"></i>
                                Cerrar Sesión
                            </a>
                        </li>
                    </ul>
                </li>

<script typy="text/javascript">


    if ($("#closeSession").length) {
        $("#closeSession").unbind("click");
        $("#closeSession").on("click", function(event) {
            event.preventDefault();
            $.post(obj.getValue(0) + "data/", {o:49, t:1, p:52, c:"u=" +localStorage.nc, from: 0, cantidad: 0, s: ""},
            function(json) {
                // alert(json[0].msg);
                if (json[0].msg=="OK"){
                console.log("Desconectado...");
                delete sessionStorage.Id;
                delete localStorage.nc;
                delete localStorage.IdEmp;
                delete localStorage.IdUser;
                delete localStorage.Empresa;
                delete localStorage.IdUserNivelAcceso;
                delete localStorage.TRPP;
                delete localStorage.IdEmpresaHome
                // alert(json[0].msg);
                document.location.href = obj.getValue(0);

                }else{
                    alert(json[0].msg);
                }
            }, "json");

        });
    }

    if ($("#nameuser")){
        var nc = localStorage.nc

        $.post(obj.getValue(0) + "data/", {o:0, t:0, c:nc, p:55, from:0, cantidad:0, s:""},
                function(json) {

                            var strx = json[0].foto.split(".");
                            var imgPath;
                            if (json[0].foto!=""){
                                imgPath = obj.getValue(0) + "upload/"+strx[0]+"-36."+strx[1];
                            }else{
                                imgPath = obj.getValue(0) + "images/emoticons/user-36.jpg";
                            }

                            $("#imgFoto").attr("src",imgPath);
                            $("#nameuser").text(json[0].nombres+" "+json[0].apellidos);

                }, "json");

    }

    if ($("#profileUser").length) {
        $("#profileUser").unbind("click");
        $("#profileUser").on("click", function(event) {
            event.preventDefault();
            cfgBase0();
            $("#preloaderSingle").show();

            var nc = localStorage.nc;
            $.post(obj.getValue(0) + "profile/", {
                    user: nc
                },
                function(html) {
                    $("#preloaderPrincipal").hide();
                    $('#breadcrumb').html(getBar('Inicio,Profile'));
                    $("#contentMain").html("").fadeOut('slow',function(event){
                       $("#contentProfile").html(html).fadeIn('slow');
                    });

                }, "html");
        });
    }


    if ($("#profileUserFoto").length) {
        $("#profileUserFoto").unbind("click");
        $("#profileUserFoto").on("click", function(event) {
            event.preventDefault();
            cfgBase0();
            $("#preloaderSingle").show();

            var nc = localStorage.nc.split("@");
            $.post(obj.getValue(0) + "profileFoto/", {
                    user: nc[0]
                },
                function(html) {
                    $("#preloaderPrincipal").hide();
                    $('#breadcrumb').html(getBar('Inicio,Avatar'));
                    $("#contentMain").html("").fadeOut('slow',function(event){
                       $("#contentProfile").html(html).fadeIn('slow');
                    });
                }, "html");
        });
    }

    if ($("#profileUserPWD").length) {
        $("#profileUserPWD").unbind("click");
        $("#profileUserPWD").on("click", function(event) {
            event.preventDefault();
            cfgBase0();
            $("#preloaderSingle").show();

            var nc = localStorage.nc.split("@");
            $.post(obj.getValue(0) + "profilePWD/", {
                    user: nc[0]
                },
                function(html) {
                    $("#preloaderPrincipal").hide();
                    $('#breadcrumb').html(getBar('Inicio,Cambiar Password'));
                    $("#contentMain").html("").fadeOut('slow',function(event){
                       $("#contentProfile").html(html).fadeIn('slow');
                    });
                }, "html");
        });
    }

    function cfgBase0(){
        resizeScreen();
        $("#contentLevel5").empty();
        $("#contentLevel5").hide();
        $("#contentLevel4").empty();
        $("#contentLevel4").hide();
        $("#contentLevel3").empty();
        $("#contentLevel3").hide();
        $("#contentProfile").empty();
        $("#contentProfile").hide();
        $("#contentMain").show();
        $("#contentMain").empty();
        $("#preloaderPrincipal").show();
        obj.setIsTimeLine(false);
    }



</script>
