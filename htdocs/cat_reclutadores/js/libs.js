   function check_Click(obj) {
        
    }
      function soloLetras(evt){ //VALIDA QUE SOLO SE INGRESEN LETRAS EN LA CAJA DE TEXTO PARA NOMBRE DEL USUARIO

            evt = (evt) ? evt : event; 
            var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode : 
            ((evt.which) ? evt.which : 0));
            if (charCode != 241 && charCode != 209 && charCode != 237 && charCode != 252 && charCode != 154 && charCode != 64 && charCode != 65 && charCode != 233 && charCode != 144 && charCode != 225 && charCode != 243 && charCode != 250 && charCode != 32 && charCode > 31 && (charCode < 64 || charCode > 90) && (charCode < 97 || charCode > 122)) {
                 return false; 
            } 
            return true; 

    }
    function LetrasNumSE(evt) {  

    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
    ((evt.which) ? evt.which : 0));
    //alert(charCode);
    if (charCode != 241 && charCode != 209 && charCode != 237 && charCode != 252 && charCode != 154 && charCode != 64 && charCode != 65 && charCode != 233 && charCode != 144 && charCode != 225 && charCode != 243 && charCode != 250 && charCode != 8 && charCode > 31 && (charCode < 48 || charCode > 57) && charCode > 31 && (charCode < 64 || charCode > 90) && (charCode < 97 || charCode > 122)) {
        
        return false;
    }
    return true;

    }

    function email(evt) { //VALIDA EL EMAIL

        evt = (evt) ? evt : event;
        var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
        ((evt.which) ? evt.which : 0));
        if (charCode != 64 && charCode != 46 && charCode != 95 && charCode != 45 && charCode != 8 && charCode > 31 && (charCode < 48 || charCode > 57) &&  charCode > 31 && (charCode < 64 || charCode > 90) && (charCode < 97 || charCode > 122)) {
            return false;
        }
        return true;

    }
    