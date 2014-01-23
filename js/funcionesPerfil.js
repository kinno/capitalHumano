/* 
 * Regino Tabares
 * 
 */
$(document).tooltip().ready(function(){ 
    //tablas
    $("button").button(); 
   
   $('#listaPerfil').dataTable( { //CONVERTIMOS NUESTRO LISTADO DE LA FORMA DEL JQUERY.DATATABLES- PASAMOS EL ID DE LA TABLA
        "sPaginationType": "full_numbers" //DAMOS FORMATO A LA PAGINACION(NUMEROS)
    } );

            
    
    $("#listaPerfil_filter").find("input:first").attr("onkeyup","resalta()");
    
    $("#nuevo").button();
    $("#nuevoPerfil").dialog({
     autoOpen: false,
     modal:true,
     width:800,
     height:415,
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
   $("#modificaPerfil").dialog({
     autoOpen: false,
     modal:true,
     width:800,
     height:450,
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
       $("#nuevoPerfil").dialog("open");
       
			$.ajax(
				{
					type:'get',
					url:'perfilnuevos.php',
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
                        url:'perfiles.php',
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
     $("#listaPerfil").unhighlight();
     $(".highlight").css({ backgroundColor: "#FFFF88" });
    $("#listaPerfil").highlight($("#listaPerfil_filter").find("input:first").val());
}
