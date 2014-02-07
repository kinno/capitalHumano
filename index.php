<!DOCTYPE html>
<?php 
$ban;
session_start(); 
if(ISSET($_SESSION['id'])){
    echo '<SCRIPT LANGUAGE="javascript">
        location.href = "contenido/home.php";
        </SCRIPT>';	
}
?>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>R.H.</title>
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<style type="text/css">
	ul
	{
		list-style-type: none;
		padding: 0;
		margin: 0;
	}
	li
	{
		display: inline-block;
		padding: 5px;
		border:1px outset #96E421;
		color: white;
		background-color:#96E421;
		width: 100px; 
		position: relative;
		margin: 2px;
		cursor: pointer;
	}
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

	@-moz-keyframe submenu
	{
		0%
		{
			opacity: 0;
			left: -150px;
		}
		100%
		{
			opacity: 1;
			left: 1px;
		}
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
		position: absolute;
		top: 30%;
		left: 22%;
		width: 80%;
		margin-left:-200px;
		height: 80%;
		margin-top: -150px;
		border:1px solid #808080;
		padding: 5px
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
  <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/jquery-ui-1.10.4.custom.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/loginFunciones.js"></script>
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <link href="css/jquery-ui-1.10.3.customblack.css" rel="stylesheet" type="text/css">
</head>
<body>

        <div>
            <div style="left:37%; top:60%; position:fixed;">
                <img src="images/upgenia.png">
            </div>
            <div>
                <div class="ui-widget-overlay"></div>
                <div class="ui-widget-shadow ui-corner-all" style="width: 26.7%; height: 33.5%; position: absolute; left: 37%; top: 25%;"></div>
            </div>
            <div class="ui-widget ui-widget-content ui-corner-all" style="position: absolute; width: 25%; height: 30%;left: 37%; top: 25%; padding: 10px;">
                <div align="center">
                    <h3 class="encabezado ui-corner-all" style="color: black;">¡Bienvenido!<br>Sistema de Capital Humano</h3>
                    <form action="../login/verificaLogin.php" id="formLogin" name="formLogin" method="post" target="_top">
                        <table>
                            <tr><td>Usuario:</td><td><input type="text" id="NomEntUsu" name="NomEntUsu" placeholder="Ingrese su nombre"></td></tr>
                            <tr><td>Contraseña:</td><td><input type="password" id="PwdEntUsu" name="PwdEntUsu" placeholder="Ingrese su password"></td></tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <input type="submit" id="envia" value="Ingresar">
                                </td>
                            </tr>
                        </table>
                    </form>
                    <div id="error" style="margin-top:10px;">
                    </div>
                </div>
            </div>    
        </div>


</body>
</html>