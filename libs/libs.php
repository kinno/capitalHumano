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
		$passwd ="admin123";
		$db = "bdrh";
		$conexion=mysql_connect($host,$user,$passwd,$db) or die(mysql_error());
                mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'", $conexion);
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
        
 	function login($valor1,$valor2)
 	{
 		$this->conectar();
 		if($valor2=='$upgenia')
 		{
 			$sqlUs="select * from tblusuarios where nickUsuario='".$valor1."'";
 			$QueryUs=mysql_query($sqlUs)or die('no se ejcuta seleccion de usuario pas general');
 			echo $rowUs=mysql_num_rows($QueryUs);
 			if($rowUs>=1)
 			{
 				
 				 $rA=mysql_fetch_array($QueryUs);
 				 session_start();
 	    $Sid=$_SESSION['id']=$rA['idUsuario'];
 		/*$Snick=$_SESSION['nick']=$nick;
 		$Spass=$_SESSION['paswd']=$pass;
 		$Snom=$_SESSION['nom']=$nom;
 		$Sapp=$_SESSION['app']=$app;
 		$Sapm=$_SESSION['apm']=$apm;
 		$Smail=$_SESSION['mail']=$mail;
 		$Srol=$_SESSION['rol']=$rol;
 		$SModiUsu=$_SESSION['modUs']=$modiUsario;
 		$SfechaA=$_SESSION['fechaA']=$fechaA;
 		$SfechaB=$_SESSION['fechaB']=$fechaB;
 		$Sstatus=$_SESSION['estatus']=$status;*/

 				 //$this->Sessiones($rA['idUsuario'],$rA['nickUsuario'],$rA['pwdUsuario'],$rA['nomUsuario'],$rA['appUsuario'],$rA['apmUsuario'],$rA['mailUsuario'],$rA['idRol'],$rA['moUsuario'],$rA['fecalta'],$rA['fecbaja'],$rA['status']);
 				//echo"las variables son: ".$rA['idUsuario']." ".$rA['nickUsuario']." ".$rA['pwdUsuario']." ".$rA['nomUsuario']." ".$rA['appUsuario']." ".$rA['apmUsuario']." ".$rA['mailUsuario']." ".$rA['idRol']."".$rA['moUsuario']." ".$rA['fecalta']." ".$rA['fecbaja']." ".$rA['status']." ";
 			return true;
 			}
 			else
 			{
 				return false;

 			}


 		}
 		else 
 		{

 		}
 	}

 	/*function Sessiones($id,$nick,$pass,$nom,$app,$apm,$mail,$rol,$modiUsario,$fechaA,$fechaB,$status)
 	{	
 		//echo"fucion sessiones id:". $id." nick:".$nick."pas: ".$pass." nom:".$nom." app: ".$app." apm: ".$apm." mail: ".$mail." rol: ".$rol." mod: ".$modiUsario." fechaA: ".$fechaA." fechaB: ".$fechaB."estatus: ".$status;
 		session_start();
 	    $Sid=$_SESSION['id']=$id;
 		$Snick=$_SESSION['nick']=$nick;
 		$Spass=$_SESSION['paswd']=$pass;
 		$Snom=$_SESSION['nom']=$nom;
 		$Sapp=$_SESSION['app']=$app;
 		$Sapm=$_SESSION['apm']=$apm;
 		$Smail=$_SESSION['mail']=$mail;
 		$Srol=$_SESSION['rol']=$rol;
 		$SModiUsu=$_SESSION['modUs']=$modiUsario;
 		$SfechaA=$_SESSION['fechaA']=$fechaA;
 		$SfechaB=$_SESSION['fechaB']=$fechaB;
 		$Sstatus=$_SESSION['estatus']=$status;

 		echo"<br>sessiones creadas".$Sid;

 	}*/


 	



        
 }







?>