<?php
//*********************************************************************
//Nombre: clase funciones.
//Funcion del Modulo: Guadar la funciones que se ocuparan.
//Fecha: 06/05/2013
//Relizo: Ricardo Lugo Recillas
//*********************************************************************	
header("Content-Type: text/html;charset=utf-8");

 class LibRef{	
		
	//Se carga el Arreglo de Años Actual - 60
	function arrayAnio($val)
	{
		for($anio=(date ("Y")); $anio>(date ("Y") - 60); $anio--){
			echo"<option value='".$anio."'>".$anio."</option>";
		}
	}	
	//Se carga el Arreglo de meses
	function arrayMes($val)
	{
		echo"<option value='1'>Ene</option>";
		echo"<option value='2'>Feb</option>";
		echo"<option value='3'>Mar</option>";
		echo"<option value='4'>Abr</option>";
		echo"<option value='5'>May</option>";
		echo"<option value='6'>Jun</option>";
		echo"<option value='7'>Jul</option>";
		echo"<option value='8'>Agt</option>";
		echo"<option value='9'>Sep</option>";
		echo"<option value='10'>Oct</option>";
		echo"<option value='11'>Nov</option>";
		echo"<option value='12'>Dic</option>";
	}	
	
	//Despliega combo mes con el numero de mes seleccionado
	function ObtNomMes($numemes)
	{
		if($numemes==1){echo"<option selected value='1'>Ene</option>";}
		else{echo"<option value='1'>Ene</option>";}	
		if($numemes==2){echo"<option selected value='2'>Feb</option>";}
		else{echo"<option value='2'>Feb</option>";}
		if($numemes==3){echo"<option selected value='3'>Mar</option>";}
		else{echo"<option value='3'>Mar</option>";}	
		if($numemes==4){echo"<option selected value='4'>Abr</option>";}
		else{echo"<option value='4'>Abr</option>";}	
		if($numemes==5){echo"<option selected value='5'>May</option>";}
		else{echo"<option value='5'>May</option>";}	
		if($numemes==6){echo"<option selected value='6'>Jun</option>";}
		else{echo"<option value='6'>Jun</option>";}	
		if($numemes==7){echo"<option selected value='7'>Jul</option>";}
		else{echo"<option value='7'>Jul</option>";}	
		if($numemes==8){echo"<option selected value='8'>Agt</option>";}
		else{echo"<option value='8'>Agt</option>";}	
		if($numemes==9){echo"<option selected value='9'>Sep</option>";}
		else{echo"<option value='9'>Sep</option>";}	
		if($numemes==10){echo"<option selected value='10'>Oct</option>";}
		else{echo"<option value='10'>Oct</option>";}	
		if($numemes==11){echo"<option selected value='11'>Nov</option>";}
		else{echo"<option value='11'>Nov</option>";}	
		if($numemes==12){echo"<option selected value='12'>Dic</option>";}
		else{echo"<option value='12'>Dic</option>";}
 	} 
 	
 	//Despliega combo volveria a contratarolo
	function ObtvolvRef($volvRef)
	{
	    echo"<option value='0'>Selecciona</option>";
	    if($volvRef==1){echo" <option selected value='1'>Si</option>";}
		else{echo" <option value='1'>Si</option>";}	
		if($volvRef==2){echo"<option selected value='2'>No</option>";}
		else{echo"<option value='2'>No</option>";}		
 	} 

 	//Despliega radios para Evaluación, c
 	//Parametros: nombre, seleccionado
	function ObtRdoSel($nombre,$seleccionado)
	{
		$checked_1 = "";
		$checked_2 = "";
		$checked_3 = "";
		$checked_4 = "";
		$checked_5 = "";

		if($seleccionado==1){$checked_1 = "checked='checked'";}
		if($seleccionado==2){$checked_2 = "checked='checked'";}
		if($seleccionado==3){$checked_3 = "checked='checked'";}
		if($seleccionado==4){$checked_4 = "checked='checked'";}
		if($seleccionado==5){$checked_5 = "checked='checked'";}		

		echo"<td><input id='".$nombre."_1' name='".$nombre."' type='radio' tabindex='1' value=1 ".$checked_1.">";
		echo"<label for='".$nombre."_1'>1</label></td>";
		echo"<td><input id='".$nombre."_2' name='".$nombre."' type='radio' tabindex='2' value=2 ".$checked_2.">";
		echo"<label for='".$nombre."_2'>2</label></td>";
		echo"<td><input id='".$nombre."_3' name='".$nombre."' type='radio' tabindex='3' value=3 ".$checked_3.">";
		echo"<label for='".$nombre."_3'>3</label></td>";
		echo"<td><input id='".$nombre."_4' name='".$nombre."' type='radio' tabindex='4' value=4 ".$checked_4.">";
		echo"<label for='".$nombre."_4'>4</label></td>";
		echo"<td><input id='".$nombre."_5' name='".$nombre."' type='radio' tabindex='5' value=5 ".$checked_5.">";
		echo"<label for='".$nombre."_5'>5</label></td>";		
 	} 
 }

?>

