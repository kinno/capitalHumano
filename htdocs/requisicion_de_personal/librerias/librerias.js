var seleccionados = new Array(4); //variable global que guarda las casillas que se selecionaron lo ocupa la funci�n "verifCheck"
                                 //Consideramos que el   elemento 0 corresponde a check "ingl�s"
                                                       //elemento 1 corresponde a check "franc�s"
                                                       //elemento 2 corresponde a check "alem�n"
                                                       //elemento 3 corresponde a check "portug�s"

/*Nombre del M�dulo: mostrar
 *Funci�n: Muestra un elemento sapan que contiene contiene una llamada a una funci�n PHP que devuelve un comboBox con los porcentajes de los idiomas
 *Par�metros: El id del span a mostar (originalmente este span esta oculto)
 *Realiz�: Jesus Abel Vera Cruz
 *Fecha:20-05-2013
 */
function mostrar(id)//recibe el id del  span donde se encuentra el combo box y lo muestra
{
   document.getElementById(id).style.display="block"; 
}
/*Nombre del M�dulo: VerifCheck
 *Funci�n: verifica cual caja esta activa, si esta activa muestra el combo de porcentaje y si no esta activa no muestra el combo de porcentaje
 *Par�metros: Recibe como par�metros el id del check box que se selecciono.
 *Realiz�: Jesus Abel Vera Cruz
 *Fecha:20-05-2013
 */
function verifCheck(id) 
{
     //va a guardar las casillas seleccionadas 
    casilla=document.getElementById(id);
    //si alguna casilla esta desactivada la activa, esto aplica s�lo cuando ya se eligier�n tres idiomas y luego volv�o a seleccionar otros tres idiomas
    document.getElementById('idiomas_0').disabled=false;
    document.getElementById('idiomas_1').disabled=false;
    document.getElementById('idiomas_2').disabled=false;
    document.getElementById('idiomas_3').disabled=false;
    switch (id) {
        
         case 'idiomas_0':
         if (!(casilla.checked))
         {
            document.getElementById("ingles").style.display="none";
            seleccionados[0]=0;//si la casilla no esta seleccionada le asignamos vacio a la posicion 0
            
             
         }
         else
         {
            seleccionados[0]=1; //si esta seleccionada le asignamos uno la posici�n cero
            
         }
          break;
         case 'idiomas_1':
         if (!(casilla.checked))
         {
            document.getElementById("frances").style.display="none";            
            seleccionados[1]=0;//si la casilla no esta seleccionada le asignamos vacio a la posicion 1
           
             
         }
         else
         {
            seleccionados[1]=1;
            
         }
          break;
        case 'idiomas_2':
         if (!(casilla.checked))
         {
            document.getElementById("aleman").style.display="none";
            seleccionados[2]=0;//si la casilla no esta seleccionada le asignamos vacio a la posicion 2
           
             
         }
         else
         {
            seleccionados[2]=1;
            
         }
          break;
        default:
         if (!(casilla.checked))
         {
            document.getElementById("portugues").style.display="none";
            seleccionados[3]=0;//si la casilla no esta seleccionada le asignamos vacio a la posicion 3
           
         }else
         {
            seleccionados[3]=1;
            
         }   
          break;
    }
  var cantidad=0;
  for (i=0;i<4;i++)
  {
    if (seleccionados[i])
    {
       cantidad++;
    }
  }
   if (cantidad==3) //si la cantidad de "unos" en el arreglo seleccionado es igual a 3, llamamos a la funci�n para desabilitar la casilla restante
   {
    desCasillas();
   }
  
}
/*Nombre del M�dulo: desCasillas
 *Funci�n: Desactiva la casilla que no fue seleccionada 
 *Par�metros: No recibe ni regresa
 *Realiz�: Jesus Abel Vera Cruz
 *Fecha:20-05-2013
 */
function desCasillas() //meneja el arreglo global con las casillas seleccionadas 
{
    //estos condicionales desactivan la casilla que no se selecciono despues de tres seleccionadas por el usuario
    if (!(seleccionados[0]))
    {
       document.getElementById('idiomas_0').disabled=true;
    }
    if (!(seleccionados[1]))
    {
      document.getElementById('idiomas_1').disabled=true;
    }
    if (!(seleccionados[2]))
    {
      document.getElementById('idiomas_2').disabled=true;
    }
    if (!(seleccionados[3]))
    {
      document.getElementById('idiomas_3').disabled=true;
    }
}
//muestra los caja y radio botones en caso de que el empleo sea temporal
//creacion: 
//27/05/2013
function muestraDuracion(id)
{
  
  switch (id)
  {
   case "creacion":
      
       document.getElementById("tiempoTrabajo").style.display="none";
       //document.getElementById("sprytextfield1").style.display="none";
      break;
   case "remplazo":
     
       document.getElementById("tiempoTrabajo").style.display="none";
       // document.getElementById("sprytextfield1").style.display="none";
      break;
   
   default:
       document.getElementById("tiempoTrabajo").style.display="block";
        //document.getElementById("sprytextfield1").style.display="block";
      break;
  }
}
function muestraFrecuencia(id)
{  
    
   switch (id)
  {
   case "si":
      document.getElementById("frec").style.display="block";
      break;
   default:
       document.getElementById("frec").style.display="none";
      break;
  }
}