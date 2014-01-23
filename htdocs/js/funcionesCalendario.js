$(document).ready(function() {
   
    // page is now ready, initialize the calendar...
        var limite = $("#numEventos").val();
         var eventos=[];
        var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
                for(var i=0;i<limite;i++)
                { 
                    var desc="Nombre del Candidato: "+$("#title"+i).val()+"\rLugar: "+$("#lugar"+i).val()+"\nProyecto: "+$("#proyecto"+i).val()+"\nPuesto: "+$("#perfil"+i).val();
                    var fechaEvento =$("#start"+i).val();//+","+$("#hora"+i).val().replace(":",",");
                eventos.push({title:$("#title"+i).val(),start:fechaEvento,allDay: false,
                        tip:desc});
                
                }
                console.log(eventos);
    $('#calendar').fullCalendar({
        // put your options and callbacks here
        theme:true,
        header:{
        left:"prev,next",
        center:'title',
        right: 'month,basicWeek,basicDay'
        },
        editable:false,
        dayNames:['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado',],
        dayNamesShort:['Dom','Lun','Mar','Mie','Jue','Vie','Sab',],
        monthNames:['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
        buttonText:{today:'Día',month:'Mes',week:'Semana',day:'Día'},
        events: eventos,
        selectable: true,
        eventRender: function(event, element) {
            element.attr('title', event.tip);
             /*element.qtip({
            content: event.tip,
        });*/
        }
    });
    // $(".fc-event").tooltip();
});