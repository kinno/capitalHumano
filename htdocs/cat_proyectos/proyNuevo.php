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
		var txtProyecto= $('#nomProyecto').val();
		//alert(txtProyecto);
			
		//GMM001 - Se valida Proyecto
		if (validar_input_txt(txtProyecto,'Proyecto',1,100) == false){
       		$('#nomProyecto').focus();
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
					nomProyecto: txtProyecto					
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
				<td>Proyecto</td>
				<td ><input type='text' class='texto'  id='nomProyecto' onkeypress='return LetrasNumEsp(event)'></td>
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