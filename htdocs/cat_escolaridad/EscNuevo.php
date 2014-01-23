<?php
header("Content-Type: text/html;charset=utf-8");
include"../libs/libs.php";

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

	//----------------------------------------------------------	
	$('#btnGuardar').click(function()
	{
		var txtEscolar= $('#nomEscolar').val();
		//alert(txtEscolar);
			
		if (validar_input_txt(txtEscolar,'Escolaridad',1,100) == false){
       		$('#nomEscolar').focus();
      		return false; 
    	}		
		else
		{
			//GMM001 - Se da de Alta el Registro				
			$.ajax({
				type:'get',
				url:'acciones.php',
				data:
				{
					ids: 'NULL',
					accion:'N',								
					nomEscolar: txtEscolar					
				},
				success:function(data)
				{			
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
</script>";

echo "
   <div style='margin-top:20px;'> 
    <center>
	<form id='formulario'>
		<table >
			<tr>
				<td>Escolaridad</td>
				<td><input type='text' class='texto'  id='nomEscolar' onkeypress='return LetrasNumEsp(event)'></td>
			</tr>		
			<tr>
				<td>
					<button id='btnGuardar' class='close' >Guardar</button>
				</td>
			</tr>
			<tr>
				<td colspan='2'>
				<center>
					<div id='resultado'></div>
				</center>	
				</td>

			</tr>
		</table>
	</form>
</center>
</div>";
?>