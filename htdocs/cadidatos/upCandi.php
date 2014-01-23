<?php 
header("Content-Type: text/html;charset=utf-8");
include "libs/libs.php";
?>

<script type="text/javascript" src='js/librerias.js'></script>
<script type="text/javascript" src='../js/libs.js'></script>
<script>

//*********************************************************************                 
$(document).ready(function()
{

    $('#close').click(function() {
        $('.overlay-container').fadeOut().end().find('.window-container').removeClass('window-container-visible');
    });

    $('#btnEliminar').click(function()
      {
        $.ajax({
          type:'post',
          url:'candi.php',
          data:{
            idC: $('#idCan').val(),
            accion : 'E'
            },
            success:function(data)
            {
              $('#resultado_ok').html(data);
            },
            error: function()
            {
              alert('Ocurrio un Erro a Eliminar el dato');
            }
        });

      });


    $('#btnGuardar').click(function()
      {


        var cIdi0,cIdi1,cIdi2,cIdi3;
        var sIdi0,sIdi1,sIdi2,sIdi3;

            if($('#idiomas_0').is(':checked'))
            {
                 
               cIdi0='on';
               sIdi0=$('#idiomas1').val();
            
                
            }
            else
            {
               
                cIdi0='off';
                sIdi0='';
                

            }

            if($('#idiomas_1').is(':checked'))
            {
                
                
               cIdi1='on';
               sIdi1=$('#idiomas2').val();
               

            }
            else
            {
               
                 cIdi1='off';
                 sIdi1='';
                
            }

            if($('#idiomas_2').is(':checked'))
            {
                
               cIdi2='on';
               sIdi2=$('#idiomas3').val();
            }
            else
            {
               
                 cIdi2='off';
                 sIdi2='';
              
            }

            if($('#idiomas_3').is(':checked'))
            {
                 
                 
                
               cIdi3='on';
               sIdi3=$('#idiomas4').val();
           

            }
            else
            {
              
                 cIdi3='off';
                 sIdi3='';
                
            }        

    //GMM001 - Se valida Nombre y apellidos
    if($('#txtname').val()== '')
    {
        $('#resultado').text('Verifica el nombre se encuentra vacío');
        $('#txtname').focus();
        return false;
    }
    else if($('#txtname').val().length < 3)
    {
       $('#resultado').text('Verifica el nombre debe tener minimo 3 caracteres');
        $('#txtname').focus();
        return false;
    }
    else if($('#txtname').val().length >= 50)
    {
       $('#resultado').text('Verifica el nombre sobre pasa numero de caracteres permitidos');
        $('#txtname').focus();
        return false;
    }
    else  if($('#txtapp').val()== '')
    {
        $('#resultado').text('Verifica el Apellido Paterno se encuentra vacío');
        $('#txtapp').focus();
        return false;
    }
    else if($('#txtapp').val().length < 3)
    {
       $('#resultado').text('Verifica el Apellido Paterno debe tener minimo 3 caracteres');
        $('#txtapp').focus();
        return false;
    }
    else if($('#txtapp').val().length >= 50)
    {
       $('#resultado').text('Verifica el Apellido Paterno  sobre pasa numero de caracteres permitidos');
        $('#txtapp').focus();
        return false;
    }
    else  if($('#txtapm').val()== '')
    {
        $('#resultado').text('Verifica el Apellido Materno se encuentra vacío');
        $('#txtapm').focus();
        return false;
    }
    else if($('#txtapm').val().length >= 50)
    {
       $('#resultado').text('Verifica el Apellido Materno  sobre pasa numero de caracteres permitidos');
        $('#txtapm').focus();
        return false;
    }
    else if($('#txtapm').val().length < 3)
    {
       $('#resultado').text('Verifica el Apellido Materno debe tener minimo 3 caracteres');
        $('#txtapm').focus();
        return false;
    }
    //GMM001 - Validar Genero
    else if($('#txtgenero').val() == 0)
    {
       $('#resultado').text('Selecciona un genero');
        $('#txtgenero').focus();
        return false;
    }
    else if($('#anio').val() == 0)
    {
        $('#resultado').text('Selecciona un año');
        $('#anio').focus();
        return false;

    }
    else if($('#mes').val() == 0)
    {
        $('#resultado').text('Selecciona un mes');
        $('#mes').focus();
        return false;

    }
    else if($('#dia').val() == 0)
    {
        $('#resultado').text('Selecciona un dia');
        $('#dia').focus();
        return false;       

    }
    //GMM001 - Validar fecha, dia mes año
    else if(Validafecha(parseInt($('#anio').val()),parseInt($('#mes').val()),parseInt($('#dia').val())) == false)
    {
        $('#resultado').text('Feha no valida, revise mes y dia');
        $('#dia').focus();
        return false;        
    }  
    else if($('#Estado').val() == 0)
    {
    $('#resultado').text('Selecciona un Estado');
        $('#Estado').focus();
        return false;
    }
    else if($('#Municipio').val() == 0)
    {
    $('#resultado').text('Selecciona un Municipio');
        $('#Municipio').focus();
        return false;
    }
    else if($('#CodigoP').val() == '')
    {
    $('#resultado').text('Verifica el Codigo Postal');
        $('#CodigoP').focus();
        return false;
    }
    else if($('#Colonia').val() == 0)
    {
    $('#resultado').text('Selecciona una Colonia');
        $('#Colonia').focus();
        return false;
    }    
    //Validar Domicilio
    else if($('#domi').val()== '')
    {
        $('#resultado').text('Verifica domicilio se encuentra vacío');
        $('#domi').focus();
        return false;
    }    
    else if($('#domi').val().length < 3)
    {
       $('#resultado').text('Verifica el domicilio debe tener minimo 3 caracteres');
        $('#domi').focus();
        return false;
    }
    else if($('#domi').val().length >= 200)
    {
       $('#resultado').text('Verifica el domicilio sobre pasa numero de caracteres permitidos');
        $('#domi').focus();
        return false;
    }
    //GMM001 - Los telefonos pueden ser nulos, Validar que al menos se capture uno
    else if($('#celu').val()== '' && $('#tel').val()== ''){
        $('#resultado').text('Capture por lo menos un telefono');
        $('#celu').focus();
        return false;        
    }      

    else if(ValidaTelefono($('#celu').val()) == false && $('#celu').val()!= '')
    {
        $('#resultado').text('Verifica el numero Celular no cumple con la estructura');
        $('#celu').focus();
        return false;

    }
    else if(ValidaTelefono($('#tel').val()) == false && $('#tel').val()!= '')
    {
        $('#resultado').text('Verifica el numero Telefono no cumple con la estructura');
        $('#tel').focus();
        return false;
    }
    else if(Validacorreo($('#mail').val()) == false)
    {
        $('#resultado').text('Verifica el Correo no cumple con la estructura');
        $('#mail').focus();
        return false;

    }
    else if($('#trAc').val() == 0)
    {
        $('#resultado').text('Selecciona si trabaja  Actualmente ');
        $('#trAc').focus();
        return false;
    }
    else if($('#escola').val() == 0)
    {
        $('#resultado').text('Selecciona Escolaridad');
        $('#Escola').focus();
        return false;
    }
    else if($('#nivE').val() == 0)
    {
        $('#resultado').text('Selecciona el nivel de Estudios');
        $('#nivE').focus();
        return false;
    }
    //Validar Otros Estudios y certificaciones
    else if($('#OtrEs').val().length >= 200)
    {
       $('#resultado').text('Verifica otros estudios maximo 200 carecteres');
        $('#OtrEs').focus();
        return false;
    }
    else if($('#txtPre').val()=='')
    {
        $('#resultado').text('Verifica tus pretensiones economicas');
        $('#txtPre').focus();
        return false;
    
    }
    else if(ValDecimal($('#txtPre').val())==false)
    {
    $('#resultado').text('Verifica estructura pretensiones economicas');
        $('#txtPre').focus();
        return false;
    }
    else if($('#Cono').val() == '')
    {
        $('#resultado').text('Verifica tus Conocimiento');
        $('#Cono').focus();
        return false;
    }
    else if(ValidaText($('#Cono').val())==false)
    {
    $('#resultado').text('Verifica el areas de Conocimientos no cumple con formato');
        $('#Cono').focus();
        return false;
    }
    
    else if($('#ArIn').val() == '')
    {
        $('#resultado').text('Verifica tus areas de interes');
        $('#ArIn').focus();
        return false;
    }
    else if(ValidaText($('#ArIn').val())==false)
    {
    $('#resultado').text('Verifica el areas de interes no cumple con formato');
        $('#ArIn').focus();
        return false;
    }
    
    else if($('#ArEx').val() == '')
    {
        $('#resultado').text('Verifica tus areas de experiencia');
        $('#ArEx').focus();
        return false;
    }
    else if(ValidaText($('#ArEx').val())==false)
    {
    $('#resultado').text('Verifica el areas de experiencia no cumple con formato');
        $('#ArEx').focus();
        return false;
    }
    else if($('#disV').val() == 0)
    {
    $('#resultado').text('Selecciona disponibilidad a viajar');
        $('#disV').focus();
        return false;
    }
    else if($('#staC').val() == 0)
    {
        $('#resultado').text('Selecciona Estatus del candidato');
        $('#staC').focus();
        return false;
    }
    else if($('#Direc').val().length >= 500)
    {
        $('#resultado').text('Verifica directorio, maximo 500 carecteres');
        $('#Direc').focus();
        return false;
    }    
    else
    {   
        $('#resultado').text('');        
        $.ajax(
            {
                type:'post',
                url:'candi.php',
                data:{
                    idC: $('#idCan').val(),
                    nombreC:$('#txtname').val(),
                    appC:$('#txtapp').val(),
                    apmC:$('#txtapm').val(),
                    generoC:$('#txtgenero').val(),
                    anioC:$('#anio').val(),
                    mesC:$('#mes').val(),
                    diaC:$('#dia').val(),
                    estadoC:$('#Estado').val(),
                    muniC:$('#Municipio').val(),
                    cpC:$('#CodigoP').val(),
                    coloniaC:$('#Colonia').val(),
                    domiC:$('#domi').val(),
                    celuC:$('#celu').val(),
                    telC:$('#tel').val(),
                    mailC:$('#mail').val(),
                    trabajoAcC:$('#trAc').val(),
                    escolaC:$('#escola').val(),
                    nivelEsC:$('#nivE').val(),
                    otroEsC:$('#OtrEs').val(),
                    idio0C:cIdi0,
                    idi0VP:sIdi0,
                    idio1C:cIdi1,
                    idi1VP:sIdi1,
                    idio2C:cIdi2,
                    idi2VP:sIdi2,
                    idio3C:cIdi3,
                    idi3VP:sIdi3,
                    preteC:$('#txtPre').val(),
                    conoC:$('#Cono').val(),
                    areainC:$('#ArIn').val(),
                    arexpC:$('#ArEx').val(),
                    dispoviajeC:$('#disV').val(),
                    statusC:$('#staC').val(),
                    direcC:$('#Direc').val(),
                    accion:'M'
                },
                success:function(data)
                {
                    $('#resultado_ok').html(data);   

                },
                error:function()
                {
                    alert('Ocurrio Un error al Guardar los datos');
                }


            });
    }
      });
      
    //Si cambia Estado, Actualiza ComboMunicipio y ComboColonias y limpia CP
	//Si cambia Estado, Actualiza ComboMunicipio y ComboColonias y limpia CP
  $('#Estado').change(function () {
        $('#Estado option:selected').each(function (){
          elegido=$(this).val();          
          intMunicipio=$(this).val();

          //Se Actualiz Combo Municipio         
          $.post('libs/cbo_municipio.php', { elegido: elegido }, function(data){
            $('#Municipio').html(data);           
          });     
      //Se Actualiza Combo Colonia
      $.post('libs/cbo_colonia.php', {elegido:elegido, municipio:intMunicipio}, function(data){
            //alert(data);
            $('#Colonia').html(data);
            $('#CodigoP').val('');            
          });                   
        });
    });
  
  //Si cambia Municipio, Actualiza Combo Colonias y limpia CP   
  $('#Municipio').change(function () {
        $('#Municipio option:selected').each(function (){
          //Se Actualiz Combo Colonia
          intMunicipio=$(this).val();
          intEstado= $('#Estado').val();     
          $.post('libs/cbo_colonia.php', {elegido:intEstado, municipio:intMunicipio}, function(data){
            //alert(data);
            $('#Colonia').html(data);
            $('#CodigoP').val('');            
          });                   
        });
  });

  //Si cambia CP, Actualiza combo Colonias, Estado y Municipio
  $('#CodigoP').change(function () {        
        cp=$(this).val();
        tipo='cbo_colonia';

        //Se Actualiza Combo Colonias
        $.post('libs/act_cp.php', {cp:cp, tipo:tipo}, function(data){
          //alert(data);
        $('#Colonia').html(data);        
        });    

        //Se actualiza Estado
    tipo='act_estado';                  
    $.post('libs/act_cp.php', {cp:cp, tipo:tipo}, function(data){
          //alert(data);
        $('#Estado').html(data);         
        });    

    //Se actualiza Municipio
    tipo='act_municipio';                 
    $.post('libs/act_cp.php', {cp:cp, tipo:tipo}, function(data){         
        $('#Municipio').html(data);        
        });    

   });

  //Si cambia Colonia, Actualiza CP   
  $('#Colonia').change(function () {
        $('#Colonia option:selected').each(function (){
          intColonia=$(this).val();
          intMunicipio=$('#Municipio').val();
          intEstado=$('#Estado').val();         
          $.post('libs/act_codigo.php', {edo:intEstado , mun:intMunicipio, col:intColonia}, function(data){
            //alert(data);
            $('#CodigoP').val(data);          
          });                   
        });
    });
	
	

	 });

	
 </script>

<?php
$idC=$_GET['idC'];
//include "libs/libs.php";
$funciones= new funciones;
$funciones->conectar();

$sqlS="select * from tblcandidato where idCandid=".$idC;
$queryS=mysql_query($sqlS)or die('no se ejecuta la selccion');
$r=mysql_fetch_array($queryS);

//----------------------------------------------------------   
echo"
<center>
    <form id='formulario'>    
        <input type='hidden' value='".$idC."' id='idCan'>
        <table width='100%'>
           <tr>
                <td width='25%'>Nombre</td>
                <td width='25%'>Apellido Paterno</td>
                <td width='25%'>Apellido Materno</td>
                <td width='25%'>Genero</td>
            </tr>
            <tr>
                <td width='25%'><input type='text' name='txtname' id='txtname' class='texto' onkeypress='return soloLetras(event)' value='".mb_convert_encoding($r['nomCandid'], "UTF-8")."'></td>
                <td width='25%'><input type='text' name='txtapp' id='txtapp' class='texto' onkeypress='return soloLetras(event)' value='".mb_convert_encoding($r['appCandid'], "UTF-8")."'></td>
                <td width='25%'><input type='text' name='txtapm' id='txtapm' class='texto' onkeypress='return soloLetras(event)' value='".mb_convert_encoding($r['apmCandid'], "UTF-8")."'></td>
                <td width='25%'>
                    <select id='txtgenero' name='txtgenero' class='sel'>";
                        if($r['genCandid']=='M')
                        {
                            echo"
                            <option value='M'>Masculino</option>
                                <option value='F'>Femenino</option>
                            ";
                        }
                        else
                        {
                         echo"
                            <option value='F'>Femenino</option>
                            <option value='M'>Masculino</option>
                        ";
                        }     
                         echo"  
                    </select>
                </td>
            </tr>
            <tr >
                <td width='25%'>Fecha Nacimiento </td>
                <td width='25%'>Telefono</td>
                <td width='25%'>Celular</td>
                <td width='25%'>Correo</td>
            </tr>                      
            <tr>
                <td width='25%'>";
                        $fEx=explode('-', $r['fecNCandid']);
                        echo"<select id='anio' class='sel_anio' name='anio'>";     
                        echo"<option value='".$fEx[0]."'>".$fEx[0]."</option>";
                        $val='';
                        $funciones= new funciones;
                        $funciones->arrayAnio($val);
                    echo"</select>";

                    $mes=array('01','02','03','04','05','06','07','08','09','10','11','12');
                         echo"<select id='mes' class='sel_fec' name='mes'>";
                            echo"<option value='".$fEx[1]."'>".$fEx[1]."</option>";
                    foreach ($mes as $mes1) 
                    {
                        echo"<option value='".$mes1."'>".$mes1."</option>";
                    }
                        echo"</select>";
                        $dias=array('01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31');
                        echo"<select name='dia' id='dia' class='sel_fec'>";
                        echo"<option value='".$fEx[2]."'>".$fEx[2]."</option>";
                        foreach($dias as $dias1)
                        {
                            echo"<option value='".$dias1."'>".$dias1."</option>";
                        }
                    echo"</select>";        
                echo"
                </td>
                <td width='25%'><input type='text' name='tel' id='tel' class='texto' onkeypress='return SoloTelefono(event)' value='".mb_convert_encoding($r['telCandid'], "UTF-8")."'></td>
                <td width='25%'><input type='text' name='celu' id='celu' class='texto' onkeypress='return SoloTelefono(event)' value='".mb_convert_encoding($r['celCandid'], "UTF-8")."'> </td>
                <td width='25%'><input type='mail' name='mail' id='mail' class='texto' value='".mb_convert_encoding($r['mailCandid'], "UTF-8")."'></td>        
            </tr>
            <tr >
                <td width='25%'>Dirección</td>
                <td width='25%'></td>
                <td width='25%'></td>
                <td width='25%'></td>
            </tr>
            <tr>
                <td colspan='2'>
                    <input name='domi' type='text' class='texto_largo' id='domi' size='68' onkeypress='return SoloTextos(event)' value='".mb_convert_encoding($r['domCandid'], "UTF-8")."'>
                </td>
                <td colspan='2'>
                </td>
            </tr>
            <tr >
                <td width='25%'>Estado</td>
                <td width='25%'>Municipio</td>
                <td width='25%'>CodigoP</td>
                <td width='25%'>Colonia</td>
            </tr>
            <tr >
                <td>
                    <select name='Estado' id='Estado' class='sel'>";
                    $val=$r['id_entidad'];
                    $funciones= new funciones;
                    $funciones->comboEstados($val);
                    echo"</select>";
                echo"       
                </td>                    
                <td>
                    <select name='Municipio' id='Municipio' class='sel'>";
                    $sqlM="select * from municipio where id_entidad=".$r['id_entidad']. " && id_municipio=".$r['id_municipio'];
                    $queryM=mysql_query($sqlM)or die('no se ejecuta municipios');
                    $P=mysql_fetch_array($queryM);
                    echo"<option value='".mb_convert_encoding($r['id_municipio'], "UTF-8")."'>".mb_convert_encoding($P['nombre_municipio'], "UTF-8")."</option>";
                    echo"</select>";                     
                echo"
                </td>
                    <td><input type='text' class='texto' name='CodigoP' id='CodigoP' onkeypress='return soloNumeros(event)' value='".mb_convert_encoding($r['idCP'], "UTF-8")."'></td>
                <td>
                    <select name='Colonia' id='Colonia' class='sel'>";
                    $sqlC="select * from codigo_postal where cp=".$r['idCP']. " && id_colonia=".$r['id_colonia']. "&& id_entidad=".$r['id_entidad']. " && id_municipio=".$r['id_municipio'];
                    $queryC=mysql_query($sqlC)or die('no se ejecuta municipioos');
                    $C=mysql_fetch_array($queryC);
                    echo"<option value='".$C['id_colonia']."'>".mb_convert_encoding($C['nombre_colonia'], "UTF-8")."</option>";
                    echo"</select>";                      
                echo"
                </td>
            </tr>        
            <tr >
                <td width='25%'>Pretensiones económicas</td>
                <td width='25%'>Status Candidato</td>
                <td width='25%'></td>
                <td width='25%'></td>
            </tr>
            <tr>
                <td><input type='text' name='txtPre' id='txtPre' class='texto' onkeypress='return SoloDecimal(event)' value='".$r['pretCandid']."'></td>
                <td>
                    <select id='staC' class='sel' name='staC'>";
                    if($r['statCandid']==1)
                    {
                        echo"<option value='1'>Si</option>
                        <option value='2'>No</option>";
                    }
                    else
                    {
                    echo"
                     <option value='2'>No</option>
                    <option value='1'>Si</option>";

                    }
                echo"
                </td>
                <td width='25%'></td>
                <td width='25%'></td>
            </tr>            
            <tr >
                <td width='25%'>Trabaja Actualmente</td>
                <td width='25%'>Escolaridad</td>
                <td width='25%'>Nivel de estudios</td>
                <td width='25%'>¿Dispuesto a viajar?</td>
            </tr>
            <tr >
                <td>
                    <select id='trAc' class='sel' name='trAc'>";
                    if($r['trabCandid']==1)
                    {
                        echo" <option value='".$r['trabCandid']."'>Si</option>";
                        echo" <option value='2'>No</option>";
                    }
                    else
                    {
                        echo" <option value='".$r['trabCandid']."'>No</option>
                        <option value='1'>Si</option>";              
                    }
                    echo" 
                    </select>
                </td>
                <td>";
                    $sqlSe="select * from tblescolar where idEscolar !=".$r['idEscolar'];
                    $querySe=mysql_query($sqlSe) or die("No se ejecuta escolaridad");

                    $sqlSe1="select * from tblescolar where idEscolar =".$r['idEscolar'];
                    $querySe1=mysql_query($sqlSe1) or die("No se ejecuta escolaridad");
                    $res=mb_convert_encoding(mysql_result($querySe1,'0','nomEscolar'),"UTF-8");            

                    echo"<select id='escola' name='escola' class='sel'>";
                    echo"<option value='".$r['idEscolar']."'>". $res."</option>";
                    while($rm=mysql_fetch_array($querySe))
                    {
                        echo"<option value='".$rm['idEscolar']."'>".mb_convert_encoding($rm['nomEscolar'], "UTF-8")."</option>";
                    }
                    echo"</select>
                </td>
                <td>";               
                    $nE=array('Trunco','Titulado','Pasante',' Maestría','Doctorado');
                    echo"<select id='nivE' class='sel' name='nivE'>";
                    echo"<option value='".$r['nivCandid']."'>".utf8_encode($r['nivCandid'])." </option>";
                    foreach ($nE as $niv) 
                    {
                        echo"<option value='".$niv."'>".$niv."</option>";
                    }
                    echo"<select>
                </td>
                <td>
                    <select id='disV' class='sel' name='disV'>";
                    if($r['viajCandid']==1)
                    {
                        echo"<option value='1'>Si</option>
                        <option value='2'>No</option>";
                    }
                    else
                    {
                        echo"
                        <option value='2'>No</option>
                        <option value='1'>Si</option>
                        ";
                    }
                    echo"</select>
                </td>
            </tr>
            <tr >
                <td colspan='2'>Idiomas</td>                
                <td colspan='2'>Otros estudios y/o certificaciones</td>                
            </tr>
            <tr >
                <td  colspan='2'>
                    <table>
                        <tr><td>";
      if($r['idimoma1']==1)
      {
        echo"<input type='checkbox' name='idiomas_0' id='idiomas_0' checked onclick=mostrar('ingles');verifCheck(this.id);>Ingles";

      }
      else
      {
        echo"<input type='checkbox' name='idiomas_0' id='idiomas_0'  onclick=mostrar('ingles');verifCheck(this.id);>Ingles";

      }
      
      echo"</td>
      <td>
      ";
      if($r['porIdioma1']!=0)
      {

    $combo="<select class='sel' id='idiomas1'>";
    $combo.="<option value='".$r['porIdioma1']."'>".$r['porIdioma1']."</option>";
    for($i=0;$i<10;$i++){
        $j=($i+1)*10;
    $combo=$combo."<option value=$j>$j</option>";
    //.">".($i+1)*10."</option>";
    }
    $combo=$combo."</select></span>";
echo $combo;

      }else
      {
      echo"<span id='ingles' style='display:none'>";
                 $id=1;
                 $listaPorcent=$funciones->ComboPIdiomas($id);
                 echo $listaPorcent;
            echo"</span>";
           }

       echo"</td>
       </tr>
       <tr>
       <td>";
       if($r['idimoma2']==2)
       {
        echo"<input type='checkbox' name='idiomas_1' id='idiomas_1' checked onclick=mostrar('frances');verifCheck(this.id)>Frances";
       }
       else
       {
          echo"<input type='checkbox' name='idiomas_1' id='idiomas_1' onclick=mostrar('frances');verifCheck(this.id)>Frances";

       }

      echo"
      </td>
      <td>";
        if($r['porIdioma2']!=0)
      {

    $combo="<select class='sel' id='idiomas2'>";
    $combo.="<option value='".$r['porIdioma2']."'>".$r['porIdioma2']."</option>";
    for($i=0;$i<10;$i++){
        $j=($i+1)*10;
    $combo=$combo."<option value=$j>$j</option>";
    //.">".($i+1)*10."</option>";
    }
    $combo=$combo."</select></span>";
echo $combo;

      }else
      {
      echo"<span id='frances' style='display:none'>";
             
                 
         $id=2;
                 $listaPorcent=$funciones->ComboPIdiomas($id);
                 echo $listaPorcent;
             
             
              echo"</span>";
           }
echo"
       </td>
       </tr>
       <tr>
       <td>";

          if($r['idimoma3']==3)
          {

       echo"<input type='checkbox' name='idiomas_2' id='idiomas_2' checked onclick=mostrar('aleman');verifCheck(this.id)>Aleman";

          }
          else
          {
            echo"<input type='checkbox' name='idiomas_2' id='idiomas_2'  onclick=mostrar('aleman');verifCheck(this.id)>Aleman";
          }


       echo"</td>
       <td> <td>";
        if($r['porIdioma3']!=0)
      {

    $combo="<select class='sel' id='idiomas3'>";
    $combo.="<option value='".$r['porIdioma3']."'>".$r['porIdioma3']."</option>";
    for($i=0;$i<10;$i++){
        $j=($i+1)*10;
    $combo=$combo."<option value=$j>$j</option>";
    //.">".($i+1)*10."</option>";
    }
    $combo=$combo."</select></span>";
echo $combo;

      }else
      {
      echo"<span id='aleman' style='display:none;align:left;'>";
             
                 
         $id=3;
                 $listaPorcent=$funciones->ComboPIdiomas($id);
                 echo $listaPorcent;
             
             
              echo"</span>";
           }
echo"
       </td>
      </td>
      </tr>
      <tr>
      <td>";
      if($r['idimoma4']==4)
      {
        echo"<input type='checkbox' name='idiomas_3' id='idiomas_3' checked  onclick=mostrar('portugues');verifCheck(this.id)>Portugues";

      }
      else
      {
         echo"<input type='checkbox' name='idiomas_3' id='idiomas_3' onclick=mostrar('portugues');verifCheck(this.id)>Portugues";
      }
      echo"</td>
      <td>
      ";
        if($r['porIdioma3']!=0)
      {

    $combo="<select class='sel' id='idiomas4'>";
    $combo.="<option value='".$r['porIdioma4']."'>".$r['porIdioma4']."</option>";
    for($i=0;$i<10;$i++){
        $j=($i+1)*10;
    $combo=$combo."<option value=$j>$j</option>";
    //.">".($i+1)*10."</option>";
    }
    $combo=$combo."</select></span>";
echo $combo;

      }else
      {
      echo"<span id='portugues' style='display:none'>";
             
                 
         $id=4;
                 $listaPorcent=$funciones->ComboPIdiomas($id);
                 echo $listaPorcent;
             
             
              echo"</span>";
           }
echo"
    </td></tr>
                    </table>";
                    echo"
                </td>                
                <td colspan='2'>
                    <table>
                        <tr>
                            <td>
                                <input name='OtrEs' type='text' class='texto_largo' id='OtrEs' size='68' onkeypress='return SoloTextos(event)' value='".mb_convert_encoding($r['otrECandid'], "UTF-8")."'>                    
                            </td>
                        </tr>
                        <tr>
                            <td>Directorio para Documentos</td>
                        </tr>
                        <tr>
                            <td><input type='text' id='Direc' name='Direc' class='texto_largo' size='68' value='".mb_convert_encoding($r['URLCandid'], "UTF-8")."'></td>
                        </tr>
                        <tr>
                            <td>
                                
                            </td>
                        </tr>
                        <tr>
                            <td>                                

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>            
        </table> 
        <table width='100%'>
            <tr>
                <td width='34%'>Conocimientos</td>
                <td width='33%'>Areas de interés</td>
                <td width='33%'>Areas de experiencia</td>
            </tr>
            <tr>
                <td><textarea id='Cono' name='Cono' class='textarea' rows='6' cols='35' onkeypress='return SoloTextos(event)'>".mb_convert_encoding($r['conCandid'], "UTF-8")."</textarea></td>
                <td><textarea id='ArIn' name='ArIn' class='textarea' rows='6' cols='35' onkeypress='return SoloTextos(event)'>".mb_convert_encoding($r['aintCandid'], "UTF-8")."</textarea></td>
                <td><textarea id='ArEx' name='ArEx' class='textarea' rows='6' cols='35' onkeypress='return SoloTextos(event)'>".mb_convert_encoding($r['aexpCandid'], "UTF-8")."</textarea></td>                
            </tr>
        </table>        
        <table width='100%'>
        <tr>
        <td colspan='5'>
            <center>
                <div id='resultado' class='resultado'></div>
                <div id='resultado_ok' class='resultado_ok'></div>
            </center>   
        </td>
        </tr>
        <tr>
            <td  width='35%'></td>
            <td  width='10%'><span id='btnGuardar' class='close' >Guardar</span></td>
            <td  width='10%'><span id='btnEliminar' class='close' >Eliminar</span></td>
            <td  width='10%'><span class='close' id='close' >Cancelar</span></td>
            <td  width='35%'></td>
        </tr>       
        </table>
    </form>
</center>
";
//----------------------------------------------------------      

?>