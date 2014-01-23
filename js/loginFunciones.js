///////////////////////////
$(function(){
       
        $("input[type=button],input[type=submit]").button(); 
	$("#formLogin").submit(function(){if(validaLogin()) return false; else return false;});
});

function validaLogin(){
	var NomEntUsu = $("#NomEntUsu").val();
	var PwdEntUsu = $("#PwdEntUsu").val();
	var url="verifica.php";
	$.post(url,{usua:NomEntUsu,paswd:PwdEntUsu},function(responseText){
                if(responseText=='bien')
                {
                    window.location='htdocs/home.php';                  

                }
                else
                {
                    $("#error").addClass("ui-state-error ui-corner-all");
                    $("#error").html("<span class='ui-icon ui-icon-alert' style='float: left;'></span>Usuario o Password<br>Incorrecto!").css("width","200px");
                }

	});
	
}
