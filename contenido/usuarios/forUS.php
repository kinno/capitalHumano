<?php
include"../libs/libs.php";
$funciones= new funciones;
$funciones->conectar();
$sqlB="select * from tblusuarios where idUsuario=".$_GET['ids'];
$queryB=mysql_query($sqlB) or die(mysql_error());
$ltxtNombre=mb_convert_encoding(mysql_result($queryB,0,'nomUsuario'),"UTF-8");
$ltxtApPat =mb_convert_encoding(mysql_result($queryB,0,'appUsuario'),"UTF-8");
$ltxtapMat =mb_convert_encoding(mysql_result($queryB,0, 'apmUsuario'),"UTF-8");
$ltxtMail  =mb_convert_encoding(mysql_result($queryB,0, 'mailUsuario'),"UTF-8");
$lintRol   =mb_convert_encoding(mysql_result($queryB,0, 'idRol'),"UTF-8");
$ltxtNomUS =mb_convert_encoding(mysql_result($queryB,0, 'nickUsuario'),"UTF-8");
$ltxtPas   =mb_convert_encoding(mysql_result($queryB,0, 'pwdUsuario'),"UTF-8");
$lintStatus=mb_convert_encoding(mysql_result($queryB,0, 'status'),"UTF-8");

echo"
<script type='text/javascript' src='../js/libs.js'></script>
<script> 
$(document).ready(function(){
	$('#eliminar').click(function(){

		var lintIdUsu=$('#idT').val();

		$.ajax(
			{
				type:'get',
				url:'acciones.php',
				data:{
					ids:lintIdUsu,
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

   	var lintIdUsu=$('#idT').val(),
   		ltxtNombre=$('#nombreUs').val(),
   		ltxtApPat=$('#appUS').val(),
   		ltxtApMat=$('#apmUs').val(),
   		lintRol=$('#RolUs').val(),
   		lintMail=$('#mailUs').val(),
   		ltxtNomUS=$('#nickUs').val(),
   		ltxtPas=$('#pawdUS').val(),
		lintStatus=$('#statusUS').val();

		if (validar_input_txt(ltxtNombre,'Nombre',1,50) == false){
       		$('#nombreUs').focus();
      		return false; 
    	}	
    	else if (validar_input_txt(ltxtApPat,'Apellido Paterno',1,50) == false){
       		$('#appUS').focus();
      		return false; 
    	}		
   		else if (validar_input_txt(ltxtApMat,'Apellido Materno',1,50) == false){
       		$('#apmUs').focus();
      		return false; 
    	}				
    	else if (validar_input_txt(lintMail,'Correo',1,50) == false){
       		$('#Correo').focus();
      		return false; 
    	}	
		else if(Validacorreo($('#mailUs').val()) == false)
    	{
        	$('#resultado').text('Verifica el Correo no cumple con la estructura');
        	$('#mailUs').focus();
        	return false;
    	}
    	else if(lintRol==0)
		{
			$('#resultado').text('Selecciona el Rol');  
			$('#rol').focus();
			return false; 
		}
		else{
			$.ajax(
			{
				type:'get',
				url:'acciones.php',
				data:{
					ids:lintIdUsu,
					accion:'M',
					nomUs:ltxtNombre,
					appUs:ltxtApPat,
					apmUs:ltxtApMat,
					mailUs:lintMail,
					rolUS: lintRol,
					nickUs:ltxtNomUS,
					pasUs:ltxtPas,
					status:lintStatus
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

</script>
";
echo "<head><meta http-equiv='Content-Type' content='text/html; charset=utf-8' /></head>
    <center>
    <fieldset>
    <legend>Información del Usuario</legend>
    <form if='form'>
            <center>
            <table >
                    <tr>
                            <td colspan='2' >Nombre</td>
                            <td ><input type='hidden' id='idT' value='".$_GET['ids']."'>
                            <input type='text' name='nombreUs' id='nombreUs' class='texto' value='".$ltxtNombre."' onkeypress='return soloLetras(event)'>
                            </td>
                    </tr>";
                    echo"<tr>
                            <td colspan='2'>Apellido Paterno</td>
                            <td >
                            <input type='text' name='appUS' id='appUS' class='texto' value='".$ltxtApPat."' onkeypress='return soloLetras(event)'>
                            </td>
                    </tr>";
                    echo"<tr>
                            <td colspan='2' >Apellido Materno</td>
                            <td >
                            <input type='text' name='apmUs' id='apmUs' class='texto' value='".$ltxtapMat."' onkeypress='return soloLetras(event)'>
                            </td>
                    </tr>";
                    echo"<tr>
                            <td colspan='2' >Correo</td>
                            <td >
                            <input type='text' name='mailUs' id='mailUs'class='texto' value='".$ltxtMail."' onkeypress='return email(event)'>
                            </td>
                    </tr>
                    <tr>
                                            <td colspan='2' >Status</td>
                                            <td >
                                            <select name='statusUS' id='statusUS' class='sel'>
            ";
                                            $funciones->comboStatus($lintStatus);


                                            echo"
            </select>
                                            </td>
                    </tr>
                    ";
                    echo"<tr>
                    <td colspan='2' >Rol</td>
                    <td >
                    ";
                    echo "<select name='RolUs' id='RolUs' class='sel'>";


                                                            $funciones->comboLimitado($lintRol);
                                                            echo"</select>";

                    echo"</td>
                    </tr>";
                    echo"<tr>
                    <td colspan='2' >Nombre Usuario</td>
                    <td >
                    <input type='text' name='nickUs' id='nickUs' class='texto' value='".$ltxtNomUS."' onkeypress='return email(event)'>
                    </td>
                    </tr>";
                    echo"<tr><td colspan='2' >Contraseña</td><td class='content'><input type='password' name='pawdUS' id='pawdUS' class='texto' value=''></td></tr>";
            echo"</table>";
            echo"</form>";
            echo"<table>";
            echo"<tr><td><span class='close' id='modif'>Guardar</span></td><td><span class='close' id='eliminar'>Eliminar</span></td></tr>";
            echo"<tr><td colspan='3' ><div id='resultado'></div></td></tr>";
            echo"</table>
            
            </fieldset>
            </center>";

?>