window.onload = function () {
    ipressupsmovil0combo();
};

function ipressver() {
    $.post(
        "../ws/web/ipress.ver.php").done(function (resultado) {
        var datos = $.parseJSON(resultado);
        if (datos != 1) {
            $("#nombrecomercial").val(datos.nombre_comercial);
            $("#codigounicoipress").val(datos.codigo_unico_ipress);
            $("#codigounicoipress").val(datos.codigo_unico_ipress);
            $("#ruc").val(datos.ruc);
            $("#razonsocial").val(datos.razon_social);
            $("#direccion").val(datos.direccion + " " + datos.departamento + "-" + datos.provincia + "-" + datos.distrito);
            $("#representantelegal").val(datos.representante_legal);
            $("#documentoidentidad").val(datos.tipo_doc_identidad + " " + datos.dni);
            $("#telefono").val(datos.telefono + " / " + datos.telefono_emergencia);
            $("#latitud").val(datos.latitud);
            $("#longitud").val(datos.longitud);
            ipresslistar();
        } else {
            alert(resultado);
        }
    }).fail(function (error) {
        alert(error.responseText);
    });
}

function ipresslistar() {
    $.post("../ws/web/ipressups.listar.php")
        .done(function (resultado) {
            $("#tablaups").empty();
            $("#tablaups").append(resultado);
        }).fail(function (error) {
            alert(error.responseText);
        });
}
///////////////////////////////////////////////////////////////////////////
///////////////////////////PanelIpressEspMed.php///////////////////////////
///////////////////////////////////////////////////////////////////////////
function ipressupsmovil0combo() {
    $.post("../ws/web/ipressupsmovil0.combo.php")
        .done(function (resultado) {
            $("#vercomboups").empty();
            $("#vercomboups").append(resultado);
        });
}

var arrayupss = [];

function agregartablaupss() {
    var comboups = document.getElementById("comboups");
    var ipress_ups_codigo = comboups.options[comboups.selectedIndex].value;
    var descripcion = comboups.options[comboups.selectedIndex].text;
    if (ipress_ups_codigo != "") {
        var estadoups = 0;
        for (var i = 0; i < arrayupss.length; i++) {
            if (arrayupss[i]["ipress_ups_codigo"] == ipress_ups_codigo) {
                estadoups = 1;
            }
        }
        if (estadoups == 0) {
            arrayupss.push({
                ipress_ups_codigo,
                descripcion
            });
            var table = document.getElementById("tablaups");
            var row = table.insertRow();
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            cell1.innerHTML = ipress_ups_codigo;
            cell2.innerHTML = descripcion;
            cell3.innerHTML = "<button class='btn btn-danger btn-circle btn-sm' onclick='removerfila(this)'>X</button>";
        }
        console.log(arrayupss);
    }
}

function removerfila(r) {
    var posicion = r.parentNode.parentNode.rowIndex;
    document.getElementById("tablaups").deleteRow(posicion);
    arrayupss.splice((posicion - 1), 1);
}

function registrarupsmovil() {
    if (arrayupss.length > 0) {
        $.post("../ws/web/ipressupsmovil.registrar.php", {
            arrayupss: arrayupss
        }).done(function (resultado) {
            try {
                var datos = $.parseJSON(resultado);
                if (datos.estado == 200) {
                    arrayupss.length = 0;
                    Swal.fire({
                        title: 'Registrado',
                        text: datos.respuesta,
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.value) {
                            window.location.replace("../Vista/PanelIpressEspMed.php");
                        } else {
                            window.location.replace("../Vista/PanelIpressEspMed.php");
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: datos.respuesta
                    });
                }
            } catch (e) {
                alert(resultado);
            }
        }).fail(function (error) {
            alert(error.responseText);
        });
    }
}

function ipressupsmovil1listar() {
    $.post("../ws/web/ipressupsmovil1.listar.php")
        .done(function (resultado) {
            $("#tablamovil1").empty();
            $("#tablamovil1").append(resultado);
        });
}

function ipressupsmovildesactivar(upsipress) {
    Swal.fire({
        title: '¿Está seguro?',
        text: "Dará de baja esta UPS y no podrá ser visto por los pacientes",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No!'
    }).then((result) => {
        if (result.value) {
            $.post("../ws/web/ipressupsmovil.desactivar.php", {
                upsipress: upsipress
            }).done(function (resultado) {
                window.location.replace("../Vista/PanelIpressEspMed.php");
            }).fail(function (error) {
                alert(error.responseText);
            });
        }
    });
}

//////////////////////////////////////////////////////////////////
///////////////////////PanelIpressMedicos.php/////////////////////
/////////////////////////////////////////////////////////////////
var documento_persona = "";
var nombre_persona = "";
var paterno_persona = "";
var materno_persona = "";
var sexo_persona = "";
var fecnac_persona = "";
var codigo_departamento = "";
var codigo_provincia = "";
var codigo_distrito = "";
var direccion_persona = "";

var codigo_cmp_medico = "";
var consejo_regional_medico = "";
var arrayupsmedico = [];

$(document).on("click", "#btnbuscarcmp", function () {
    var cmpmedico = document.getElementById("buscarcmp").value;
    $.post("../ws/web/ipressmedico.ver.php", {
        cmpmedico: cmpmedico
    }).done(function (resultado) {
        try {
            var datos = $.parseJSON(resultado);
            $("#htmlcmp").val(cmpmedico);
            $("#htmlnombrecmp").val(datos['nombres']);
            $("#htmlapellidocmp").val(datos['apellido']);
            $("#htmlconsejoregionalcmp").val(datos['consejo']);
            codigo_cmp_medico = cmpmedico;
            consejo_regional_medico = datos['consejo'];
        } catch (e) {
            Swal.fire({
                icon: 'error',
                title: 'Error...',
                text: 'No se encontró resultados',
            });
            $("#htmlcmp").val("");
            $("#htmlnombrecmp").val("");
            $("#htmlapellidocmp").val("");
            $("#htmlconsejoregionalcmp").val("");
            codigo_cmp_medico = "";
        }
    });
});

$(document).on("click", "#btnbuscardni", function () {
    var dni = document.getElementById("buscardni").value;
    var fechaNac = document.getElementById("buscarfechanacimiento").value;
    var sexo = document.getElementById("buscarsexo").value;
    var sex;
    var sexid;
    if (sexo == 1) {
        sex = "MASCULINO";
        sexid = 1;
    } else {
        sex = "FEMENINO";
        sexid = 0;
    }
    $.post(
        "../ws/web/repositorio.DNIbuscar.php", {
            dni: dni,
            fechaNac: fechaNac,
            sexo: sexo
        }
    ).done(function (resultado) {
        try {
            var datos = $.parseJSON(resultado);
            if (datos.msg == "") {
                $("#htmldni").val(dni);
                $("#htmlfechanacimientodni").val(fechaNac);
                $("#htmlsexodni").val(sex);
                $("#htmlnombredni").val(datos.dataJson.persona.preNombres);
                $("#htmlapellidodni").val(datos.dataJson.persona.apPaterno + " " + datos.dataJson.persona.apMaterno);
                $("#htmldirecciondni").val(datos.dataJson.persona.deDireccion);
                $("#htmldepartamentodni").val(datos.dataJson.persona.deUbigeoDep);
                $("#htmlprovinciadni").val(datos.dataJson.persona.deUbigeoPro);
                $("#htmldistritodni").val(datos.dataJson.persona.deUbigeoDis);

                documento_persona = dni;
                nombre_persona = datos.dataJson.persona.preNombres;
                paterno_persona = datos.dataJson.persona.apPaterno;
                materno_persona = datos.dataJson.persona.apMaterno;
                sexo_persona = sexid;
                fecnac_persona = fechaNac;
                codigo_departamento = datos.dataJson.persona.coUbigeoDep;
                codigo_provincia = datos.dataJson.persona.coUbigeoPro;
                codigo_distrito = datos.dataJson.persona.coUbigeoDis;
                direccion_persona = datos.dataJson.persona.deDireccion;
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error...',
                    text: datos.msg,
                });
                $("#htmldni").val("");
                $("#htmlfechanacimientodni").val("");
                $("#htmlsexodni").val("");
                $("#htmlnombredni").val("");
                $("#htmlapellidodni").val("");
                $("#htmldirecciondni").val("");
                $("#htmldepartamentodni").val("");
                $("#htmlprovinciadni").val("");
                $("#htmldistritodni").val("");
                documento_persona = "";
            }
        } catch (e) {
            $("#htmldni").val("");
            $("#htmlfechanacimientodni").val("");
            $("#htmlsexodni").val("");
            $("#htmlnombredni").val("");
            $("#htmlapellidodni").val("");
            $("#htmldirecciondni").val("");
            $("#htmldepartamentodni").val("");
            $("#htmlprovinciadni").val("");
            $("#htmldistritodni").val("");
            documento_persona = "";
        }
    });
});

function ipressupsmovil1combo() {
    $.post("../ws/web/ipressupsmovil1.combo.php")
        .done(function (resultado) {
            $("#combomovil").empty();
            $("#combomovil").append(resultado);
        });
}
//arrayupsmedico
$(document).on("click", "#btnagregartablaupsmovil", function () {
    var comboups = document.getElementById("comboups");
    var ipress_ups_codigo = comboups.options[comboups.selectedIndex].value;
    var descripcion = comboups.options[comboups.selectedIndex].text;
    if (ipress_ups_codigo != "0") {
        var estadoups = 0;
        for (var i = 0; i < arrayupsmedico.length; i++) {
            if (arrayupsmedico[i]["ipress_ups_codigo"] == ipress_ups_codigo) {
                estadoups = 1;
            }
        }
        if (estadoups == 0) {
            arrayupsmedico.push({
                ipress_ups_codigo,
                descripcion
            });
            var table = document.getElementById("tablaupsmedico");
            var row = table.insertRow();
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            cell1.innerHTML = ipress_ups_codigo;
            cell2.innerHTML = descripcion;
            cell3.innerHTML = "<button class='btn btn-danger btn-circle btn-sm' onclick='btnquitartablaupsmovil(this)'>X</button>";
        }
    }
});

function btnquitartablaupsmovil(r) {
    var posicion = r.parentNode.parentNode.rowIndex;
    document.getElementById("tablaupsmedico").deleteRow(posicion);
    arrayupsmedico.splice((posicion - 1), 1);
}

$(document).on("click", "#btnregistrarmedico", function () {
    var correo_cuenta = document.getElementById("correomedico").value;
    var telefono_persona = document.getElementById("telefonomedico").value;
    var combocivil = document.getElementById("estadocivilmedico");
    var civil_persona = combocivil.options[combocivil.selectedIndex].text;
    var referencia_persona = document.getElementById("referenciamedico").value;
    var estado = 0;
    var respuesta;

    if (arrayupsmedico == 0) {
        estado = 1;
        respuesta = "Ingrese por lo menos un UPS";
    }

    if (telefono_persona == "" || civil_persona == "Estado Civil" || referencia_persona == "" || correo_cuenta == "") {
        estado = 1;
        respuesta = "Faltan datos";
    }

    if (documento_persona == "") {
        estado = 1;
        respuesta = "Ingrese DNI";
    }
    if (codigo_cmp_medico == "") {
        estado = 1;
        respuesta = "Ingrese Codigo CMP";
    }

    if (estado == 0) {
        $.post("../ws/web/ipressmedico.registrar.php", {
            documento_persona: documento_persona,
            nombre_persona: nombre_persona,
            paterno_persona: paterno_persona,
            materno_persona: materno_persona,
            telefono_persona: telefono_persona,
            sexo_persona: sexo_persona,
            civil_persona: civil_persona,
            fecnac_persona: fecnac_persona,
            codigo_departamento: codigo_departamento,
            codigo_provincia: codigo_provincia,
            codigo_distrito: codigo_distrito,
            direccion_persona: direccion_persona,
            referencia_persona: referencia_persona,
            correo_cuenta: correo_cuenta,
            codigo_cmp_medico: codigo_cmp_medico,
            consejo_regional_medico: consejo_regional_medico,
            arrayupsmedico: arrayupsmedico
        }).done(function (resultado) {
            try {
                var datos = $.parseJSON(resultado);
                if (datos.estado == 200) {
                    arrayupsmedico.length = 0;
                    documento_persona = "";
                    nombre_persona = "";
                    paterno_persona = "";
                    materno_persona = "";
                    telefono_persona = "";
                    sexo_persona = "";
                    civil_persona = "";
                    fecnac_persona = "";
                    codigo_departamento = "";
                    codigo_provincia = "";
                    codigo_distrito = "";
                    direccion_persona = "";
                    referencia_persona = "";
                    codigo_cmp_medico = "";
                    consejo_regional_medico = "";
                    Swal.fire({
                        title: 'Registrado',
                        text: datos.respuesta,
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.value) {
                            window.location.replace("../Vista/PanelIpressMedico.php");
                        } else {
                            window.location.replace("../Vista/PanelIpressMedico.php");
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: datos.respuesta
                    });
                }
            } catch (e) {
                alert(e);
            }
        }).fail(function (error) {
            alert(error.responseText);
        });
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Faltan datos',
            text: respuesta
        });
    }
});

//////////////////////////////////////////////////////////////////
///////////////////////PanelIpressHorarios.php////////////////////
//////////////////////////////////////////////////////////////////

$(document).on("click", "#dia", function () {
    var header = document.getElementById("dias");
    var btns = header.getElementsByClassName("btnday");
    var valor;
    var estado = "0";

    for (var i = 0; i < btns.length; i++) {
        var current = document.getElementsByClassName("active"); //obtiene el activado
        //reenplata todos los activados a no activado
        if (current[i] == this) {
            estado = "1";
        }
    }
    if (estado == "1") {
        this.className = this.className.replace(" active", "");
    } else {
        this.className += " active";
    }
    console.log(this);
});

function ipressmedicocombo() {
    $.post("../ws/web/ipressmedico.combo.php")
        .done(function (resultado) {
            $("#vercombomedico").empty();
            $("#vercombomedico").append(resultado);
        });
}

$(document).on("change", "#combomedico", function () {
    var id_afiliacion = this.value;
    $.post("../ws/web/ipressupsmedico.listar.php", {
            id_afiliacion: id_afiliacion
        })
        .done(function (resultado) {
            $("#vertablaupsmedico").empty();
            $("#vertablaupsmedico").append(resultado);
        });
});

function ipressupshorario(upsmedicoipress, ups, idafiliacion) {
    $.post("../ws/web/ipressupshorario.ver.php", {
            upsmedicoipress: upsmedicoipress,
            ups: ups,
            idafiliacion : idafiliacion
        })
        .done(function (resultado) {
            arraycheck.length = 0;
            $("#vertablahorario").empty();
            $("#vertablahorario").append(resultado);
        });
}

var arraycheck = [];
$(document).on("click", "#btnregistrarhorario", function () {
    Swal.fire({
        title: '¿Está seguro de registrar?',
        text: "Se registrará los horarios del médico!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si,Registrar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            arraycheck.length = 0;
            $("input[type=checkbox]:checked").each(function (i) {
                arraycheck.push($(this).val());
            });
            $.post("../ws/web/ipresshorariomedico.registrar.php", {
                arraycheck: arraycheck
            }).done(function (resultado) {
                var datos = $.parseJSON(resultado);
                Swal.fire({
                    title: 'Registrado',
                    text: datos.respuesta,
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.value) {
                        window.location.replace("../Vista/PanelIpressHorarios.php");
                    } else {
                        window.location.replace("../Vista/PanelIpressHorarios.php");
                    }
                });
            }).fail(function (error) {
                alert(error.responseText);
            });
        }
    });
});