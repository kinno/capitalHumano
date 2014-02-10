$(function(){
    $("#user").button({
      icons: {
        primary: "ui-icon-person"
      }});
    $("#inicio")
            .button()
                .click(function() {
                        $(location).attr('href', "../");
                        });
    $("#solicitudes")
            .button()
                .hover(function() {
                        $(this).parent().nextAll("ul").hide();
                        var menu1 = $(this).parent().next().show().position({
                            my: "left top",
                            at: "left bottom",
                            of: this
                        });
                        $(window).one("click", function() {
                            menu1.hide();
                        });
                        menu1.on('mouseleave',function(){menu1.hide();});
                        return false;
                    });
     $("#vacantes").button().hover(function() {
                        $(this).parent().nextAll("ul").hide();
                        var menu2 = $(this).parent().next().next().show().position({
                            my: "left top",
                            at: "left bottom",
                            of: this
                        });
                        $(window).one("click", function() {
                            menu2.hide();
                        });
                        menu2.on('mouseleave',function(){menu2.hide();});
                        return false;
                    });
     $("#candidatos")
            .button()
                .hover(function() {
                        $(this).parent().nextAll("ul").hide();
                        var menu3 = $(this).parent().next().next().next().show().position({
                            my: "left top",
                            at: "left bottom",
                            of: this
                        });
                        $(window).one("click", function() {
                            menu3.hide();
                        });
                        menu3.on('mouseleave',function(){menu3.hide();});
                        return false;
                    });
      $("#catalogos").button().hover(function() {
                        $(this).parent().nextAll("ul").hide();
                        var menu4 = $(this).parent().next().next().next().next().show().position({
                            my: "left top",
                            at: "left bottom",
                            of: this
                        });
                        $(window).one("click", function() {
                            menu4.hide();
                        });
                        menu4.on('mouseleave',function(){menu4.hide();});
                        return false;
                    });
     $("#agenda").button();
     $("#reportes").button();
     $("#salir").button().click(function() {
                        $(location).attr('href', "out.php");
                        }).parent().buttonset().nextAll("ul").hide().menu();
     
    
    
});

function menu(mnu)
	{
		
		var obj = document.getElementById("div_hom");
		obj.innerHTML = "";

		switch (mnu)
		{

      //Inicio ----------------------------------
      case "inicio":
        obj.innerHTML = "<object type='text/html' data='inicio.html' class='homeobj' id='obj_inx'>";
        break;    
      //Solicitudes -----------------------------
      case "CatSoli":
        obj.innerHTML = "<object type='text/html' data='web_solicitudes.php' class='homeobj' id='obj_inx'>";
        break;
      case "RSoli":
	//if (sesion==1) {
	     obj.innerHTML = "<object type='text/html' data='web_requisicionPersonal.php'' class='homeobj' id='obj_inx'>";
	//}else{
	   // obj.innerHTML = "<object data='NoTienePermisos.html' class='homeobj' id='obj_inx'>";
	    //alert("No tiene los permisos para ingresar a este módulo");
	//}
        
        break;
      //Vacantes --------------------------------
      case "cVac":
        obj.innerHTML = "<object type='text/html' data='vacantes.php' class='homeobj' id='obj_inx'>";
        break;
    case "rCan":
        obj.innerHTML = "<object type='text/html' data='vacanteCandidato.php' class='homeobj' id='obj_inx'>";
        break;          
    
      case "reclu":
        obj.innerHTML = "<object type='text/html' data='cat_reclutadores/web_reclutadores.php' class='homeobj' id='obj_inx'>";
        break;     
      //Candidatos ------------------------------
      case "cand":
        obj.innerHTML = "<object type='text/html' data='web_candidatos.php' class='homeobj' id='obj_inx'>";
        break;          
      //busqueda de candidatos
      case "busCandi":
        obj.innerHTML = "<object type='text/html' data='cadidatos/busqueda/acordeon.php' class='homeobj' id='obj_inx'>";
        break;                            
      //Catálogos -------------------------------
      case "usu":
        obj.innerHTML = "<object type='text/html' data='usuarios/index.php' class='homeobj'  id='obj_inx'>";
        break;               
      case "perfil":
        obj.innerHTML = "<object type='text/html' data='cat_perfiles/web_perfil.php' class='homeobj' id='obj_inx'>";
        break;
      case "doc":
        obj.innerHTML = "<object type='text/html' data='cat_documentos/web_documentos.php' class='homeobj' id='obj_inx'>";
        break;
      case "esc":
        obj.innerHTML = "<object type='text/html' data='cat_escolaridad/web_Esc.php' class='homeobj' id='obj_inx'>";
        break;            
      case "pry":
        obj.innerHTML = "<object type='text/html' data='cat_proyectos/web_proy.php' class='homeobj' id='obj_inx'>";
        break;
      //Agenda -------------------------------
      case "agenda":
        obj.innerHTML = "<object type='text/html' data='calendario/agenda.php' class='homeobj'  id='obj_inx'>";
        break;                 
          
			//case "reclut":
      //obj.innerHTML = "<object data='cat_reclutadores/web_reclutadores.php' class='homeobj' id='obj_inx'>";
      //break;
      
		}		
	}