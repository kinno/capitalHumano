<?php
header("Content-Type: text/html;charset=utf-8");
include"../libs/libs.php";
$funciones= new funciones; //CREA UN NUEVO OBJETO DE LA CLASE FUNCIONES
$funciones->conectar(); //EJECUTA EL MÉTODO CONECTARSE 
$sqlB="select * from tblperfil where idPerfil=".$_GET['ids']; //HACE UNA CONSULTA A LA TABLA  
$queryB=mysql_query($sqlB) or die(mysql_error()); //EJECUTA LA CONSULTA
//EXTRAE CADA UNO DE LOS CAMPOS DE LA CONSULTA
$reg = mysql_fetch_array($queryB);
$ltxtDesc=$reg['descPerfil']; 
$ltxtpPerfil=$reg['perfPerfil'];
$ltxtComp=$reg['compPerfil'];
$ltxtFunc=$reg['funcPerfil'];
$ltxtHab=$reg['habPerfil'];
$ltxtConoc=$reg['conocPerfil'];

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
   $('#modif').click(function(){  //Si se da clic en modificar se manda las modificaciones
                
   	        var lintIdUsu=$('#idT').val(),
   		ltxtDesc = $('#descPerfil').val(),
   		ltxtPerfil = $('#perfilPerfil').val(),
   		ltxtComp = $('#compPerfil').val(),
                ltxtFunc = $('#funcPerfil').val(),
                ltxtHab = $('#habPerfil').val(),
                ltxtConoc = $('#conocPerfil').val();
                
   		if(ltxtDesc=='')
   		{
   			$('#error').addClass('ui-state-error ui-corner-all');
   			$('#error').html('<span class=\'ui-icon ui-icon-alert\' style=\'float:left;\'></span>Verifica la descripción del perfil se encuentra vacia'); 
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
                                $('#error').html('<span class=\'ui-icon ui-icon-alert\' style=\'float:left;\'></span>Información requerda');  
				$('#perfilPerfil').focus();
				return false;  

			}
		else if(ltxtComp.length >1)
			{
				$('#error').addClass('ui-state-error ui-corner-all');
                                $('#error').html('<span class=\'ui-icon ui-icon-alert\' style=\'float:left;\'></span>La complejidad del perfil debe estar entre 1 y 5');  
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
                                $('#error').html('<span class=\'ui-icon ui-icon-alert\' style=\'float:left;\'></span>Información requerida');  
				$('#funcPerfil').focus();
				return false;  

			}
		else if(ltxtHab=='')
			{
				$('#error').addClass('ui-state-error ui-corner-all');
                                $('#error').html('<span class=\'ui-icon ui-icon-alert\' style=\'float:left;\'></span>Información requerida');  
				$('#habPerfil').focus();
				return false;  

			}
		else if(ltxtConoc=='')
			{
				$('#error').addClass('ui-state-error ui-corner-all');
                                $('#error').html('<span class=\'ui-icon ui-icon-alert\' style=\'float:left;\'></span>Información requerida');  
				$('#conocPerfil').focus();
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
<table>";
	echo"<tr>
		<td colspan='2' class='header'>Descripci&oacute;n del perfil</td>
		<td class='content'><input type='hidden' id='idT' value='".$_GET['ids']."'>
		<input type='text' name='descPerfil' id='descPerfil' class='texto' value='".$ltxtDesc."'>
		</td>
	</tr>";
	echo"<tr>
		<td colspan='2' class='header'>Perfil</td>
		<td class='content'>
		<textArea name='perfilPerfil' id='perfilPerfil' rows='5' cols='40'>".$ltxtpPerfil."</textArea>
		</td>
	</tr>";
         $selec1="";
         $selec2="";
         $selec3="";
         $selec4="";
         $selec5="";
         //echo $ltxtComp;
         switch($ltxtComp)
         {
            case 1:
               $selec1="selected";
               break;
            case 2:
               $selec2="selected";
               break;
             case 3;
               $selec3="selected";
               break;
            case 4:
               $selec4="selected";
               break;
            default:
               $selec5="selected";
               break;
         }
         
         
	echo"<tr>
		<td colspan='2' class='header'>Complejidad del Perfil</td>
		<td class='content'>
		<select name='compPerfil' id='compPerfil'>
                      <option $selec1>1</option>
                      <option $selec2 >2</option>
                      <option $selec3>3</option>
                      <option $selec4>4</option>
                      <option $selec5>5</option>
                    </select>
		</td>
	</tr>"; //agregar función para sólo números
        echo"<tr>
		<td colspan='2' class='header'>Funciones</td>
		<td class='content'>
                <textArea name='funcPerfil' id='funcPerfil' rows='5' cols='100'>".$ltxtFunc."</textArea>
		</td>
	</tr>";
        echo"<tr>
		<td colspan='2' class='header'>Habilidades</td>
		<td class='content'> 
                <textArea name='habPerfil' id='habPerfil' rows='3' cols='100'>".$ltxtHab."</textArea>
		</td>
	</tr>";
        echo"<tr>
		<td colspan='2' class='header'>Conocimientos</td>
		<td class='content'>
                <textArea name='conocPerfil' id='conocPerfil' rows='5' cols='100'>".$ltxtConoc."</textArea>
		</td>
	</tr>";
echo"</table>";
echo"</form>";
echo"<table>";
echo"<tr><td><span class='close' id='modif'>Guardar</span></td><td><span class='close' id='eliminar'>Eliminar</span></td></tr>";
echo"</table>
<div id='res'></div>
<div id='error' style='margin-top:10px; width:400px;'>
</center>";
?>