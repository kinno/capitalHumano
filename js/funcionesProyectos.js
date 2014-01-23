/* 
 * Regino Tabares
 * 
 */
$(document).tooltip().ready(function(){ 
    //tablas
    $("button").button(); 
   
   $('#listaEsc').dataTable( { //CONVERTIMOS NUESTRO LISTADO DE LA FORMA DEL JQUERY.DATATABLES- PASAMOS EL ID DE LA TABLA
        "sPaginationType": "full_numbers" //DAMOS FORMATO A LA PAGINACION(NUMEROS)
    } );

            
    
    $("#listaEsc_filter").find("input:first").attr("onkeyup","resalta()");
    
    $("#nuevo").button();
    $("#nuevoEscolaridad,#modificaEscolaridad").dialog({
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
       $("#nuevoEscolaridad").dialog("open");
       
			$.ajax(
				{
					type:'get',
					url:'EscNuevo.php',  //GMM001 - Cambiar nombre del Archivo
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
  $("#modificaEscolaridad").dialog("open");
               $.ajax({
                        type:'get',
                        url:'Esc.php',
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
     $("#listaEsc").unhighlight();
     $(".highlight").css({ backgroundColor: "#FFFF88" });
    $("#listaEsc").highlight($("#listaEsc_filter").find("input:first").val());
}
