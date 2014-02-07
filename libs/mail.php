<?php
 include"PHPMailer/class.phpmailer.php";
 include"PHPMailer/class.smtp.php";

 class mail{
     function mail(){
         
     }
     
     function enviarMail($correo,$mensaje,$subject,$correorh){
                
                $mensaje = $mensaje;
                $asunto = $subject;
                
                $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
                $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
                $cabeceras .= "From: info@upgenia.com";
                $cabeceras .= "Bcc: $correorh";
                $cuerpo = ' 
                            <html>
                            <link type="text/css" href="http://localhost/recursosHumanos/css/jquery-ui-1.10.3.custom.css" rel="stylesheet" /> 
                            <style>
                            table{
                                box-shadow: 5px 5px 20px #999;
                                -webkit-box-shadow: 2px 2px 5px #999;
                                -moz-box-shadow: 2px 2px 5px #999;
                                filter: shadow(color=#999999, direction=135, strength=2);
                                border-color: #999;
                                }
                                td{
                                    box-shadow: 5px 5px 5px #999;
                                }
                                h1{
                                    font-size: 32px;
                                }
                            </style>
                            <body class="ui-widget">
                            <center>
                            <table border="2" class="ui-widget" cellspacing="10" cellpadding="5">
                                <tr>
                                    <td rowspan="2"><center><img src="http://localhost/capitalHumano/images/upgenia.png" style="width:200px;"/></center></td><td><center><h1>Sistema capital humano</h1></center></td>
                                </tr>
                                <tr>
                                    <td><center><h2>'.$asunto.'</h2></center></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                       '.$mensaje.'
                                    </td>
                                </tr>

                            </table>
                            </center>
                            </body>
                            </table>
                            ';
                
                if(mail($correo, $asunto, $cuerpo, $cabeceras)){
                    //echo "enviado";
                    return true;
                }else{
                    //echo "error";
                    return false;
                }
                /*
                    $cuerpo = ' 
                            <html>
                            <link type="text/css" href="http://localhost/recursosHumanos/css/jquery-ui-1.10.3.custom.css" rel="stylesheet" /> 
                            <style>
                            table{
                                box-shadow: 5px 5px 20px #999;
                                -webkit-box-shadow: 2px 2px 5px #999;
                                -moz-box-shadow: 2px 2px 5px #999;
                                filter: shadow(color=#999999, direction=135, strength=2);
                                border-color: #999;
                                }
                                td{
                                    box-shadow: 5px 5px 5px #999;
                                }
                                h1{
                                    font-size: 32px;
                                }
                            </style>
                            <body class="ui-widget">
                            <center>
                            <table border="2" class="ui-widget" cellspacing="10" cellpadding="5">
                                <tr>
                                    <td rowspan="2"><center><img src="http://upgenia.com/blog/wp-content/uploads/2013/10/logo2.png" style="width:200px;"/></center></td><td><center><h1>Sistema Capital Humano</h1></center></td>
                                </tr>
                                <tr>
                                    <td><center><h2>'.$asunto.'</h2></center></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                       '.$mensaje.'
                                    </td>
                                </tr>

                            </table>
                            </center>
                            </body>
                            </table>
                            ';
                  $mail = new PHPMailer();
		  $mail->IsSMTP();
		  $mail->SMTPAuth = true;
		  $mail->SMTPSecure = "ssl";
		  $mail->Host = "smtp.gmail.com";
		  $mail->Port = 465;
		  $mail->Username = "regino.tabares@gmail.com";
		  $mail->Password = "Herectic666";
		  $mail->SMTPDebug = 0; //a�adido para mostrar informaci�n detallada de error en caso de producirse
                  $mail->From = "info@upgenia.com";
		  $mail->FromName = "Avisos.CapitalHumano"; //nombre de quien lo mando
		  $mail->Subject = utf8_decode($asunto);  //subjet de mail
		  $mail->MsgHTML(utf8_decode($cuerpo));//body del mail
		  $mail->AddAddress($correo, "Destinatario"); //a quien va dirijida
		  $mail->AddAddress($correorh, "Destinatario"); //a quien va dirijida
		  $mail->IsHTML(true);
		 	 
		  if(!$mail->Send()) {
		   return false;
		  }
                  return true;
                      
                    */ 
     }
 }
?>
