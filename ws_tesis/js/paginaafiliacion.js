$(document).ready(function(){
    $("#mensajeDNI").hide();
    $("#mensajeIPRESS").hide();
    $("#mensajeArchivo").hide();
});

function buscarDNI(){
    var dni=document.getElementById("dni").value;
    var fechaNac=document.getElementById("fechaNac").value;
    var sexo=document.getElementById("sexo").value;
    $.post(
            "../ws/web/repositorio.DNIbuscar.php",
            {
                dni : dni,fechaNac:fechaNac,sexo:sexo
            }
        ).done(function(resultado){
            var datos = $.parseJSON(resultado); 
            if(datos.msg == ""){
                $("#datodni").val(dni);
                $("#nombres").val(datos.dataJson.persona.preNombres);
                $("#paterno").val(datos.dataJson.persona.apPaterno);
                $("#materno").val(datos.dataJson.persona.apMaterno);
                $("#direccion").val(datos.dataJson.persona.deDireccion);
                $("#mensajeDNI").hide();
            }else{
                $("#mensajeDNI").hide();
                $("#datodni").val("");
                $("#nombres").val("");
                $("#paterno").val("");
                $("#materno").val("");
                $("#direccion").val("");
                document.getElementById("errordni").innerHTML=datos.msg;
                $("#mensajeDNI").show();
            }
        }).fail(function(error){
            alert(error.responseText);
        });
}

function buscarIPRESS(){
    var codigoipress=document.getElementById("codigoipress").value;
    $.post(
            "../ws/web/repositorio.IPRESSbuscar.php",
            {
                codigoipress:codigoipress
            }
        ).done(function(resultado){
            if(resultado != "1"){
                var datos = $.parseJSON(resultado);
                $("#codipress").val(codigoipress);
                $("#rucipress").val(datos[0].PROPIETARIO_RUC);
                $("#nombreipress").val(datos[0].ESTABLECIMIENTO_NOMBRE);
                $("#correoipress").val(datos[0].REPLEGAL_CORREO);
                $("#direccionipress").val(datos[0].ESTABLECIMIENTO_DIRECCION);
                $("#representanteipress").val(datos[0].REPLEGAL_DATOS); 
                $("#mensajeIPRESS").hide();
            }else{
                $("#codipress").val("");
                $("#rucipress").val("");
                $("#nombreipress").val("");
                $("#correoipress").val("");
                $("#direccionipress").val("");
                $("#representanteipress").val("");
                document.getElementById("erroripress").innerHTML="El Código ingresado de la IPRESS no existe.";
                $("#mensajeIPRESS").show();
            }
        }).fail(function(error){
            alert(error.responseText);
        });
}

function insertarSolicitud(){
    var codipress=document.getElementById("codipress").value;
    var datodni=document.getElementById("datodni").value;
    var correoipress=document.getElementById("correoipress").value;
    var archivo = document.getElementById("archivo").files[0];
    var form_data = new FormData();
    form_data.append("file",archivo);
    if(datodni == ""){
        document.getElementById("errordni").innerHTML="No ha ingresado su DNI";
        document.getElementById("dni").focus();
        $("#mensajeDNI").show();
    }else{
        if(codipress == ""){
            document.getElementById("erroripress").innerHTML="No ha ingresado el código de IPRESS";
            document.getElementById("codigoipress").focus();
            $("#mensajeIPRESS").show();
        }else{
            if(document.getElementById("archivo").files[0] == undefined){
                document.getElementById("errorarchivo").innerHTML="No se ha seleccionado ningún documento";
                $("#mensajeArchivo").show();
            }else{
                $("#mensajeArchivo").hide();
                $("#mensajeIPRESS").hide();
                $("#mensajeDNI").hide();
                $.ajax({
                    url:"../ws/web/afiliacion_solicitud.registrar.php?codipress="+codipress+"&datodni="+datodni+"&correoipress="+correoipress,
                    method:"POST",
                    data:form_data,
                    contentType:false,
                    cache:false,
                    processData:false,
                    before:function(){
                        
                    },
                    success:function(data)
                    {
                        var datos = $.parseJSON(data);
                        if(datos[0].estado == 500){
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: datos[0].respuesta
                            });
                        }else{
                            Swal.fire({
                                title: 'Registrado',
                                text: datos[0].respuesta,
                                icon: 'success',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.value) {
                                    window.location.replace("index.html");
                                }else{
                                    window.location.replace("index.html");
                                }
                            });
                        }
                    }
                });
            }   
        }
    }
}