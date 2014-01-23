<?php
header("Content-Type: text/html;charset=utf-8");
include"../libs/libs.php";
$funciones= new funciones; 
$funciones->conectar(); 
$sqlB="select * from tblescolar where idEscolar=".$_GET['ids']; 				//GMM001 - Modificar Consulta
$queryB=mysql_query($sqlB) or die(mysql_error()); 
$ltxtEsc=  mysql_fetch_array($queryB);	//GMM001 - Modificar Campo

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
		$('#resultado').html(data);
	},
		error:function(){
		alert('error');
	}

	});
	return false;
});

$('#modif').click(function(){  
       
	var intEscolar=$('#ids').val();
   	var txtEscolar= $('#nomEscolar').val();
   	//alert(txtEscolar);

   	//GMM001 - Se valida nombre de la Escolaridad
	if (validar_input_txt(txtEscolar,'Escolaridad',1,100) == false){
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
echo"
<div style='margin-top:10px;'>    
    <form id='form'>"; //Este es el formulario que se muestra para la modificaciones o eliminaciones
echo"<center>
<table >";
	echo"<tr>
		<td colspan='2'>Escolaridad</td>
		<td><input type='hidden' id='ids' value='".$_GET['ids']."'>
		<input type='text' style='width:280px;' name='nomEscolar' id='nomEscolar' class='texto' value='".$ltxtEsc[1]."' onkeypress='return LetrasNumEsp(event)'>
		</td>
	</tr>";
echo"</table>";
echo"</form>";
echo"<tr><td colspan='3' ><div id='resultado'></div></td></tr>";
echo"<table>";
echo"<tr><td><span class='close' id='modif'>Guardar</span></td><td><span class='close' id='eliminar'>Eliminar</span></td></tr>";
echo"</table>
</center>
</div>";

?>