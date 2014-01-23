<?php
include"libs.php";

$funciones= new funciones;
$funciones->conectar();
?>
<!DOCTYPE html>
<html lan='es'>
<head>
	<meta charset='utf-8'>
	<title></title>
	<script type="text/javascript" src='jquery-1.9.1.js'></script>
  <script type="text/javascript" src='jquery-ui.js'></script>
	<script type="text/javascript" src='libs.js'></script>
<link href="css/south-street/jquery-ui-1.10.3.custom.css" rel="stylesheet">
   
  
	<script>
  function bus(id)
  {

              $(document).ready(function () {
                 $('.overlay-container').fadeIn(function() {
                window.setTimeout(function(){
                  $('.window-container.zoomin').addClass('window-container-visible');},0000);
                    });
                 $.ajax({
                  type:'post',
                  url:' detalle.php',
                  data:
                  {
                    ids: id
                  },
                  success:function(data)
                  {
                    $('#mostrar').html(data);

                  },
                  error: function()
                  {

                  }


                 });
            
        
             });
}
        
            

 

  $(function() {

$('#close').click(function() {
        $('.overlay-container').fadeOut().end().find('.window-container').removeClass('window-container-visible');
    });

    $( "#envioG" ).button();
    $( "#btnedad" ).button();
    $( "#btnCon" ).button(); 

    $( "#accordion" ).accordion({
      heightStyle: "content"
    });
  });



  $(document).ready(function()
    {


      $('#envioG').click(function()
      {
        

        var Pcla=$('#pClaveg').val();
        var edad1=$('#edad1g').val();
        var edad2=$('#edad2g').val();
        var disV=$('#selDg').val();
        var gene=$('#selGg').val();
        var esco=$('#selEg').val();
        var nivel=$('#selNg').val();
        var prete1=$('#pr1g').val();
        var prete2=$('#pr2g').val();
        if(edad1 != '' && edad2=='')
        {
          $('#resGene').text('llena la  segunda edad');
          $('#edad2g').focus();

        }
        else if(edad2 != '' && edad1=='')
        {
          $('#resGene').text('llena la primer edad');
          $('#edad1g').focus();

        }
        else if(prete1 != '' && prete2=='')
        {
          
          $('#resGene').text('llena la segunda pretencion economica');
          $('#pr2g').focus();

        }
        else if(prete2 != '' && prete1=='')
        {
          $('#resGene').text('llena la primer pretencion economica');
          $('#pr1g').focus();

        }
        else
        {
          $.ajax(
            {
              type:'post',
              url:'general.php',
              data:
              {
                palabraCla: Pcla,
                ed1:edad1,
                ed2:edad2,
                disViaje:disV,
                genero: gene,
                ecola:esco,
                niv:nivel,
                prt1:prete1,
                prt2:prete2


                
    

              },
              success: function(data)
              {
                $('#resGene').html(data);

              },
              error:function()
              {
                alert('Ocurrio un error LA enviar la busqueda ');
              }

            });
        }



      });




       $('#btnCon').click(function()
        {
          var p1=$('#pr1').val();
          var p2=$('#pr2').val();
          if(p1=='')
          {
            $('#rePre').text('Selecciona pretenciones econocmicas 1');
            $('#pr1').focus();


          }
          else if(p2=='')
          {
            $('#rePre').text('Selecciona pretenciones econocmicas 2');
            $('#pr2').focus();

          }
          else
          {
            $.ajax({
              type:'post',
              url:'rango.php',
              data:
              {
                v1:p1,
                v2:p2

              },
              success:function(data)
              {
                $('#rePre').html(data);

              },
              error:function()
              {
                alert('Ocurrio un error al aser la consulta por Rangos de Pretenciones');

              }

            });

          }
        });



        $('#nivE').change(function()
          {
              var valorS=$('#nivE').val();

              if(valorS==0)
          {
            $('#resNiv').text('Selecciona la nivel de estudio');
            $('#nivE').focus();
            

          }
          else
          {
            $.ajax({
              type:'post',
              url:'nivEs.php',
              data:{
                nivEs: valorS

              },
              success:function(data)
              {
                $('#resNiv').html(data);

              },
              error:function()
              {
                alert('Ocurrio un erro al realizar la Consulta por nivel de estudio');
              }


            });
          }



          });



      $('#escola').change(function()
        {
          var valorS=$('#escola').val();
          
          if(valorS==0)
          {
            $('#resEs').text('Selecciona la escolaridad');
            $('#escola').focus();
            return false;

          }
          else
          {
            $.ajax({
              type:'post',
              url:'escolaridad.php',
              data:{
                esco: valorS

              },
              success:function(data)
              {
                $('#resEs').html(data);

              },
              error:function()
              {
                alert('Ocurrio un erro al realizar la Consulta pro genero');
              }


            });
          }

        });



      $('#disVi').change(function()
        {
         var valorS=$('#disVi').val();
         if(valorS==0)
         {
          $('#aroS').html('');
          $('#reSe').text('Seleccion La disponibilidad a Viajar');
          $('#reSe').focus();
          return false;

         }
         else
         {
          $.ajax({
            type:'post',
            url:'disV.php',
            data:{
              valor :valorS

            },
            success:function(data)
            {
              $('#reSe').text('');
              $('#aroS').html(data);

            },
            error: function()
            {

            }
          });

         }
        });

      $('#gene').change(function()
        {
          var genero= $('#gene').val();
          if(genero==0)
          {
            $('#resGenero').text('Selecciona el genero');
            $('#gene').focus();
            return false;

          }
            else
            {
              $.ajax(
                {
                  type:'post',
                  url:'generoC.php',
                  data:
                  {
                    gen:genero

                  },
                  success: function(data)
                  {
                     $('#resGenero').html(data);

                  },
                  error: function()
                  {
                    alert('Ocurrio un error al Realizar la busqueda intente mas tarde');

                  }

                });

            }

        });





      $('#btnedad').click(function()
        {
        var ed1= $('#edad1').val();
            var ed2= $('#edad2').val();
          
          
          if(ed1=='')
          {
            $('#resEd').text('Verifica la primer edad se encuetra vacia');
            return false;

          }
          else if(ed2=='')
          {
            $('#resEd').text('Verifica la segunda edad se encuetra vacia');
            return false;

          }
          else
          {
            $.ajax(
              {
                type:'post',
                url:'edades.php',
                data:
                {
                  edad1: ed1,
                  edad2:ed2

                },
                success: function(data)
                {
                  $('#red').html(data);


                },
                error: function()
                {
                  alert('Ocurrio un erro al enviar los datos');
                }

              });

          }


        });

    });


  $(document).ready(function() {
				$("#parametro").keydown(
					function(event)
					{
						var param = $("#parametro").val();
						//$("#resultado").text(param);
						$("#resultado").load('bus.php',{parametro:param});
					}
				);
			});
			$(document).ready(function() {
				$("#parametro").keyup(
					function(event)
					{
						var param = $("#parametro").val();
						//$("#resultado").text(param);
						$("#resultado").load('bus.php',{parametro:param});
					}
				);
			});
  </script>
  
  <style>
    
  
  .overlay-container {
    display: none;
    content: " ";
    height: 100%;
    width: 100%;
    position: fixed;
    left: 0;
    top: 0;
    overflow: scroll;
    background: -moz-radial-gradient(center, ellipse cover,  rgba(127,127,127,0) 0%, rgba(127,127,127,0.9) 100%);
    background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%,rgba(127,127,127,0)), color-stop(100%,rgba(127,127,127,0.9)));
    background: -webkit-radial-gradient(center, ellipse cover,  rgba(127,127,127,0) 0%,rgba(127,127,127,0.9) 100%);
    background: -o-radial-gradient(center, ellipse cover,  rgba(127,127,127,0) 0%,rgba(127,127,127,0.9) 100%);
    background: -ms-radial-gradient(center, ellipse cover,  rgba(127,127,127,0) 0%,rgba(127,127,127,0.9) 100%);
    background: radial-gradient(center, ellipse cover,  rgba(127,127,127,0) 0%,rgba(127,127,127,0.9) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#007f7f7f', endColorstr='#e67f7f7f',GradientType=1 );
  }
  
  .window-container {
    display: block;
    background: #fcfcfc;
    margin: 1em auto;
    width: 80%;
    height: 90%;
    padding: 10px 20px 20px;
    text-align: left;
    z-index: 3;

    border-radius: 3px;
    box-shadow: 0px 0px 30px rgba(0,0,0,0.2);
    -webkit-transition: 0.4s ease-out;
    -moz-transition: 0.4s ease-out;
    -ms-transition: 0.4s ease-out;
    -o-transition: 0.4s ease-out;
    transition: 0.4s ease-out;
    opacity: 0;
  }
  
  .zoomin {
    -webkit-transform:  scale(1.2);
    -moz-transform:  scale(1.2);
    -ms-transform:  scale(1.2);
    transform:  scale(1.2);
  }
  
  .zoomout {
    -webkit-transform:  scale(0.7);
    -moz-transform:  scale(0.7);
    -ms-transform:  scale(0.7);
    transform:  scale(0.7);
  }
  
  .window-container-visible {
    -webkit-transform:  scale(1);
    -moz-transform:  scale(1);
    -ms-transform:  scale(1);
    transform:  scale(1);
    opacity: 1;
  }
  
    .window-container h3 {
      margin: 1em 0 0.5em;
      font-family: "Oleo Script";
      font-weight: normal;
      font-size: 25px;
      text-align: center;
    }
    
    .close {
      margin: 1em auto;
      display: block;
      width: 52px;
      background: #fafafa;
      background: -moz-linear-gradient(top,  #fafafa 0%, #f4f4f4 40%, #e5e5e5 100%);
      background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#fafafa), color-stop(40%,#f4f4f4), color-stop(100%,#e5e5e5));
      background: -webkit-linear-gradient(top,  #fafafa 0%,#f4f4f4 40%,#e5e5e5 100%);
      background: -o-linear-gradient(top,  #fafafa 0%,#f4f4f4 40%,#e5e5e5 100%); 
      background: -ms-linear-gradient(top,  #fafafa 0%,#f4f4f4 40%,#e5e5e5 100%);
      background: linear-gradient(to bottom,  #fafafa 0%,#f4f4f4 40%,#e5e5e5 100%); 
      filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fafafa', endColorstr='#e5e5e5',GradientType=0 );
      border: 1px solid #aaa;
      padding: 5px 14px;
      color: #444;
      font-family: Helvetica, sans-serif;
      font-size: 12px;
      border-radius: 3px;
      box-shadow: 0 1px 3px #ddd;
      -webkit-transition: 0.2s linear;
      -moz-transition: 0.2s linear;
      -ms-transition: 0.2s linear;
      -o-transition: 0.2s linear;
      transition: 0.2s linear;
      cursor: pointer;
    }
  
      .close:hover {
        background: #fefefe;
        background: -moz-linear-gradient(top,  #fefefe 0%, #f8f8f8 40%, #e9e9e9 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#fefefe), color-stop(40%,#f8f8f8), color-stop(100%,#e9e9e9));
        background: -webkit-linear-gradient(top,  #fefefe 0%,#f8f8f8 40%,#e9e9e9 100%);
        background: -o-linear-gradient(top,  #fefefe 0%,#f8f8f8 40%,#e9e9e9 100%);
        background: -ms-linear-gradient(top,  #fefefe 0%,#f8f8f8 40%,#e9e9e9 100%);
        background: linear-gradient(to bottom,  #fefefe 0%,#f8f8f8 40%,#e9e9e9 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fefefe', endColorstr='#e9e9e9',GradientType=0 );
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        border: 1px solid #aaa;
      }
  
      .close:active {
        background: #f4f4f4;
        background: -moz-linear-gradient(top,  #f4f4f4 0%, #efefef 40%, #dcdcdc 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#f4f4f4), color-stop(40%,#efefef), color-stop(100%,#dcdcdc));
        background: -webkit-linear-gradient(top,  #f4f4f4 0%,#efefef 40%,#dcdcdc 100%);
        background: -o-linear-gradient(top,  #f4f4f4 0%,#efefef 40%,#dcdcdc 100%);
        background: -ms-linear-gradient(top,  #f4f4f4 0%,#efefef 40%,#dcdcdc 100%);
        background: linear-gradient(to bottom,  #f4f4f4 0%,#efefef 40%,#dcdcdc 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f4f4f4', endColorstr='#dcdcdc',GradientType=0 );
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.2);
      }
      .texto{
 border: solid 1px #E5E5E5;
  background: #FFFFFF;
  margin: 5px 30px 0px 30px;
  padding: 9px;
  display:block;
  font-size:16px;
  
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
  -moz-box-shadow: 0px 0px 8px #f0f0f0;
  -webkit-box-shadow: 0px 0px 8px #f0f0f0;
  box-shadow: 0px 0px 8px #f0f0f0;
  }
  .texto:focus
  {
   background:#feffef;
  }
     .sel
    {
        border: solid 1px #E5E5E5;
  background: #FFFFFF;
  margin-left: .7cm;
  padding: 9px;
    }
  </style>
</head>
<body>


</head>
<body>
 
<div id="accordion">
  <h3><center>General</center></h3>
    <div>
     
     <table  width="400">
        <tr>
            <td>Palabra Clave</td>
            <td><input type='texto' class="texto" id='pClaveg' onkeypress="return letarGM(event);" ></td>
            <td>Edad inicial</td>
          <td><input type="text" class="texto" id="edad1g" onkeypress="return IsNumber(event);"></td>
          <td>Edad Final</td>
          <td><input type='text' class='texto' id='edad2g' onkeypress="return IsNumber(event);"></td>
        </tr>
         <tr>
          <td>Disponibilida a Viajar</td>
          <td>
            <select id='selDg' class='sel'>
              <option value='0'>Selecciona</option>
              <option value='1'>Si</option>
              <option value='2'>No</option>
            </select>
          </td>
      <td>Genéro</td>
            <td>
                <select id='selGg' class='sel'>
                  <option value='0'>Selecciona</option>
                  <option value='M'>M</option>
                  <option value='F'>F</option>
                </select>
            </td>

             <td>Escolaridad</td>
      <td>
      <?php
             $sqlSe="select * from tblescolar";
                $querySe=mysql_query($sqlSe) or die("No se ejecuta escolaridad");
                echo"<select id='selEg' class='sel'>";
                echo"<option value='0'>Selecciona</option>";
                while($rm=mysql_fetch_array($querySe))
                {
                    echo"<option value='".$rm['idEscolar']."'>".utf8_encode($rm['nomEscolar'])."</option>";

                }
                echo"</select>";
      ?>

      </td>
      </tr>
      <tr>
         <td>Nivel de estudios</td>
            <td>
               <?php 
                $nE=array('Trunco','Titulado','Pasante',' Maestría','Doctorado');
                echo"<select id='selNg' class='sel' name='nivE'>";
                echo"<option value='0'>Selecciona </option>";
                foreach ($nE as $niv) 
                {
                    echo"<option value='".$niv."'>".$niv."</option>";
               }
                echo"<select>
                </td>";
               ?>
                <td>Pretensión economica Inicial </td>
      <td><input type='text' name='pr1g' id='pr1g' class="texto"  onkeypress="return IsNumberC(event);"></td>
      <td>Pretensión economica Final</td>
      <td> <input type='text' name='pr2g' id='pr2g'  class="texto" onkeypress="return IsNumberC(event);"></td>
      </tr>
      <tr>
        <td colspan='6'><center><span id='envioG'>Enviar</span></center></td>
      </tr>
      </table>
      <div id='resGene'></div>


    </div>
  <h3><center>Palabra clave</center></h3>
  <div >
       	<table align='center'>
    		<tr>
    			<td>Palabras clave</td>
    			<td><input type='text' class="texto"  name='parametro' id='parametro' onkeypress="return letarGM(event);"></td>

    		</tr>
    	</table>
    	<div id='resultado'></div>
  </div>
  <h3><center>Busqueda edades</center></h3>
  <div>
    <table align='center'>
      
      <tr>
        <td>Edad Inicial</td>
        <td><input type="text" class="texto" id="edad1" onkeypress="return IsNumber(event);"></td>
        <td>Edad Final</td>
        <td><input type='text' class='texto' id='edad2' onkeypress="return IsNumber(event);"></td></tr>
        <tr><td colspan='4'><div id='resEd'></div></td></tr>
      <tr><td colspan='4'><center><span id='btnedad'>Buscar</span></center></td></tr>
    </table>
    <div id='red'></div>
  </div>


  <h3><center>Disponibilidad de viaje</center></h3>
  <div>
    <table align='center'>
      <tr>
        <td>Disponibilidad a Viajar</td>
        <td>
          <select id='disVi' class='sel'>
            <option value='0'>Selecciona</option>
            <option value='1'>Si</option>
            <option value='2'>No</option>
          </select>
        </td>

      </tr>
      <tr><td colspan='2'><div id='reSe'></div></td></tr>
    </table>
    <div id='aroS'></div>
  </div>
  <h3><center>Género</center></h3>
  <div>
    <table align='center'>
      <tr>
        <td>Selecciona el Género</td>
        <td>
            <select id='gene' class='sel'>
              <option value='0'>Selecciona</option>
              <option value='M'>M</option>
              <option value='F'>F</option>
            </select>
        </td>
      </tr>
    </table>
    <div id='resGenero'></div>
  </div>
 <h3><center>Escolaridad</center></h3>
 <div>
  <table align='center'>
    <tr>
      <td>Escolaridad</td>
      <td>
<?php
        $sqlSe="select * from tblescolar";
                $querySe=mysql_query($sqlSe) or die("No se ejecuta escolaridad");
                echo"<select id='escola' name='escola' class='sel'>";
                echo"<option value='0'>Selecciona</option>";
                while($rm=mysql_fetch_array($querySe))
                {
                    echo"<option value='".$rm['idEscolar']."'>".utf8_encode($rm['nomEscolar'])."</option>";

                }
                echo"</select>";
?>

      </td>
    </tr>

  </table>
  <div id='resEs'></div>

 </div>
 <h3><center>Nivel de Estudios</center></h3>
<div>

  <table align='center'>
    <tr>
             <td>Nivel de estudios</td>
            <td>
               <?php 
                $nE=array('Trunco','Titulado','Pasante',' Maestría','Doctorado');
                echo"<select id='nivE' class='sel' name='nivE'>";
                echo"<option value='0'>Selecciona </option>";
                foreach ($nE as $niv) 
                {
                    echo"<option value='".$niv."'>".$niv."</option>";
               }
                echo"<select>
                </td>";
               ?>
               </tr> 

  </table>
<div id='resNiv'></div>
</div>
<h3><center>Salarios</center></h3>
<div>

  <table align='center'>
    <tr>
      <td>Pretensión económica inicial</td>
      <td><input type='text' name='pr1' id='pr1' class='texto' onkeypress="return IsNumberC(event);"></td>
      <td>Pretensión económica  final</td>
      <td> <input type='text' name='pr2' id='pr2' class='texto' onkeypress="return IsNumberC(event);"></td>
    </tr>
    <tr>
      <td colspan='4'><center><span id='btnCon'>Consultar</span></center></td>
    </tr>

  </table>
  <div id='rePre'></div>

</div>
</div>


<div class="overlay-container">
        <center>
          <div class="window-container zoomin" id='mostrar'>
          
          
        </div>
      </center>
    </div>
</body>
</html>