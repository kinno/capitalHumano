
<script type="text/javascript" src="jquery.quick.pagination.min.js"></script>
<script>
$(document).ready(function ()
{
$("ul.pagination1").quickPagination();

});
</script>

<style>
ul{
	list-style: none;
}
ul.simplePagerNav li{
    display:block;
    float: left;
    padding: 10px;
    margin-bottom: 10px;
    font-family: georgia;
	font-size:14px;
}

ul.simplePagerNav li a{
     color:#000000;
    text-decoration: none;
}

li.currentPage {
	
    background: #459e00;	
   
}

ul.simplePagerNav li.currentPage a {
	color:#000000;	
}
.enca
{
	background: #459e00;
	color: white;

}
.td1
{
	 
  background: #FFFFFF;

  
  background: 
    -webkit-gradient(
      linear,
      left top,
      left 25,
      from(#FFFFFF),
      color-stop(4%, #EEEEEE),
      to(#FFFFFF)
    );
  background: 
    -moz-linear-gradient(
      top,
      #FFFFFF,
      #EEEEEE 1px,
      #FFFFFF 25px
      );
 
}
tr
{
cursor:pointer;
}
</style>
<?php
include "libs.php";
$funciones= new funciones;
$funciones->conectar();
date_default_timezone_set('Mexico/General');
 $fA=date('Y-m-d');
$T1= $_POST['edad1'];
$T2= $_POST['edad2'];
$bandera=0;
$sql="select * from tblcandidato";

$query= mysql_query($sql) or die('no se eejcura selecct candidatos');
if($filas=mysql_num_rows($query)<=0)
{
	echo"<table class='td1'><tr><td>No existen datos.</td></tr></table>";

}
else
{
	echo"<ul class='pagination1'>
";
	echo"<li>
				   <table class='enca'>
				   <tr>
				   <td width='200'>Nombre</td>
				   <td width='200'>Apellido Paterno</td>
				   <td width='200'>Apellido Paterno</td>
				   <td width='200'>Genero</td>
				   <td width='200'>Fecha de Nacimiento</td>
				   <td width='200'>Edad</td>
				   </tr>
				   </table>
				   </li>";

			while($r=mysql_fetch_array($query))
				
			{
				$fe=explode('-', $r['fecNCandid']);
			$fechaC=$fe[2].'-'.$fe[1].'-'.$fe[0];

			$edad=$funciones->calcular_edad($fechaC);
			if($edad >= $T1 && $edad <=$T2)
			{
				 
				echo"<li>
					<table class='td1'>
					<tr onclick='bus(".$r['idCandid'].")'>
					<td width='200'>".utf8_encode($r['nomCandid'])."</td>
					<td width='200'>".utf8_encode($r['appCandid'])."</td>
					<td width='200'>".utf8_encode($r['apmCandid'])."</td>
					<td width='200'>".$r['genCandid']."</td>
					<td width='200'>".$r['fecNCandid']."</td>
					<td width='200'>".$funciones->calcular_edad($fechaC)."</td>
					</tr>
					</table>
					</li>";

			}
			else
			{
			$bandera=1;

			}
				//echo "<tr><td>".$r['nomCandid']."</td><td>".$r['fecNCandid']."</td><td>".$funciones->calcular_edad($fechaC)."</td></tr>";

			}
			if($bandera==1)
			{
				echo"<li><table class='td1'><tr><td colspan='5'>No existen datos.</td></tr></table></li>";

			}
			echo"</ul><br></br>";

}

?>