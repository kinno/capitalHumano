
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
include"libs.php";

$funciones= new funciones;
$funciones->conectar();

if(isset($_POST['parametro']))
{



$r=explode(' ', $_POST['parametro']);

$array="";
$where='';

if($r[0]!='')
{
for($i=0;$i<count($r);$i++)
{
	
	 if($r[$i]!='')
	 {
	 	${'array'}[] = $r[$i]; 

	 }

}
$where="";


if(count($array)=='1')
{
	$where=" WHERE CONCAT( otrECandid, aintCandid, aexpCandid, conCandid ) LIKE  '%".$array[0]."%'";

}
else
{
	$where=" WHERE CONCAT( otrECandid, aintCandid, aexpCandid, conCandid ) LIKE  '%".$array[0]."%'";
		for($i2=1;$i2<count($array);$i2++)
		{
			//echo $i2;

			
			$where.=" OR CONCAT( otrECandid, aintCandid, aexpCandid, conCandid ) LIKE '%".$array[$i2]."%'";

		}

}

}




	
$sqlP="SELECT * 
FROM  tblcandidato ".$where;


	 /*$sqlP='SELECT * 
FROM  tblcandidato 
WHERE CONCAT( otrECandid, aintCandid, aexpCandid, conCandid ) LIKE  "%'.$_POST['parametro'].'%"';
*/
$queryP=mysql_query($sqlP)or die('esta es la consulta');
if(mysql_num_rows($queryP)<=0)
{
	echo"No Existen Datos con Esa palabra";

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
	   </tr>
	   </table>
	   </li>";
		while($r=mysql_fetch_array($queryP))
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

}







}



?>