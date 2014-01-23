<?php
include"../libs/libs.php";
echo"<script>
$(document).ready(function(){

	//----------------------------------------------------------
  	//activar, para edici�n, el primer input del formulario:
  	//----------------------------------------------------------    
  	//$(':input:first').focus();
  	$(function(){
    	$('form:not(.filter) :input:visible:enabled:first').focus();
  	});

  	//----------------------------------------------------------
	$('#close').click(function() {
    	$('.overlay-container').fadeOut().end().find('.window-container').removeClass('window-container-visible');
  	}); 

	//----------------------------------------------------------	
	$('#btnGuardar').click(function()  //CUANDO SE DE CLIC EN EL BOT�N GUARDAR 
	{
		var ltxtDocumento= $('#documento').val();            		
		if (validar_input_txt(ltxtDocumento,'Documento',1,100) == false){
       		$('#documento').focus();
      		return false; 
    	}		
		else
		{   			
            $.ajax({
				type:'get',
				url:'acciones.php',
				data:
				{
					ids: 'NULL',  // LE MANDAMOS NULO POR QUE ESTE CAMPOS ES A-I EN LA BASE DE DATOS
					accion:'N',  //LA ACCION N ES PARA NUEVO ENTONCES ENTRA A LA FUNCI�N NUEVO EN ACCIONES.PHP
					documento: ltxtDocumento,								
				},
				success:function(data){
					$('#resultado').html(data);     
				},
				error: function(){
					alert('error');
				}
			});  
  		return false;
		}		
			
	});    

});


</script>";  //SE CREA EL FORMULARIO PARA INGRESAR LOS DATOS NUEVOS
echo '<head><meta charset="utf-8" /></head>';
echo "
<div style='margin-top:20px;'>
<center>
<form id='formulario'>
		<table >
			<tr>
				<td class='header'>Descripci&oacute;n del Documento</td>
				<td class='content'><input type='text' class='texto'  id='documento' onkeypress='return soloLetras(event)'></td>
			</tr>
                        </table>
			<tr>
                        <table>
				<td>
				<button id='btnGuardar' class='close' >Guardar</button>
				</td>
			</tr>
			
		</table>
                <div id='res'></div>
                <div id='error' style='margin-top:10px; width:400px;'>
                    </div>
</form>
</center>
</div>        ";
?>