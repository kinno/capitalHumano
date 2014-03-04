var i =1;
$(document).tooltip().ready(function(){
     
});



function abrirpanelAgregar(){
    $.post("../contenido/altaCandidatos.php",{},function(data){
              $("#contenidoAgregar").html(data);
               $("#contenidoAgregar").find('#acordeon').accordion({
                    heightStyle: "content"
                   });
               $("#enviar").button({icons:{primary:"ui-icon-disk"}}); 
               $("#back").button({icons:{primary:"ui-icon-arrowthick-1-w"}}); 
               $("#btnsC").buttonset();
              $("#contenido").toggle('slide',function(){
                  $("#contenidoAgregar").toggle('slide');
              });
              $("#nvaReferencia").button({icons:{primary:"ui-icon-plus"}});
              $(".eliminaReferencia").button({icons:{primary:"ui-icon-close"}});
            });
}

function abrirpanelListar(){
    $("#contenidoAgregar").toggle('slide',function(){
                  $("#contenido").toggle('slide');
              });
              //setTimeout(function(){alert();cargarCandidatos();},2500);
}

function cargarCandidatos(){
     $.post("../controlador/listarCandidatos.php",{},function(data){
              $("#contenido").html(data);
                $("#nuevoCandidato").button({icons:{primary:"ui-icon-person"}});
                $(".modificarCandidato").button({icons:{primary:"ui-icon-check"}});
                $(".detalleCandidato").button({icons:{primary:"ui-icon-clipboard"}});
                $(".btnsDA").buttonset();
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
               //$(".ui-dialog-titlebar").css("height","10px");
                
                 $('#listaCandidatos').dataTable( { 
                    "sPaginationType": "full_numbers",
                    "bJQueryUI": true,
                    "bAutoWidth": true
                    });
            });
}

function detalleCandidato(idCandid){
    var url="../controlador/detallesCandidato.php";
    $.post(url,{idCandid:idCandid},function(responseText){
        $("#contenedor").html(responseText);
        $( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
        $( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
        $("#tabs").find("input,textarea,select").each(function(){
            $(this).addClass("datos").attr('disabled','true').addClass("ui-corner-all");
        });
        $("#edit").button();
        $("#guardar").button({icons:{primary:"ui-icon-disk"}});
        $(".regResultados").button({icons:{primary:"ui-icon-pencil"}});
        $(".guardarResultados").button({icons:{primary:"ui-icon-disk"}});
        $(".show").button({icons:{primary:"ui-icon-circle-triangle-s"}});
        
    });
        
    $("#detalleCandidato").dialog("open");
    
}

function guardarCandidato(){
    var ban= true;
    $("#numReferencias").val(i);
    $("#fdatosPersonales").find("input,textarea,select").each(function(){
        if($(this).val()==""){
            $(this).focus();
            ban = false;
            return false;
        }
    });
    $("#fdatosAcademicos").find("input,textarea,select").each(function(){
        if($(this).val()==""){
            $(this).focus();
            ban = false;
            return false;
        }
    });
    $("#fdatosProfesionales").find("input,textarea,select").each(function(){
        if($(this).val()==""){
            $(this).focus();
            ban = false;
            return false;
        }
    });
    
    if(ban){
   
    
    
    var url="../controlador/registrarCandidato.php";
    $.post(url,$("#fdatosPersonales").serialize(),function(responseText){
        if(responseText=='ok'){
            $("#res").html('<div style="font-size: 45px; text-align: center; padding-top:200px;"><img style="width:100px;" src="../img/paloma.png" /> ¡Candidato registrado!</div>');
            $("#conteiner").toggle('slide',function(){$("#res").toggle('slide');});
            $("#conteiner").find("input,select,textarea").each(function(){
                $(this).val('');
            });
            setTimeout(function(){
                $("#res").toggle('slide',function(){$("#contenido").toggle('slide');});
            },4000);
            setTimeout(function(){cargarCandidatos(); $("#contenidoAgregar").hide();},2000);
            
            
        }else{
            $("#res").html('<div style="font-size: 45px; text-align: center; padding-top:200px;"><img style="width:100px;" src="../img/tache.png" /> ¡Ocurrio un error!</div>');
            $("#conteiner").toggle('slide');
            $("#res").toggle('slide');
//            $("#conteiner").find("input,select,textarea").each(function(){
//                $(this).val('');
//            });
            setTimeout(function(){
                $("#res").toggle('slide');
                $("#conteiner").toggle('slide');
            },4000);
            $( "#acordeon" ).accordion({ active: 0 });
        }
    });
    
    }
}

function nuevaReferencia(){
    i++;
    var nueva =$("#r1").clone();
    $("#tblref").find("tr:last").before(nueva).prev("tr").attr("id","r"+i);;
    $("#r"+i).find("#nomrefCandid1").attr({"id":"nomrefCandid"+i,"name":"nomrefCandid"+i}).val('');
    $("#r"+i).find("#telrefCandid1").attr({"id":"telrefCandid"+i,"name":"telrefCandid"+i}).val('');
    $("#r"+i).find("#relrefCandid1").attr({"id":"relrefCandid"+i,"name":"relrefCandid"+i}).val('');
    $("#r"+i).find("#e1").attr({"id":"e"+i}).show();
    $("#e"+(i-1)).hide();
    
}

function eliminaReferencia(){
    $("#r"+i).remove();
    i--;
    if(i!=1){
    $("#e"+i).show();
    }
    
}

function abrirResultados(idReferencia,id){
   
   var url="../controlador/registroResultado.php";
   $.post(url,{},function(responseText){
        $("#fieldset"+id).find(".regResultados").hide();
        
        $("#fieldset"+id).append(responseText).find("#panelResultados").toggle('fold'); 
        $("#fieldset"+id).find("#idsReferencia").val(idReferencia);
        $("input[type=fecha]").datepicker( {
                                            changeMonth: true,
                                            changeYear: true,
                                            showButtonPanel: true,
                                            dateFormat: 'MM yy',
                                            onClose: function(dateText, inst) { 
                                                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                                                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                                                $(this).datepicker('setDate', new Date(year, month, 1));                                              
                                                
                                            }
                                        });
        
                $("#panelResultados").find(".guardarResultados").button({icons:{primary:"ui-icon-disk"}});
   });   
}

function registrarResultados(obj){
   
    
    var url="../controlador/guardarResultadosCandidato.php";
    $.post(url,$("#resultadoReferencia").serialize(),function(responseText){
        if(responseText=='ok'){
            $("#respResultados").html('<div style="font-size: 45px; text-align: center;"><img style="width:100px;" src="../img/paloma.png" /> ¡Resultados registrados!</div>');
            $(obj).parent().parent().parent().parent().parent().toggle('slide',function(){
                $("#respResultados").toggle('slide');
                setTimeout(function(){
                detalleCandidato($("#candidatoActivo").val());
                setTimeout(function(){
                    $( "#tabs" ).tabs({active:3});
                },50);
            },2000);
            
            });
        }else{
            $("#respResultados").html('<div style="font-size: 45px; text-align: center;"><img style="width:100px;" src="../img/tache.png" /> ¡Ocurrio un error!</div>');
            $(obj).parent().parent().parent().parent().parent().toggle('slide',function(){
                $("#respResultados").toggle('slide');
                setTimeout(function(){
                detalleCandidato($("#candidatoActivo").val());
                setTimeout(function(){
                    $( "#tabs" ).tabs({active:3});
                },50);
            },2000);
            
            });
        }
            
        
         });
         
   
        
}

function mostrarResultados(aux){
    $("#panelResultados"+aux).toggle('blind');
}

function abrirCampos(){
   
    $("#tabs").find("input,textarea,select").each(function(){
        $(this).removeAttr("disabled").css("background-color","#FFF");
    });
    $("#edit").toggle("slide",function(){
        $("#guardar").toggle("slide");
    });  
    
}

function actualizarCampos(){
    
    var url="../controlador/modificarCandidato.php";
    $.post(url,$("#fdatosPersonales").serialize(),function(responseText){


        if(responseText=='ok'){
            cargarCandidatos();
            $("#contenido").effect("bounce");
            $("#msjRespuesta").html('<div style="font-size: 45px; text-align: center; padding-top:100px;"><img style="width:100px;" src="../img/paloma.png" /> ¡Candidato actualizado!</div>');
            $("#contenedor").toggle('slide',function(){$("#msjRespuesta").toggle('slide');});
             setTimeout(function(){
                $("#msjRespuesta").toggle('slide');
                $("#contenedor").toggle('slide',function(){$("#detalleCandidato").dialog("close");});
                
            },2000);
            
        }else{
            /*$("#res").html('<div style="font-size: 45px; text-align: center; padding-top:200px;"><img style="width:100px;" src="../img/tache.png" /> ¡Ocurrio un error!</div>');
            $("#conteiner").toggle('slide');
            $("#res").toggle('slide');
//            $("#conteiner").find("input,select,textarea").each(function(){
//                $(this).val('');
//            });
            setTimeout(function(){
                $("#res").toggle('slide');
                $("#conteiner").toggle('slide');
            },4000);
            $( "#acordeon" ).accordion({ active: 0 });*/
        }
    });
    
}

function cambiarEstatus(idCandid){
    if(confirm("¿Desea el estatus de contratado a disponible?")){
        var url="../controlador/liberaCandidato.php";
        $.post(url,{idCandid:idCandid},function(responseText){
            if(responseText=='ok'){
                location.reload();
            }
        });
    }
}