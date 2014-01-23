<?php
include"../libs/libs.php";
$funciones= new funciones; //CREA UN NUEVO OBJETO DE LA CLASE FUNCIONES
$funciones->conectar(); //EJECUTA EL MÉTODO CONECTARSE 
$sqlB="select * from tblreclut where idReclut=".$_GET['ids']; //HACE UNA CONSULTA A LA TABLA  
$queryB=mysql_query($sqlB) or die(mysql_error()); //EJECUTA LA CONSULTA

$ltxtNombre=mb_convert_encoding(mysql_result($queryB,0,'nomReclut'), "UTF-8");//EXTRAE CADA UNO DE LOS CAMPOS DE LA CONSULTA 
$ltxtApPat=mb_convert_encoding(mysql_result($queryB,0,'appReclut'), "UTF-8");
$ltxtapMat=mb_convert_encoding(mysql_result($queryB,0, 'apmReclut'), "UTF-8");

echo"
<script> 
$(document).ready(function(){
	$('#close').click(function() {
             $('.overlay-container').fadeOut().end().find('.window-container').removeClass('window-container-visible');
            });
	$('#eliminar').click(function(){  //si da clic en eliminar se manda el id a eliminar y la acción por medio de ajax

		var lintIdUsu=$('#idT').val();

		$.ajax(
			{
				type:'get',
				url:'acciones.php',
				data:{
					ids:lintIdUsu,
					accion:'E' //E es de eliminar

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

   	var lintIdUsu=$('#idT').val(),
   		ltxtNombre=$('#nombreReclut').val(),
   		ltxtApPat=$('#appReclut').val(),
   		ltxtApMat=$('#apmReclut').val();
   		if(ltxtNombre=='')
   		{
   			$('#res').text('Verifica el nombre se encuentra Vacio'); //
   			$('#nombreReclut').focus();
   			return false;


   		}
   		else if(ltxtNombre.length < 3)
			{
				$('#res').text('Nombre debe tener minimo 3 Caracteres');  
				$('#nombreReclut').focus();
   				return false;

			}
		else if(ltxtNombre.length > 50)
			{
				$('#res').text('Nombre excede el numero de caracteres permitidos');  
				$('#nombreReclut').focus();
				return false; 

			}
		else if(ltxtApPat=='')
			{
				$('#res').text('Apellido Paterno se encuentra Vacio');  
				$('#appReclut').focus();
				return false;  

			}
		else if(ltxtApPat.length < 3)
			{
				$('#res').text('Apellido Paterno se encuentra Vacio');  
				$('#appReclut').focus();
				return false;  

			}
			else if(ltxtApPat.length > 50)
			{
				$('#res').text('Apellido Paterno exede el numero de caracteres permitidos');  
				$('#appReclut').focus();
				return false; 

			}
			else if(ltxtApMat=='')
			{
				$('#res').text('Apellido Materno se encuentra Vacio');  
				$('#apmReclut').focus();
				return false;  

			}
			else if(ltxtApMat.length < 3)
			{
				$('#res').text('Apellido Materno se encuentra Vacio');  
				$('#apmReclut').focus();
				return false;  

			}
			else if(ltxtApMat.length > 50)
			{
				$('#res').text('Apellido Materno excede el numero de caracteres permitidos');  
				$('#apmReclut').focus();
				return false; 

			}


		else{
				$.ajax( //por medio de ajax le envia los datos a acciones.php
					{
						type:'get',
						url:'acciones.php',
						data:{
							ids:lintIdUsu,
							accion:'M',
							nomReclut:ltxtNombre,  //LO RECIBE ACCIONES.PHP POR MEDIO DE GET
							appReclut:ltxtApPat,   //LO RECIBE ACCIONES.PHP POR MEDIO DE GET
							apmReclut:ltxtApMat    //LO RECIBE ACCIONES.PHP POR MEDIO DE GET
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
</script> 
";
echo"<form id='form'>"; //Este es el formulario que se muestra para la modificaciones o eliminaciones
echo"<center>
<table >";
	echo"<tr>
		<td colspan='2'>Nombre</td>
		<td><input type='hidden' id='idT' value='".$_GET['ids']."'>
		<input type='text' name='nombreReclut' id='nombreReclut' class='texto' value='".$ltxtNombre."' onkeypress='return soloLetras(event)'>
		</td>
	</tr>";
	echo"<tr>
		<td colspan='2'>Apellido Paterno</td>
		<td>
		<input type='text' name='appReclut' id='appReclut' class='texto' value='".$ltxtApPat."' onkeypress='return soloLetras(event)'>
		</td>
	</tr>";
	echo"<tr>
		<td colspan='2'>Apellido Materno</td>
		<td>
		<input type='text' name='apmReclut' id='apmReclut' class='texto' value='".$ltxtapMat."' onkeypress='return soloLetras(event)'>
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