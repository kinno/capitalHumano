$(document).ready(function() {
   
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    
    	var tooltip = $('<div/>').qtip({
		id: 'calendar',
		prerender: true,
		content: {
			text: ' ',
			title: {
				button: false
			}
		},
		position: {
			my: 'top left',
			at: 'bottom center',
			target: 'event',
			viewport: $('#calendar'),
			adjust: {
				mouse: false,
				scroll: false
			}
		},
		show: false,
		hide: false,
		style: {
                    classes: 'qtip-rounded qtip-shadow qtip-tipsy'
                }
	}).qtip('api');
    
    $('#calendar').fullCalendar({
        // put your options and callbacks here
        theme:true,
        //height: 650,
        aspectRatio:2,
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
        events: "../controlador/buscaEntrevistasAgenda.php",
        selectable: false,
        eventClick:  function(data, event, view) {
            $("#calendar").find(".active").each(function(){
                $(this).removeClass('active');
            });
            var content='<span class="title">Hora: </span>' + ($.fullCalendar.formatDate(data.start, 'hh:mmtt')) + '<br><span class="title">Entrevistador: </span>' + data.entrevistador
                                                        + '<br><span class="title">Lugar: </span>' + data.lugar + '<br><span class="title">Perfil: </span>' + data.perfil;
            var title ='<span></span>'+data.subproyecto+'<br><span></span>'+data.proyecto;    
            
            tooltip.set({
                        'content.text':content,
                        'content.title':title
                        }).reposition(event).show(event);
            $(this).addClass( "active" );            
        },
       // eventMouseout:function(){tooltip.hide()},
        dayClick: function() { tooltip.hide(); 
            $("#calendar").find(".active").each(function(){
                $(this).removeClass('active');
            });},
        //eventClick: function(){tooltip.hide()},
        eventResizeStart: function() { tooltip.hide() },
        eventDragStart: function() { tooltip.hide() },
        viewDisplay: function() { tooltip.hide() },                                                          
    });
    // $(".fc-event").tooltip();
});