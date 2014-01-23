<style type="text/css">
label{

	display:block;
	padding:10px 30px 0px 30px;
	margin:10px 0px 0px 0px;
	}
	textarea {
	
	border: solid 1px #E5E5E5;
	background: #FFFFFF;
	margin: 5px 30px 0px 30px;
	padding: 9px;
	display:block;
	font-size:16px;
	resize:none;
	
}
	</style>
<script type="text/javascript">
$(document).ready(
	function()
	{
		$('#close').click(function() {

        $('.overlay-container').fadeOut().end().find('.window-container').removeClass('window-container-visible');
    });
	});

</script>
<?php
include"libs.php";

$funciones= new funciones;
$funciones->conectar();

$sql="select * from tblcandidato where idCandid=".$_POST['ids'];
$query=mysql_query($sql)or die('no se ejecuta esta');
$rs=mysql_fetch_array($query);
echo"
<table  align='center'>
<tr>
<td>
<label><strong>Nombre</strong>: ".utf8_encode($rs['nomCandid'])." ".utf8_encode($rs['appCandid'])." ".utf8_encode($rs['apmCandid'])."</label>
<label><strong>Genéro</strong>: ".$rs['genCandid']."</label>
<label><strong>Fecha Nacimiento</strong>: ".$rs['fecNCandid']."</label>
<label>";
$sqlEntidad="select * from entidad_federativa where id_entidad=".$rs['id_entidad'];
$queryEntidad=mysql_query($sqlEntidad)or die('n se ejecuta la de entidad federativa');
$nomEnti=mysql_result($queryEntidad,0,'nombre_entidad');

echo"<strong>Estado</strong>: ".utf8_encode($nomEnti)."</label>
<label>";
$sqlMuni="select * from municipio where id_entidad=".$rs['id_entidad']." and id_municipio=".$rs['id_municipio'];
$queryMuni=mysql_query($sqlMuni)or die('no se eejcurta la de municipio');

$muni=mysql_result($queryMuni,0,'nombre_municipio');
echo"<strong>Municipio</strong>: ".$muni."</label>
<label>
";

$sqlColonia="select * from codigo_postal where cp=".$rs['idCP']." and id_colonia=".$rs['id_colonia'];
$queryColonia=mysql_query($sqlColonia)or die('no se eejcuta la consulta de colonia');
$nombreColo=mysql_result($queryColonia,0,'nombre_colonia');
echo"
<strong>Colonia</strong>: ".utf8_encode($nombreColo)."
</label>
<label><strong>Codigo Postal</strong>".$rs['idCP']."</label>
<label><strong>Domicilio</strong>: ".$rs['domCandid']."</label>
<label><strong>Telefono</strong>: ".$rs['telCandid']."</label>
<label><strong>Celular</strong>: ".$rs['celCandid']."</label>

</td>
<td>
<label><strong>Correo</strong>: ".$rs['mailCandid']."</label>
<label><strong>Trabaja Actualmente?</strong>: ";
if($rs['trabCandid']=='1')
{
echo $vaTra='Si';
}
else
{
echo $vaTra='No';
}
echo"
</label>

";

echo"
<label><strong>Escolaridad</strong>: ";
 $sqlEsco="select * from tblescolar where idEscolar=".$rs['idEscolar'];
$queryEsco=mysql_query($sqlEsco)or die('no se ejecuta la de escolaridad');
echo utf8_encode($resEsco=mysql_result($queryEsco,0,'nomEscolar'));
echo "</label>
<label><strong>Nivel de Estudios</strong> :".utf8_encode($rs['nivCandid'])."</label>
<label>Idiomas</label>
";
if($rs['idimoma1']!='0')
{
	echo"<label>Ingles: ".$rs['porIdioma1']."%   </label> ";

}
if($rs['idimoma2']!='0')
{
	echo"<label>   Frances: ".$rs['porIdioma2']."%  </label>  ";

}
if($rs['idimoma3']!='0')
{
	echo" <label> Aleman: ".$rs['porIdioma3']."% </label>   ";

}
if($rs['idimoma4']!='0')
{
	echo"<label>  Portugues: ".$rs['porIdioma4']."% </label>   ";

}


echo"
<label><strong>Pretensión Economica</strong>: ".$rs['pretCandid']."$</label>
<label><strong>Conocimientos</strong></label><textarea disabled rows='5' cols='20'>".utf8_encode($rs['conCandid'])."</textarea>

</td>

<td>

<label><strong>Áreas de interes</strong></label><textarea disabled rows='5' cols='20'>".utf8_encode($rs['aintCandid'])."</textarea>
<label><strong>Áreas de experiencia</strong></label><textarea disabled rows='5' cols='20'>".utf8_encode($rs['aexpCandid'])."</textarea>
<label><strong>Dispuesto a Viajar?</strong>: ";
if($rs['viajCandid']=='1')
{
	echo"Si";

}else
{
	echo"No";
}


echo"</label>
</td>
</tr>


</table>
";

?>

<span class='close' id='close'>Cerrar</span>