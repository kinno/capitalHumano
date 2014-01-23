var seleccionados = new Array(4); //variable global que guarda las casillas que se selecionaron lo ocupa la función "verifCheck"
                                 //Consideramos que el   elemento 0 corresponde a check "inglés"
                                                       //elemento 1 corresponde a check "francés"
                                                       //elemento 2 corresponde a check "alemén"
                                                       //elemento 3 corresponde a check "portugés"

/*Nombre del Módulo: mostrar
 *Función: Muestra un elemento sapan que contiene contiene una llamada a una función PHP que devuelve un comboBox con los porcentajes de los idiomas
 *Parámetros: El id del span a mostar (originalmente este span esta oculto)
 *Realizó: Jesus Abel Vera Cruz
 *Fecha:20-05-2013
 */
function mostrar(id)//recibe el id del  span donde se encuentra el combo box y lo muestra
{
   document.getElementById(id).style.display="block"; 
}
/*Nombre del Módulo: VerifCheck
 *Función: verifica cual caja esta activa, si esta activa muestra el combo de porcentaje y si no esta activa no muestra el combo de porcentaje
 *Parámetros: Recibe como parámetros el id del check box que se selecciono.
 *Realizó: Jesus Abel Vera Cruz
 *Fecha:20-05-2013
 */
function verifCheck(id) 
{
     //va a guardar las casillas seleccionadas 
    casilla=document.getElementById(id);
    //si alguna casilla esta desactivada la activa esto aplica sólo cuando ya se eligierón tres idiomas y luego se hizo volvío a seleccionar otros tres idiomas
    document.getElementById('idiomas_0').disabled=false; //ingles
    document.getElementById('idiomas_1').disabled=false;//frances
    document.getElementById('idiomas_2').disabled=false;//aleman
    document.getElementById('idiomas_3').disabled=false;//portugues
    switch (id) {
        
         case 'idiomas_0':
         if (!(casilla.checked))
         {
            document.getElementById("ingles").style.display="none";
            seleccionados[0]=0;//si la casilla no esta seleccionada le asignamos vacio a la posicion 2
            
             
         }
         else
         {
            seleccionados[0]=1;
            
         }
          break;
         case 'idiomas_1':
         if (!(casilla.checked))
         {
            document.getElementById("frances").style.display="none";
            seleccionados[1]=0;//si la casilla no esta seleccionada le asignamos vacio a la posicion 2
           
             
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
   if (cantidad==3) //si la cantidad de "unos" en el arreglo seleccionado es igual a 3 llamamos a la función para desabilitar la casilla restante
   {
    desCasillas();
   }
  
}
/*Nombre del Módulo: desCasillas
 *Función: Desactiva la casilla que no fue seleccionada 
 *Parámetros: No recibe ni regresa
 *Realizó: Jesus Abel Vera Cruz
 *Fecha:20-05-2013
 */
function desCasillas() //recibe el arreglo con las casillas seleccionadas 
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