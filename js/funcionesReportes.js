var bandR=false;
$(document).ready(function(){
    $("input[type=radio]").button();
    $("#mnuReportes").buttonset();
    desplegarProyectos();
    desplegarReclutadores();
    
});

function desplegarProyectos(){
 
    var url="../controlador/listarProyectos.php";
    $.post(url,{},function(data){$("#selectProyecto").html(data);
        //$("#rAnual").button().attr("checked",true);
        
        
        $( "#periodoInicial" ).datepicker({
                                defaultDate: "+1w",
                                changeMonth: false,
                                numberOfMonths: 1,
                                dateFormat: 'dd-mm-yy',
                                onClose: function( selectedDate ) {
                                  $( "#periodoFinal" ).datepicker( "option", "minDate", selectedDate );
                                }
                              });
        $( "#periodoFinal" ).datepicker({
                                defaultDate: "+1w",
                                changeMonth:false,
                                numberOfMonths: 1,
                                dateFormat: 'dd-mm-yy',
                                onClose: function( selectedDate ) {
                                  $( "#periodoInicial" ).datepicker( "option", "maxDate", selectedDate );
                                }
        });
        
        $("#consultaReporte").button({icons:{primary:'ui-icon-document-b'}});
        
    });
    
    
}

function abrePeriodo(opcion){
    if(opcion==1){
       $("#fechas").find('input').each(function(){$(this).val('')}); 
       $("#fechas").hide();
    }else{
        $("#fechas").toggle('slide');
    }
    
}

function desplegarReclutadores(){

    var url="../controlador/listarReclutadores.php";
    $.post(url,{},function(data){$("#selectReclutadores").html(data);
        $( "#periodoInicialR" ).datepicker({
                                defaultDate: "+1w",
                                changeMonth: false,
                                numberOfMonths: 1,
                                dateFormat: 'dd-mm-yy',
                                onClose: function( selectedDate ) {
                                  $( "#periodoFinal" ).datepicker( "option", "minDate", selectedDate );
                                }
                              });
        $( "#periodoFinalR" ).datepicker({
                                defaultDate: "+1w",
                                changeMonth:false,
                                numberOfMonths: 1,
                                dateFormat: 'dd-mm-yy',
                                onClose: function( selectedDate ) {
                                  $( "#periodoInicial" ).datepicker( "option", "maxDate", selectedDate );
                                }
        });
        
        $("#consultaReporteR").button({icons:{primary:'ui-icon-document-b'}});
    });
}

function abrePeriodoR(opcion){
    if(opcion==1){
       $("#fechasR").find('input').each(function(){$(this).val('')}); 
       $("#fechasR").hide();
    }else{
        $("#fechasR").toggle('slide');
    }
    
}

function panelProyecto(){
    $("#btnPeriodo").buttonset();
    $("#idProyectos").val('');
    $("#rProyecto").html('');
    $("input[type=fecha]").val('');
    $("#fechas").hide();
    $("#btnPeriodo").buttonset("refresh");
    $("input[name=radio1]:checked").next().removeClass('ui-state-active');
    if(bandR){
     $("#rProyecto").hide().toggle('slide');
     bandR=true;
    }
    $("#divGeneral,#divReclutador").hide(); 
   $("#divProyecto").toggle('slide');
   
}

function panelReclutador(){
    $("#btnPeriodoR").buttonset();
    $("#idReclutador").val('');
    $("#rReclutador").html('');
     $("input[type=fecha]").val('');
    $("#fechasR").hide();
    $("#btnPeriodoR").buttonset("refresh");
    $("input[name=radio2]:checked").next().removeClass('ui-state-active');
    if(bandR){
     $("#rReclutador").hide().toggle('slide');
     bandR=true;
    }
    $("#divGeneral,#divProyecto").hide(); 
   $("#divReclutador").toggle('slide');
}

function reporteProyectos(){
   //Validaciones 
    if($("#idProyectos").val()==''){
        alert("Seleccione un proyecto");
        $("#idProyectos").focus();
        return false;
    }
   if($("input[name=radio1]:checked").val()==undefined){
       alert("Seleccione un tipo de reporte");
       $("input[name=radio1]:first").focus();
       return false;
   }
    if(bandR){
        $("#rProyecto").toggle('slide');
    }
    var periodo;
    var inicio;
    var final;
    if($("input[name=radio1]:checked").val()==1){
         periodo=1;
    }else{
        if($("#periodoInicial").val()==''){
            alert("Defina fecha de inicio");
            $("#periodoInicial").focus();
            return false;
        }else if($("#periodoFinal").val()==''){
            alert("Defina periodo final");
            $("#periodoFinal").focus();
            return false;
        }else {
         periodo=2;
         inicio = $("#periodoInicial").val();
         final=$("#periodoFinal").val();
        
        
        }
    }
    var idProyecto = $("#idProyectos").val();
    var url="../controlador/proyectoReportes.php";
    $.post(url,{idProyecto:idProyecto,periodo:periodo,inicio:inicio,final:final},function(data){
        $("#rProyecto").html(data);
    });
    $("#rProyecto").toggle('slide');
    bandR=true;
}

function reporteReclutador(){
    
     if($("#idReclutador").val()==''){
        alert("Seleccione un reclutador");
        $("#idReclutador").focus();
        return false;
    }
   if($("input[name=radio2]:checked").val()==undefined){
       alert("Seleccione un tipo de reporte");
       $("input[name=radio2]:first").focus();
       return false;
   }
    if(bandR){
        $("#rReclutador").toggle('slide');
    }
    var periodo;
    var inicio;
    var final;
    if($("input[name=radio2]:checked").val()==1){
         periodo=1;
    }else{
        if($("#periodoInicialR").val()==''){
            alert("Defina fecha de inicio");
            $("#periodoInicialR").focus();
            return false;
        }else if($("#periodoFinalR").val()==''){
            alert("Defina periodo final");
            $("#periodoFinalR").focus();
            return false;
        }else {
         periodo=2;
         inicio = $("#periodoInicialR").val();
         final=$("#periodoFinalR").val();
        }
    }
    var idReclutador = $("#idReclutador").val();
    var url="../controlador/reclutadorReportes.php";
    $.post(url,{idReclutador:idReclutador,periodo:periodo,inicio:inicio,final:final},function(data){
        $("#rReclutador").html(data);
    });
    $("#rReclutador").toggle('slide');
    bandR=true;
}