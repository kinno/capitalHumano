<?php
header("Content-Type: text/html;charset=utf-8");
include"../libs/libs.php";

echo"<script>
$(document).ready(function(){
	$('#close').click(function() {
             $('.overlay-container').fadeOut().end().find('.window-container').removeClass('window-container-visible');
            });

	$('#btnGuardar').click(function()
	{
		var txtEscolar= $('#nomEscolar').val();
		//alert(txtEscolar);
			
		//GMM001 - Se valida Escolaridad
		if(txtEscolar=='')
		{
			$('#resultado').text('Escolaridad se encuentra vacio').addClass('msg_error');  
			$('#nomEscolar').focus();
			return false;  
		}
		else if(txtEscolar.length < 3)
		{
			$('#resultado').text('Escolaridad no valido');  
			$('#nomEscolar').focus();
			return false;  
		}
		else if(txtEscolar.length > 100)
		{
			$('#resultado').text('Escolaridad exede el numero de caracteres permitidos');  
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

echo "<center>
	<form id='formulario'>
		<table >
			<tr>
				<td>Escolaridad</td>
				<td><input type='text' class='texto'  id='nomEscolar' onkeypress='return LetrasNumEsp(event)'></td>
			</tr>		
			<tr>
				<td>
					<span id='btnGuardar' class='close' >Guardar</span>
				</td>
				<td>
					<span class='close' id='close' >Cancelar</span>
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
</center>";
?>