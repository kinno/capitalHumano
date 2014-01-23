<?php
header("Content-Type: text/html;charset=utf-8");
include"../libs/libs.php";
$funciones= new funciones; //CREA UN NUEVO OBJETO DE LA CLASE FUNCIONES
$funciones->conectar(); //EJECUTA EL MÉTODO CONECTARSE 
$sqlB="select * from tbldocumento where idDocumento=".$_GET['ids']; //HACE UNA CONSULTA A LA TABLA  
$queryB=mysql_query($sqlB) or die(mysql_error()); //EJECUTA LA CONSULTA
//EXTRAE CADA UNO DE LOS CAMPOS DE LA CONSULTA 
$ltxtDoc= mysql_fetch_array($queryB);


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
	$('#eliminar').click(function(){  //si da clic en eliminar se manda el id a eliminar y la acción por medio de ajax

		var lintIdUsu=$('#idT').val();

		$.ajax(
			{
				type:'get',
				url:'acciones.php',
				data:{
					ids:lintIdUsu, //manda el campo id del registro que se esta usando
					accion:'E' //E es de eliminar

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
       
   		var lintIdUsu=$('#idT').val(),
   	 		ltxtDoc=$('#documento').val();   

   		if (validar_input_txt(ltxtDoc,'Documento',1,100) == false){
       		$('#documento').focus();
      		return false; 
    	}				
		else{
				$.ajax( //por medio de ajax le envia los datos a acciones.php
					{
						type:'get',
						url:'acciones.php',
						data:{
							ids:lintIdUsu,   //campo id de registro que se esta usando
							accion:'M',
							documento:ltxtDoc  //LO RECIBE ACCIONES.PHP POR MEDIO DE GET
							
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
echo '<head><meta charset="utf-8" /></head>';
echo"<form id='form'>"; //Este es el formulario que se muestra para la modificaciones o eliminaciones
echo"<center>
<table >";
	echo"<tr>
		<td colspan='2'>Documento</td>
		<td><input type='hidden' id='idT' value='".$_GET['ids']."'>
		<input type='text' name='documento' id='documento' class='texto' value='".$ltxtDoc[1]."' onkeypress='return soloLetras(event)'>
		</td>
	</tr>";
echo"</table>";
echo"</form>";
echo"<tr><td colspan='3' ><div id='resultado'></div></td></tr>";
echo"<table>";
echo"<tr><td><span class='close' id='modif'>Guardar</span></td><td><span class='close' id='eliminar'>Eliminar</span></td></tr>";
echo"</table>
</center>";

?>