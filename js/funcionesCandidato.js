$(document).tooltip().ready(function(){
    $('#acordeon').accordion({
         heightStyle: "content"
        });
     $("#enviar").button({icons:{primary:"ui-icon-disk"}});   
});

function cargarCandidatos(){
     $.post("../controlador/listarCandidatos.php",{},function(data){
              $("#contenido").html(data);
             $('#listaCand').dataTable( { 
                    "sPaginationType": "full_numbers",
                    "bJQueryUI": true,
                    "bAutoWidth": true
                });
            });
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
