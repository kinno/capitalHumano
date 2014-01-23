<?php
header("Content-Type: text/html;charset=utf-8");
include"libs/libs.php";
$funciones= new funciones;

echo"<script>
$(document).ready(function(){

    //----------------------------------------------------------
    //activar, para edición, el primer input del formulario:
    //----------------------------------------------------------    
    //$(':input:first').focus();
    $(function(){
        $('form:not(.filter) :input:visible:enabled:first').focus();
    });

    //----------------------------------------------------------
    $('#close').click(function() {
        $('.overlay-container').fadeOut().end().find('.window-container').removeClass('window-container-visible');
    }); 

    //COMBOS
    //----------------------------------------------------------    
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

    //----------------------------------------------------------    
    $('#btnGuardar').click(function()  //CUANDO SE DE CLIC EN EL BOTÓN GUARDAR 
    {
        //----------------------------------------------------------
        // Se valida Idiomas
        //----------------------------------------------------------    
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
        if(cIdi0=='on'  && sIdi0=='vacio')
        {
            //alert('Verifica el porcentaje de idioma Ingles');
            $('#resultado').text('Verifica el porcentaje de idioma Ingles');
            $('#idiomas1').focus();
            return false;
        }   
        if(cIdi1=='on'  && sIdi1=='vacio')
        {
            //alert('Verifica el porcentaje de idioma Frances');
            $('#resultado').text('Verifica el porcentaje de idioma Frances');
            $('#idiomas2').focus();
            return false;
        }   
        if(cIdi2=='on'  && sIdi2=='vacio')
        {
            //alert('Verifica el porcentaje de idioma Aleman');
            $('#resultado').text('Verifica el porcentaje de idioma Aleman');
            $('#idiomas3').focus();
            return false;
        }
        if(cIdi3=='on'  && sIdi3=='vacio')
        {
            //alert('Verifica el porcentaje de idioma Portugues');
            $('#resultado').text('Verifica el porcentaje de idioma Portugues');
            $('#idiomas4').focus();
            return false;
        }

        //----------------------------------------------------------
        // Se valida Formulario
        //----------------------------------------------------------    
        if (validar_input_txt($('#txtname').val(),'Nombre',1,50) == false){
        $('#txtname').focus();
            return false; 
        }  
        else if (validar_input_txt($('#txtapp').val(),'Apellido Paterno',1,50) == false){
            $('#txtapp').focus();
            return false; 
        } 
        else if (validar_input_txt($('#txtapm').val(),'Apellido Materno',1,50) == false){
            $('#txtapm').focus();
            return false; 
        }          
        else if($('#txtgenero').val() == 0)
        {
            $('#resultado').text('Selecciona genero');
            $('#txtgenero').focus();
            return false;
        }
        //Se valida Fecha de Nacimiento
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
        //Validar fecha, dia mes año
        else if(Validafecha(parseInt($('#anio').val()),parseInt($('#mes').val()),parseInt($('#dia').val())) == false)
        {
            $('#resultado').text('Feha de Nacimiento no valida, revise mes y dia');
            $('#dia').focus();
            return false;               
        }  
        //Validar Domicilio
        else if (validar_input_txt($('#domi').val(),'Domicilio',1,200) == false){
            $('#domi').focus();
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
        //Los telefonos pueden ser nulos, Validar que al menos se capture uno
        else if($('#celu').val()== '' && $('#tel').val()== ''){
            $('#resultado').text('Capture por lo menos un telefono');
            $('#tel').focus();
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
         else if($('#txtPre').val()=='')
        {
            $('#resultado').text('Verifica pretensiones economicas');
            $('#txtPre').focus();
            return false;    
        }
        else if(ValDecimal($('#txtPre').val())==false)
        {
            $('#resultado').text('Verifica estructura pretensiones economicas');
            $('#txtPre').focus();
            return false;
        }
        else if($('#staC').val() == 0)
        {
            $('#resultado').text('Selecciona Estatus del candidato');
            $('#staC').focus();
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
            $('#escola').focus();
            return false;
        }
        else if($('#nivE').val() == 0)
        {
            $('#resultado').text('Selecciona el nivel de Estudios');
            $('#nivE').focus();
            return false;
        }
        else if($('#disV').val() == 0)
        {
            $('#resultado').text('Selecciona disponibilidad a viajar');
            $('#disV').focus();
            return false;
        }
        else if($('#OtrEs').val().length >= 200)
        {
            $('#resultado').text('Verifica otros estudios maximo 200 carecteres ');
            $('#OtrEs').focus();
            return false;
        }    
        else if($('#Direc').val().length >= 500)
        {
            $('#resultado').text('Verifica directorio, maximo 500 carecteres');
            $('#Direc').focus();
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
            $('#resultado').text('Verifica areas de experiencia');
            $('#ArEx').focus();
            return false;
        }
        else if(ValidaText($('#ArEx').val())==false)
        {
            $('#resultado').text('Verifica areas de experiencia no cumple con formato');
            $('#ArEx').focus();
            return false;
        }          
        else
        {               
            $('#resultado').text('');           
            $.ajax({
                type:'post',
                url:'candi.php',
                data:{
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
                    accion:'N'
                },
                success:function(data){                    
                    $('#resultado_ok').html(data);     
                },
                error: function(){
                    alert('error');
                }
            });  
            return false;
            
        }       

    });    
    //----------------------------------------------------------    

});


</script>";  //SE CREA EL FORMULARIO PARA INGRESAR LOS DATOS NUEVOS

//----------------------------------------------------------   
echo"
<center>
    <form id='formulario'>    
        <table width='100%'>
           <tr>
                <td width='25%'>Nombre</td>
                <td width='25%'>Apellido Paterno</td>
                <td width='25%'>Apellido Materno</td>
                <td width='25%'>Genero</td>
            </tr>
            <tr>
                <td width='25%'><input type='text' name='txtname' id='txtname' class='texto' onkeypress='return soloLetras(event)'></td>
                <td width='25%'><input type='text' name='txtapp' id='txtapp' class='texto' onkeypress='return soloLetras(event)'></td>
                <td width='25%'><input type='text' name='txtapm' id='txtapm' class='texto' onkeypress='return soloLetras(event)'></td>
                <td width='25%'>
                    <select id='txtgenero' name='txtgenero' class='sel'>
                        <option value='0'>Selecciona</option>
                        <option value='M'>Masculino</option>
                        <option value='F'>Femenino</option>
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
                <td width='25%'>
                    <select name='anio' id='anio' class='sel_anio'>";
                    $val='';
                    $funciones->arrayAnio($val);
                    echo"</select>";
                    $mes=array('01','02','03','04','05','06','07','08','09','10','11','12');
                    echo"<select id='mes'  name='mes' class='sel_fec'>";
                    echo"<option value='0'>M</option>";
                    foreach ($mes as $mes1) 
                    {
                        echo"<option value='".$mes1."'>".$mes1."</option>";
                    }
                    echo"</select>";
                    $dias=array('01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31');
                    echo"<select name='dia' id='dia' class='sel_fec'>";
                    echo"<option value='0'>D</option>";
                    foreach($dias as $dias1)
                    {
                        echo"<option value='".$dias1."'>".$dias1."</option>";
                    }
                    echo"</select>";
                echo "
                </td>
                <td width='25%'><input type='text' name='tel' id='tel' class='texto' onkeypress='return SoloTelefono(event)'></td>
                <td width='25%'><input type='text' name='celu' id='celu' class='texto' onkeypress='return SoloTelefono(event)'> </td>
                <td width='25%'><input type='mail' name='mail' id='mail' class='texto' ></td>
            </tr>
            <tr >
                <td width='25%'>Dirección</td>
                <td width='25%'></td>
                <td width='25%'></td>
                <td width='25%'></td>
            </tr>
            <tr>
                <td colspan='2'>
                    <input name='domi' type='text' class='texto_largo' id='domi' size='68' onkeypress='return SoloTextos(event)'>
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
                    echo"<option value=0>Selecciona un valor</option>";
                    $val='';
                    $funciones= new funciones;
                    $funciones->comboEstados($val);
                    echo"</select>";         
                echo"       
                </td>                    
                <td>
                    <select name='Municipio' id='Municipio' class='sel'>";    
                    echo"<option value=0>Selecciona un valor</option>";
                    echo"</select>";                        
                echo"
                </td>
                <td><input type='text' class='texto' name='CodigoP' id='CodigoP' onkeypress='return soloNumeros(event)'></td>
                <td>
                    <select name='Colonia' id='Colonia' class='sel'>";
                    echo"<option value=0>Selecciona un valor</option>";
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
                <td><input type='text' name='txtPre' id='txtPre' class='texto' onkeypress='return SoloDecimal(event)'></td>
                <td>
                    <select id='staC' class='sel' name='staC'>
                    <option value='0'>Selecciona</option>
                    <option value='1'>Disponible</option>
                    <option value='2'>No Disponible</option>
                    </select>
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
                    <select id='trAc' class='sel' name='trAc'>
                        <option value='0'>Selecciona</option>
                        <option value='1'>Si</option>
                        <option value='2'>No</option>
                    </select>
                </td>
                <td>";
                    $sqlSe="select * from tblescolar";
                    $querySe=mysql_query($sqlSe) or die("No se ejecuta escolaridad");
                    echo"<select id='escola' name='escola' class='sel'>";
                    echo"<option value='0'>Selecciona </option>";
                    while($rm=mysql_fetch_array($querySe))
                    {
                        echo"<option value='".$rm['idEscolar']."'>".mb_convert_encoding($rm['nomEscolar'], "UTF-8")."</option>";
                    }
                     echo"</select>
                </td>
                <td>";               
                    $nE=array('Trunco','Titulado','Pasante',' Maestría','Doctorado');
                    echo"<select id='nivE' class='sel' name='nivE'>";
                    echo"<option value='0'>Selecciona </option>";
                    foreach ($nE as $niv) 
                    {
                        echo"<option value='".$niv."'>".$niv."</option>";
                    }
                    echo"<select>
                </td>
                <td>
                    <select id='disV' class='sel' name='disV'>
                    <option value='0'>Selecciona</option>
                    <option value='1'>Si</option>
                    <option value='2'>No</option>
                    </select>
                </td>
            </tr>
            <tr >
                <td colspan='2'>Idiomas</td>                
                <td colspan='2'>Otros estudios y/o certificaciones</td>                
            </tr>
            <tr >
                <td  colspan='2'>
                    <table>
                        </tr>
                            <td>
                                <label>
                                    <input type='checkbox' name='idiomas_0' id='idiomas_0'  onclick=mostrar('ingles');verifCheck(this.id);>Ingles
                                </label>
                            </td>
                            <td>
                                <span id='ingles' style='display:none'>";
                                    $id=1;
                                    $listaPorcent=$funciones->ComboPIdiomas($id);
                                    echo $listaPorcent;
                                    echo"
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    <input type='checkbox' name='idiomas_1' id='idiomas_1'  onclick=mostrar('frances');verifCheck(this.id)>Frances
                                </label>
                            </td>
                           <td>
                                <span id='frances' style='display:none'>";
                                    $id=2;
                                    $listaPorcent=$funciones->ComboPIdiomas($id);
                                    echo $listaPorcent;
                                    echo"
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    <input type='checkbox' name='idiomas_2' id='idiomas_2'  onclick=mostrar('aleman');verifCheck(this.id)>Aleman
                                </label>
                            </td>
                            <td>
                                <span id='aleman' style='display:none;align:left;'>";
                                    $id=3;
                                    $listaPorcent=$funciones->ComboPIdiomas($id);
                                    echo $listaPorcent;
                                    echo"
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    <input type='checkbox' name='idiomas_3' id='idiomas_3'  onclick=mostrar('portugues');verifCheck(this.id)>Portugues
                                </label>
                            </td>
                            <td>
                                <span id='portugues' style='display:none'>";
                                    $id=4;
                                    $listaPorcent=$funciones->ComboPIdiomas($id);
                                    echo $listaPorcent;
                                    echo"
                                </span>
                            </td>
                        </tr>
                    </table>";
                    echo"
                </td>                
                <td colspan='2'>
                    <table>
                        <tr>
                            <td>
                                <input name='OtrEs' type='text' class='texto_largo' id='OtrEs' size='68' onkeypress='return SoloTextos(event)'>                    
                            </td>
                        </tr>
                        <tr>
                            <td>Directorio para Documentos</td>
                        </tr>
                        <tr>
                            <td><input type='text' id='Direc' name='Direc' class='texto_largo' size='68'></td>
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
                <td><textarea id='Cono' name='Cono' class='textarea' rows='6' cols='35' onkeypress='return SoloTextos(event)'></textarea></td>
                <td><textarea id='ArIn' name='ArIn' class='textarea' rows='6' cols='35' onkeypress='return SoloTextos(event)'></textarea></td>
                <td><textarea id='ArEx' name='ArEx' class='textarea' rows='6' cols='35' onkeypress='return SoloTextos(event)'></textarea></td>
            </tr>
        </table>        
        <table width='100%'>
        <tr>
        <td colspan='4'>
            <center>
                <div id='resultado' class='resultado'></div>
                <div id='resultado_ok' class='resultado_ok'></div>
            </center>   
        </td>
        </tr>
        <tr>
            <td  width='40%'></td>
            <td  width='10%'><span id='btnGuardar' class='close' >Guardar</span></td>
            <td  width='10%'><span class='close' id='close' >Cancelar</span></td>
            <td  width='40%'></td>
        </tr>       
        </table>
    </form>
</center>
";

//----------------------------------------------------------    
?>