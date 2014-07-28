<?php
include_once("../libs/libs.php");
$funciones= new funciones;
$funciones->conectar();


/*fecha de creaci�n: 20-05-2013*/
function ComboPIdiomas($id) //regresa un combo box con los porcentajes para los idiomas
{
    $combo="<select class='idiomas' id='idiomas$id'>";
    $combo.="<option value='vacio' selected>Porcentaje</option>";
    for($i=0;$i<10;$i++){
        $j=($i+1)*10;
    $combo=$combo."<option value=$j>$j</option>";
    }
    $combo=$combo."</select></span>";
    return $combo;
}

function ComboProyecto() //Realiza la consulta para obtener todos los nombres de los proyectos de la tabla tblProyecto
{
    $query="SELECT idProyecto, nomProyecto FROM tblproyecto WHERE fecBaja is Null"; //Obtiene los nombres de todos los proyectos que tengan null en su campo fecbaja,
                                                                     //es decir los proyectos que estan en desarrollo
    $result="";
    $result=mysql_query($query)or die(mysql_error());
    $nombreCombo="proyec";
    $idCombo="proyec";
    $campos=array();
    $numRegistros=mysql_numrows($result);
    $numCampos=mysql_numfields($result);
    $combo="<select name=$nombreCombo id=$nombreCombo style='width:auto' onchange='cargaSubProyecto();'>";  //$combo guarda el combo box que se va a imprimir en el formulario
    $combo=$combo."<option value='vacio'></option>";
    $j=0;
    $i=0;
    while($registros=mysql_fetch_array($result)) //Mientras no se acaben los registros
    {
          
        $id=$campos[$j][$i]=mb_convert_encoding($registros[0], "UTF-8"); //id de los proyectos
        $campos[$j][$i+1]=mb_convert_encoding($registros[1], "UTF-8"); //nombre de los proyectos
        $combo=$combo."<option id='proyecto' value=$id>".$campos[$j][$i+1]."</option>";
        $i++;
    }
    $combo=$combo."</select>";
   return $combo;
}

function ComboSubproyecto($idProyecto) //Realiza la consulta para obtener todos los nombres de los proyectos de la tabla tblProyecto
{
    $query="SELECT * FROM tblsubproyecto WHERE fecBaja is Null and idProyecto=$idProyecto"; //Obtiene los nombres de todos los proyectos que tengan null en su campo fecbaja,
    $result=mysql_query($query)or die(mysql_error());
    $combo="<label>Subproyecto:</label><br/><select name='subproyecto' id='subproyecto' style='width:auto' onchange=''>";  //$combo guarda el combo box que se va a imprimir en el formulario
    $combo=$combo."<option value=-1></option>";
    while($registros=mysql_fetch_array($result)) //Mientras no se acaben los registros
    {
        $combo=$combo."<option value=".$registros['idSubproyecto'].">".$registros['nomSubproy']."</option>";
    }
    $combo=$combo."</select><br>
        <label>Lider de Proyecto:</label><br>
        <input type='text' id='liderProyecto' style='width:290px;'>";
   return $combo;
}
function GenComboBox($result,$nombreCombo,$idCombo) //Genera y retorna un combo Box con los par�metros mandados
{
    $resultado=$result;
    $campos=array();
    $numRegistros=mysql_numrows($resultado);
    $numCampos=mysql_numfields($resultado);
    $combo="<select name='.$nombreCombo.' id='.$idCombo.'>";  //$combo guarda el combo box que se va a imprimir en el formulario
    $combo=$combo."<option value='vacio'></option>";
    $i=0;
    while($registros=mysql_fetch_array($resultado))
    {
          
          for($j=0;$j<$numCampos;$j++)
          {
            $campos[$j]=mb_convert_encoding($registros[$j], "UTF-8");;
            $combo=$combo."<option value='valor '>"."$campos[$j]"."</option>";
            //echo $campos[$j];
          }
          $i++;
    }
     $combo=$combo."</select>";
     return $combo;
    
}
/*
 *Nombre del M�dudlo: GenFolios
 *Par�metros:--
 *Funci�n: Genera los folios para las solicitudes de puestos con el siguiente formaro "a�omesconsecutivo" ej.=1305001
 *Fecha: 21-05-2013
 *Realiz�: Jes�s Abel Vera Cruz
 */
function GenFolios()
{
   $agno=date("y"); //obtiene los dos �ltimos digitos del a�o ej: 99,99,...,13,14,15
   $mes=date("m");  //obtiene los el mes en dos digitos ej:01,02,03,...,12
    $query="SELECT folsolici FROM tblSolicitud"; //Obtiene todos los folios de de la tabla solcitudes                                               
    $result="";
    $result=mysql_query($query)or die(mysql_error());
    $numRegistros=mysql_numrows($result); //obtenemos el n�mero de registros
    $numRegistros+=1; //le sumamos uno al n�mero de registros asi cuando la tabla este vacia aqui generamos el registro 001
    $consecutivo=str_pad($numRegistros,3,"0",STR_PAD_LEFT); //funci�n para formatear un n�mero le coloca 2 digitos a la izquierda de $numRegistros
    $folio=$agno.$mes.$consecutivo; //concatenamos las tres partes del folio
    return $folio;
}

function comboLugares(){
    $query="Select * from tbllugares";
    $result=  mysql_query($query) or die(mysql_error());
        echo '<select id="lugarTrabajo">
                  <option value=-1></option>';
    while($lugar=  mysql_fetch_array($result)){
            echo '<option value='.$lugar['idlugar'].'>'.$lugar['titulolugar'].'</option>';
    }
        echo '</select>';
}
function comboEstatus(){
    $query="SELECT * FROM tblstaent;";
    $result=  mysql_query($query) or die(mysql_error());
        echo '<select id="staent">
                  <option value=-1>Seleccionar estatus...</option>';
    while($res=  mysql_fetch_array($result)){
            echo '<option value='.$res['idStaEnt'].'>'.$res['descEstatus'].'</option>';
    }
        echo '</select>';
}
/*
 *Nombre del M�dulo: altaSolicitud
 *Par�metros:folio. le mandamos todos los datos que se se van a insertar en la tabla tblsolicitud 
 *Funci�n:Crea una consulta tipo insert con todos los datos enviados por el archivo  procesaSoli.php y si hace hizo la inserci�n envia un correo al gerete de operaciones avisando
 *que se tiene una nueva Requisici�n de Personal
 *Fecha: 27-05-2013
 */
function altaSolicitud($folio, $idSubproyecto,$liderProyecto, $tipoVacante, $inicioDSolici, $finDSolici, $idPerfil, $numVacantes, $diasTrabajo,
                       $horaTrabajo,$fechaRequi, $lugarTrabajo, $salarioMin, $salarioMax, $otrasPercep,$idioma1, $pHablado1, $pEscrito1, $idioma2,$pHablado2,$pEscrito2, $idioma3, $pHablado3,$pEscrito3, $idioma4,$pHablado4,$pEscrito4, $viajar, $frecueViajar,
                       $comentario,$descActividades,$estatus,$usuario)
{
    include_once("../libs/mail.php");
    $mail=new mail();
  
    mysql_query("SET NAMES 'utf8'");
    $query="INSERT INTO tblsolicitud values($folio, $idSubproyecto,'$liderProyecto', $tipoVacante, $inicioDSolici, $finDSolici, $idPerfil, $numVacantes, $diasTrabajo,
                       $horaTrabajo,$fechaRequi, $lugarTrabajo, $salarioMin, $salarioMax, $otrasPercep,$idioma1, $pHablado1, $pEscrito1, $idioma2,$pHablado2,$pEscrito2, $idioma3, $pHablado3,$pEscrito3, $idioma4,$pHablado4,$pEscrito4, $viajar, $frecueViajar,
                       $comentario,'$descActividades',$estatus,$usuario,now(),null)";
    $result=mysql_query($query)or die(mysql_error());
    if($result){
        
        $mailGerente="SELECT mailUsuario FROM tblusuarios WHERE idRol=3";
        $result=mysql_query($mailGerente) or die(mysql_error());
        $mensaje="Se ha dado de alta una nueva solicitud de vacantes, con el folio $folio, por favor ingrese al sistema para aceptar o rechazar las nuevas solicitudes";
        $subject="Nueva solicitud de personal";
        $correo=mysql_result($result,0,'mailUsuario');
        
        $sqlCorreorh="select mailUsuario from tblusuarios where idRol=2";
        $queryCorreo = mysql_query($sqlCorreorh) or die(mysql_error());
        $correorh=  mysql_fetch_array($queryCorreo);
        
                
        if($mail->enviarMail($correo, $mensaje, $subject, $correorh['mailUsuario']))
        {
            echo "ok";
        }else{
        echo "No se envío el correo";
        }
		
		 //echo "ok";
        
    }
}
?>