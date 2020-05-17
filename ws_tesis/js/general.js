window.onload = function() {
  combodepartamento();
  comboprovincia('00');
  combodistrito('00','00');
};

$(document).on("change", "#combodepartamento", function(){
    comboprovincia(this.value);
    var e = document.getElementById("comboprovincia");
    var strUser = e.options[e.selectedIndex].value;
    combodistrito(this.value,strUser);
});

$(document).on("change", "#comboprovincia", function(){
    var e = document.getElementById("combodepartamento");
    var strUser = e.options[e.selectedIndex].value;
    combodistrito(strUser,this.value);
});

function combodepartamento(){
    $.post("../ws/web/generaldepartamento.combo.php")
        .done(function(resultado){
        $("#htmlcombodepartamento").empty();
        $("#htmlcombodepartamento").append(resultado);
    });
}

function comboprovincia(codigodepartamento){
    $.post("../ws/web/generalprovincia.combo.php",{codigodepartamento:codigodepartamento})
        .done(function(resultado){
        $("#htmlcomboprovincia").empty();
        $("#htmlcomboprovincia").append(resultado);
    });
}

function combodistrito(codigodepartamento,codigoprovincia){
    $.post("../ws/web/generaldistrito.combo.php",{codigodepartamento:codigodepartamento,codigoprovincia:codigoprovincia})
        .done(function(resultado){
        $("#htmlcombodistrito").empty();
        $("#htmlcombodistrito").append(resultado);
    });
}