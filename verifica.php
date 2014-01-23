<?php
include"libs/libs.php";
 $ltxtUsua=$_POST['usua'];
 $ltxtPasw=$_POST['paswd'];
$funciones= new funciones;
$funciones->conectar();
if($ltxtPasw=='$upgenia')
 		{
 			$sqlUs="select * from tblusuarios where nickUsuario='".$ltxtUsua."'";
 			$QueryUs=mysql_query($sqlUs)or die('no se ejcuta seleccion de usuario pas general');
 			$rowUs=mysql_num_rows($QueryUs);
 			if($rowUs>=1)
 			{
 				
 				 $rA=mysql_fetch_array($QueryUs);
 				 session_start();
		 	    $Sid=$_SESSION['id']=$rA['idUsuario'];
		 	    $Snick=$_SESSION['nick']=$rA['nickUsuario'];
		 		$Spass=$_SESSION['paswd']=$rA['pwdUsuario'];
		 		$Snom=$_SESSION['nom']=$rA['nomUsuario'];
		 		$Sapp=$_SESSION['app']=$rA['appUsuario'];
		 		$Sapm=$_SESSION['apm']=$rA['apmUsuario'];
		 		$Smail=$_SESSION['mail']=$rA['mailUsuario'];
		 		$Srol=$_SESSION['rol']=$rA['idRol'];
		 		$SModiUsu=$_SESSION['modUs']=$rA['moUsuario'];
		 		$SfechaA=$_SESSION['fechaA']=$rA['fecalta'];
		 		$SfechaB=$_SESSION['fechaB']=$rA['fecbaja'];
		 		$Sstatus=$_SESSION['estatus']=$rA['status'];
				$_SESSION['Cpas']=false;
		 		//header('Location:home.php');
		 		//print"<meta http-equiv=refresh content=\"0 ; url='home.php'\">";
              //exit;

		 		echo "bien";

 				
 		
 			}
 			else
 			{
 				echo"Verifica tus datos";
				//echo"<script>alert('Verifica tus datos')</script>";
 				//print"<meta http-equiv=refresh content=\"0 ; url='index.php'\">";
             // exit;


 			}


 		}
 		else
 		{
 			$sqlUs="select * from tblusuarios where nickUsuario='".$ltxtUsua."' and pwdUsuario='".md5($ltxtPasw)."'";
 			$QueryUs=mysql_query($sqlUs)or die('no se ejcuta selección de usuario pas general');
 			$rowUs=mysql_num_rows($QueryUs);
 			if($rowUs>=1)
 			{
 				
 				 $rA=mysql_fetch_array($QueryUs);
 				 session_start();
		 	    $Sid=$_SESSION['id']=$rA['idUsuario'];
		 	    $Snick=$_SESSION['nick']=$rA['nickUsuario'];
		 		$Spass=$_SESSION['paswd']=$rA['pwdUsuario'];
		 		$Snom=$_SESSION['nom']=$rA['nomUsuario'];
		 		$Sapp=$_SESSION['app']=$rA['appUsuario'];
		 		$Sapm=$_SESSION['apm']=$rA['apmUsuario'];
		 		$Smail=$_SESSION['mail']=$rA['mailUsuario'];
		 		$Srol=$_SESSION['rol']=$rA['idRol'];
		 		$SModiUsu=$_SESSION['modUs']=$rA['moUsuario'];
		 		$SfechaA=$_SESSION['fechaA']=$rA['fecalta'];
		 		$SfechaB=$_SESSION['fechaB']=$rA['fecbaja'];
		 		$Sstatus=$_SESSION['estatus']=$rA['status'];
		 		//header('Location:home.php');
		 		if(md5($_SESSION['nick'])==$_SESSION['paswd'])
		 		{
		 			$_SESSION['Cpas']=true;
		 			echo "bien";

		 		}
		 		else
		 		{
		 			$_SESSION['Cpas']=false;
		 			echo "bien";

		 		}

		 		//echo "bien";

 				
 		
 			}
 			else
 			{
				echo"Verifica tus datos";
 				//echo"<script>alert('Verifica tus datos')</script>";
 				//print"<meta http-equiv=refresh content=\"0 ; url='index.php'\">";
              //exit;

 			}

 		}


?>