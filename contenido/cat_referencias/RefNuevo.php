<?php
header("Content-Type: text/html;charset=utf-8");
include"../libs/libs.php";
include"libs/libRef.php";

$idCandid=$_GET['idCandid'];

echo"<script>
$(document).ready(function(){

  //----------------------------------------------------------
  //activar, para edición, el primer input del formulario:
  //----------------------------------------------------------    
  //$(':input:first').focus();
  $(function(){
    $('form:not(.filter) :input:visible:enabled:first').focus();
  });

  //----------------------------------------------------------
	$('#close').click(function() {
    $('.overlay-container').fadeOut().end().find('.window-container').removeClass('window-container-visible');
  }); 

	$('#btnGuardar').click(function()
	{

    //----------------------------------------------------------
    // Asignación de variables
    //----------------------------------------------------------
    var intidCandid  = $('#idCandid').val();
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
      //GMM001 - Se da de Alta el Registro              
      $('#resultado').text('');        
      $.ajax({
				type:'get',
				url:'Ref_accion.php',
				data:
				{
          idCandid:intidCandid,
					numRef: 'NULL',
					accion:'N',								
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
});
</script>";

echo "<center>
	<form id='formulario'>
     	<table width='100%' >
      <input type='hidden' id='idCandid' value='".$idCandid."'>
  		<tr >
    	<td width='40%'>
        <table>
				<tr>
        	<td>Empresa:</td>          
					<td><input type='text' class='texto'  id='empRef' onkeypress='return SoloTextos(event)'></td>
	     		</tr>
	     		<tr>
		    		<td>Nombre exjefe:</td>
					<td><input type='text' class='texto'  id='nomRef' onkeypress='return soloLetras(event)'></td>
	     		</tr>
	     		<tr>
		    		<td>Puesto exjefe:</td>
					<td><input type='text' class='texto'  id='puestoRef' onkeypress='return LetrasNumEsp(event)'></td>
	     		</tr>
	     		<tr>
		    		<td>Periodo laboral:</td>					
            <td>
            ";  
                echo "<select name='mesI' id='mesI' class='sel_anio'>
                <option value='0'>M</option>";
                $val='';
                $LibRef= new LibRef;
                $LibRef->arrayMes($val);
                echo"</select>"; 

                echo "<select name='anioI' id='anioI' class='sel_anio'>
                <option value='0'>AA</option>";
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
                echo "<select name='mesF' id='mesF' class='sel_anio'>
                <option value='0'>M</option>";
                $val='';
                $LibRef= new LibRef;
                $LibRef->arrayMes($val);
                echo"</select>"; 

                echo "<select name='anioF' id='anioF' class='sel_anio'>
                <option value='0'>AA</option>";
                $val='';
                $LibRef= new LibRef;
                $LibRef->arrayAnio($val);
                echo"</select>";                 
      echo"</td>      
          </tr>
	     		<tr>
		    		<td>Sueldo que percibía:</td>
					<td><input type='text' class='texto'  id='sueldoRef' onkeypress='return SoloDecimal(event)'></td>
	     		</tr>
	     		<tr>
		    		<td>Motivo de salida:</td>
					<td><input type='text' class='texto'  id='motivoRef' onkeypress='return SoloTextos(event)'></td>
	     		</tr>
	     		<tr>
		    		<td>Último Puesto:</td>
					<td><input type='text' class='texto'  id='ultPuestRef' onkeypress='return LetrasNumEsp(event)'></td>
	     		</tr>
	     		<tr>
		    		<td>¿Lo volvería a contratar?</td>            
            <td>
                <select id='volvRef' class='sel' name='volvRef'>
                <option value='0'>Selecciona</option>
                <option value='1'>Si</option>
                <option value='2'>No</option>
                </select>
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
  						<th align='right'>Responsabilidad</th>
      					<td><input id='respRef_1' name='respRef' type='radio' tabindex='1' value=1>        
      						<label for='respRef_1'>1</label>
      					</td>
      					<td><input id='respRef_2' name='respRef' type='radio' tabindex='2' value=2>
      						<label for='respRef_2'>2</label>
      					</td>
      					<td><input id='respRef_3' name='respRef' type='radio' tabindex='3' value=3 checked='checked'>
      						<label for='respRef_3'>3</label>
      					</td>
      					<td><input id='respRef_4' name='respRef' type='radio' tabindex='4' value=4>
      						<label for='respRef_4'>4</label>
      					</td>
      					<td><input id='respRef_5' name='respRef' type='radio' tabindex='5' value=5>
      						<label for='respRef_5'>5</label>
      					</td>
      				</tr>
      				<tr>
      					<th align='right'>Asistencia</th>
      					<td><input id='asistenciaRef_1' name='asistenciaRef' type='radio' tabindex='1' value=1>        
      						<label for='asistenciaRef_1'>1</label>
      					</td>
      					<td><input id='asistenciaRef_2' name='asistenciaRef' type='radio' tabindex='2' value=2>
      						<label for='asistenciaRef_2'>2</label>
      					</td>
      					<td><input id='asistenciaRef_3' name='asistenciaRef' type='radio' tabindex='3' value=3 checked='checked'>
      						<label for='asistenciaRef_3'>3</label>
      					</td>
      					<td><input id='asistenciaRef_4' name='asistenciaRef' type='radio' tabindex='4' value=4>
      						<label for='asistenciaRef_4'>4</label>
      					</td>
      					<td><input id='asistenciaRef_5' name='asistenciaRef' type='radio' tabindex='5' value=5>
      						<label for='asistenciaRef_5'>5</label>
      					</td>
    				</tr>
    				<tr>
  						<th align='right'>Puntualidad</th>
      					<td><input id='puntualidadRef_1' name='puntualidadRef' type='radio' tabindex='1' value=1>        
      						<label for='puntualidadRef_1'>1</label>
      					</td>
      					<td><input id='puntualidadRef_2' name='puntualidadRef' type='radio' tabindex='2' value=2>
      						<label for='puntualidadRef_2'>2</label>
      					</td>
      					<td><input id='puntualidadRef_3' name='puntualidadRef' type='radio' tabindex='3' value=3 checked='checked'>
      						<label for='puntualidadRef_3'>3</label>
      					</td>
      					<td><input id='puntualidadRef_4' name='puntualidadRef' type='radio' tabindex='4' value=4>
      						<label for='puntualidadRef_4'>4</label>
      					</td>
      					<td><input id='puntualidadRef_5' name='puntualidadRef' type='radio' tabindex='5' value=5>
      						<label for='puntualidadRef_5'>5</label>
      					</td>
      				</tr>
      				<tr>
  						<th align='right'>Actitud con compañeros</th>
      					<td><input id='actitudRef_1' name='actitudRef' type='radio' tabindex='1' value=1>        
      						<label for='actitudRef_1'>1</label>
      					</td>
      					<td><input id='actitudRef_2' name='actitudRef' type='radio' tabindex='2' value=2>
      						<label for='actitudRef_2'>2</label>
      					</td>
      					<td><input id='actitudRef_3' name='actitudRef' type='radio' tabindex='3' value=3 checked='checked'>
      						<label for='actitudRef_3'>3</label>
      					</td>
      					<td><input id='actitudRef_4' name='actitudRef' type='radio' tabindex='4' value=4>
      						<label for='actitudRef_4'>4</label>
      					</td>
      					<td><input id='actitudRef_5' name='actitudRef' type='radio' tabindex='5' value=5>
      						<label for='actitudRef_5'>5</label>
      					</td>
      				</tr>
      				<tr>
  						<th align='right'>Compromiso</th>
      					<td><input id='compromisoRef_1' name='compromisoRef' type='radio' tabindex='1' value=1>        
      						<label for='compromisoRef_1'>1</label>
      					</td>
      					<td><input id='compromisoRef_2' name='compromisoRef' type='radio' tabindex='2' value=2>
      						<label for='compromisoRef_2'>2</label>
      					</td>
      					<td><input id='compromisoRef_3' name='compromisoRef' type='radio' tabindex='3' value=3 checked='checked'>
      						<label for='compromisoRef_3'>3</label>
      					</td>
      					<td><input id='compromisoRef_4' name='compromisoRef' type='radio' tabindex='4' value=4>
      						<label for='compromisoRef_4'>4</label>
      					</td>
      					<td><input id='compromisoRef_5' name='compromisoRef' type='radio' tabindex='5' value=5>
      						<label for='compromisoRef_5'>5</label>
      					</td>
      				</tr>
      				<tr>
  						<th align='right'>Honestidad</th>
      					<td><input id='honestidadRef_1' name='honestidadRef' type='radio' tabindex='1' value=1>        
      						<label for='honestidadRef_1'>1</label>
      					</td>
      					<td><input id='honestidadRef_2' name='honestidadRef' type='radio' tabindex='2' value=2>
      						<label for='honestidadRef_2'>2</label>
      					</td>
      					<td><input id='honestidadRef_3' name='honestidadRef' type='radio' tabindex='3' value=3 checked='checked'>
      						<label for='honestidadRef_3'>3</label>
      					</td>
      					<td><input id='honestidadRef_4' name='honestidadRef' type='radio' tabindex='4' value=4>
      						<label for='honestidadRef_4'>4</label>
      					</td>
      					<td><input id='honestidadRef_5' name='honestidadRef' type='radio' tabindex='5' value=5>
      						<label for='honestidadRef_5'>5</label>
      					</td>
      				</tr>
      				<tr>
  						<th align='right'>Relación con superiores</th>
      					<td><input id='relsupRef_1' name='relsupRef' type='radio' tabindex='1' value=1>        
      						<label for='relsupRef_1'>1</label>
      					</td>
      					<td><input id='relsupRef_2' name='relsupRef' type='radio' tabindex='2' value=2>
      						<label for='relsupRef_2'>2</label>
      					</td>
      					<td><input id='relsupRef_3' name='relsupRef' type='radio' tabindex='3' value=3 checked='checked'>
      						<label for='relsupRef_3'>3</label>
      					</td>
      					<td><input id='relsupRef_4' name='relsupRef' type='radio' tabindex='4' value=4>
      						<label for='relsupRef_4'>4</label>
      					</td>
      					<td><input id='relsupRef_5' name='relsupRef' type='radio' tabindex='5' value=5>
      						<label for='relsupRef_5'>5</label>
      					</td>
      				</tr>
      				<tr>
  						<th align='right'>Iniciativa</th>
      					<td><input id='iniciativaRef_1' name='iniciativaRef' type='radio' tabindex='1' value=1 >        
      						<label for='iniciativaRef_1'>1</label>
      					</td>
      					<td><input id='iniciativaRef_2' name='iniciativaRef' type='radio' tabindex='2' value=2 >
      						<label for='iniciativaRef_2'>2</label>
      					</td>
      					<td><input id='iniciativaRef_3' name='iniciativaRef' type='radio' tabindex='3' value=3 checked='checked'>
      						<label for='iniciativaRef_3'>3</label>
      					</td>
      					<td><input id='iniciativaRef_4' name='iniciativaRef' type='radio' tabindex='4' value=4 >
      						<label for='iniciativaRef_4'>4</label>
      					</td>
      					<td><input id='iniciativaRef_5' name='iniciativaRef' type='radio' tabindex='5' value=5 >
      						<label for='iniciativaRef_5'>5</label>
      					</td>
      				</tr>
      				<tr>
  						<th align='right'>Lealtad</th>
      					<td><input id='lealtadRef_1' name='lealtadRef' type='radio' tabindex='1' value=1 >        
      						<label for='lealtadRef_1'>1</label>
      					</td>
      					<td><input id='lealtadRef_2' name='lealtadRef' type='radio' tabindex='2' value=2 >
      						<label for='lealtadRef_2'>2</label>
      					</td>
      					<td><input id='lealtadRef_3' name='lealtadRef' type='radio' tabindex='3' value=3 checked='checked'>
      						<label for='lealtadRef_3'>3</label>
      					</td>
      					<td><input id='lealtadRef_4' name='lealtadRef' type='radio' tabindex='4' value=4 >
      						<label for='lealtadRef_4'>4</label>
      					</td>
      					<td><input id='lealtadRef_5' name='lealtadRef' type='radio' tabindex='5' value=5 >
      						<label for='lealtadRef_5'>5</label>
      					</td>
      				</tr>
      				<tr>
  						<th align='right'>Apego a políticas y procedimientos</th>
      					<td><input id='apegoRef_1' name='apegoRef' type='radio' tabindex='1' value=1 >        
      						<label for='apegoRef_1'>1</label>
      					</td>
      					<td><input id='apegoRef_2' name='apegoRef' type='radio' tabindex='2' value=2 >
      						<label for='apegoRef_2'>2</label>
      					</td>
      					<td><input id='apegoRef_3' name='apegoRef' type='radio' tabindex='3' value=3 checked='checked'>
      						<label for='apegoRef_3'>3</label>
      					</td>
      					<td><input id='apegoRef_4' name='apegoRef' type='radio' tabindex='4' value=4 >
      						<label for='apegoRef_4'>4</label>
      					</td>
      					<td><input id='apegoRef_5' name='apegoRef' type='radio' tabindex='5' value=5 >
      						<label for='apegoRef_5'>5</label>
      					</td>
      				</tr>
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
		<td><textArea name='comentRef' id='comentRef' class='textarea' rows='7' cols='80' onkeypress='return SoloTextos(event)'></textArea></td>
	</tr> 	
</table>

<table >
  <tr>
    <td colspan='2'>
      <center>
          <div id='resultado' class='resultado'></div>
          <div id='resultado_ok' class='resultado_ok'></div>
      </center> 
    </td>
  </tr>
	<tr>
		<td>
			<span id='btnGuardar' class='close' >Guardar</span>
		</td>
		<td>
			<span class='close' id='close' >Cancelar</span>
		</td>
	</tr>	
</table>

</form>

</center>";
?>
