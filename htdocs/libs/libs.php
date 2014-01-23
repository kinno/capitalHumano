<?php

 
//*********************************************************************
//Nombre: clase funciones.
//Funcion del Modulo: Guadar la funciones que se ocuparan.
//Fecha: 06/05/2013
//Relizo: Ricardo Lugo Recillas
//*********************************************************************	

 class funciones {
 	

 	public function conectar()
 	{
	 	$host = "localhost";
		$user = "root";
		$passwd ="admin";
		$db = "bdrh";
		$conexion=mysql_connect($host,$user,$passwd,$db) or die(mysql_error());
		$selecDB=mysql_select_db($db,$conexion)or die(mysql_error());

 	}

 


 	function combo()
 	{ 
 		
 		$this->conectar();
 		
 		 $sqlC="SELECT *  FROM  tblroles ";
 		$queryC=mysql_query($sqlC) or die(mysql_error());
 		while($row=mysql_fetch_array($queryC))
 		{
 			echo"<option value=".$row['idRol'].">".$row['nomRol']."</option>";

 		}
 		

 	}
 	function comboLimitado($Valor){
 		
 		$this->conectar();
 		$sqlC1="SELECT *  FROM  tblroles where idRol =".$Valor;
 		$queryC1=mysql_query($sqlC1) or die(mysql_error());
 		$nomRol=mysql_result($queryC1,0,'nomRol');
 		echo"<option value='".$Valor."'>".$nomRol."</option>";


 		
 		$sqlC="SELECT *  FROM  tblroles where idRol !=".$Valor;
 		$queryC=mysql_query($sqlC) or die(mysql_error());
 		while($row=mysql_fetch_array($queryC))
 		{
 			echo"<option value=".$row['idRol'].">".$row['nomRol']."</option>";

 		}

 	}
 	function comboStatus($Valor)
 	{
 		if($Valor==0)
 		{
 			echo"<option value='0'>Inactivo</option>";
 			echo"<option value='1'>Activo</option>";

 		}
 		else if($Valor==1)
 		{
 			echo"<option value='1'>Activo</option>";
 			echo"<option value='0'>Inactivo</option>";
 		}

 	}
 	/*function mail($correo,$mensaje)
 	{
		  $mail = new PHPMailer();
		  $mail->IsSMTP();
		  $mail->SMTPAuth = true;
		  $mail->SMTPSecure = "ssl";
		  $mail->Host = "smtp.gmail.com";
		  $mail->Port = 465;
		  $mail->Username = "gmm1610@gmail.com";
		  $mail->Password = "upgenia123";
		  //$mail->SMTPDebug = 1; //añadido para mostrar información detallada de error en caso de producirse
		  $tabla="<html><body>
		  <tabla border><tr><td>olas</td></tr></tabla>";
		  $tabla.="</body></html>";
		  $mail->From = "gmm1610@gmail.com";
		  $mail->FromName = "RH Upgenia"; //nombre de quien lo mando
		  $mail->Subject = "Registro de Usuario";  //subjet de mail
		  $mail->MsgHTML(utf8_decode($mensaje));//body del mail
		  $mail->AddAddress($correo, "Destinatario"); //a quien va dirijida
		  $mail->IsHTML(true);
			 
		  if(!$mail->Send()) {
		   
		   return false;
		  } else {
		  return true;
		  }  
 		
 	}*/




 }







?>