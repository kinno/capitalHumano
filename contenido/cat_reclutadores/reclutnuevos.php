<?php
include"../libs/libs.php";
echo"<script>
$(document).ready(function(){
	$('#close').click(function() {  //CUANDO SE DE CLIC EN EL BOTÓN AGREGAR DE EEJCUTA ESTE SCRITP
             $('.overlay-container').fadeOut().end().find('.window-container').removeClass('window-container-visible');
            });

	$('#btnGuardar').click(function()  //CUANDO SE DE CLIC EN EL BOTÓN GUARDAR 
	{
		
		        var ltxtNomReclut= $('#NombreReclut').val();            //SE GUARDAN LOS DATOS QUE ESTAN EN EL FORMULARIO
                        var ltxtAppReclut= $('#AppReclut').val();
			var ltxtApmReclut= $('#ApmReclut').val();
			if(ltxtNomReclut =='')   //SE VALIDAN LOS DATOS DEL FORMULARIO
			{
				$('#resultado').text('Nombre se encuentra Vacio');
				  
			
				$('#NombreReclut').focus();
				return false;  

			}
			else if(ltxtNomReclut.length < 3)
			{
				$('#resultado').text('Nombre debe tener minimo 3 Caracteres');  
			
				$('#NombreReclut').focus();
				return false; 

			}
			else if(ltxtNomReclut.length > 50)
			{
				$('#resultado').text('Nombre excede el numero de caracteres permitidos');  
			
				$('#NombreReclut').focus();
				return false; 

			}
			else if(ltxtAppReclut=='')
			{
				$('#resultado').text('Apellido Paterno se encuentra Vacio').addClass('msg_error');  
			
				$('#AppReclut').focus();
				return false;  

			}
			else if(ltxtAppReclut.length < 3)
			{
				$('#resultado').text('Apellido Paterno se encuentra Vacio');  
			
				$('#AppReclut').focus();
				return false;  

			}
			else if(ltxtAppReclut.length > 50)
			{
				$('#resultado').text('Apellido Paterno excede el numero de caracteres permitidos');  
			
				$('#NombreReclut').focus();
				return false; 

			}
			else if(ltxtApmReclut=='')
			{
				$('#resultado').text('Apellido Materno se encuentra Vacio');  
			
				$('#ApmReclut').focus();
				return false;  

			}
			else if(ltxtApmReclut < 3)
			{
				$('#resultado').text('Apellido Materno se encuentra Vacio');  
			
				$('#ApmReclut').focus();
				return false;  

			}
			else if(ltxtApmReclut.length > 50)
			{
				$('#resultado').text('Apellido Materno excede el numero de caracteres permitidos');  
			
				$('#ApmReclut').focus();
				return false; 

			}
			else
			{    //SI NO ENTRO A NINGUN IF ENTONCES MANDA LOS DATOS AL ARCHIVO ACCIONES.PHP CON AJAX JUNTO CON LA ACCION
			$.ajax({
			type:'get',
			url:'acciones.php',
			data:
			{
				ids: 'NULL',  
				accion:'N',  //LA ACCION N ES PARA NUEVO ENTONCES ENTRA A LA FUNCIÓN NUEVO EN ACCIONES.PHP
				nombre: ltxtNomReclut,
				apPat: ltxtAppReclut,
				apMat: ltxtApmReclut
				
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


</script>";  //SE CREA EL FORMULARIO PARA INGRESAR LOS DATOS NUEVOS
echo "<center>
<form id='formulario'>
		<table >
			<tr>
				<td>Nombre</td>
				<td><input type='text' class='texto'  id='NombreReclut' onkeypress='return soloLetras(event)'></td>
			</tr>
			<tr>
				<td>Apellido Paterno</td>
				<td><input type='text' class='texto'  id='AppReclut' onkeypress='return soloLetras(event)'></td>
			</tr>
			<tr>
				<td>Apellido Materno</td>
				<td><input type='text' class='texto'  id='ApmReclut' onkeypress='return soloLetras(event)'></td>
			</tr>
                        <tr>
				<td colspan='2'>
				<center>
					<div id='resultado'></div>
				</center>	
				</td>

			</tr>
                        </table>
                        <table>
			<tr>
				<td>
				<span id='btnGuardar' class='close' >Guardar</span>
				</td>
				<td>
				<td><span class='close' id='close' >Cancelar</span>
				</td>
			</tr>
			
		</table>
	</form></center>";
?>