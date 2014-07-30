var folioVacante;
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
  $("#contenido").find(".up").button({icons:{primary:"ui-icon-arrowthick-2-n-s"}});
  $("#contenido").find(".cancelar").button({icons:{primary:"ui-icon-cancel"}});
  $("#contenido").find(".cerrar").button({icons:{primary:"ui-icon-check"}});
  $("#contenido").find(".btnsVac").buttonset();
  
   $('#listaSolicitud,#listaCandidatos,#listaVacantes').dataTable( { //CONVERTIMOS NUESTRO LISTADO DE LA FORMA DEL JQUERY.DATATABLES- PASAMOS EL ID DE LA TABLA
        "sPaginationType": "full_numbers",
        "bJQueryUI": true
    } );
    $("#listaVacantes_filter").find("input:first").attr("onkeyup","resalta()");
    
   $("#dialog,#dialogEntrevista").dialog({
     autoOpen: false,
     modal:true,
     width:550,
     height:150,
     resizable:false,
     draggable:false,
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
     draggable:false,
      show: {
        effect: "clip",
        duration: 500
      },
      hide: {
        effect: "clip",
        duration: 500
      }  
   });
  
  $("#panelcambiarReclutador").dialog({
     autoOpen: false,
     modal:true,
     draggable:false,
     height:100
  });
   
    $(".guardar").button();
//    $(".asignarCandidato").button({icons:{primary:"ui-icon-person"}});
//    $(".detalleCandidato").button({icons:{primary:"ui-icon-clipboard"}});
//    $(".btnsDA").buttonset();
    
    $("#detalleCandidato").dialog({
                                            autoOpen: false,
                                            modal:true,
                                            width:1300,
                                            height:450,
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
                                          
    $("#panelCancelar").dialog({
                                            autoOpen: false,
                                            modal:true,
                                            draggable:false,
                                            height:200,
                                            width:250,
                                            title: 'Cancelar vacante'
                                         });
   
});

function resalta(valor){
     $("#listaVacantes").unhighlight();
     $(".highlight").css({ backgroundColor: "#FFFF88" });
    $("#listaVacantes").highlight($("#listaVacantes_filter").find("input:first").val());
}

function abreDialog(aux){
   if($("#comp"+aux).val()==1)
       var descComp='Muy bajo';
   if($("#comp"+aux).val()==2)
       var descComp='Bajo';
   if($("#comp"+aux).val()==3)
       var descComp='Medio';
   if($("#comp"+aux).val()==4)
       var descComp='Avanzado';
   if($("#comp"+aux).val()==5)
       var descComp='Complejo';
   
   var max=($("#numPuestos"+aux).html()-$("#numFaltantes"+aux).html());
   $("#dialog").find("td").addClass('ui-corner-all');
   
   $("#folioVacante").html($("#folio"+aux).html());
   $("#proyectoVacante").html($("#proyecto"+aux).html());
   $("#complejidad").html(descComp);
   $("#spinner").spinner(
           {min:1,
            max:max}
           ).css("width",'20px');
   $("button").button();            
   $("#dialog").dialog("open");
   $("#asigna").attr("onclick","asignaRecluta("+aux+","+$("#comp"+aux).val()+")");
  
}

function asignaRecluta(fila,comp){
    if(confirm("¿Deseas asignar estas vacantes al reclutador?")){
        
        var folSolici = $("#folioVacante").html();
        var idReclutador = $("#reclutador").val();
        var puestos = $("#spinner").val();
        var compPerfil = comp;
        var statVacante = 2;
        //alert(compPerfil);
        var url="../controlador/asignarReclutador.php";
        $.post(url,{folSolici:folSolici,idReclutador:idReclutador,puestos:puestos,compPerfil:compPerfil,statVacante:statVacante},
            function(responseText){
                if(responseText==='ok'){
                    var actuales=parseInt($("#numFaltantes"+fila).html())+parseInt(puestos);
                    $("#numFaltantes"+fila).html(actuales);
                    //$("#content").append("Datos guardados!");
                    $("#dialog").dialog("close");
                    window.setTimeout(function()
			{
			location.reload()
			},1000);
	
			
			
                }
            });
    }
    
}

function eliminarReclutador(aux){
    if(confirm("¿Deseas quitar las vacantes al reclutador?")){
        var folSolici = $("#idVacante").html();
        var idReclutador = $("#id"+aux).val();
        var url="../controlador/quitarReclutador.php";
        $.post(url,{folSolici:folSolici,idReclutador:idReclutador},
            function(responseText){
                $("#panelModificacion").append(responseText);
            });
        
    }
    
}
function abrirpanelReasignar(aux){
    $("#f").val($("#idVacante").html());
    $("#ranterior").val($("#id"+aux).val());
    $("#msje").html('');
    $("#panelcambiarReclutador").dialog("open");
}

function cambiarReclutador(){
    
    if(confirm("¿Deseas asignar las vacantes a otro reclutador?")){
    var folSolici = $("#f").val();
    var reclutadorAnterior = $("#ranterior").val();
    var reclutadorNuevo=$("#nvoReclutador").val();
    var url="../controlador/cambiarReclutador.php";
    $.post(url,{folSolici:folSolici,reclutadorAnterior:reclutadorAnterior,reclutadorNuevo:reclutadorNuevo},
            function(responseText){
                abrePanel($("#panel").val());
                $("#panelcambiarReclutador").find('#msje').html("Reclutador asignado!");
                setTimeout(function(){$("#panelcambiarReclutador").dialog("close");},1000);
            });
    }
}

function cerrarVacante(aux,idUsuario){
    if(confirm("¿Cerrar la vacante para éste reclutador?")){
    var folSolici=$("#folio"+aux).text();
        var url="../controlador/cerrarVacanteVC.php";
        $.post(url,{folSolici:folSolici,idUsuario:idUsuario},function(responseText){
           if(responseText=='ok'){
               $("#respVC").html('<div style="font-size: 45px; text-align: center; padding-top:200px;"><img style="width:100px;" src="../img/paloma.png" /> ¡Vacante cerrada con éxito!</div>');
               $("#contentVC").toggle('slide',function(){$("#respVC").toggle('slide'); setTimeout(function(){location.reload()},4000);
               });
           }else{
               alert('Error');
           } 
        });
    }
}

function panelCancelar(aux,idUsuario){
   $("#folioCancelar").val($("#folio"+aux).text());
   $("#usuarioCancelar").val(idUsuario);
   $("#aceptar").button({icons:{primary:'ui-icon-cancel'}});
   $("#panelCancelar").dialog('open');
}

function cancelarVacante(){
    if(confirm("¿Cancelar la vacante para éste reclutador?")){
        $("#panelCancelar").dialog('close');
    var folSolici=$("#folioCancelar").val();
    var idUsuario = $("#usuarioCancelar").val();
    var descCancela=$("#usrCancelar").val();
    var obsCancela=$("#obsCancelar").val();
        var url="../controlador/cancelarVacanteVC.php";
        $.post(url,{folSolici:folSolici,idUsuario:idUsuario,descCancela:descCancela,obsCancela:obsCancela},function(responseText){
           if(responseText=='ok'){
               $("#respVC").html('<div style="font-size: 45px; text-align: center; padding-top:200px;"><img style="width:100px;" src="../img/tache.png" /> ¡Vacante cancelada!</div>');
               $("#contentVC").toggle('slide',function(){$("#respVC").toggle('slide'); setTimeout(function(){location.reload()},4000)});
           }else{
               alert('Error');
           } 
        });
    }
}

function abrePanel(aux){
    var folSolici=$("#folio"+aux).html();
    
    var url="../controlador/vacantesAsignadas.php";
    $.post(url,{folSolici:folSolici},
            function(responseText){
                $("#panelModificacion").html(responseText);
                $("#panel").val(aux);
                $('#tablaProyecto,#tablaReclutadores').dataTable( { //CONVERTIMOS NUESTRO LISTADO DE LA FORMA DEL JQUERY.DATATABLES- PASAMOS EL ID DE LA TABLA
                    "bSortCellsTop": true,
                    "bFilter": false,
                    "bInfo": false,
                    "bPaginate": false,
                    "bSort": false,
                    "bJQueryUI": true
                    }).css("height","50px");
                    $("#tablaReclutadores_wrapper").css({"margin-top":"15px",width:"50%"});
                $("#back").button({icons: {
                                            primary: "ui-icon-circle-arrow-w"
                                          }}).css("height","20px");
                $(".eliminar").button({icons: {
                                                primary: "ui-icon-close"
                                              }});
                $(".reasignar").button({icons: {
                                                primary: "ui-icon-person"
                                              }});
            });
            if($("#panelVacantes").is(":visible")){
                $("#panelVacantes").toggle("drop",function(){$("#panelModificacion").toggle("drop")});
            }
            else{
                $("#panelModificacion").effect("shake");
            }
            
    /*$("#panelVacantes").slideUp('slow',function(){
        $("#panelModificacion").slideDown();
    });*/
}

function abreVacantes(){
    $("#panelModificacion").toggle('drop',function(){
        $("#panelVacantes").toggle("drop");
    });
}

function abreBusqueda(folio){
       
        $("#dialog").dialog({
            width:1200,
            height:800
        });
        
        //$("#vacante").val($("#numVacante"+aux).val());
        //$("#fila").val(aux);
        $("#dialog").dialog("open");
     
   
    }

function abrirPanel(obj){
	
    $(".activo").each(function(){
        $(this).find("div").toggle("blind",function(){$(this).parents(".activo:first").remove();},1000);
    });
   
    $("#vacante"+obj).after("<tr class='activo'><td colspan='9'><input type='hidden' id='idVacante"+obj+"' class='vacante' /><div id='panel"+obj+"' class='ui-corner-all' style='padding-bottom:15px; height:250px;background-color:#FCFDFD;display:none;'></div></td></tr>");
     $("#idVacante"+obj).val($("#folio"+obj).text());
     
    var url="../controlador/menuCandidatosVC.php";
    $.post(url,{},
            function(responseText){
                $("#panel"+obj).html(responseText);
                $("#panel"+obj).find(".btnCandidatos").each(function(){
                    $(this).button({icons:{primary:"ui-icon-person"}});
                });
                $("#panel"+obj).find(".btnEntrevistas").each(function(){
                    $(this).button({icons:{primary:"ui-icon-calendar"}});
                });
            });
   
    $("#panel"+obj).toggle("fold",1000);
}

function listarCandidatos(){
    folioVacante =$("#menuCandidatos").parent().parent().parent().children("input:first").val();
        var url="../controlador/buscaCandidatosVC.php";
    $.post(url,{folioVacante:folioVacante},
            function(responseText){
                $("#containerCandidatos").html(responseText);
                $("#plus").button({icons: {
                    primary: "ui-icon-plus"
                  }});
            });
  
    if($("#containerEntrevistas").is(':visible')){
        
        $("#containerEntrevistas").toggle('drop',function(){$("#containerCandidatos").toggle('drop');});
    }
    else{
        $("#containerCandidatos").toggle('drop');
    }
    
}
function listarEntrevistas(){
    folioVacante =$("#menuCandidatos").parent().parent().parent().children("input:first").val();
     var url="../controlador/buscaVC.php";
    $.post(url,{folioVacante:folioVacante},
            function(responseText){
                $("#containerEntrevistas").html(responseText);
                
            });
            
     if($("#containerCandidatos").is(':visible')){
        $("#containerCandidatos").toggle('drop',function(){$("#containerEntrevistas").toggle('drop');});
     }
     else{
         $("#containerEntrevistas").toggle('drop');
     }
}

function detallesCandidato(idCandid){

    var url="../controlador/detallesCandidato.php";
    $.post(url,{idCandid:idCandid},function(responseText){
        
        $("#condetalle").html(responseText);
        $("#condetalle").find("#edit").hide();
        $( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
        $( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
        $("#tabs").find("input,textarea,select").each(function(){
            $(this).addClass("datos").attr('readonly','true');
        });
        $("#condetalle").find(".show").each(function(){
            $(this).button({icons:{primary:"ui-icon-circle-triangle-s"}});
        });
        
    });
    $("#detalleCandidato").dialog("open");
    
}
function mostrarResultados(aux){
    $("#panelResultados"+aux).toggle('blind');
}

function asignarCandidato(aux){
   var idCandid = $("#idCandid"+aux).val();
   var numVacante = $("#vacante").val();
   //var candidato = $("#candidato"+aux).html();
   //var fila = $("#fila").val();
    var url="../controlador/asignarCandidatoVC.php";
    
        $.post(url,{idCandid:idCandid,numVacante:numVacante,folioVacante:folioVacante},
            function(responseText){
                
                if(responseText==='ok'){
                    $("#resp").html('Datos guardados!');
                    listarCandidatos();
                    listarCandidatos();
                   setTimeout(function(){$("#dialog").dialog("close")},1000);
                }
                
                if(responseText==='Existente'){
                    alert("El candidato ya ha sido asigando a esta vacante por otro reclutador");
                }
                
            });
}

function buscaEntrevistas(idVacCand){
    if(idVacCand=="-1"){
        $("#mnuEntrev").remove();
        $("#entrev").html('');
    }else{
    $("#mnuEntrev").remove();
    $("#entrev").html('');
     var url="../controlador/buscaEntrevistaVC.php";
    $.post(url,{idVacCand:idVacCand},
            function(responseText){
                
                $("#entrev").html(responseText);
                $("#divCandidatos").append('<div id="mnuEntrev" style="margin-top:5px;display:none;"><center><span id="nvaEntrevista" style="height:20px" onclick="agendaEntrevista();" title="Agendar entrevista"></span><span id="contratar" style="height:20px" onclick="estadoCandidato(1);" title="Contratado"></span><span id="posible" style="height:20px" onclick="estadoCandidato(2);" title="Rechazado pero candidato a otra vacante"></span><span id="rechazar" style="height:20px" onclick="estadoCandidato(3);" title="Rechazado"></span></center></div>');
                 $("#mnuEntrev").toggle('size');
                $("#nvaEntrevista").button({icons:{primary: "ui-icon-calendar"}});
                $("#contratar").button({icons:{primary: "ui-icon-check"}});
                $("#posible").button({icons:{primary: "ui-icon-alert"}});
                $("#rechazar").button({icons:{primary: "ui-icon-cancel"}});
                $("#mnuEntrev").buttonset();
                $(".resEntrev").each(function(){
                    $(this).button({icons:{primary:"ui-icon-pencil"}});
                });
            });
    $("#entrev").fadeOut('fast');
    $("#entrev").fadeIn('fast');}
}

function agendaEntrevista(){
    var idVacCand=$("#cndidatos").val();
   $("#dialogEntrevista").find("input,select").each(function(){$(this).val('');});
    $("#idVacCand").val(idVacCand);
    $("#dialogEntrevista").dialog({
            width:1100,
            height:200,
            show: {
                effect: "slide",
                duration: 1000
              },
            hide: {
              effect: "slide",
              duration: 1000
            }
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
        var idVacCand=$("#idVacCand").val();
        var fecha=$("#fecha").val();
        var hora=$("#hora").val();
        var entrevistador=$("#entrevistador").val();
        var lugar=$("#lugarTrabajo").val();
       
        var url="../controlador/registraEntrevistaVC.php"
        $.post(url,{idVacCand:idVacCand,fecha:fecha,hora:hora,entrevistador:entrevistador,lugar:lugar},function(responseText){
            
            if(responseText=='ok'){
                $("#cndidatos").change();
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

function estadoCandidato(estado){
    var vacCand = $("#cndidatos").val();
    if(confirm("¿Desea cambiar la situación del candidato?")){
        var url="../controlador/estadoVC.php";
        $.post(url,{vacCand:vacCand,estado:estado},function(responseText){
            
            if(responseText=='ok'){
                location.reload();
            }
            else{
                
                alert("Ocurrio un error!");
            }
        });
    }
}

function abrirResultados(idEntrev){
    $("#regEntrev").button({icons:{primary:"ui-icon-disk"}});
    $("#resultadoEntrevista").find("input,select,textarea").each(function(){$(this).val('');});
    $("#idEntr").val(idEntrev);
    $("#resultadoEntrevista").dialog({
            show: {
                effect: "slide",
                duration: 1000
              },
            hide: {
              effect: "slide",
              duration: 1000
            }
        });
    $("#resultadoEntrevista").dialog("open");
}

function registrarEstatus(){
    var idEntrev = $("#idEntr").val();
    var est = $("#staent").val();
    var observaciones = $("#observaciones").val();
    var url="../controlador/registraEstatusVC.php";
        $.post(url,{idEntrev:idEntrev,est:est,observaciones:observaciones},function(responseText){
            if(responseText=='ok'){
                $("#cndidatos").change();
                $("#resultadoEntrevista").dialog("close");
            }
            else{
                
                $("#err").html(responseText);
            }
        });
}

function desactivaOpciones(){
    $("#mnuEntrev").toggle("slide");
    $("#containerEntrevistas").find(".resEntrev").each(function(){
        $(this).toggle('slide');
    });
}

