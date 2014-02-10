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
            });
}

function abrirpanelListar(){
    $("#contenidoAgregar").toggle('slide',function(){
                  $("#contenido").toggle('slide');
              });
}

function cargarCandidatos(){
     $.post("../controlador/listarCandidatos.php",{},function(data){
              $("#contenido").html(data);
                $("#nuevoCandidato").button({icons:{primary:"ui-icon-person"}});
                $(".modificarCandidato").button({icons:{primary:"ui-icon-contact"}});
                $(".detalleCandidato").button({icons:{primary:"ui-icon-clipboard"}});
                $(".btnsDA").buttonset();
                $("#detalleCandidato").dialog({
                                            autoOpen: false,
                                            modal:true,
                                            width:1300,
                                            height:650,
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
    });
    $("#detalleCandidato").dialog("open");
    
}

function guardarCandidato(){
    var ban= true;
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
   
    /*var datosAcademicos = $("#fdatosAcademicos").serialize();
    var datosProfesionales = $("#fdatosProfesionales").serialize();*/
    
    var url="../controlador/registrarCandidato.php";
    $.post(url,$("#fdatosPersonales").serialize(),function(responseText){
        if(responseText=='ok'){
            $("#res").html('<div style="font-size: 45px; text-align: center; padding-top:200px;"><img style="width:100px;" src="../img/paloma.png" /> ¡Candidato registrado!</div>');
            $("#conteiner").toggle('slide',function(){$("#res").toggle('slide');});
            $("#conteiner").find("input,select,textarea").each(function(){
                $(this).val('');
            });
            setTimeout(function(){
                $("#res").toggle('slide',function(){$("#conteiner").toggle('slide');});
            },4000);
            $( "#acordeon" ).accordion({ active: 0 });
            
        }else{
            $("#res").html('<div style="font-size: 45px; text-align: center; padding-top:200px;"><img style="width:100px;" src="../img/tache.png" /> ¡Ocurrio un error!</div>');
            $("#conteiner").toggle('slide');
            $("#res").toggle('slide');
            $("#conteiner").find("input,select,textarea").each(function(){
                $(this).val('');
            });
            setTimeout(function(){
                $("#res").toggle('slide');
                $("#conteiner").toggle('slide');
            },4000);
            $( "#acordeon" ).accordion({ active: 0 });
        }
    });
    
    }
}
