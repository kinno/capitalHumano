<?php
include"libs/libs.php";
$funciones= new funciones; 
$funciones->conectar(); 
//GMM001 - Se busca registro seleccionado
$sqlB="select * from codigo_postal where cp=".$_GET['idcp']." and id_colonia=".$_GET['idc'];
$queryB=mysql_query($sqlB) or die(mysql_error()); 
//GMM001 Se extraen datos de la consulta
$txtColonia=mb_convert_encoding(mysql_result($queryB,0,'nombre_colonia'), "UTF-8");

echo"
<script> 
$(document).ready(function(){
$('#close').click(function() {
             $('.overlay-container').fadeOut().end().find('.window-container').removeClass('window-container-visible');  //REGRSA A LA PANTALLA DONDE SE MUESTRA EL CATÁLOGO
            });
            
$('#eliminar').click(function(){  //si da clic en eliminar se manda el id a eliminar y la acción por medio de ajax
	//Varuables que se van a enviar
	var txtCP=$('#idcp').val();
	var intCol=$('#idc').val();

	$.ajax(
	{
		type:'get',
		url:'acciones.php',
		data:{
			cp:txtCP, 
			ids:intCol,
			accion:'E' 
		},
		success:function(data){
		$('#res').html(data);
	},
		error:function(){
		alert('error');
	}

	});
	return false;


	});
   $('#modif').click(function(){  //Si se da clic en modificar se manda las modificaciones .val() supongo que es para validar 
       
   		var txtCP=$('#idcp').val();
   		var intCol=$('#idc').val();
   		var txtColonia= $('#nomcolonia').val();

   		//GMM001 - Se valida nombre de la Colonia
		if(txtColonia=='')
		{
			$('#resultado').text('Nombre de colonia se encuentra vacio').addClass('msg_error');  
			$('#nomcolonia').focus();
			return false;  
		}
		else if(txtColonia.length < 3)
		{
			$('#resultado').text('Nombre no valido');  
			$('#nomcolonia').focus();
			return false;  
		}
		else if(txtColonia.length > 200)
		{
			$('#resultado').text('Colonia exede el numero de caracteres permitidos');  
			$('#nomcolonia').focus();
			return false; 
		}
		else{
			$.ajax( //por medio de ajax le envia los datos a acciones.php
			{
				type:'get',
				url:'acciones.php',
				data:{
					cp:txtCP, 
					ids:intCol,
					accion:'M',   
					nomcolonia:txtColonia  							
				},
				success:function(data){
					$('#res').html(data);
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
		<td colspan='2'>Nombre Colonia</td>
		<td><input type='hidden' id='idcp' value='".$_GET['idcp']."'>
		<td><input type='hidden' id='idc' value='".$_GET['idc']."'>
		<input type='text' name='nomcolonia' id='nomcolonia' class='texto' value='".$txtColonia."' onkeypress='return LetrasNumEsp(event)'>
		</td>
	</tr>";
echo"</table>";
echo"</form>";
echo"<tr><td colspan='3' ><div id='res'></div></td></tr>";
echo"<table>";
echo"<tr><td><span class='close' id='modif'>Guardar</span></td><td><span class='close' id='eliminar'>Eliminar</span></td><td><span class='close' id='close'>Cancelar</span></td></tr>";
echo"</table>
</center>";

?>