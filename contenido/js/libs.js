//*********************************************************************
//Nombre: libs.js
//Funcion del Modulo: Funciones, validaciones
//Fecha:  28/05/2013
//Relizo: Graciela Martinez Mejia
//********************************************************************* 
function check_Click(obj){
        
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

//*********************************************************************
//Nombre:   SoloTextos
//Funcion:  letras numeros y espacios, acentos, ñ y parentesis (), #, etc
//Fecha:    28/05/2013
//Relizo:   Graciela Martínez Mejía
//Retorna:  true si cumple false si no.
//********************************************************************* 
function SoloTextos(evt) {
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
        (charCode == 35)                     ||     //# - Para direcciones
        (charCode == 42)                     ||     //Asteriscos
        (charCode == 43)                     ||     //Mas
        (charCode == 45)                     ||     //Menos
        (charCode == 44)                     ||     //Coma 
        (charCode == 46)                     ||     //Punto
        (charCode == 13)                     ||     //Salto de linea
        (charCode == 32))                           //Espacio                                         
    {
        return true;
    }
    return false;
}

//*********************************************************************
//Nombre:   soloLetras
//Funcion:  Acepta letras y espacio
//Parametros:
//Fecha:    27/05/2013
//Relizo:   Ricardo Lugo Recillas
//Retorna:  true si cumple false si no.
//********************************************************************* 
function soloLetras(evt){ 
    evt = (evt) ? evt : event; 
    var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode : 
    ((evt.which) ? evt.which : 0));
    if (charCode != 241 && charCode != 209 && charCode != 237 && charCode != 252 && charCode != 154 && charCode != 64 && charCode != 65 && charCode != 233 && charCode != 144 && charCode != 225 && charCode != 243 && charCode != 250 && charCode != 32 && charCode > 31 && (charCode < 64 || charCode > 90) && (charCode < 97 || charCode > 122)) {
        return false; 
    } 
    return true; 
}

//*********************************************************************
//Nombre:   soloNumeros
//Funcion:  Acepta solo Numeros
//Parametros:
//Fecha:    27/05/2013
//Relizo:   Ricardo Lugo Recillas
//Retorna:  true si cumple false si no.
//********************************************************************* 
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

//*********************************************************************
//Nombre:   SoloDecimal
//Funcion:  Acepta numeros y puntos
//Parametros: caracter digitado
//Fecha:    28/05/2013
//Relizo:   Graciela Martinez Mejia
//Retorna:  true si cumple false si no.
//********************************************************************* 
function SoloDecimal(evt) {
    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
    ((evt.which) ? evt.which : 0));
    //alert(charCode);
    if ((charCode >= 48  && charCode <=  57) ||     // Numeros 48-57
        (charCode == 46))                           //Punto        
    {
        return true;
    }
    return false;
}

//*********************************************************************
//Nombre:   soloTelefono
//Funcion:  Acepta numeros y guiones
//Parametros: caracter digitado
//Fecha:    28/05/2013
//Relizo:   Graciela Martinez Mejia
//Retorna:  true si cumple false si no.
//********************************************************************* 
function SoloTelefono(evt) {
    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
    ((evt.which) ? evt.which : 0));
    //alert(charCode);
    if ((charCode >= 48  && charCode <=  57) ||     // Numeros 48-57
        (charCode == 45)                     ||     // - Guion
        (charCode == 32))                           //Espacio                                         
    {
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
//Parametros:
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

//*********************************************************************
//Nombre:    numeroGuion
//Funcion:   numeroGuion valida numeros con guiones y minimo 10 digitos
//Parametros: Cadena de caracteres
//Fecha: 21/05/2013
//Relizo: Ricardo Lugo Recillas
//Retorna: true si cumple false si no.
//********************************************************************* 
function numeroGuion(valr)
{
    cadena='^([0-9,\-\]{10,15})$';
    re = new RegExp(cadena);
    
    if(valr.match(re))
    {
        return true;
    }
    else
    {
        return false;
    }
}

//*********************************************************************
//Nombre:     numeroTel
//Funcion:    Valida Numero de Telefono
//Parametros: Cadena del telefono
//Fecha:      28/05/2013
//Relizo:     Graciela Martinez Mejia
//Retorna: true si cumple false si no.
//********************************************************************* 
function ValidaTelefono(valr)
{
    cadena='^[0-9]{2,3}-? ?[0-9]{6,7}$';
    re = new RegExp(cadena);    
    if(valr.match(re))
    {
        return true;
    }
    else
    {
        return false;
    }
}

//*********************************************************************
//Nombre:     Validacorreo
//Funcion:    Validacorreo  el correo electronico
//Parametros: Cadena de correo
//Fecha:      21/05/2013
//Relizo:     Ricardo Lugo Recillas
//Retorna:    true si cumple false si no.
//********************************************************************* 
function Validacorreo(valr)
{
    cadena = '^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$'; 
    re = new RegExp(cadena);
    
    if (valr.match(re))
    {
        return true;
    }
    else
    {
        return false;
    }
} 

//*********************************************************************
//Nombre:   ValDecimal
//Funcion:  valida numero Decimal
//Fecha:    28/05/2013
//Relizo:   Graciela Martinez Mejia
//Retorna:  true si cumple false si no.
//********************************************************************* 
function ValDecimal(vr)
{
    cadena = /^[0-9]+[\.]*[0-9]*$/;
    re = new RegExp(cadena);
       
    if (vr.match(re))
    {
        return true; 
    }
        else
    {
        return false;
    }
}

//*********************************************************************
//Nombre:   ValidaText
//Funcion:  letras numeros y espacios, acentos, ñ y parentesis (), #
//Fecha:    28/05/2013
//Relizo:   Graciela Martinez Mejia
//Retorna:  true si cumple false si no.
//********************************************************************* 
function ValidaText(vr)
{                                                   //500-Caracteres max
    cadena =/^[a-zA-Z0-9.,\s\-\+\[\]()üÜáéíóúÁÉÍÓÚñÑ#*']{1,500}$/; 
    //alert(vr);
    re = new RegExp(cadena);         
    if (vr.match(re))
    {
        return true; 
    }
    else
    {
        return false;
    }
}

//**************************************************************
//Nombre: validar_input
//Descripcion: 1-Valida si el campo puede ser NULO
//             2-verifica que la longitud <=3
//             3-Valida longitud maxima
//Parametros:  objeto input, div, longitud minima, longitud maxima
//Realizo:     Graciela Martinez Mejia
//Fecha:       29/0/2013
//**************************************************************
function validar_input_txt(objinput,nominput,lenmin,lenmax)
{

    if(objinput.length == 0 && lenmin > 0)
    {
        
        $('#resultado').text(nominput + ' se encuentra vacio').addClass('msg_error');          
        return false;         
    }
    else if(objinput.length > 0 && objinput.length < 3)
    {
        $('#resultado').text(nominput + ' no valido');          
        return false;  
    }
    else if(objinput.length > lenmax)
        {
            $('#resultado').text(nominput + ' exede el número de caracteres permitidos, max: ' + lenmax);              
            return false; 
        }
    else{
        $('#resultado').text('');  
        return true; 
    }
}



        
