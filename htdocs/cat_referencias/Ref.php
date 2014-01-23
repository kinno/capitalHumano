<?php
header("Content-Type: text/html;charset=utf-8");

include"../libs/libs.php";
include"libs/libRef.php";

$funciones= new funciones; 
$funciones->conectar(); 
$idCandid=$_GET['idCandid'];
$numRef=$_GET['numRef'];

$sqlB="select * from tblreferencias where idCandid=$idCandid and numRef=$numRef";
$queryR=mysql_query($sqlB) or die(mysql_error()); 

//Se Obtiene Información del Regristro para desplegar en la Forma
$txtempRef=mb_convert_encoding(mysql_result($queryR,0,'empRef'), "UTF-8");
$txtnomRef=mb_convert_encoding(mysql_result($queryR,0,'nomRef'), "UTF-8");
$txtpuestoRef=mb_convert_encoding(mysql_result($queryR,0,'puestoRef'), "UTF-8");
$fecPerI=mb_convert_encoding(mysql_result($queryR,0,'perIniRef'), "UTF-8"); 
$fecPerF=mb_convert_encoding(mysql_result($queryR,0,'perFinRef'), "UTF-8");
$intsueldoRef=mb_convert_encoding(mysql_result($queryR,0,'sueldoRef'), "UTF-8");
$txtmotivoRef=mb_convert_encoding(mysql_result($queryR,0,'motivoRef'), "UTF-8");
$txtultPstRef=mb_convert_encoding(mysql_result($queryR,0,'ultPuestRef'), "UTF-8");
$intvolvRef=mb_convert_encoding(mysql_result($queryR,0,'volvRef'), "UTF-8");
$txtcomentRef=mb_convert_encoding(mysql_result($queryR,0,'comentRef'), "UTF-8");
//---Evaluación
$rdorespRef=mb_convert_encoding(mysql_result($queryR,0,'respRef'), "UTF-8");
$rdoasistenciaRef=mb_convert_encoding(mysql_result($queryR,0,'asistenciaRef'), "UTF-8");
$rdopuntualidadRef=mb_convert_encoding(mysql_result($queryR,0,'puntualidadRef'), "UTF-8");
$rdoactitudRef=mb_convert_encoding(mysql_result($queryR,0,'actitudRef'), "UTF-8");
$rdocompromisoRef=mb_convert_encoding(mysql_result($queryR,0,'compromisoRef'), "UTF-8");
$rdohonestidadRef=mb_convert_encoding(mysql_result($queryR,0,'honestidadRef'), "UTF-8");
$rdorelsupRef=mb_convert_encoding(mysql_result($queryR,0,'relsupRef'), "UTF-8");
$rdoiniciativaRef=mb_convert_encoding(mysql_result($queryR,0,'iniciativaRef'), "UTF-8");
$rdolealtadRef=mb_convert_encoding(mysql_result($queryR,0,'lealtadRef'), "UTF-8");
$rdoapegoRef=mb_convert_encoding(mysql_result($queryR,0,'apegoRef'), "UTF-8");

//--------------------------------------------------------
//Se obtiene año y mes para Combos de Perido de Referncia
//--------------------------------------------------------
$FPI=explode('-',$fecPerI);
$FPF=explode('-',$fecPerF);
//--------------------------------------------------------
echo"
<script type='text/javascript' src='../js/libs.js'></script>
<script> 
$(document).ready(function(){

	$('#close').click(function(){
    	$('.overlay-container').fadeOut().end().find('.window-container').removeClass('window-container-visible');  
    });

  //--------------------------------------------------------
  //MODIFICAR
  //--------------------------------------------------------
  $('#modif').click(function(){   
    var intidCandid  = $('#idCandid').val();
    var intnumRef    = $('#numRef').val();
    var txtempRef    = $('#empRef').val();
    var txtnomRef    = $('#nomRef').val();
    var txtpuestoRef = $('#puestoRef').val();
    var intmesI      = $('#mesI').val();
    var intanioI     = $('#anioI').val();
    var intmesF      = $('#mesF').val();
    var intanioF     = $('#anioF').val();
    var intsueldoRef = $('#sueldoRef').val();
    var txtultPstRef = $('#ultPuestRef').val();     
    var txtmotivoRef = $('#motivoRef').val();
    var intvolvRef   = $('#volvRef').val();
    var txtcomentRef = $('#comentRef').val(); 
    var rdorespRef        = $('input[name=respRef]:radio:checked').val();   
    var rdoasistenciaRef  = $('input[name=asistenciaRef]:radio:checked').val();
    var rdopuntualidadRef = $('input[name=puntualidadRef]:radio:checked').val();
    var rdoactitudRef     = $('input[name=actitudRef]:radio:checked').val();
    var rdocompromisoRef  = $('input[name=compromisoRef]:radio:checked').val();
    var rdohonestidadRef  = $('input[name=honestidadRef]:radio:checked').val();
    var rdorelsupRef      = $('input[name=relsupRef]:radio:checked').val();
    var rdoiniciativaRef  = $('input[name=iniciativaRef]:radio:checked').val();
    var rdolealtadRef     = $('input[name=lealtadRef]:radio:checked').val();
    var rdoapegoRef       = $('input[name=apegoRef]:radio:checked').val();  

    //Fecha Inicial
    strPerI = '1' + '/' + intmesI + '/' + intanioI;
    fecPerI = new Date();
    fecPerI.setTime(Date.parse(strPerI));
    //Fecha Final
    strPerF = '1' + '/' + intmesF + '/' + intanioF;
    fecPerF = new Date();
    fecPerF.setTime(Date.parse(strPerF)); 
   
    //----------------------------------------------------------
    // Se valida Formulario
    //----------------------------------------------------------  
    if (validar_input_txt(txtempRef,'Empresa',1,100) == false){
      $('#empRef').focus();
      return false; 
    }  
    else if (validar_input_txt(txtnomRef,'Nombre exjefe',1,100) == false){
       $('#nomRef').focus();
      return false; 
    } 
    else if (validar_input_txt(txtpuestoRef,'Puesto',1,100) == false){
      $('#puestoRef').focus();
      return false; 
    }          
    //Validando Periodo 
    else if(intmesI == 0 || intanioI == 0 || intmesF == 0 || intanioF == 0)
    {
        $('#resultado').text('Periodo laboral no Valido');  
        $('#mesI').focus();
        return false;
    }
    else if (fecPerI > fecPerF){
      $('#resultado').text('Error periodo, fecha final no puede ser menor que fecha inicial');  
      $('#mesI').focus();
      return false;
    }
    else if (intsueldoRef == ''){
      $('#resultado').text('Favor de capturar sueldo');  
      $('#sueldoRef').focus();
      return false; 
    }
    else if (validar_input_txt(txtmotivoRef,'Motivo de salida',0,200) == false){
      $('#motivoRef').focus();
      return false; 
    }   
    else if (validar_input_txt(txtultPstRef,'Ultimo puesto',1,200) == false){
      $('#ultPuestRef').focus();
      return false; 
    }      
    else if(intvolvRef == 0)
    {
        $('#resultado').text('Lo volveria a contratar no valido');  
        $('#volvRef').focus();
        return false;
    }    
    else if (validar_input_txt(txtcomentRef,'Comentarios',0,5000) == false){
      $('#comentRef').focus();
      return false; 
    }
    //Validando Evaluacion    
    else if(!rdorespRef || !rdoasistenciaRef || !rdopuntualidadRef || !rdoactitudRef || 
        !rdocompromisoRef  || !rdohonestidadRef  || !rdorelsupRef  || 
        !rdoiniciativaRef  || !rdolealtadRef  || !rdoapegoRef) 
    {
      $('#resultado').text('Favor de completar la evaluación');  
      $('#respRef').focus();
      return false;
    }      
    //----------------------------------------------------------
    // Termina Validación y se Guarda 
    //----------------------------------------------------------  
    else
    { 
      //GMM001 - Se da Modifica Registro          
      $('#resultado').text('');              
      $.ajax({
        type:'get',
        url:'Ref_accion.php',
        data:
        {
          idCandid:intidCandid,
          numRef:intnumRef,
          accion:'M',               
          empRef: txtempRef,
          nomRef: txtnomRef,
          puestoRef:txtpuestoRef,
          mesI:intmesI,
          anioI:intanioI,
          mesF:intmesF,
          anioF:intanioF,
          sueldoRef:intsueldoRef,
          motivoRef:txtmotivoRef,     
          ultPuestRef:txtultPstRef,  
          volvRef:intvolvRef,
          comentRef:txtcomentRef,
          respRef:rdorespRef,
          asistenciaRef:rdoasistenciaRef,
          puntualidadRef:rdopuntualidadRef,
          actitudRef:rdoactitudRef,
          compromisoRef:rdocompromisoRef,
          honestidadRef:rdohonestidadRef,
          relsupRef:rdorelsupRef,
          iniciativaRef:rdoiniciativaRef,
          lealtadRef:rdolealtadRef,
          apegoRef:rdoapegoRef
        },
        success:function(data)
        {     
          $('#resultado_ok').html(data);     
        },
        error: function(){
          alert('error');
        }
      });
      return false;
    }
  });

  //--------------------------------------------------------
  //ELIMINACION - FISICA
  //--------------------------------------------------------
  $('#eliminar').click(function(){  
    var intidCandid  = $('#idCandid').val();
    var intnumRef    = $('#numRef').val();

    $.ajax({
        type:'get',
        url:'Ref_accion.php',
        data:
        {
          idCandid:intidCandid,
          numRef:intnumRef,
          accion:'E'             
        },
        success:function(data)
        {     
          $('#resultado_ok').html(data);     
        },
        error: function(){
          alert('error');
        }
      });
      return false;
  });
  //--------------------------------------------------------
  //--------------------------------------------------------

});
</script> ";

echo '<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>';
echo"<form id='form'>"; 

//-------------------------------------------------------------
echo "<center>
	<form id='formulario'>
     	<table width='100%' >
  		<tr >
    	<td width='40%'>
      <table>            
        <tr>       
          <td><input type='hidden' id='idCandid' value='".$idCandid."'></td>
          <td><input type='hidden' id='numRef' value='".$numRef."'></td>
          </tr>
        <tr>
				<tr>
        	<td>Empresa:</td>
					<td><input type='text' class='texto'  id='empRef' value='".$txtempRef."' onkeypress='return SoloTextos(event)'></td>
	     		</tr>
	     		<tr>
		    		<td>Nombre exjefe:</td>
					<td><input type='text' class='texto'  id='nomRef' value='".$txtnomRef."' onkeypress='return soloLetras(event)'></td>
	     		</tr>
	     		<tr>
		    		<td>Puesto exjefe:</td>
					<td><input type='text' class='texto'  id='puestoRef' value='".$txtpuestoRef."' onkeypress='return LetrasNumEsp(event)'></td>
	     		</tr>
	     		<tr>
		    		<td>Periodo laboral:</td>					
            <td>
            ";  
                echo "<select name='mesI' id='mesI' class='sel_anio'>";                
                $LibRef= new LibRef;
                $LibRef->ObtNomMes($FPI[1]);                                
                echo"</select>"; 

                echo "<select name='anioI' id='anioI' class='sel_anio'>";
                echo"<option value='".$FPI[0]."'>".$FPI[0]."</option>";
                $val='';
                $LibRef= new LibRef;
                $LibRef->arrayAnio($val);
                echo"</select>";                 
      echo"</td>      
	     		</tr>
          <tr>
            <td align='right'></td>         
            <td>
            ";  
                echo "<select name='mesF' id='mesF' class='sel_anio'>";
                $LibRef= new LibRef;
                $LibRef->ObtNomMes($FPF[1]);               
                echo"</select>"; 

                echo "<select name='anioF' id='anioF' class='sel_anio'>";
                echo"<option value='".$FPF[0]."'>".$FPF[0]."</option>";
                $val='';
                $LibRef= new LibRef;
                $LibRef->arrayAnio($val);
                echo"</select>";                 
      echo"</td>      
          </tr>
	     		<tr>        
	    		<td>Sueldo que percibía:</td>
					<td><input type='text' class='texto'  id='sueldoRef' value='".$intsueldoRef."' onkeypress='return SoloDecimal(event)'></td>
	     		</tr>
	     		<tr>
		    		<td>Motivo de salida:</td>
					<td><input type='text' class='texto'  id='motivoRef' value='".$txtmotivoRef."' onkeypress='return SoloTextos(event)'></td>
	     		</tr>
	     		<tr>
		    		<td>Último Puesto:</td>
					<td><input type='text' class='texto'  id='ultPuestRef' value='".$txtultPstRef."' onkeypress='return LetrasNumEsp(event)'></td>
	     		</tr>
	     		<tr>
		    		<td>¿Lo volvería a contratar?</td>            
            <td>
                <select id='volvRef' class='sel' name='volvRef'>";
                $LibRef= new LibRef;
                $LibRef->ObtvolvRef($intvolvRef);      
                echo"</select>
            </td>
	     		</tr>	     		
			</table>
        </td>
    	<td width='60%'>
            <table cellspacing='5'>
				<caption id='title5'>Evaluar del 1 al 5, donde 5 se considera  excelente y 1 malo
    			</caption>
				<thead>
					<tr>
	    				<th width='35%'>&nbsp;</th>
      					<td width='10%'>Malo</td>
      					<td width='10%'>Regular</td>
      					<td width='10%'>Bueno</td>
      					<td width='10%'>Muy Bueno</td>
      					<td width='10%'>Excelente</td>
    				</tr>
    			</thead>
  				<tbody>    
  					<tr>
  						<th align='right'>Responsabilidad</th>";
                  $LibRef= new LibRef;
                  $LibRef->ObtRdoSel('respRef',$rdorespRef);          					 
      				echo"</tr>
      				<tr>
      					<th align='right'>Asistencia</th>";
                  $LibRef= new LibRef;
                  $LibRef->ObtRdoSel('asistenciaRef',$rdoasistenciaRef);
              echo"</tr>
    				  <tr>
  						  <th align='right'>Puntualidad</th>";
                  $LibRef= new LibRef;
                  $LibRef->ObtRdoSel('puntualidadRef',$rdopuntualidadRef);
              echo"</tr>
      				<tr>
  						  <th align='right'>Actitud con compañeros</th>";
                  $LibRef= new LibRef;
                  $LibRef->ObtRdoSel('actitudRef',$rdoactitudRef);                     
              echo"</tr>
      				<tr>
  						  <th align='right'>Compromiso</th>";
                  $LibRef= new LibRef;
                  $LibRef->ObtRdoSel('compromisoRef',$rdocompromisoRef);
              echo"</tr>
      				<tr>
  						  <th align='right'>Honestidad</th>";
                  $LibRef= new LibRef;
                  $LibRef->ObtRdoSel('honestidadRef',$rdohonestidadRef);
              echo"</tr>
      				<tr>
  						  <th align='right'>Relación con superiores</th>";
                  $LibRef= new LibRef;
                  $LibRef->ObtRdoSel('relsupRef',$rdorelsupRef);
              echo"</tr>
      				<tr>
  						  <th align='right'>Iniciativa</th>";
                  $LibRef= new LibRef;
                  $LibRef->ObtRdoSel('iniciativaRef',$rdoiniciativaRef);
              echo"</tr>
      				<tr>
  						  <th align='right'>Lealtad</th>";
                  $LibRef= new LibRef;
                  $LibRef->ObtRdoSel('lealtadRef',$rdolealtadRef);
              echo"</tr>
      				<tr>
  						  <th align='right'>Apego a políticas y procedimientos</th>";
                  $LibRef= new LibRef;
                  $LibRef->ObtRdoSel('apegoRef',$rdoapegoRef);
              echo"</tr>
  				</tbody>
			</table>            
        </td>
  	</tr>
</table>

<table width='100%'>
	<tr>
		<td>Comentarios acerca del desempeño del Candidato:</td>
	</tr>
	<tr>      
		<td><textArea name='comentRef' id='comentRef' rows='7' cols='80' onkeypress='return SoloTextos(event)'>".$txtcomentRef."</textArea></td>
	</tr> 	
</table>

<table >
	<tr>
		<td><span class='close' id='modif'   >Guardar</span></td>
		<td><span class='close' id='eliminar'>Eliminar</span></td>
		<td><span class='close' id='close'   >Cancelar</span></td>
	</tr>
	<tr>
		<td colspan='2'>
			<center>
			    <div id='resultado' class='resultado'></div>
          <div id='resultado_ok' class='resultado_ok'></div>
			</center>	
		</td>
	</tr>
</table>

</form>

</center>";

//-------------------------------------------------------------
?>


