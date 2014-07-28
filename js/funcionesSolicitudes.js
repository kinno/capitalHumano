    /* 
 * Regino Tabares
 * 
 */
$(document).tooltip().ready(function(){ 
    $('#inicioD').datepicker({dateFormat: 'dd-mm-yy', 
                            onClose: function( selectedDate ) {
                            $( "#finalD" ).datepicker( "option", "minDate", selectedDate );
      }});
    $("#finalD").datepicker({dateFormat: 'dd-mm-yy',
                            onClose: function( selectedDate ) {
                            $( "#inicioD" ).datepicker( "option", "maxDate", selectedDate );
      }});  
    $('#acordeon').accordion({
         heightStyle: "content"
        });
        
    $( "#selectable" ).selectable({
      stop: function() {
        var result = "";
        $( ".ui-selected", this ).each(function() {
          var dia = $( this ).text();
          result=result+","+dia
          $("#diasTrabajo").val(result.replace(',',''));
        });
      }
    });
    
    
    /*$( "#slider-range" ).slider({
      range: true,
      min: 00,
      max: 24,
      //step:30,
      values: [ 09, 18 ],
      slide: function( event, ui ) {
        $( "#horario" ).val( ui.values[ 0 ] + " hrs. - " + ui.values[ 1 ] + " hrs." );
      }
    });
    
    $( "#horario" ).val( $( "#slider-range" ).slider( "values", 0 ) +
      " hrs. - " + $( "#slider-range" ).slider( "values", 1 ) + " hrs." );
      */
       $("#nVacante").spinner(
           {min:1,
            max:99}
           ).css("width",'20px');
    $("#hInicio").timepicker({
        defaultTime: '09:00',
            onSelect: function(){
                $("#horario").val($(this).val()+" hrs.");
            }
        });        
    $("#hFin").timepicker({
        defaultTime: '18:00',
            onSelect: function(){
                var Horario = $("#horario").val();
                $("#horario").val(Horario+" - "+$(this).val()+" hrs.");
            }
        });        
       
    $(".spinnerPorcentaje").spinner({min:0,max:100,step:10});
    
      
    $('#solicitudTab').tabs({
        event: "mouseover"});
    $("input,select,textarea").addClass("ui-corner-all");
    $("button").button();
    $("#catperf").button();
    $("#catperf").button({icons: {
        primary: "ui-icon-search"
      }});
      $(".seleccionar").button({icons: {
        primary: "ui-icon-circle-check",
      },text:false}).css({'height':'20px'});
  $(".modificar").button({icons: {
        primary: "ui-icon-wrench",
      },text:false}).css({'height':'20px'});
  $(".ver").button({icons: {
        primary: "ui-icon-search",
      },text:false}).css({'height':'20px'});
  $('#listaPerfil').dataTable( {
      "bAutoWidth": true,
        "bLengthChange": false,
        "bSortCellsTop": true,
        "sPaginationType": "full_numbers",
        "sScrollY": "480",
        "bScrollCollapse": true,
        "bJQueryUI": true
    } );
   
    $("#listaPerfil_filter").find("input:first").attr("onkeyup","resalta()");
    
   


    $("#ventanaPerfil").dialog({
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
    $("#ventanaSolicitud").dialog({
     autoOpen: false,
     modal:true,
     width:1250,
     height:520,
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
   
   
    
});

/*
 *       FUNCIONES PARA EL MÓDULO DE REQUISICION DE PERSONAL
 */
function cargaSubProyecto(){
  var idProyecto=$("#proyec").val();
   $.ajax({
                        type:'post',
                        url:'../controlador/buscaSubPry.php',
                        data:
                        {
                          idProyecto:idProyecto
                        },
                        success:function(data){
                          $('#suproyecto').html(data);     
                        },
                        error: function()
                        {
                          alert("Error");
			  
                        }
                    });
}
var seleccionados = new Array(4); //variable global que guarda las casillas que se selecionaron lo ocupa la funci�n "verifCheck"
                                 //Consideramos que el   elemento 0 corresponde a check "ingl�s"
                                                       //elemento 1 corresponde a check "franc�s"
                                                       //elemento 2 corresponde a check "alem�n"
                                                       //elemento 3 corresponde a check "portug�s"

/*Nombre del M�dulo: mostrar
 *Funci�n: Muestra un elemento sapan que contiene contiene una llamada a una funci�n PHP que devuelve un comboBox con los porcentajes de los idiomas
 *Par�metros: El id del span a mostar (originalmente este span esta oculto)
 *Realiz�: Jesus Abel Vera Cruz
 *Fecha:20-05-2013
 */
function mostrar(id)//recibe el id del  span donde se encuentra el combo box y lo muestra
{
   document.getElementById(id).style.display="block"; 
}
/*Nombre del M�dulo: VerifCheck
 *Funci�n: verifica cual caja esta activa, si esta activa muestra el combo de porcentaje y si no esta activa no muestra el combo de porcentaje
 *Par�metros: Recibe como par�metros el id del check box que se selecciono.
 *Realiz�: Jesus Abel Vera Cruz
 *Fecha:20-05-2013
 */
function verifCheck(id) 
{
     //va a guardar las casillas seleccionadas 
    casilla=document.getElementById(id);
    //si alguna casilla esta desactivada la activa, esto aplica s�lo cuando ya se eligier�n tres idiomas y luego volv�o a seleccionar otros tres idiomas
    document.getElementById('idiomas_0').disabled=false;
    document.getElementById('idiomas_1').disabled=false;
    document.getElementById('idiomas_2').disabled=false;
    document.getElementById('idiomas_3').disabled=false;
    switch (id) {
        
         case 'idiomas_0':
         if (!(casilla.checked))
         {
            document.getElementById("ingles").style.display="none";
            seleccionados[0]=0;//si la casilla no esta seleccionada le asignamos vacio a la posicion 0
            
             
         }
         else
         {
            seleccionados[0]=1; //si esta seleccionada le asignamos uno la posici�n cero
            
         }
          break;
         case 'idiomas_1':
         if (!(casilla.checked))
         {
            document.getElementById("frances").style.display="none";            
            seleccionados[1]=0;//si la casilla no esta seleccionada le asignamos vacio a la posicion 1
           
             
         }
         else
         {
            seleccionados[1]=1;
            
         }
          break;
        case 'idiomas_2':
         if (!(casilla.checked))
         {
            document.getElementById("aleman").style.display="none";
            seleccionados[2]=0;//si la casilla no esta seleccionada le asignamos vacio a la posicion 2
           
             
         }
         else
         {
            seleccionados[2]=1;
            
         }
          break;
        default:
         if (!(casilla.checked))
         {
            document.getElementById("portugues").style.display="none";
            seleccionados[3]=0;//si la casilla no esta seleccionada le asignamos vacio a la posicion 3
           
         }else
         {
            seleccionados[3]=1;
            
         }   
          break;
    }
  var cantidad=0;
  for (i=0;i<4;i++)
  {
    if (seleccionados[i])
    {
       cantidad++;
    }
  }
   if (cantidad==3) //si la cantidad de "unos" en el arreglo seleccionado es igual a 3, llamamos a la funci�n para desabilitar la casilla restante
   {
    desCasillas();
   }
  
}
/*Nombre del M�dulo: desCasillas
 *Funci�n: Desactiva la casilla que no fue seleccionada 
 *Par�metros: No recibe ni regresa
 *Realiz�: Jesus Abel Vera Cruz
 *Fecha:20-05-2013
 */
function desCasillas() //meneja el arreglo global con las casillas seleccionadas 
{
    //estos condicionales desactivan la casilla que no se selecciono despues de tres seleccionadas por el usuario
    if (!(seleccionados[0]))
    {
       document.getElementById('idiomas_0').disabled=true;
    }
    if (!(seleccionados[1]))
    {
      document.getElementById('idiomas_1').disabled=true;
    }
    if (!(seleccionados[2]))
    {
      document.getElementById('idiomas_2').disabled=true;
    }
    if (!(seleccionados[3]))
    {
      document.getElementById('idiomas_3').disabled=true;
    }
}
//muestra los caja y radio botones en caso de que el empleo sea temporal
//creacion: 
//27/05/2013
function muestraDuracion(id)
{
  
  switch (id)
  {
   case "creacion":
      
       document.getElementById("tiempoTrabajo").style.display="none";
       //document.getElementById("sprytextfield1").style.display="none";
      break;
   case "remplazo":
     
       document.getElementById("tiempoTrabajo").style.display="none";
       // document.getElementById("sprytextfield1").style.display="none";
      break;
   
   default:
       document.getElementById("tiempoTrabajo").style.display="block";
        //document.getElementById("sprytextfield1").style.display="block";
      break;
  }
}
function muestraFrecuencia(id)
{  
    
   switch (id)
  {
   case "si":
      document.getElementById("frec").style.display="block";
      break;
   default:
       document.getElementById("frec").style.display="none";
      break;
  }
}

var IDPERFIL=0;
            function recuperaId(id) {
               IDPERFIL=id;
            }
             function resetFormulario() {
                 
               document.getElementById("solicitud").reset();
               
             }
 function envia(){
    var iconoError = '<span class="ui-icon ui-icon-alert" style="float:left"></span>';
     var enviar=true;
                            var folio=$('#folios').val();
                            //campos obligatorios
                            //

                         //CAMPOS NUEVOS//
                            var idProyecto=$("#proyec").val();
                            var idSubproyecto=$("#subproyecto").val();
                            var liderProyecto=$("#liderProyecto").val();
                            var tipoVacante= $('input[name=tipoVacante]:checked').val();  //radio
                            var inicioDuracion=$("#inicioD").val();
                            var finalDuracion=$("#finalD").val();
                        //    
                            var idDescPuesto=IDPERFIL;
                            var numVacantes=$("#nVacante").val();
                            var diasTrabajo=$("#diasTrabajo").val();
                            var horaTrabajo=$("#horario").val();
                            var lugarTrabajo=$("#lugarTrabajo").val();
                            var salMin=$("#salarioMin").val();
                            var salMax=$("#salarioMax").val();
			    salMax=parseInt(salMax);
			    salMin=parseInt(salMin);
                            //var fechaRequi=$("#fechaRequi").val();
                            var viajar=$('input[name=reqViajar]:checked').val(); //radio
                            //campos no obligatorios pero se pueden convertir en obligatorios al seleccionarlos
                            
                            var descActividades=$("#activi").val();
                            
                            var pHablado1=0, pHablado2=0,pHablado3=0, pHablado4=0;
                            var pEscrito1=0, pEscrito2=0,pEscrito3=0, pEscrito4=0;
                            var idioma1=0, idioma2=0, idioma3=0, idioma4=0;
                            var frecuViaje=0;
                            //campos no obligatorios 
                            var otrasPercep=0;
                            var comentarios="";
                            
                            //validaciones
                            if (idProyecto=="vacio") {
                                $("#res").addClass('ui-state-error ui-corner-all').html(iconoError+'<strong>Error:</strong>Elija un proyecto en Datos Generales');
                                  $("#proyec").focus();
                                  //$("#datGenerales").show();
                                  enviar=false;
                            }else if (idSubproyecto==-1) {
                                $("#res").addClass('ui-state-error ui-corner-all').html(iconoError+'<strong>Error:</strong>Elija un subproyecto en Datos Generales');
                                  $("#subproyecto").focus();
                                  //$("#datGenerales").show();
                                  enviar=false;
                            }else if (liderProyecto=='') {
                                $("#res").addClass('ui-state-error ui-corner-all').html(iconoError+'<strong>Error:</strong>Debe registrar un Lider de Proyecto en Datos Generales');
                                  $("#liderProyecto").focus();
                                  //$("#datGenerales").show();
                                  enviar=false;
                            }else if(inicioDuracion==''){
                                $("#res").addClass('ui-state-error ui-corner-all').html(iconoError+'<strong>Error:</strong>Debe ingresar inicio de trabajo en Datos Generales');
                                $("#inicioD").focus();
                                enviar=false;
                            }else if(finalDuracion==''){
                                $("#res").addClass('ui-state-error ui-corner-all').html(iconoError+'<strong>Error:</strong>Debe ingresar fin de trabajo en Datos Generales');
                                $("#finalD").focus();
                                enviar=false;
                            }else if (idDescPuesto==0) {
                                $("#res").addClass('ui-state-error ui-corner-all').html(iconoError+'<strong>Error:</strong>Elija un perfil en Descripción del Puesto');
                                //$("#catperf").focus();
                               // $("#descPuesto").show();
                                enviar=false;
                            }else if(diasTrabajo===''){
                                $("#res").addClass('ui-state-error ui-corner-all').html(iconoError+'<strong>Error:</strong>Elija los días laborales en Descripción del Puesto');
                                //$("#catperf").focus();
                               // $("#descPuesto").show();
                                enviar=false;
                            }else if (lugarTrabajo==-1) {
                                $("#res").addClass('ui-state-error ui-corner-all').html(iconoError+'<strong>Error:</strong>Elija un lugar de trabajo en Descripción del Puesto');
                                $("#lugarTrabajo").focus();
                                enviar=false;
                            }else if (salMax<salMin) {
                                 $("#res").addClass('ui-state-error ui-corner-all').html(iconoError+'<strong>Error:</strong>El salario máximo es menor que el salario mínimo en Descrpción del Puesto');
                                 $("#salarioMax").focus();
                                // $("#descPuesto").show();
                                 enviar=false;
                            }
                            
                            $("#solicitud").find('.rRequerido1').each(function(){
                            if(!(tipoVacante)){
                               $("#res").addClass('ui-state-error ui-corner-all').html(iconoError+'<strong>Error:</strong>Debe elegir el Tipo de vacante en Datos Generales');
                               $(this).focus();
                             //  $("#datGenerales").show();
                               enviar=false;
                            }});
                            
                             $("#solicitud").find('.rRequerido2').each(function(){
                            if(!(viajar)){
                               $("#res").addClass('ui-state-error ui-corner-all').html(iconoError+'<strong>Error:</strong>Elija una opción en Requiere Viajar, Requisitos para el Puesto');
                               $(this).focus();
                             //  $("#requisitos").show();
                               enviar=false;
                            }
                            });
                            
                            if (($('input[name=idioma1]:checked').val())||($('input[name=idioma2]:checked').val())||($('input[name=idioma3]:checked').val())||($('input[name=idioma4]:checked').val())) { //entra cuando le dimos clic a en un Check box 
                                //alert("Entro a idiomas");
                                idioma1=$('input[name=idioma1]:checked').val();
                                idioma2=$('input[name=idioma2]:checked').val();
                                idioma3=$('input[name=idioma3]:checked').val();
                                idioma4=$('input[name=idioma4]:checked').val();
                                if (idioma1) {
                                   pHablado1=$("#pHablado1").val();
                                   pEscrito1=$("#pEscrito1").val();
                                    if (pHablado1==0||pEscrito1==0) {
                                        $("#res").addClass('ui-state-error ui-corner-all').html(iconoError+'<strong>Error:</strong>Elija un porcentaje de conocimientos de inglés en Requisitos para el Puesto');
                                        //$("#requisitos").show();
                                        enviar=false;
                                    }
                                }
                                if (idioma2) {
                                    pHablado2=$("#pHablado2").val();
                                    pEscrito2=$("#pEscrito2").val();
                                    if (pHablado2==0||pEscrito2==0) {
                                        $("#res").addClass('ui-state-error ui-corner-all').html(iconoError+'<strong>Error:</strong>Elija un porcentaje de conocimientos de francés en Requisitos para el Puesto');
                                        $("#idiomas2").focus();
                                       // $("#requisitos").show();
                                        enviar=false;
                                    }
                                }
                                if (idioma3) {
                                    pHablado3=$("#pHablado3").val();
                                   pEscrito3=$("#pEscrito3").val();
                                    if (pHablado3==0||pEscrito3==0) {
                                        $("#res").addClass('ui-state-error ui-corner-all').html(iconoError+'<strong>Error:</strong>Elija un porcentaje de conocimientos de alemán en Requisitos para el Puesto');
                                        $("#idiomas3").focus();
                                        //$("#requisitos").show();
                                        enviar=false;
                                    }
                                }
                                if (idioma4) {
                                    pHablado4=$("#pHablado4").val();
                                   pEscrito4=$("#pEscrito4").val();
                                    if (pHablado4==0||pEscrito4==0) {
                                        $("#res").addClass('ui-state-error ui-corner-all').html(iconoError+'<strong>Error:</strong>Elija un porcentaje de conocimientos de portugués en Requisitos para el Puesto');
                                        $("#idiomas4").focus();
                                        //$("#requisitos").show();
                                        enviar=false;
                                    }
                                }
                            }
                            if (viajar==1) {
                                frecuViaje=$("#frecuencia").val();
                                if (frecuViaje=="") {
                                    $("#res").addClass('ui-state-error ui-corner-all').html(iconoError+'<strong>Error:</strong>Se necesita un valor la frecuancia de viaje en Requisitos para el Puesto');
                                    $("#frecuencia").focus();
                                    //$("#requisitos").show();
                                    enviar=false;
                                }
                            }
                            
                            //si al final no tenemos ning�n idioma activo entonces mandamos todo como ceros
                                if (!$('input[name=idioma1]:checked').val())
                                 {
                                     idioma1=0;
                                    pHablado1=0;
                                    pEscrito1=0;
                                }
                                if(!$('input[name=idioma2]:checked').val())
                                { idioma2=0;
                                    pHablado2=0;
                                    pEscrito2=0;
                                }
                                if(!$('input[name=idioma3]:checked').val())
                                {idioma3=0;
                                    pHablado3=0;
                                    pEscrito3=0;
                                }
                                if(!$('input[name=idioma4]:checked').val())
                                {
                                idioma4=0;
                                    pHablado4=0;
                                    pEscrito4=0;
                                }
                                if ($("#otrasPercep").val())
                            {
                                otrasPercep=$("#otrasPercep").val();
                            }
                            if($("#comentarios").val())
                            {
                                comentarios=$("#comentarios").val();
                            }
                                if (descActividades=='') {
                                $("#res").addClass('ui-state-error ui-corner-all').html(iconoError+'<strong>Error:</strong>Describa las actividades para el puesto');
                                
                                //$("#catperf").focus();
                               // $("#descPuesto").show();
                                enviar=false;
                            }
                            
                            
                            
                           
                             
                                
                                
                            /*    
                            
     
     
                            if(($(".textfieldInvalidFormatState").css("display")) || ($(".textfieldMinCharsState").css("display")) || ($(".textfieldMaxCharsState").css("display")) )
                             {
                               $("#res").addClass('ui-state-error ui-corner-all').html(iconoError+'<strong>Error:</strong>Datos erróneos, verifique los datos');
                               enviar=false;
                               //$("#desPuesto").show();
                             }
                            
                            if (diasTrabajo=="vacio") {
                              $("#res").addClass('ui-state-error ui-corner-all').html(iconoError+'<strong>Error:</strong>Elija los dias de trabajo en Datos Generales');
                                  $("#diasTrabajo").focus();
                                  //$("#descPuesto").show();
                                  
                                  enviar=false;
                            }
                            $("#solicitud").find('.requerido').each(function(){     
                            if($(this).val()==""){
                               $("#res").addClass('ui-state-error ui-corner-all').html(iconoError+'<strong>Error:</strong>Algún campo sigue vacío');
                               $(this).focus();
                               //$(this).show();
                               //$("#descPuesto").show();
                               //$("#requisitos").show();
                               enviar=false;
                            }}); //cierra el find()
                        
                            
                            });
                           
                            
                            
                            
                            if (horaTrabajo=="") {
                               $("#res").addClass('ui-state-error ui-corner-all').html(iconoError+'<strong>Error:</strong>Ingrese horario de trabajo con formato HH-HH');
                               //$("#fechaRequi").focus();
                              // $("#descPuesto").show();
                               enviar=false;
                            }
                            
                            if (idDescPuesto==0) {
                                $("#res").addClass('ui-state-error ui-corner-all').html(iconoError+'<strong>Error:</strong>Elija un perfil en Descripción del Puesto');
                                //$("#catperf").focus();
                               // $("#descPuesto").show();
                                enviar=false;
                            }
                            
                            
                            
                            
                            /*if (tipoVacante==1 || tipoVacante==2 || viajar==0) { //nos aseguramos que si al final ning�n campo se convirtio en
                                //obligatorio los valores de esos campos se vallan como ceros
                                duracion=0;
                                descTiempo=0;
                                //frecuViaje=0;
                               
                            }*/
                            var data={
				 folios:folio,
                                 idSubproyecto:idSubproyecto,
                                 liderProyecto:liderProyecto,
                                 tVacante:tipoVacante,
                                 inicioDSolici:inicioDuracion,
                                 finDSolici:finalDuracion,
                                 perfil:IDPERFIL,
                                 nVacantes:numVacantes,
                                 dTrabajo:diasTrabajo,
                                 hTrabajo:horaTrabajo,
                                 lTrabajo:lugarTrabajo,
                                 sMin:salMin,
                                 sMax:salMax,
                                 oPercep:otrasPercep,
                                 idio1:idioma1,
                                 pHablado1:pHablado1,
                                 pEscrito1:pEscrito1,
                                 idio2:idioma2,
                                 pHablado2:pHablado2,
                                 pEscrito2:pEscrito2,
                                 idio3:idioma3,
                                 pHablado3:pHablado3,
                                 pEscrito3:pEscrito3,
                                 idio4:idioma4,
                                 pHablado4:pHablado4,
                                 pEscrito4:pEscrito4,
                                 viaje:viajar,
                                 fViaje:frecuViaje,
                                 comentario:comentarios,
                                 descActividades:descActividades,
                                 accion:'A'
                                 };
                            if (enviar===true)
                            {
                                console.log(data);
                                $("#res").text("Porcesando Solicitud...");
                                //$('#enviar').attr("disabled", true);
                                //$('#restablecer').attr("disabled", true);
                                
                                 $.ajax(
                                 
			     {
				 type:'post',
			         url:'../controlador/procesaSoli.php',
                                 processData: true,
			         data:data
				 ,
                                  success:function(data){
                                            if(data=='ok'){
                                                  $("#panelResp").html('<div style="font-size: 45px; text-align: center; padding-top:200px;"><img style="width:100px;" src="../img/paloma.png" /> ¡Solicitud registrada!</div>');
                                                  $("#panelRequisicion").toggle('slide',function(){$("#panelResp").toggle('slide');});
                                                  /*$("#conteiner").find("input,select,textarea").each(function(){
                                                      $(this).val('');
                                                  });*/
                                                  setTimeout(function(){
                                                      $("#panelResp").toggle('slide',function(){$("#panelRequisicion").toggle('slide');});
                                                  },4000);
                                                  setTimeout(function(){location.reload();},2000);


                                              }else{
                                                  $("#panelResp").html('<div style="font-size: 45px; text-align: center; padding-top:200px;"><img style="width:100px;" src="../img/tache.png" /> ¡Ocurrio un error!</div>');
                                                  $("#panelRequisicion").toggle('slide');
                                                  $("#panelResp").toggle('slide');
                                      //            $("#conteiner").find("input,select,textarea").each(function(){
                                      //                $(this).val('');
                                      //            });
                                                  setTimeout(function(){
                                                      $("#panelResp").toggle('slide');
                                                      $("#panelRequisicion").toggle('slide');
                                                  },4000);
                                                  setTimeout(function(){location.reload();},3000);
                                              }
                                  },
                                  error:function(){
                                  alert('Error intentelo m�s tarde');
                                }
                             });  
                             
                           }
                           
 }            
 
 function verPerfiles(){
     $("#ventanaPerfil").dialog("open");
     var url="../controlador/listarPerfiles.php";
    $.post(url,{},function(responseText){
        $("#contDialog").html(responseText);
        
    });
 }
 
 function recuperaPerfil(id)
  {
     
		  try {
			    var idPerfil=id;
			    $.ajax
			({
			    type:'post',
			    url:'../controlador/buscarperfil.php', //le mandanos el id y nos regresa un json
			    data:{id:idPerfil},
			    error: callback_error,
			   success: recuperarPerfil  //funci�n para recuperar los campos de la base de datos
			});
		      }
		    catch(ex)
		      {
			   alert("No se Realiz� la Consulta");
		      }
				        
		      function callback_error(XMLHttpRequest, textStatus, errorThrown)
		      {
			   alert("Error Intentelo m�s Tarde");
		      }
		      function recuperarPerfil(ajaxResponse)
		      {
		         var perfiles = procesarResp(ajaxResponse);
			if (!perfiles) {
			alert("Error al consultar el cat�logo de Perfiles")
		       }
			//manda los datos obtenidos del Json a las respectivas cajas de texto
                         document.getElementById("perfil").value=perfiles[0].perfil;
			 document.getElementById("conoc").value=perfiles[1].conoc;
			 document.getElementById("Esco-Expi").value=perfiles[2].escoexpi;
			 document.getElementById("habi").value=perfiles[3].habi;
			 
                         cerrar();
			                                                                                                            //a�adir los datos al formulario
			
		      }
			//evalua lo que nos envia ajax desde el servidor
			function procesarResp(ajaxResponse) {
			  var response;
			  try {
				eval('response='+ajaxResponse);
			    } catch(ex) {
						response= null;
					}
					return response;
		    }
		     
	
      recuperaId(id); //se envia el id del perfil seleccionado a un funcion js que se encuetra en index.php
  }
  function cerrar() {
  $("#ventanaPerfil").dialog("close");
   //$('.overlay-container').fadeOut().end().find('.window-container').removeClass('window-container-visible');
  }
 
 function resalta(){
     
    $("#listaPerfil").unhighlight();
    $("#listaPerfil").highlight($("#listaPerfil_filter").find("input:first").val());
    $(".highlight").css({ backgroundColor: "#FFFF88" });
   
}

function cargarSolicitudes(){
    
      var randomnumber=Math.random()*11;
            $.post("../controlador/listarSolicitudes.php", {
                randomnumber:randomnumber
            }, function(data){
                
              $("#contenido").html(data);
            });
}

function detallesSolicitud(id,SESION){
    
    $("#ventanaSolicitud").dialog("open");
    $.ajax({
                        type:'get',
                        url:'../controlador/solicitudes.php',
                        data:
                        {
                          ids:id,
			  SES:SESION
                        },
                        success:function(data){
                          $('#contDialog').html(data);     
                        },
                        error: function()
                        {
                          alert("Error");
			  
                        }
                    });
}

function aceptarSolicitud(){

    var folio=$('#folio').val();
            $.ajax(
            {
                 type:'get',
                 url:'../controlador/acciones.php',
                 data:{
                 folio:folio,
                 accion:'A' //A de aceptar la solicitud
                },
                success:function(data){
                $('#res').html(data);
                },
                error:function(){
                alert('error');
                }

            });
}

function rechazarSolicitud(){

    var folio=$('#folio').val();
            $.ajax(
            {
                 type:'get',
                 url:'../controlador/acciones.php',
                 data:{
                 folio:folio,
                 accion:'R' //R rechazar la  solicitud
                },
                success:function(data){
                $('#res').html(data);
                },
                error:function(){
                alert('error');
                }
            });
     
}

function listarSolicitudes(){
    $('#listaSolicitud').dataTable( { //CONVERTIMOS NUESTRO LISTADO DE LA FORMA DEL JQUERY.DATATABLES- PASAMOS EL ID DE LA TABLA
        "sPaginationType": "full_numbers", //DAMOS FORMATO A LA PAGINACION(NUMEROS)
        "bAutoWidth": true,
        
        "bScrollCollapse": true,
        "bJQueryUI": true
    } );
    $("body").addClass('ui-widget');
    $("#contenido").addClass('ui-widget');
    
}