<?php

$idCandid=$_GET['idCandid'];
//-------------------------------------------------------------
echo "
<head>
<style>
	.ref
	{
		position: absolute;
		top: 0%;
		left: 0%;
		width: 100%;
		height: 100%;
	}
	.refobj
	{
		width: 100%;
		height: 100%;   
	}
</style>

<title> </title>

</head>
  <body> 
        <div class='ref' id='div_hom'>
        	<object data='../cat_referencias/web_Ref.php?idCandid=".$idCandid."' class='refobj' id='obj_inx'></object>        
        </div>  
  </div>
</body>
</html>
";

//<form id='formulario'>
//<input  type='text' class='texto' id='idCandid' value='".$idCandid."'>
//</form>
//-------------------------------------------------------------
?>