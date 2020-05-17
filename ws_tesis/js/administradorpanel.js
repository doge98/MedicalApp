$(document).ready(function(){
    solicitudlistar();
    solicitudRegistradolistar();
});

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////   PAGINA (SOLICITUDES IORESS)   //////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Quién llama esta funcion? PanelAdminSolicitudes.php
function solicitudlistar(){
    $.post("../ws/web/solicitud.listar.php"
        ).done(function(resultado){
        $("#tablaSolicitud").empty();
        $("#tablaSolicitud").append(resultado);
    });
}

//Quién llama esta funcion? PanelAdminSolicitudesVer.php
function paneladminsolicitudesver(codipress,num_solicitud){
    if (codipress == null || codipress == ''){
    }
    window.location.replace("../Vista/PanelAdminSolicitudesVer.php?codipress=" + codipress +"&num_solicitud=" + num_solicitud);
}

//Quién llama esta funcion? PanelAdminSolicitudesVer.php
function solicitudver(codipress,num_solicitud){
    if (codipress == null || codipress == '' || num_solicitud == null || num_solicitud == ''){
    }
    $.post("../ws/web/solicitud.ver.php",
        {
            codipress:codipress,num_solicitud:num_solicitud
        }
          )
            .done(function(resultado){ 
                $("#solicitudver").empty();
                $("#solicitudver").append(resultado);
            });
}

//Quién llama esta funcion? solicitud.ver.php
function solicitudtransaccion(codigoipress,departamento,provincia,distrito,estado,num_solicitud){
    //SE REGISTRA
    var observacion = document.getElementById("observacion").value;
    var nombrecomercial="";
    var ruc="";
    var razonsocial="";
    var direccion="";
    var representantelegal="";
    var tipodocidentidad="";
    var dni="";
    var telefono="";
    var telefonoemergencia="";
    var latitud="";
    var longitud="";
    var correoipress="";
    
    if(estado == 2){
        observacion = "";
        nombrecomercial=document.getElementById("nombrecomercial").value;
        ruc=document.getElementById("ruc").value;
        razonsocial=document.getElementById("razonsocial").value;
        direccion=document.getElementById("direccion").value;
        representantelegal=document.getElementById("representantelegal").value;
        tipodocidentidad=document.getElementById("tipodocidentidad").value;
        dni=document.getElementById("dni").value;
        telefono=document.getElementById("telefono").value;
        telefonoemergencia=document.getElementById("telefonoemergencia").value;
        latitud=document.getElementById("latitud").value;
        longitud=document.getElementById("longitud").value;
        correoipress=document.getElementById("correo").value;
    }else{
        departamento = "";
        provincia = "";
        distrito = "";
    }
    if (codigoipress != null || codigoipress != ''){
        $.post("../ws/web/ipress.registrar.php",{
            codigoipress:codigoipress,
            estado:estado,
            observacion:observacion,
            nombrecomercial:nombrecomercial,
            ruc:ruc,
            razonsocial:razonsocial,
            direccion:direccion,
            departamento:departamento,
            provincia:provincia,
            distrito:distrito,
            representantelegal:representantelegal,
            tipodocidentidad:tipodocidentidad,
            dni:dni,
            telefono:telefono,
            telefonoemergencia:telefonoemergencia,
            latitud:latitud,
            longitud:longitud,
            correoipress:correoipress,
            num_solicitud:num_solicitud
        }).done(function(resultado){ 
            var datos = $.parseJSON(resultado);
            if(datos.estado == 200){
                $('#modal-observacion').modal('hide');
                $('#modal-aceptar').modal('hide');
                Swal.fire({
                    title: 'Registrado',
                    text: datos.respuesta,
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.value) {
                        window.location.replace("../Vista/PanelAdminSolicitudes.php");
                    }else{
                        window.location.replace("../Vista/PanelAdminSolicitudes.php");
                    }
                });
            }else{
                Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: datos.respuesta
                }).then((result) => {
                    if (result.value) {
                        window.location.replace("../Vista/PanelAdminSolicitudes.php");
                    }else{
                        window.location.replace("../Vista/PanelAdminSolicitudes.php");
                    }
                });
            }
        });
    }
}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////   PAGINA (SOLICITUDES REGISTRADAS)   /////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function solicitudRegistradolistar(){
    $.post("../ws/web/solicitudregistrada.listar.php"
        ).done(function(resultado){
        $("#tablaSolicitudRegistrada").empty();
        $("#tablaSolicitudRegistrada").append(resultado);
    });
}











