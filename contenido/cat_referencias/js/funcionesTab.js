$(document).ready(function(){

	var id = $('#idCandid').val();	
    verlistado(id)   //Se envia como parametro idCandidato
})

function verlistado(id){ 	
	var randomnumber=Math.random()*11;	
    $.post("libs/listarRef.php?idCandid="+id, {		//GMM001-Se llama al Archivo que realiza lista
        randomnumber:randomnumber
    }, function(data){
       $("#contenido").html(data);
    });
}