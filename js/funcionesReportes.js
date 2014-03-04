var bandR=false;
$(document).ready(function(){
    $("input[type=radio]").button();
    $("#mnuReportes").buttonset();
    desplegarProyectos();
    desplegarReclutadores();
});

function desplegarProyectos(){
 
    var url="../controlador/listarProyectos.php";
    $.post(url,{},function(data){$("#selectProyecto").html(data)});
    
}

function desplegarReclutadores(){

    var url="../controlador/listarReclutadores.php";
    $.post(url,{},function(data){$("#selectReclutadores").html(data)});
}

function panelProyecto(){
    $("#idProyecto").val('');
    $("#rProyecto").html('');  
    if(bandR){
     $("#rProyecto").hide().toggle('slide');
     bandR=true;
    }
    $("#divGeneral,#divReclutador").hide(); 
   $("#divProyecto").toggle('slide');
}

function panelReclutador(){
    $("#idReclutador").val('');
    $("#rReclutador").html('');   
    if(bandR){
     $("#rReclutador").hide().toggle('slide');
     bandR=true;
    }
    $("#divGeneral,#divProyecto").hide(); 
   $("#divReclutador").toggle('slide');
}

function reporteProyectos(idProyecto){
    if(bandR){
        $("#rProyecto").toggle('slide');
    }
    var url="../controlador/proyectoReportes.php";
    $.post(url,{idProyecto:idProyecto},function(data){
        $("#rProyecto").html(data);
    });
    $("#rProyecto").toggle('slide');
    bandR=true;
}

function reporteReclutador(idReclutador){
    if(bandR){
        $("#rReclutador").toggle('slide');
    }
    var url="../controlador/reclutadorReportes.php";
    $.post(url,{idReclutador:idReclutador},function(data){
        $("#rReclutador").html(data);
    });
    $("#rReclutador").toggle('slide');
    bandR=true;
}