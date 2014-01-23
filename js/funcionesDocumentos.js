/* 
 * Regino Tabares
 * 
 */
$(document).tooltip().ready(function(){ 
    //tablas
    $("button").button(); 
   
   $('#listaDoc').dataTable( { //CONVERTIMOS NUESTRO LISTADO DE LA FORMA DEL JQUERY.DATATABLES- PASAMOS EL ID DE LA TABLA
        "sPaginationType": "full_numbers" //DAMOS FORMATO A LA PAGINACION(NUMEROS)
    } );

            
    
    $("#listaDoc_filter").find("input:first").attr("onkeyup","resalta()");
    
    $("#nuevo").button();
    $("#nuevoDocumento,#modificaPerfil").dialog({
     autoOpen: false,
     modal:true,
     width:450,
     height:180,
     resizable:false,
      show: {
        effect: "clip",
        duration: 500
      },
      hide: {
        effect: "clip",
        duration: 500
      }  
   });
   
   $("#nuevo").click(function(){
       $("#nuevoDocumento").dialog("open");
       
			$.ajax(
				{
					type:'get',
					url:'documentoNuevo.php',
					data:{
						accion:'N',
						
					},
					success:function(data){

						$('#contDialog').html(data);   
                                                $("button").button();
                                                
					},
					error:function(){
						alert("error !");

					}
				});
		});
});

function on(id){
  $("#modificaPerfil").dialog("open");
               $.ajax({
                        type:'get',
                        url:'documento.php',
                        data:
                        {
                          ids:id
                        },
                        success:function(data){
                          $('#contModifica').html(data);   
                          $("#modif,#eliminar").button();
                        },
                        error: function()
                        {
                          alert("error");
			  
                        }
                    });       
    }

function resalta(){
     $("#listaDoc").unhighlight();
     $(".highlight").css({ backgroundColor: "#FFFF88" });
    $("#listaDoc").highlight($("#listaDoc_filter").find("input:first").val());
}
