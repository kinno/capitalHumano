//*********************************************************************
//Nombre: libs.js
//Funcion del Modulo: Funciones, validaciones
//Fecha:  28/05/2013
//Relizo: Graciela Martinez Mejia
//********************************************************************* 
   function check_Click(obj) {
        
    }

    //letras numeros y espacios, acentos, ñ y parentesis ()
   function LetrasNumEsp(evt) {
        evt = (evt) ? evt : event;
        var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
        ((evt.which) ? evt.which : 0));
        //alert(charCode);
        if ((charCode >= 48  && charCode <=  57) ||     // Numeros 48-57
            (charCode >= 65  && charCode <=  90) ||     //maysuculas: A-Z
            (charCode >= 97  && charCode <= 122) ||     //minusculas: a-z
            (charCode >= 40  && charCode <=  41) ||     //()
            (charCode == 225)                    ||     //á
            (charCode == 233)                    ||     //é
            (charCode == 237)                    ||     //í
            (charCode == 243)                    ||     //ó
            (charCode == 250)                    ||     //ú
            (charCode == 241)                    ||     //ñ
            (charCode == 209)                    ||     //Ñ
            (charCode == 32))                           //Espacio                                         
        {
            return true;
        }
        return false;
    }

    //Letras
    function soloLetras(evt){ 
            evt = (evt) ? evt : event; 
            var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode : 
            ((evt.which) ? evt.which : 0));
            if (charCode != 241 && charCode != 209 && charCode != 237 && charCode != 252 && charCode != 154 && charCode != 64 && charCode != 65 && charCode != 233 && charCode != 144 && charCode != 225 && charCode != 243 && charCode != 250 && charCode != 32 && charCode > 31 && (charCode < 64 || charCode > 90) && (charCode < 97 || charCode > 122)) {
                 return false; 
            } 
            return true; 

    }

    //GMM001 - 0-48, 1-49, 2-50 ... 9-57
    function soloNumeros(evt) {
        evt = (evt) ? evt : event;
        var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
        ((evt.which) ? evt.which : 0));
        //alert(charCode);
        if (charCode >= 48 && charCode <= 57){
            return true;
        }
        return false;
    }

    //Correo Electronico   
    function email(evt) {
        evt = (evt) ? evt : event;
        var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
        ((evt.which) ? evt.which : 0));
        if (charCode != 64 && charCode != 46 && charCode != 95 && charCode != 45 && charCode != 8 && charCode > 31 && (charCode < 48 || charCode > 57) &&  charCode > 31 && (charCode < 64 || charCode > 90) && (charCode < 97 || charCode > 122)) {
            return false;
        }
        return true;

    }
    
//*********************************************************************
//Nombre:   Validafecha
//Funcion:  Valida que la fecha sea correcta
//Fecha:    27/05/2013
//Relizo:   Graciela Martínez Mejía
//Retorna:  true si cumple false si no.
//********************************************************************* 
function Validafecha(anio,mes,dia)
{    
    band_valida = 1;    
    switch(mes)
    {
        case 1:
            //Enero acepta 31 Dias
            break;
        case 2:
            //Si es Bisiesto
            if((anio % 4) == 0 && dia>29){                   
                band_valida = 0;
            }
            else if((anio % 4) != 0 && dia>28){   
                band_valida = 0;
            }
            break;
        case 3:
            //Acepta 31 Dias
            break;
        case 4:
            if(dia>30)
            {
                band_valida = 0;             
            }
            break;
        case 5:
            //Acepta 31 Dias
            break;
        case 6:
            if(dia>30)
            {
                band_valida = 0;             
            }
            break;
        case 7:
            //Acepta 31 Dias
            break;
        case 8:
             //Acepta 31 Dias
            break;
        case 9:
            if(dia>30)
            {
                band_valida = 0;            
            }
            break;
        case 10:
            //Acepta 31 Dias
            break;
        case 11:
            if(dia>30)
            {
                band_valida = 0;              
            }
            break;
        case 12:
            //Acepta 31 Dias
            break;
        default:
            band_valida = 0;                      
    }

    if (band_valida == 0){
        return false;
    }
    else{
        return true;
    }
}