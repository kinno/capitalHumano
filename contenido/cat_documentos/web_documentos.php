<?php
session_start();
if($_SESSION['rol']==1||$_SESSION['rol']==2){
      $permisosEspeciales=1;
  }
  else
      $permisosEspeciales=0;

?>
<!doctype html>
<html lang='es'>
<head>
	<meta charset='utf8'>
	<title></title>

<!--	<link type="text/css" href="css/style.css" rel="stylesheet" /> -->
	<link type="text/css" href="css/demo_table.css" rel="stylesheet" /> 
        <link type="text/css" href="../../css/jquery-ui-1.10.3.customblack.css" rel="stylesheet" /> 
        <link type="text/css" href="../../css/style.css" rel="stylesheet" /> 
        <script type="text/javascript" language="javascript" src="../../js/jquery.js"></script>
        <script type="text/javascript" language="javascript" src="../../js/jquery-ui-1.10.3.custom.js"></script>
        <script type="text/javascript" language="javascript" src="../../js/funcionesDocumentos.js"></script>
	<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
	<script type="text/javascript" language="javascript" src="js/funcionesTab.js"></script>
        <script type="text/javascript" language="javascript" src="../../js/jquery.highlight.js"></script>
	<script type='text/javascript' src='../js/libs.js'></script>
	<style>
    /*
  
  .overlay-container {
    display: none;
    content: " ";
    height: 100%;
    width: 100%;
    position: fixed;
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


  .titulo{
    border: 1px none #E8E8E8;
    color: #666666;
    display: block;
    float: left;
    padding: 10px;
    resize: none;
    -webkit-transition: all 0.1s linear;
    -moz-transition: all 0.1s linear;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 16px;
    background-color: #F4F4F4;
  }

  .texto{
    background: #F5F5F5;
    border: 1px solid #E8E8E8;
    color: #626262;
    display: block;
    float: left;
    padding: 8px;
    resize: none;
    width: 200px;
    -webkit-transition: all 0.1s linear;
    -moz-transition: all 0.1s linear;
  }

  .texto:focus
  {
    border: 1px solid #33CCFF;
    outline: none;
    background-color: #FFFFFF;
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

  .button {
    font-family: san-serif;
    font-size: 16px;
    font-style: normal;
    cursor: pointer;
    cursor: hand;
    color: #0000A0;
    padding: 2px;    
  }

  .button:hover {
    font-family: san-serif;
    font-size: 16px;
    font-style: normal;
    cursor: pointer;
    cursor: hand;
    color: #FFFFFF;
    background-color: #99B3FF;
    font-weight: bold;
  }
*/
  </style>

	<script type="text/javascript">
            /*
	$(document).ready(function(){

		$("#nuevo").click(function(){



			$('.overlay-container').fadeIn(function() {
                window.setTimeout(function(){
                  $('.window-container.zoomin').addClass('window-container-visible');},0000);
                    });
			$.ajax(
				{
					type:'get',
					url:'documentoNuevo.php',
					data:{
						accion:'N',
						
					},
					success:function(data){

						$('#mostrar').html(data);   

					},
					error:function(){
						alert("error !");

					}
				});
		});
	});
*/
	</script>
</head>
<body>
<p><span class='titulo' id='candidato'>Catálogo de Documentos</span></p>
<?php
  if($permisosEspeciales==1){
echo "<center><span class='close' id='nuevo'>Agregar</span></center>";
  }
?>
<article id="contenido">
	
</article>
<div id="nuevoDocumento" title="Agregar nuevo documento">
        <div id="contDialog"></div>
  </div>

</body>
</html>