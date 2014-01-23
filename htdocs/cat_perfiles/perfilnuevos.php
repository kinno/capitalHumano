<?php
include"../libs/libs.php";

echo"<script>
$(document).ready(function(){
	$('#close').click(function() {  //CUANDO SE DE CLIC EN EL BOT�N AGREGAR DE EEJCUTA ESTE SCRITP
             $('.overlay-container').fadeOut().end().find('.window-container').removeClass('window-container-visible');
            });

	$('#btnGuardar').click(function()  //CUANDO SE DE CLIC EN EL BOT�N GUARDAR 
	{
		
		var ltxtDesc= $('#descPerfil').val(), //GUARDAMOS LOS DATOS DEL FORMULARIO
   		ltxtPerfil = $('#perfilPerfil').val(),
   		ltxtComp = $('#compPerfil').val(),
                ltxtFunc = $('#funcPerfil').val(),
                ltxtHab = $('#habPerfil').val(),
                ltxtConoc = $('#conocPerfil').val();
   		if(ltxtDesc=='')
   		{
                        $('#error').addClass('ui-state-error ui-corner-all');
   			$('#error').html('<span class=\'ui-icon ui-icon-alert\' style=\'float:left;\'></span>La descripción del perfil se encuentra vacía'); 
   			$('#descPerfil').focus();
   			return false;
   		}
   		else if(ltxtDesc.length < 3)
			{
                                $('#error').addClass('ui-state-error ui-corner-all');
                                $('#error').html('<span class=\'ui-icon ui-icon-alert\' style=\'float:left;\'></span>La descripción debe tener minimo 3 Caracteres');
				$('#descPerfil').focus();
   				return false;

			}
		else if(ltxtDesc.length > 200)
			{
                                
				$('#error').addClass('ui-state-error ui-corner-all');
                                $('#error').html('<span class=\'ui-icon ui-icon-alert\' style=\'float:left;\'></span>La descripción del perfil excede el número de caracteres permitidos');  
				$('#descPerfil').focus();
				return false; 

			}
		else if(ltxtPerfil=='')
			{
                               
				$('#error').addClass('ui-state-error ui-corner-all');
                                $('#error').html('<span class=\'ui-icon ui-icon-alert\' style=\'float:left;\'></span>El perfil se ecuentra vacío');  
				$('#perfilPerfil').focus();
				return false;  

			}
		else if(ltxtComp.length >1)
			{
                               
				$('#error').addClass('ui-state-error ui-corner-all');
                                $('#error').html('<span class=\'ui-icon ui-icon-alert\' style=\'float:left;\'></span>La complejidad del perfil debe de estar entre 1 y 5');  
				$('#compPerfil').focus();
				return false;  

			}
		else if(ltxtComp=='')
			{
                                
				$('#error').addClass('ui-state-error ui-corner-all');
                                $('#error').html('<span class=\'ui-icon ui-icon-alert\' style=\'float:left;\'></span>La complejidad del perfil esta vacio');  
				$('#compPerfil').focus();
				return false; 

			}
		else if(ltxtFunc=='')
			{
                                
				$('#error').addClass('ui-state-error ui-corner-all');
                                $('#error').html('<span class=\'ui-icon ui-icon-alert\' style=\'float:left;\'></span>Información requerida en Funciones');  
				$('#funcPerfil').focus();
				return false;  

			}
		else if(ltxtHab=='')
			{
                                
				$('#error').addClass('ui-state-error ui-corner-all');
                                $('#error').html('<span class=\'ui-icon ui-icon-alert\' style=\'float:left;\'></span>Información requerida en Habilidades');  
				$('#habPerfil').focus();
				return false;  

			}
		else if(ltxtConoc=='')
			{
                                
				$('#error').addClass('ui-state-error ui-corner-all');
                                $('#error').html('<span class=\'ui-icon ui-icon-alert\' style=\'float:left;\'></span>Información requerida en Conocimientos');  
				$('#conocPerfil').focus();
				return false; 
			}
			else
			{//SI NO ENTRO A NINGUN ELSE IF, ENTONCES MANDA LOS DATOS AL ARCHIVO ACCIONES.PHP CON AJAX JUNTO CON LA ACCION
                           
			   $.ajax({
			     type:'get',
			     url:'acciones.php',
			     data:
			{
				ids: 'NULL',  
				accion:'N',  //LA ACCION N ES PARA NUEVO ENTONCES ENTRA A LA FUNCI�N NUEVO EN ACCIONES.PHP
				descPerfil:ltxtDesc,  //LO RECIBE ACCIONES.PHP POR MEDIO DE GET
                                perfPerfil:ltxtPerfil,
                                compPerfil:ltxtComp,
                                funcPerfil:ltxtFunc,
                                habPerfil:ltxtHab,
                                conocPerfil:ltxtConoc
                                
				
			},
			success:function(data){
			
				$('#res').html(data);     


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
echo "
    <meta charset='utf8'>
<center>
<form id='formulario'>
		<table>
		 <tr>
		    <td colspan='2' class='header'>Descripción del perfil</td>
                    <td class='content'>
		    <input type='text' name='descPerfil' id='descPerfil' >
		    </td>
	        </tr>
	        <tr>
		    <td colspan='2' class='header'>Perfil</td>
		    <td class='content'>
		    <textarea name='perfilPerfil' id='perfilPerfil' rows='2' cols='40'></textArea>
		    </td>
	        </tr>
	        <tr>
		    <td colspan='2' class='header'>Complejidad del Perfil</td>
		    <td class='content'>
		    <select name='compPerfil' id='compPerfil' >
                      <option name='vacio'></option>
                      <option name='uno'>1</option>
                      <option name='dos'>2</option>
                      <option name='tres'>3</option>
                      <option name='cuatro'>4</option>
                      <option name='cinco'>5</option>
                    </select>
		    </td>
	        </tr> 
                <tr>
		    <td colspan='2' class='header'>Funciones</td>
		    <td class='content'>
                    <textArea name='funcPerfil' id='funcPerfil' rows='5' cols='100'></textArea>
		    </td>
	        </tr>
                <tr>
		    <td colspan='2' class='header'>Habilidades</td>
		    <td class='content'>
                    <textArea name='habPerfil' id='habPerfil' rows='3' cols='100'></textArea>
		    </td>
	        </tr>
                <tr>
		    <td colspan='2' class='header'>Conocimientos</td>
		    <td class='content'>
                    <textArea name='conocPerfil' id='conocPerfil' rows='5' cols='100'></textArea>
		    </td>
	        </tr>
                   
		</table>
                <table>
		<tr>
                      <td><button id='btnGuardar'>Guardar</button></td>
		</tr>
                </table>
		<div id='res'></div>
                <div id='error' style='margin-top:10px; width:400px;'>
                    </div>
		
	</form></center>";
?>