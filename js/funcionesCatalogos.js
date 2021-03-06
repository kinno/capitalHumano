var band=false;
$(document).tooltip().ready(function(){
     $("#menu").menu();
});

function despliegaUsuarios(){
    if(band){
        $("#mainContent").html('').toggle('slide');
    }
    $("#menu").find(".menuActive").each(function(){
        $(this).removeClass("menuActive");
    });
    $("#catUsuarios").children().addClass("menuActive");
    var url="../controlador/usuariosCatalogo.php";
     $.post(url,{},function(data){
            $("#mainContent").html(data);
            
            $("#mainContent").find('#listaUsuarios').dataTable( { 
                    "sPaginationType": "full_numbers",
                    "bJQueryUI": true,
                    "bAutoWidth": true
                    });
                    
             $(".nvoUsuario").button({icons: {
                primary: "ui-icon-plus"
              }});
             $(".modUsuario").button({icons: {
                primary: "ui-icon-wrench"
              }});
             $(".elimUsuario").button({icons: {
                primary: "ui-icon-cancel"
              }});
             $(".activaUsuario").button({icons: {
                primary: "ui-icon-check"
              }});
          
             $("#modificaUsuario").dialog({
                                            autoOpen: false,
                                            modal:true,
                                            width:800,
                                            height:350,
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
            
             
           
              $("#mainContent").toggle("slide");
              band=true;
            });
}

function despliegaPerfiles(){
     if(band){
        $("#mainContent").html('').toggle('slide');
    }
     $("#menu").find(".menuActive").each(function(){
        $(this).removeClass("menuActive");
    });
    $("#catPerfiles").children().addClass("menuActive");
     var url="../controlador/perfilCatalogo.php";
     $.post(url,{},function(data){
            $("#mainContent").html(data);
            setTimeout(function(){
                 $("#mainContent").find('#listaPerfil').dataTable( { 
                  
                    "bJQueryUI": true,
                    "bAutoWidth": true,
                    "bLengthChange": false,
                    "bSortCellsTop": true,
                    "sPaginationType": "full_numbers",
                    "sScrollY": "415",
                    "bScrollCollapse": true
                    
                    });
                    
             $(".nvoPerfil").button({icons: {
                primary: "ui-icon-plus"
              }});
//             $(".modPerfil").button({icons: {
//                primary: "ui-icon-wrench"
//              }});
//             $(".elimPerfil").button({icons: {
//                primary: "ui-icon-cancel"
//              }});
//             $(".activaPerfil").button({icons: {
//                primary: "ui-icon-check"
//              }});
            },100);
           
            $("#modificaPerfil").dialog({
                                            autoOpen: false,
                                            modal:true,
                                            width:800,
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
          
             
              $("#mainContent").toggle("slide");
            band=true;
            });
}

function despliegaProyectos(){
    
     if(band){
        $("#mainContent").html('').toggle('slide');
    }
    
     $("#menu").find(".menuActive").each(function(){
        $(this).removeClass("menuActive");
    });
    $("#catProyectos").children().addClass("menuActive");
     var url="../controlador/proyectosCatalogo.php";
     
     $.post(url,{},function(data){
            $("#mainContent").html(data);
           $("#mainContent").toggle("slide");
            $(".elimProyecto").button({icons:{primary:"ui-icon-cancel"}}); 
            $("#nvoProyecto").button({icons:{primary:"ui-icon-plus"}});
            $("#panelNProyecto,#panelNSubproyecto").dialog({
                autoOpen: false,
                modal: true
            });
             $("#gproyecto").button({icons:{primary:"ui-icon-disk"}});
             $("#gsubproyecto").button({icons:{primary:"ui-icon-disk"}});
            band=true;
            });
}

function buscaSubpry(idProyecto,obj){
    $("#proyectos").find(".active").each(function(){
        $(this).removeClass("active");
    });
    $(obj).addClass('active');
    var url="../controlador/subpryCatalogo.php";
     $.post(url,{idProyecto:idProyecto},function(data){
                $("#subpryCont").html(data);
                 $(".elimsubpry").button({icons:{primary:"ui-icon-cancel"}}); 
                $("#nvoSubproyecto").button({icons:{primary:"ui-icon-plus"}}); 
            });
}

function nuevoProyecto(){
    $("#nomProyecto").val('');
    $("#panelNProyecto").dialog('open');
}

function guardarProyecto(){
    var nomPry=$("#nomProyecto").val();
    var url="../controlador/guardarProyecto.php";
    $.post(url,{nomProyecto:nomPry},function(data){
        if(data=='ok'){
            $("#panelNProyecto").dialog("close");
            despliegaProyectos();
        }
        else{
            alert(data);
        }
    });
}

function eliminarProyecto(idProyecto){
    if(confirm("¿Desea eliminar proyecto junto con sus subproyectos?")){
        var url="../controlador/eliminaProyecto.php";
        $.post(url,{idProyecto:idProyecto},function(data){
            if(data=='ok'){
                despliegaProyectos();
            }
            else{
                alert(data);
            }
        });
    }
}

function nuevoSubproyecto(idProyecto){
    //alert(idProyecto);
    $("#idPry").val(idProyecto);
    $("#nomsubproyecto").val('');
    $("#panelNSubproyecto").dialog('open');
}

function guardarSubproyecto(){
    var nomSubpry=$("#nomsubproyecto").val();
    var idPry=$("#idPry").val();
    var url="../controlador/guardarSubproyecto.php";
    $.post(url,{nomSubpry:nomSubpry,idPry:idPry},function(data){
        if(data=='ok'){
            $("#panelNSubproyecto").dialog("close");
            $("#proyectos").find(".active").each(function(){$(this).click();})
        }
        else{
            alert(data);
        }
    });
}

function eliminarSubproyecto(idSubproyecto){
    if(confirm("¿Desea eliminar subproyecto?")){
        var url="../controlador/eliminaSubproyecto.php";
        $.post(url,{idSubproyecto:idSubproyecto},function(data){
            if(data=='ok'){
                $("#proyectos").find(".active").each(function(){$(this).click();})
            }
            else{
                alert(data);
            }
        });
    }
}

function despliegaLugares(){
     $("#menu").find(".menuActive").each(function(){
        $(this).removeClass("menuActive");
    });
    $("#catLugares").children().addClass("menuActive");
}

function panelNuevoUsuario(){
  var url="../controlador/agregaUsuarioCatalogo.php";
  $.post(url,{},function(responseText){
    $("#nuevoUsuario").html(responseText);
    $("#btnGuardar").button();
    $("#btnCancel").button();
  });
  $("#listado").toggle('slide',function(){
      $("#nuevoUsuario").toggle('slide');
  });
 }
 
 function registrarUsuario(){
   
  var url="../controlador/registraUsuarioCatalogo.php";
  $.post(url,$("#formulario").serialize(),function(responseText){
   if(responseText=='ok'){
        $("#nuevoUsuario").toggle('slide',function(){
             despliegaUsuarios();
            despliegaUsuarios();
        });
   }
   
  });
}

function panelModUsuario(id){
  var url="../controlador/modUsuarioCatalogo.php"
  $.post(url,{id:id},function(responseText){
    $("#contModifica").html(responseText);
    $("#guardarDatos").button();
  });
  
  $("#modificaUsuario").dialog("open");             
}

function modificaUsuario(){
  var url="../controlador/actualizaUsuarioCatalogo.php";
  $.post(url,$("#formUsr").serialize(),function(responseText){
   if(responseText=='ok'){
       $("#modificaUsuario").dialog('close');
       despliegaUsuarios();
       despliegaUsuarios();
   }
  });
}

function eliminarUsuario(id){
  var url="../controlador/eliminaUsuarioCatalogo.php";
  $.post(url,{id:id},function(responseText){
   if(responseText=='ok'){
       despliegaUsuarios();
       despliegaUsuarios();
   }
  });
}
function activaUsuario(id){
  var url="../controlador/activaUsuarioCatalogo.php";
  $.post(url,{id:id},function(responseText){
   if(responseText=='ok'){
       despliegaUsuarios();
       despliegaUsuarios();
   }
  });
}

function cancelarUsuario(){
  $("#nuevoUsuario").toggle('slide',function(){
      $("#listado").toggle('slide');
  });
}

function panelModPerfil(id){
  var url="../controlador/modPerfilCatalogo.php"
  $.post(url,{id:id},function(responseText){
    $("#contModificaPerfil").html(responseText);
    $("#guardarDatos").button();
  });
  
  $("#modificaPerfil").dialog("open");             
}

function modificaPerfil(){
  var url="../controlador/actualizaPerfilCatalogo.php";
  $.post(url,$("#formPerfil").serialize(),function(responseText){
   if(responseText=='ok'){
       $("#modificaPerfil").dialog('close');
            despliegaPerfiles();
          //despliegaPerfiles();
   }
  });
}
function panelNuevoPerfil(){
  var url="../controlador/agregaPerfilCatalogo.php";
  $.post(url,{},function(responseText){
    $("#nuevoPerfil").html(responseText);
    $("#guardarDatos").button();
  });
  $("#listado").toggle('slide',function(){
      $("#nuevoPerfil").toggle('slide');
  });
 }
 
 function registrarPerfil(){
   
  var url="../controlador/registraPerfilCatalogo.php";
  $.post(url,$("#formPerfil").serialize(),function(responseText){
   if(responseText=='ok'){
        $("#nuevoPerfil").toggle('slide',function(){
                despliegaPerfiles();
                //despliegaPerfiles();
        });
   }
   
  });
}
//function eliminarUsuario(id){
//  var url="../controlador/eliminaUsuarioCatalogo.php";
//  $.post(url,{id:id},function(responseText){
//   if(responseText=='ok'){
//       despliegaUsuarios();
//       despliegaUsuarios();
//   }
//  });
//}
//function activaUsuario(id){
//  var url="../controlador/activaUsuarioCatalogo.php";
//  $.post(url,{id:id},function(responseText){
//   if(responseText=='ok'){
//       despliegaUsuarios();
//       despliegaUsuarios();
//   }
//  });
//}
//
//function cancelarUsuario(){
//  $("#nuevoUsuario").toggle('slide',function(){
//      $("#listado").toggle('slide');
//  });
//}

// ----------- lugares
function despliegaLugares(){
    if(band){
        $("#mainContent").html('').toggle('slide');
    }
    
     $("#menu").find(".menuActive").each(function(){
        $(this).removeClass("menuActive");
    });
    $("#catLugares").children().addClass("menuActive");
     var url="../controlador/listarLugares.php";
     
    $.post(url,{},function(data){
        $("#mainContent").html(data);
        setTimeout(function(){
            $("#mainContent").find('#listaLugares').dataTable( { 
                "sPaginationType": "full_numbers",
                "bJQueryUI": true,
                "bAutoWidth": true
            }); 
        },100);    
        $(".btonModLug").button({
            icons:{ primary:"ui-icon-wrench"},
            text: false
        }).height("18px");
        $(".btonDelLug").button({
            icons:{ primary:"ui-icon-trash"},
            text: false
        }).height("18px"); 
        $("#btonAddLug").button({
            icons:{ primary:"ui-icon-plus"},
            text: true
        }); 
        
        $("#mainContent").toggle("slide");     
        $("#dialogSetLugar").dialog({
            autoOpen: false,
            modal:true,
            width:800,
            height:250,
            resizable:true,
             show: {
               effect: "clip",
               duration: 500
             },
             hide: {
               effect: "clip",
               duration: 500
             },
             buttons: {
                "Guardar": function() {
                  setRegistroLugar();
                },
                "Cancelar": function() {
                  $("#dialogSetLugar").dialog("close");
                }
            }
        });
        band=true;
    });
}

function eliminaLugar(idlugar,boton){
    if(confirm("\u00BFDesea eliminar el lugar?")){
        var url="../controlador/eliminaLugar.php";
        $.post(url,{idlugar:idlugar},function(data){
            if(data == "ok"){
                $(boton).parents("tr").remove();
                alert("Se ha eliminado el lugar correctamente");                               
            }else{
                alert(data);
            }
        });
    }
}

function agregarLugar(){
    var url="../controlador/agregaLugar.php";
  $.post(url,{},function(responseText){      
    $("#mainContent").toggle("slide",function(){
        $("#mainContent").html(responseText);        
        $("#mainContent").toggle("slide",function (){
            $("#btonGuardar").button();
            $("#btonCancel").button();
        });
    });    
  });  
}

function addLugar(){
    var url="../controlador/registraLugar.php";
    $.post(url,$("#formLugar").serialize(),function(responseText){
        if(responseText == "ok"){
            alert("Se registr\u00f3 el lugar correctamente");
            $("#mainContent").toggle("slide",function (){  
                $("#mainContent").html("");
                $("#mainContent").toggle("slide",function(){
                    despliegaLugares();
                });                
            });             
        }else{
            alert(responseText);
        }
    });
}

function setLugar(idlugar,titulo,direccion,boton){    
    $("#dialogSetLugar").dialog("open");
    $("#direccionlugar").val(direccion);
    $("#titulolugar").val(titulo);
    $("#idlugar").val(idlugar); 
    
}

function setRegistroLugar(){
    var url="../controlador/actualizaLugar.php";
    $.post(url,$("#formLugar").serialize(),function(responseText){
        if(responseText == "ok"){
            alert("Se actualiz\u00f3 el lugar correctamente");
            $("#dialogSetLugar").dialog("close");
            $("#mainContent").toggle("slide",function (){  
                $("#mainContent").html("");
                $("#mainContent").toggle("slide",function(){
                    despliegaLugares();
                });                
            });             
        }else{
            alert(responseText);
        }
    });
}

function cancelAddLugar(){
    $("#mainContent").toggle("slide",function (){  
        $("#mainContent").html("");
        $("#mainContent").toggle("slide",function(){
            despliegaLugares();
        });                
    }); 
}
