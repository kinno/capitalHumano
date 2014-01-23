<?php
include"../libs/libs.php";
$funciones= new funciones; //CREA UN NUEVO OBJETO DE LA CLASE FUNCIONES
$funciones->conectar(); //EJECUTA EL MÉTODO CONECTARSE
$folio=$_GET['ids'];
$SESION=$_GET['SES'];
$sqlB="select * from tblsolicitud where folSolici=".$folio; //HACE UNA CONSULTA A LA TABLA  
$queryB=mysql_query($sqlB) or die(mysql_error()); //EJECUTA LA CONSULTA
$solicitud = mysql_fetch_array($queryB);

   //obteniendo los datos del catálogo de perfiles
   $sqlPerf="SELECT descPerfil, funcPerfil, perfPerfil, habPerfil, conocPerfil FROM tblperfil WHERE idPerfil=".$solicitud['idPerfil']." and fecbaja is null";
   $resulPerf=mysql_query($sqlPerf) or die (mysql_error());
$pfl=  mysql_fetch_array($resulPerf);   
   
//Nombre del proyecto
$sqlP="SELECT nomProyecto, nomSubproy FROM tblproyecto pry
join tblsubproyecto sub on pry.idProyecto = sub.idProyecto
where sub.idSubproyecto=".$solicitud['idSubproyecto']."";
$resulProy=mysql_query($sqlP) or die (mysql_error());
$datosProy=  mysql_fetch_array($resulProy);
//Nombre del usuario
$sqlU="SELECT nomUsuario, appUsuario, apmUsuario FROM tblusuarios WHERE idUsuario=".$solicitud['idUsuario'];
$resulUsu=mysql_query($sqlU) or die (mysql_error());
$nomUsuario=mysql_result($resulUsu,0, 'nomUsuario')." ".mysql_result($resulUsu,0, 'appUsuario')." ".mysql_result($resulUsu,0, 'apmUsuario');

$sqlLugar = "select titulolugar,direccionlugar from tbllugares lug
join tblsolicitud sol on lug.idlugar = sol.idlugar where sol.idlugar=".$solicitud['idlugar']."";
$resulLugar=mysql_query($sqlLugar) or die (mysql_error());
$place=  mysql_fetch_array($resulLugar);

switch($solicitud['tipSolici']){
    case "1":
        $vacante="Nuevo";
        break;
    case "2":
        $vacante="Remplazo";
        break;
    default:
        $vacante="Temporal";
        break;
}

if($solicitud['viajSolic']==0)
    $viaj = "No";
else
    $viaj = "Si".$solicitud['freVSolici'];

$idiomas="";
    if($solicitud['idioma1']==1){
        $idiomas=$idiomas."Inglés (Hablado: ".$solicitud['pHablado1']."% , Escrito: ".$solicitud['pEscrito1']."<br>";
    }
    if($solicitud['idioma2']==1){
        $idiomas=$idiomas."Francés (Hablado: ".$solicitud['pHablado2']."% , Escrito: ".$solicitud['pEscrito2']."<br>";
    }
    if($solicitud['idioma3']==1){
        $idiomas=$idiomas."Inglés (Hablado: ".$solicitud['pHablado3']."% , Escrito: ".$solicitud['pEscrito3']."<br>";
    }
    if($solicitud['idioma4']==1){
        $idiomas=$idiomas."Francés (Hablado: ".$solicitud['pHablado4']."% , Escrito: ".$solicitud['pEscrito4']."<br>";
    }

    

echo "
    <script type='text/javascript' language='javascript' src='../../js/funcionesSolicitudes.js'></script>";
echo"<center>";
echo'
  <h2>REQUISICION DE PERSONAL N° <input type="text" name="folio" readonly="readonly" id="folio" value="'.$folio.'" /></h2> 
  <div id="solicitudTab">
  
    <ul>
        <li><a href="#hoja1">Datos generales</a></li>
        <li><a href="#hoja2">Descripción del puesto</a></li>
        <li><a href="#hoja3">Requisitos del puesto</a></li>
    </ul>
   
          <div id="hoja1">
           <table>
                <tr align="center">    
                   <td>
                    <label for="proyecto">Proyecto:</label><br>
                    <input type="text" name="proyecto" readonly="readonly" id="proyecto" size="30" value="'.$datosProy['nomProyecto'].'" />
                   </td>
                </tr>
                <tr align="center">
                    <td>
                    <label for="proyecto">Subproyecto:</label><br>
                    <input type="text" name="proyecto" readonly="readonly" id="proyecto" size="30" value="'.$datosProy['nomSubproy'].'" />
                   </td>
                </tr>
                <tr align="center">
                   <td>
                    <label for="lider">Lider del Proyecto:</label><br>
                    <input type="text" name="lider" readonly="readonly" id="lider" size="30" value="'.$solicitud['liderProyecto'].'"/>
                   </td>                    
                </tr>
                <tr align="center">
                  <td>
                    <label for="vacante">Tipo Vacente:</label><br>
                    <input type="text" name="vacante" readonly="readonly" id="vacante"  value="'.$vacante.'" />
                  </td>
                </tr>  
               <tr align="center">   
                  <td>
                    <label for="duracion">Duración del Puesto:</label><br>
                    De: <input type="text" name="duracion" readonly="readonly" id="duracion" value="'.$solicitud['inicioDSolici'].'" /> A: <input type="text" name="duracion" readonly="readonly" id="duracion" value="'.$solicitud['finDSolici'].'" />
                  </td>
                </tr>
           </table>
          </div>

        <div id="hoja2">
                <p>
                  <label for="nombrePuesto">Puesto:</label>
                  <input type="text" name="nombrePuesto" readonly="readonly" id="nombrePuesto" size="50" value="'.$pfl['descPerfil'].'" />
                </p>
                <p>
                  <label for="nVacante">Número de Puestos:</label>
                  <input type="text" name="nVacante" readonly="readonly" id="nVacante" size="4" value="'.$solicitud['numVSolici'].'" />
                  <label for="dias">Jornada Laboral:</label>
                  <input type="text" name="dias" readonly="readonly" id="dias" style="width:350px;" value="'.$solicitud['diasSolici'].'" />
                  <label for="dTrabajo">Horario Laboral:</label>
                  <input type="text" name="dTrabajo" readonly="readonly" id="dTrabajo" size="30" value="'.$solicitud['horSolici'].'" />
                </p>
                <p>
                <label for="lugarTrabajo">Lugar del Trabajo:</label><br/>
                  <textarea name="lugarTrabajo" id="lugarTrabajo" readonly="readonly"  class="area" cols="50" rows="1">'.$place['titulolugar'].'</textarea><br>
                  <label for="direccionTrabajo">Dirección:</label><br/>
                  <textarea name="direccionTrabajo" id="direccionTrabajo" readonly="readonly"  class="area" cols="100" rows="2">'.$place['direccionlugar'].'</textarea>
                </p>
                <p>
                  <label for="rSalarial">Rango Salarial:</label>
                  <input type="text" name="rSalarial" readonly="readonly" id="rSalarial" value="$'.$solicitud['minSolici'].' a $'.$solicitud['maxSolici'].'" />
                  <label for="otrPerc">Otras Percepciones:</label>
                  <input type="text" name="otrPercep" readonly="readonly" id="otrPercep" value="'.$solicitud['otrPSolici'].'" />
                  <label for="fechaRequi">Fecha en que se Requiere:</label>
                  <input type="text" name="fechaRequi" readonly="readonly" id="fechaRequi" style="width:130px;" value="'.$solicitud['iniSolici'].'" />
                </p>

            </div>
    
          <div id="hoja3">
          <table >
            <tr>
                <td>
                    <label for="escoyExpe">Escolaridad y Experiencia:</label><br/>
                    <textarea name="escoyExpe" id="escoyExpe" readonly="readonly" class="area" rows="7" cols="70">'.$pfl['perfPerfil'].'</textarea>
                </td>
                <td>
                    <label for="conocimientos">Conocimientos:</label><br/>
                    <textarea name="conocimientos" id="conocimientos" readonly="readonly" class="area" rows="7" cols="70">'.$pfl['conocPerfil'].'</textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="habilidades">Habilidades:</label><br/>
                    <textarea name="habilidades" id="habilidades" readonly="readonly" class="area" rows="7" cols="70">'.$pfl['habPerfil'].'</textarea>
                </td>
                <td>
                    <label for="descActividades">Descripción de Actividades:</label><br/>
                    <textarea name="descActividades" id="descActividades" readonly="readonly" class="area" rows="7" cols="70">'.$solicitud['descActividades'].'</textarea>
                </td>
            </tr>
            <tr>
                <td>
                <table align="center">
                        <tr>
                          <td><span><label for="reqViajar">¿Requiere Viajar?:</label></td>
                          <td><textarea name="reqViajar" readonly="readonly" id="reqViajar" class="area" rows="1" cols=33">'.$viaj.'</textarea></td>
                          
                        </tr>
                        <tr>
                        <td><span><label for="idiomas">Idiomas:</label></td>
                           <td><textarea name="idiomas" readonly="readonly" id="idiomas" class="area" rows="7" cols="33">'.$idiomas.'</textarea></td>
                        </tr>
                    </table>
                </td>
                <td colspan="2">
                <center>
                 <label for="comentarios">Comentarios:</label><br/>
                <textarea name="comentarios" id="comentarios" readonly="readonly" class="area" rows="7" cols="70">'.$solicitud['textSolici'].'</textarea>
                </center>
                </td>
            </tr>
         </table>         
         </div>
</div>';
echo"<tr>
      <td colspan='3' ><div id='res'></div></td>
    </tr>";
echo"</table>";
$botGteOp="<table>
    <tr>
      <td><button id='aceptar' onclick='aceptarSolicitud();'>Aceptar</button></td>
      <td><button id='rechazar' onclick='rechazarSolicitud();'>Rechazar</button></td>
      </tr>
     </table>
     ";
$botGteRH="";
if($SESION==1){
    echo $botGteOp;
}else{
  echo $botGteRH;
}
echo"</center>";
?>