<script type="text/javascript" src="jquery.quick.pagination.min.js"></script>
<script>
$(document).ready(function ()
{

$('#close').click(function() {
	alert('entras aca');
        $('.overlay-container').fadeOut().end().find('.window-container').removeClass('window-container-visible');
    });
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
$palabra=$_POST['palabraCla'];
$edad1=$_POST['ed1'];
$edad2=$_POST['ed2'];
$disV=$_POST['disViaje'];
$genero=$_POST['genero'];
$esco=$_POST['ecola'];
$nivel=$_POST['niv'];
$prete1=$_POST['prt1'];
$prete2=$_POST['prt2'];
$banderaEdad=0;
$b=0;
$bandera=0;

if($palabra!='')
{
	$r=explode(' ', $palabra);
	$array="";
	$where='';

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
$whereP="";


	if(count($array)=='1')
	{
		$whereP=" WHERE CONCAT( otrECandid, aintCandid, aexpCandid, conCandid ) LIKE  '%".$array[0]."%'";
	$b=1;
	}
	else
	{
		$whereP=" WHERE CONCAT( otrECandid, aintCandid, aexpCandid, conCandid ) LIKE  '%".$array[0]."%'";
			for($i2=1;$i2<count($array);$i2++)
			{
				//echo $i2;

				
				$whereP.=" OR CONCAT( otrECandid, aintCandid, aexpCandid, conCandid ) LIKE '%".$array[$i2]."%'";

			}
			$b=1;

	}


//$whereP='WHERE CONCAT( otrECandid, aintCandid, aexpCandid, conCandid ) LIKE  "%'.$palabra.'%"';

}
}
else
{
$whereP="";
}




if($edad1!='' && $edad2!='')
{
 $bandera=2;
}
else
{
 $bandera=0;
}

if($disV!='0')
{
	if($b!=0)
	{
		$wherEd=" AND viajCandid=".$disV;

	}
	else
	{
		$wherEd= "WHERE viajCandid=".$disV;
		$b=1;
	}

}
else
{
	$wherEd="";

}

if($genero !='0')
{
	if($b!='0')
	{
		$whereG="AND genCandid='".$genero."'";

	}
	else
	{
		$whereG="WHERE genCandid='".$genero."'";
		$b=1;
	}

}
else
{
	$whereG="";

}
if($esco!='0')
{
	if($b!=0)
	{
		$whereE="AND idEscolar=".$esco;

	}
	else
	{
		$whereE="WHERE idEscolar=".$esco;
		$b=1;
	}

}
else
{
$whereE="";
}

if($nivel!='0')
{
		if($b!='0')
		{
			$whereN="AND nivCandid='".$nivel."'";

		}
		else
		{
			$whereN="WHERE nivCandid='".$nivel."'";
			$b=1;
		}

}
else
{
$whereN="";
}


	if($prete1 !='' && $prete2!='')
	{
		if($b!='0')
		{
			$wherePr="AND pretCandid >=".$prete1." AND pretCandid <=".$prete2;

		}
		else
		{
			$wherePr="WHERE pretCandid >=".$prete1." AND pretCandid <=".$prete2;
			$b=1;
  
		}
	}
	else
	{
		$wherePr="";


	}

	$sql="select * from tblcandidato ".$whereP." ".$wherEd." ".$whereG." ".$whereE." ".$whereN." ".$wherePr;
	$queryP=mysql_query($sql)or die('esta es la consulta');
	
if(mysql_num_rows($queryP)<=0)
{
	echo"<table align='center' class='enca'><td><center>No existen datso con estos criterios de busqueda</center></td></table>";

}
else
{

	    echo"<ul class='pagination1'>
";
		  echo"<li>
	   <table  class='enca'>
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
	   if($bandera==2)
	   {
	   

	   	while($r=mysql_fetch_array($queryP))
			{
				
			$fe=explode('-', $r['fecNCandid']);
			$fechaC=$fe[2].'-'.$fe[1].'-'.$fe[0];
			$edad=$funciones->calcular_edad($fechaC);
				if($edad >= $edad1 && $edad <=$edad2)
					{
						echo "
						<li>
						<table class='td1' >
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
						$banderaEdad=2;

					}
				
			}
			if($banderaEdad==2)
			{
			echo"<table align='center'><td><center>No existen datos con estos criterios de busqueda</center></td></table>";
			}

	   }
	   else
	   {


		while($r=mysql_fetch_array($queryP))
		{
			$fe=explode('-', $r['fecNCandid']);
			$fechaC=$fe[2].'-'.$fe[1].'-'.$fe[0];
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
		
		}

		echo"</ul><br></br>";

}

					


?>