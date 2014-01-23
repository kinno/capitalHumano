<?php


?>
<script type="text/javascript" src='js/jquery-1.9.1.min.js'></script>
<script type="text/javascript">
$(document).ready(function()
	{
		$('#btnCs').click(
			function(){

			var pswd1=$('#pswd1').val(),
				pswd2=$('#pswd2').val();
			

				if(pswd1.length > 20)
				{
					$('#res').text('Exede el numero de carcateres permitidos');
					$('#pswd1').focus();

				}
				else if(pswd1=='')
				{
					$('#res').text('La contraseña se encuentra vacia');
					$('#pswd1').focus();

				}
				if(pswd1.length < 6)
				{
					$('#res').text('La contraseña minimo 6 caracteres');
					$('#pswd1').focus();

				}
				else if(pswd2.length > 20)
				{
					$('#res').text('Exede el numero de carcateres permitidos');
					$('#pswd2').focus();

				}

				else if(pswd2=='')
				{
					$('#res').text('La contraseña se encuentra vacia');
					$('#pswd2').focus();

				}
				else if(pswd1 != pswd2)
				{
					
					//alert(' Cp1: '+pswd1+' Cp2:'+pswd2);
					$('#res').text('La contraseñas no Coinciden');
					$('#pswd1').focus();
					$('#pswd2').focus();

				}
				else
				{
					$.ajax(
						{
							type:'post',
							url:'CambioPas/moPas.php',
							data:
							{
								p1: pswd1,
								p2: pswd2

							},
							success:function(data)
							{
								$('#res').html(data);

							},
							error:function()
							{
								alert('Ocurrio un error al guardar los datos');

							}

						});


				}


		});

	});

</script>

<form>
	<table align='center'>
		<tr>
			<td>Nueva Contraseña</td>
			<td><input type='password' id='pswd1' name='pswd1' class='texto'></td>
		</tr>
		<tr>
			<td>Verifica Contraseña</td>
			<td><input type='password' id='pswd2' name='pswd2' class='texto'></td>
		</tr>
		<tr><td colspan='2'><center><div id='res'></div>	</center></td></tr>
		<tr>
			<td colspan='2'><center><span class='close' id='btnCs'>Guardar</span></center></td>
		</tr>

	</table>

</form>