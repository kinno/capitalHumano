<?php
include"../libs/libs.php";
$funciones= new funciones; 
$funciones->conectar(); 
$sqlB="select * from tblescolar where idEscolar=".$_GET['ids']; 				//GMM001 - Modificar Consulta
$queryB=mysql_query($sqlB) or die(mysql_error()); 
$ltxtEsc=mb_convert_encoding(mysql_result($queryB,0,'nomEscolar'), "UTF-8");	//GMM001 - Modificar Campo


echo"
<script> 
$(document).ready(function(){
	$('#close').click(function() {
    	$('.overlay-container').fadeOut().end().find('.window-container').removeClass('window-container-visible');  
    });
            
$('#eliminar').click(function(){  
	//Variables que se van a enviar
	var intEscolar=$('#ids').val();
	//alert(intEscolar);
	$.ajax(
	{
		type:'get',
		url:'acciones.php',
		data:{
			ids:intEscolar,
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
       
	var intEscolar=$('#ids').val();
   	var txtEscolar= $('#nomEscolar').val();
   	//alert(txtEscolar);

   	//GMM001 - Se valida nombre de la Escolaridad
	if(txtEscolar=='')
	{
		$('#resultado').text('Escolaridad se encuentra vacio').addClass('msg_error');  
		$('#nomEscolar').focus();
		return false;  
	}
	else if(txtEscolar.length < 3)
	{
		$('#resultado').text('Escolaridad no valida');  
		$('#nomEscolar').focus();
		return false;  
	}
	else if(txtEscolar.length > 100)
	{
		$('#resultado').text('Escolaridad exede el numero de caracteres permitidos');  
		$('#nomEscolar').focus();
		return false; 
	}
	else{
		$.ajax( //por medio de ajax le envia los datos a acciones.php
		{
			type:'get',
			url:'acciones.php',
			data:{				
				ids:intEscolar,
				accion:'M',   
				nomEscolar:txtEscolar  							
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
		<td colspan='2'>Escolaridad</td>
		<td><input type='hidden' id='ids' value='".$_GET['ids']."'>
		<input type='text' name='nomEscolar' id='nomEscolar' class='texto' value='".$ltxtEsc."' onkeypress='return LetrasNumEsp(event)'>
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