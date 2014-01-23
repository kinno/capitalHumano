<?php
include"../libs/libs.php";
$funciones= new funciones; 
$funciones->conectar(); 
$sqlB="SELECT * FROM tblproyecto WHERE idProyecto=".$_GET['ids']; 				//GMM001 - Modificar Consulta
$queryB=mysql_query($sqlB) or die(mysql_error()); 
$ltxtnomProy=mb_convert_encoding(mysql_result($queryB,0,'nomProyecto'), "UTF-8");	//GMM001 - Modificar Campo

echo"
<script type='text/javascript' src='../js/libs.js'></script>
<script> 
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
$('#eliminar').click(function(){  
	//Variables que se van a enviar
	var intProyecto=$('#ids').val();
	//alert(intProyecto);
	$.ajax(
	{
		type:'get',
		url:'acciones.php',
		data:{
			ids:intProyecto,
			accion:'E' 
		},
		success:function(data){
		$('#resultado').html(data);
	},
		error:function(){
		alert('error');
	}

	});
	return false;
});

$('#modif').click(function(){  //Si se da clic en modificar se manda las modificaciones .val() supongo que es para validar 
       
	var intProyecto=$('#ids').val();
   	var txtProyecto= $('#nomProyecto').val();
   	//alert(txtProyecto);

   	//GMM001 - Se valida nombre Proyecto
	if (validar_input_txt(txtProyecto,'Proyecto',1,100) == false){
		$('#nomProyecto').focus();
      	return false; 
    }		
	else{
		$.ajax( //por medio de ajax le envia los datos a acciones.php
		{
			type:'get',
			url:'acciones.php',
			data:{				
				ids:intProyecto,
				accion:'M',   
				nomProyecto:txtProyecto  							
			},
			success:function(data){
				$('#resultado').html(data);
			},
			error:function(){
				alert('error');
			}
		});
		return false;
	}	
});

});

</script> ";
echo '<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>';
echo"<form id='form'>"; //Este es el formulario que se muestra para la modificaciones o eliminaciones
echo"<center>
<table >";
	echo"<tr>
		<td colspan='2'>Proyecto</td>
		<td><input type='hidden' id='ids' value='".$_GET['ids']."'>
		<input type='text' name='nomProyecto' id='nomProyecto' class='texto' value='".$ltxtnomProy."' onkeypress='return LetrasNumEsp(event)'>
		</td>
	</tr>";
echo"</table>";
echo"</form>";
echo"<tr><td colspan='3' ><div id='resultado'></div></td></tr>";
echo"<table>";
echo"<tr><td><span class='close' id='modif'>Guardar</span></td><td><span class='close' id='eliminar'>Eliminar</span></td><td><span class='close' id='close'>Cancelar</span></td></tr>";
echo"</table>
</center>";

?>