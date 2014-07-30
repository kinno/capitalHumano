<?php
 date_default_timezone_set('America/Mexico_City'); 
//*********************************************************************
//Nombre: home.php
//Funcion del Modulo: Pantalla pprincipal - Menú 
//Fecha:  14/05/2013
//Relizo: 
//********************************************************************* 
//obj.innerHTML = "<object data='home.htm' class='homeobj' id='obj_inx'>";
session_start();
//print_r($_SESSION);
if( !isset($_SESSION['id']))
{
	print"<meta http-equiv=refresh content=\"0 ; url='../'\">";
    exit;
    $SESION=$_SESSION['rol'];
    
    
}
else if($_SESSION['Cpas']==true)
{
echo"session creada";
echo'<script src="js/jquery-1.9.1.min.js"></script>';
echo"<script>
$(document).ready(function()
	{
		$('.overlay-container').fadeIn(function() {
                window.setTimeout(function(){
                  $('.window-container.zoomin').addClass('window-container-visible');},0000);
                    });
$.ajax({
	type:'post',
	url:'CambioPas/CambioPas.php',
	data:{
 r:'p'

	},
	success:function(data)
	{
		$('#mostrar').html(data);

	},
	error: function()
	{
		alert('Ocurrío un error a general formulario de passwords');
	}


});


	});

</script>";
}
?>
<html lang="es">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />  
<title>R.H.</title>
<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../js/jquery-ui-1.10.4.custom.js" type="text/javascript"></script>
<script src="../js/funcionesGeneral.js" type="text/javascript"></script>
<link href="../css/jquery-ui-1.10.4.custom.css" rel="stylesheet" type="text/css"/>

<!--[if lt IE 9]>
<!--<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>-->
<![endif]-->

<style type="text/css">
	
	#mnuindex
	{
		text-align: center;
	}

	.submenu
	{
		position: absolute;	
		top: 30px;
		left: 1px;	
		display: none;
		box-shadow: 0px 0.5px 5px #000;
		border-radius: 0px 0px 10px 10px;
		-moz-animation-duration:0.8s;
	}
	.submenu li:last-child
	{
		border-radius: 0px 0px 10px 10px;
	}
	.submenu > li
	{
		display: block;		
	}

	#mnuindex li:hover ul
	{
		display: block;
		-moz-animation-name:submenu;    
	}


	#mnuindex>li:first-child
	{
		background: #FFFFFF;
		padding-top: 10px;
		box-shadow: 0px 0px 4px #FFFFFF;
		border-radius:10px 10px 0px 0px;
		border: 1px outset #D0DBE6;
		color: #96E421;
		text-shadow:1px 1px 1px #375F85;
	}

	.home
	{
                width: 98%;
                margin-top: 0px;
                height: 90%;
                margin-left: auto;
                margin-right: auto;
                
               box-shadow:0px 0px 50px black;
               border-radius:5px;
		/*position: absolute;
		top: 30%;
		left: 22%;
		width: 80%;
		margin-left:-200px;
		height: 80%;
		margin-top: -150px;
		border:1px solid #808080;
		padding: 5px*/
	}
	.homeobj
	{
		width: 100%;
		height: 100%;
   
	}
</style>

<style>

 .overlay-container {
    display: none;
    content: " ";
    height: 100%;
    width: 100%;
    position: absolute;
    left: 0;
    top: 0;
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
    margin: 8em auto;
    width: 500px;
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
  background: #F5F5F5;
    border: 1px solid #E8E8E8;
    color: #626262;
    display: block;
    float: left;
    padding: 8px;
    resize: none;
    width: 180px;
    -webkit-transition: all 0.1s linear;
    -moz-transition: all 0.1s linear;
  }
  .texto:focus
  {
    background: #F9F9F9;
    border: 1px solid #D3D3D3;
    outline: none;
  }
     .sel
    {
        font-family: Georgia;
  font-size: 16px;
  color: #f6f6f6;
  background-color:#444444;
  border: 0 none;
  padding: 5px;
    }
  </style>
</head>
<body  style="background-color: #dcdcdc"> 
<div style="position: absolute; left:25px; margin-top: 0px;">
    <?php
    echo '<div>
            <button id="user">Usuario: '.$_SESSION["nom"].' '.$_SESSION['app'].'</button>
          </div>';
    ?>
</div>    
<div style="position: absolute; right:5px; margin-top: -40px;">
        <img src="../img/upgenia_head.png" width="50%" style="float: right;"></img>
    </div>    
<div id="container" style="margin-top:35px;">
    <table width="1325px">
        <tr id ="contenedor">
            <td align="center">
                <div>
                    <div>
                        <button id="inicio" style="margin-right: -.3em;">Inicio</button>
                        <button id="solicitudes" style="margin-right: -.3em;">Solicitudes</button>
                        <button id="vacantes" style="margin-right: -.3em;">Vacantes</button>
                        <button id="candidatos" onClick="menu('cand');" style="margin-right: -.3em;">Candidatos</button>
                        <button id="catalogos" onClick="menu('catalogos');" style="margin-right: -.3em;">Catálogos</button>
                        <button id="agenda" onClick="menu('agenda');" style="margin-right: -.3em;">Agenda</button>
                        <button id="reportes" onClick="menu('reportes');" style="margin-right: -.3em;" onclick="cambiaHtml('reportesView.php');">Reportes</button>
                        <button id="salir" style="margin-right: -.3em;">Salir</button>
                    </div>
                    <ul style="width: 150px;text-align: left;position: absolute;">

                        <li onClick="menu('RSoli');"><a href="#"><span class="ui-icon ui-icon-plus"></span>Requisición de Personal</a></li>

                        <li onClick="menu('CatSoli')"><a href="#"><span class="ui-icon ui-icon-wrench"></span>Cátalogo de Solicitudes</a></li>
                    </ul>
                    <ul style="width: 150px;text-align: left;position: absolute;">

                        <li onClick="menu('cVac');"><a href="#"><span class="ui-icon ui-icon-plus"></span>Crear Vacantes</a></li>

                        <li onClick="menu('rCan')"><a href="#"><span class="ui-icon ui-icon-wrench"></span>Registrar Candidato</a></li>
                    </ul>
<!--                    <ul style="width: 150px;text-align: left;position: absolute;">

                        <li onClick="menu('cand')"><a href="#"><span class="ui-icon ui-icon-plus"></span>Candidatos</a></li>

                        <li onClick="menu('busCandi')"><a href="#"><span class="ui-icon ui-icon-wrench"></span>Buscar</a></li>
                    
                    </ul>
                    <ul style="width: 150px;text-align: left;position: absolute;">
                    
                        <li onClick="menu('usu')"><a href="#"><span class="ui-icon ui-icon-plus"></span>Usuarios</a></li>
                        <li onClick="menu('reclu')"><a href="#"><span class="ui-icon ui-icon-plus"></span>Reclutadores</a></li>
                        <li onClick="menu('perfil')"><a href="#"><span class="ui-icon ui-icon-wrench"></span>Perfiles</a></li>
                        <li onClick="menu('doc')"><a href="#"><span class="ui-icon ui-icon-cart"></span>Documentos</a></li>
                        <li onClick="menu('esc')"><a href="#"><span class="ui-icon ui-icon-plus"></span>Escolaridad</a></li>
                        <li onClick="menu('pry')"><a href="#"><span class="ui-icon ui-icon-wrench"></span>Proyectos</a></li>

                    </ul>-->
                </div>
            </td>
        </tr>
        
    </table>
   
</div>
<div class="home" id="div_hom" style="background: #FFFFFF;">
    <center><img src="../img/upgenia.png" style="margin-top: 160px; margin-left: auto; margin-right: auto;"/></center>
</div>    
<div class="overlay-container">
     <center>
          <div class="window-container zoomin" id='mostrar'>        

          </div>
     </center>
</div>
</body>
</html>