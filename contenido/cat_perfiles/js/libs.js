   function check_Click(obj) {
        
    }
   
      function soloLetras(evt){ 

            evt = (evt) ? evt : event; 
            var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode : 
            ((evt.which) ? evt.which : 0));
            
           if (charCode != 241 && charCode != 209 && charCode != 237 && charCode != 252 && charCode != 154 && charCode != 64 && charCode != 65 && charCode != 233 && charCode != 144 && charCode != 225 && charCode != 243 && charCode != 250 && charCode != 32 && charCode > 31 && (charCode < 64 || charCode > 90) && (charCode < 97 || charCode > 122))
           {
                 return false; 
          } 
            return true;
    }


