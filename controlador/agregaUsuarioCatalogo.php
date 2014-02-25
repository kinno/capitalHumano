<?php
include"../libs/libs.php";
/*echo"<script>
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

		var ltxtNomUsu= $('#NombreUSu').val();
		var ltxtApPatU= $('#ApPatUSu').val();
		var ltxtApMatU= $('#ApMatUsu').val();
		var ltxtCorUsu= $('#Correo').val();
		var lintRolUsu= $('#rol').val();

		if (validar_input_txt(ltxtNomUsu,'Nombre',1,50) == false){
       		$('#NombreUSu').focus();
      		return false; 
    	}		
    	else if (validar_input_txt(ltxtApPatU,'Apellido Paterno',1,50) == false){
       		$('#ApPatUSu').focus();
      		return false; 
    	}		
    	else if (validar_input_txt(ltxtApMatU,'Apellido Materno',1,50) == false){
       		$('#ApMatUsu').focus();
      		return false; 
    	}		
    	else if (validar_input_txt(ltxtCorUsu,'Correo',1,50) == false){
       		$('#Correo').focus();
      		return false; 
    	}	
		else if(Validacorreo($('#Correo').val()) == false)
    	{
        	$('#resultado').text('Verifica el Correo no cumple con la estructura');
        	$('#Correo').focus();
        	return false;
    	}
    	else if(lintRolUsu==0)
		{
			$('#resultado').text('Selecciona el Rol');  
			$('#rol').focus();
			return false; 
		}
		else
		{
			$.ajax({
			type:'get',
			url:'acciones.php',
			data:
				{
					ids: 'NULL',
					accion:'N',
					nombre: ltxtNomUsu,
					apPat: ltxtApPatU,
					apMat: ltxtApMatU,
					correo: ltxtCorUsu,
					rol:lintRolUsu
				},
				success:function(data){			
					$('#resultado').html(data);     
				},
				error: function()
				{
					alert('error');
				}
			});
  
  			return false;
		}		
	});     

});


</script>";*/
echo "
<center>  
<fieldset class='ui-widget-content'>    
<legend>Información de Usuario</legend>    
<form id='formulario'>
		<table class='ui-widget'>
			<tr>
				<td >Nombre</td>
				<td ><input type='text' id='nomUsuario' name='nomUsuario' ></td>
			</tr>
			<tr>
				<td >Apellido Paterno</td>
				<td ><input type='text' id='appUsuario' name='appUsuario'></td>
			</tr>
			<tr>
				<td >Apellido Materno</td>
				<td ><input type='text' id='apmUsuario' name='apmUsuario' ></td>
			</tr>
			<tr>
				<td >Correo</td>
				<td ><input type='text' id='mailUsuario' name='mailUsuario'></td>
			</tr>
			<tr>
				<td >Password</td>
				<td ><input type='password' id='pwdUsuario' name='pwdUsuario'></td>
			</tr>
			<tr>
				<td >Rol</td>
				<td >";					
					echo "<select name='rol' id='rol'>
					<option value='0'>Selecciona un valor</option>";
					$funciones= new funciones;
					$funciones->combo();
					echo"</select>";					
				echo"</td>
			</tr>
                        <tr>
				<td>
				<span id='btnGuardar' onclick='registrarUsuario();'>Guardar</span>
				</td>
				<td>
				<span id='btnCancel' onclick='cancelarUsuario();'>Cancelar</span>
				</td>
			</tr>
			</table>
	</form>
</fieldset>
</center>
        ";
?>