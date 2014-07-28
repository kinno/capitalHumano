<?php
// include"libs/PHPMailer/class.phpmailer.php";
// include"libs/PHPMailer/class.smtp.php";
 require 'libs/PHPMailer/PHPMailerAutoload.php';
$mail = new PHPMailer();
		  $mail->IsSMTP();
		  $mail->SMTPAuth = true;
		  //$mail->SMTPSecure = "ssl";
		  $mail->Host = "imap.upgenia.com";
		  $mail->Port = 25;
		  $mail->Username = "regino.tabares";
		  $mail->Password = "herectic1";
		  $mail->SMTPDebug = 0; //a�adido para mostrar informaci�n detallada de error en caso de producirse
                  $mail->From = "no-reply@upgenia.com";
		  $mail->FromName = "Avisos.CapitalHumano"; //nombre de quien lo mando
		  $mail->Subject = utf8_decode("huevotes");  //subjet de mail
		  $mail->MsgHTML(utf8_decode("huevotes"));//body del mail
		  $mail->AddAddress("jcpm0214@gmail.com", "Destinatario"); //a quien va dirijida
		  //$mail->AddAddress($correorh, "Destinatario"); //a quien va dirijida
		  $mail->IsHTML(true);
		 	 
		  if(!$mail->Send()) {
		  echo "Mailer Error: " . $mail->ErrorInfo;
		   return false;
		  }
                  return true;
                
?>