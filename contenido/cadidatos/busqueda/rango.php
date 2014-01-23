
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
</style>
<?php
include"libs.php";

$funciones= new funciones;
$funciones->conectar();
$v1=$_POST['v1'];
$v2=$_POST['v2'];
 $sql="select * from tblcandidato where pretCandid >=".$v1." and pretCandid <=".$v2;
$query=mysql_query($sql)or die('esta es la consulta rango precios');
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
	   </tr>
	   </table>
	   </li>";
		while($r=mysql_fetch_array($query))
		{
		echo"<li>
		<table class='td1'>
		<tr onclick='bus(".$r['idCandid'].")'>
		<td width='200'>".utf8_encode($r['nomCandid'])."</td>
		<td width='200'>".utf8_encode($r['appCandid'])."</td>
		<td width='200'>".utf8_encode($r['apmCandid'])."</td>
		<td width='200'>".$r['genCandid']."</td>
		<td width='200'>".$r['fecNCandid']."</td>
		</tr>
		</table>
		</li>";
		}
		

		echo"</ul><br></br>";


?>