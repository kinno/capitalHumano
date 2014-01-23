<?php
session_start();
if($_SESSION['rol']==1||$_SESSION['rol']==2)
      $permisosEspeciales=1;
  else
      $permisosEspeciales=0;
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


</script>";
echo "<center>
<fieldset>    
<legend>Información de Usuario</legend>    
<form id='formulario'>
		<table >
			<tr>
				<td >Nombre</td>
				<td ><input type='text' class='texto'  id='NombreUSu' onkeypress='return soloLetras(event)'></td>
			</tr>
			<tr>
				<td >Apellido Paterno</td>
				<td ><input type='text' class='texto'  id='ApPatUSu' onkeypress='return soloLetras(event)'></td>
			</tr>
			<tr>
				<td >Apellido Materno</td>
				<td ><input type='text' class='texto'  id='ApMatUsu' onkeypress='return soloLetras(event)'></td>
			</tr>
			<tr>
				<td >Correo</td>
				<td ><input type='text' class='texto'  id='Correo' onkeypress='return email(event)'></td>
			</tr>
			<tr>
				<td >Rol</td>
				<td >";					
					echo "<select name='rol' id='rol' class='sel'>
					<option value='0'>Selecciona un valor</option>";
					$funciones= new funciones;
					$funciones->combo();
					echo"</select>";					
				echo"</td>
			</tr>
			</table>
			<table>
			<tr>
				<td>
				<span id='btnGuardar' class='close' >Guardar</span>
				</td>
			</tr>
			
		</table>
	</form>
</fieldset>        
        <div id='resultado'></div>
        <div id='error' style='margin-top:10px; width:400px;'></div></center>
        ";
?>