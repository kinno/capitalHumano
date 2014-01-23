
$(document).tooltip().ready(function(){ 
    $("input[type=button],button").button();
    $("input,select,textarea").addClass("ui-corner-all");
    $("#contenido").find("#buscar").button({icons: {
        primary: "ui-icon-search"
      }});
   $("#contenido").find("#agenda").button({icons: {
           
           
        primary: "ui-icon-calendar"
      }});
  $("#contenido").find("#ver").button({icons: {
        primary: "ui-icon-note"
      }});
   $('#listaSolicitud,#listaCandidatos,#listaVacantes').dataTable( { //CONVERTIMOS NUESTRO LISTADO DE LA FORMA DEL JQUERY.DATATABLES- PASAMOS EL ID DE LA TABLA
        "sPaginationType": "full_numbers" //DAMOS FORMATO A LA PAGINACION(NUMEROS)
    } );/*.find("input[type=button],button").button().find("#buscar").button({icons: {
        primary: "ui-icon-search"
      }});*/
    $("#listaVacantes_filter").find("input:first").attr("onkeyup","resalta()");
   
    //alert($("#listaVacantes_filter").find("input:first").attr("type"));
  
   //$('#listaSolicitud').find("input[type=button]").button(); 
   $("#dialog,#dialogEntrevista").dialog({
     autoOpen: false,
     modal:true,
     width:550,
     height:150,
     resizable:false,
      show: {
        effect: "clip",
        duration: 500
      },
      hide: {
        effect: "clip",
        duration: 500
      }  
   });
   
   $("#entrevistasRegistradas").dialog({
     autoOpen: false,
     modal:true,
     width:900,
     height:400,
     resizable:false,
      show: {
        effect: "clip",
        duration: 500
      },
      hide: {
        effect: "clip",
        duration: 500
      }  
   });
  
   
   //$("th").on("click",function(){$("input[type=button],button").button();})
   
});

function resalta(valor){
     $("#listaVacantes").unhighlight();
     $(".highlight").css({ backgroundColor: "#FFFF88" });
    $("#listaVacantes").highlight($("#listaVacantes_filter").find("input:first").val());
}

function abreDialog(aux){
   var max=($("#numPuestos"+aux).html()-$("#numFaltantes"+aux).html());
   $("#dialog").find("td").addClass('ui-corner-all');
   
   $("#folioVacante").html($("#folio"+aux).html());
   $("#proyectoVacante").html($("#proyecto"+aux).html());
   $("#spinner").spinner(
           {min:1,
            max:max}
           ).css("width",'20px');
   $("button").button();            
   $("#dialog").dialog("open");
   $("#asigna").attr("onclick","asignaRecluta("+aux+")");
}

function asignaRecluta(fila){
    if(confirm("¿Deseas asignar estas vacantes al reclutador?")){
        
        var folSolici = $("#folioVacante").html();
        var idReclutador = $("#reclutador").val();
        var puestos = $("#spinner").val();
        var compPerfil = $("#complejidad").val();
        var statVacante = 2;
        
        var url="functions/asignarReclutador.php";
        $.post(url,{folSolici:folSolici,idReclutador:idReclutador,puestos:puestos,compPerfil:compPerfil,statVacante:statVacante},
            function(responseText){
                if(responseText==='ok'){
                    var actuales=parseInt($("#numFaltantes"+fila).html())+parseInt(puestos);
                    $("#numFaltantes"+fila).html(actuales);
                    $("#dialog").dialog("close");
                }
            });
    }
    
}

function abreBusqueda(aux){
       
        $("#dialog").dialog({
            width:1200,
            height:800,
        });
        $("#vacante").val($("#numVacante"+aux).val());
        $("#fila").val(aux);
        $("#dialog").dialog("open");
     
   
    }

function asignarCandidato(aux){
   var idCandid = $("#idCandid"+aux).html();
   var numVacante = $("#vacante").val();
   var candidato = $("#candidato"+aux).html();
   var fila = $("#fila").val();
    var url="functions/asignarCandidato.php";
        $.post(url,{idCandid:idCandid,numVacante:numVacante},
            function(responseText){
                $("#resp").html(responseText);
                if(responseText==='ok'){
                    $("#candid"+fila).html(candidato);
                    $("#acciones"+fila).append('<button id="agenda" title="Agendar Entrevista" onclick="agendaEntrevista('+fila+')" ></button>')
                    .find("#agenda").button({icons: {
                                    primary: "ui-icon-calendar"
                                                }});
                
                    $("#dialog").dialog("close");
                }
            });
}


function agendaEntrevista(fila){
    $("#nVacante").val($("#numVacante"+fila).val());
    $("#dialogEntrevista").dialog({
            width:1300,
            height:200,
        });
    $("#fecha").datepicker({
        minDate: new Date(),
        dateFormat:'yy-mm-dd'
        });
    $("#hora").timepicker();        
    $("#dialogEntrevista").dialog("open");
}

function registraEntrevista(){
    if(confirm("¿Desear agendar la entrevista?")){
        var nVacante=$("#nVacante").val();
        var fecha=$("#fecha").val();
        var hora=$("#hora").val();
        var entrevistador=$("#entrevistador").val();
        var lugar=$("#lugar").val();
        var comentario=$("#comentario").val();
        var est=$("#est").val();
        var url="functions/registraEntrevista.php"
        $.post(url,{est:est,nVacante:nVacante,fecha:fecha,hora:hora,entrevistador:entrevistador,lugar:lugar,comentario:comentario},function(responseText){
            
            if(responseText=='ok'){
                
                $("#dialogEntrevista").dialog("close");
            }
            else{
                
                $("#err").html(responseText);
            }
        });
    }
    else{
        return false;
    }
}

function buscaEntrevistas(fila){
    var numVacante=$("#numVacante"+fila).val();
    var url="functions/buscaEntrevista.php";
    
    $("#entrevistasRegistradas").dialog("open");
    $.post(url,{numVacante:numVacante},function(responseText){
        $("#entrevistasRegistradas").find("#content").html(responseText);
        //$("#entrevistasRegistradas").find("#listaEntrevistas").dataTable();
        
    });
    
}

