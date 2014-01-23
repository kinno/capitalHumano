<?php 


include"../../libs/libs.php"; 

 //SE EJECUTA LA CONSULTA
class Vacantes{
    
    
    function Vacantes(){
        
    }
    
    function obtener_solicitudes(){
        $funciones= new funciones;
        $funciones->conectar();
        $sqlB="select *,nomProyecto,descPerfil from tblsolicitud sol 
            join tblproyecto pry on sol.idProyecto=pry.idProyecto
            join tblperfil pfl on sol.idPerfil = pfl.idPerfil
        where sol.statSolici=2";
        $queryB=mysql_query($sqlB) or die(mysql_error());
        $datos = array();
            while($fila=  mysql_fetch_array($queryB)){
                $datos[]=$fila;                
            }
            return $datos;
    }
    
    function obtener_numasignadas($folio){
        $funciones = new funciones();
        $funciones->conectar();
        $query="select count(*) from tblvacante where folSolici='".$folio."'";
        $result=mysql_query($query) or die(mysql_error());
        $datos=array();
        while($fila=  mysql_fetch_array($result)){
                $datos[]=$fila;                
            }
            return $datos;
    }
    
    function obtener_reclutadores(){
        $funciones = new funciones();
        $funciones->conectar();
        $query="select * from tblreclut where fecbaja is null";
        $result=  mysql_query($query) or die(mysql_error());
        $datos=array();
        while($fila=  mysql_fetch_array($result)){
            $datos[]=$fila;
        }
        return $datos;
    }
    
    function asignar_reclutadores($folSolici,$idReclutador,$compPerfil,$statVacante){
         
        $funciones = new funciones();
        $funciones->conectar();
        $query = "insert into tblvacante (folSolici,idReclutador,compPerfil,statVacante,fecalta)
                    values ('$folSolici',$idReclutador,$compPerfil,$statVacante,now())";
        if(mysql_query($query)){
            $resultado='ok';
            return $resultado;
        }
        else{
            echo $query;
            return mysql_error();
        }
    }
    
    function obtener_vacantes(){
        $funciones = new funciones();
        $funciones->conectar();
        $query="select vac.folSolici,vac.numVacante,vac.idCandid,pry.nomProyecto,pfl.descPerfil,rec.nomReclut,rec.appReclut,rec.apmReclut,vac.compPerfil,vac.statVacante from tblvacante vac
                    join tblsolicitud sol on vac.folSolici = sol.folSolici
                    join tblproyecto pry on sol.idProyecto = pry.idProyecto
                    join tblperfil pfl on sol.idPerfil = pfl.idPerfil
                    join tblreclut rec on vac.idReclutador = rec.idReclut";
        $result=  mysql_query($query) or die(mysql_error());
        $datos=array();
        while($fila=  mysql_fetch_array($result)){
            $datos[]=$fila;
        }
        return $datos;
    }
    
    function obtener_candidatos(){
        $funciones = new funciones();
        $funciones->conectar();
        $query="select * from tblcandidato";
        $result=  mysql_query($query) or die(mysql_error());
        $datos=array();
        while($fila=  mysql_fetch_array($result)){
            $datos[]=$fila;
        }
        return $datos;
    }
    
    function nombre_candidato($idCandid){
        $funciones = new funciones();
        $funciones->conectar();
        $query="select nomCandid, appCandid, apmCandid from tblcandidato where idCandid=$idCandid";
        $result=  mysql_query($query) or die(mysql_error());
        $fila=  mysql_fetch_array($result);
            $nombre = $fila['nomCandid'].' '.$fila['appCandid'].' '.$fila['apmCandid']; 
        
        return $nombre;
    }
    
    function asignar_candidato($numVacante,$idCandid){
        $funciones = new funciones();
        $funciones->conectar();
        $query="update tblvacante set idCandid =$idCandid where numVacante=$numVacante";
        if(mysql_query($query)){
            $resultado='ok';
            return $resultado;
        }
        else{
            echo $query;
            return mysql_error();
        }
    }
    
    function agendaEntrevista($numVacante,$fecEntrev,$horEntrev,$nomEentrev,$lugarEentrev,$ObsEntrev,$statEntrev){
        $funciones = new funciones();
        $funciones->conectar();
        $query="insert into tblentrevista(numVacante,fecEntrev,horEntrev,nomEentrev,lugarEntrev,ObsEntrev,fecalta,statEntrev)
                values ($numVacante,'".$fecEntrev." ".$horEntrev."','".$horEntrev."','".$nomEentrev."','".$lugarEentrev."','".$ObsEntrev."',now(),'".$statEntrev."')";
        if(mysql_query($query)){
            $resultado='ok';
            return $resultado;
        }
        else{
            echo $query;
            return mysql_error();
        }
    }
    
    function consulta_entrevista(){
        $funciones = new funciones();
        $funciones->conectar();
        $query="select entr.fecEntrev,entr.lugarEntrev,can.nomCandid,can.appCandid,can.apmCandid,pry.nomProyecto,pfl.descPerfil from tblentrevista entr
                join tblvacante vac on entr.numVacante = vac.numVacante
                join tblcandidato can on vac.idCandid = can.idCandid
                join tblsolicitud sol on vac.folSolici = sol.folSolici
                join tblproyecto pry on sol.idProyecto = pry.idProyecto
                join tblperfil pfl on sol.idPerfil = pfl.idPerfil";
        $result=  mysql_query($query) or die(mysql_error());
        $datos=array();
        while($fila=  mysql_fetch_array($result)){
            $datos[]=$fila;
        }
        return $datos;
    }
    
    function entrevista_especifica($numVacante){
        $funciones = new funciones();
        $funciones->conectar();
        $query="select entr.fecEntrev,entr.lugarEntrev,entr.ObsEntrev,can.nomCandid,can.appCandid,can.apmCandid,pry.nomProyecto,pfl.descPerfil from tblentrevista entr
                join tblvacante vac on entr.numVacante = vac.numVacante
                join tblcandidato can on vac.idCandid = can.idCandid
                join tblsolicitud sol on vac.folSolici = sol.folSolici
                join tblproyecto pry on sol.idProyecto = pry.idProyecto
                join tblperfil pfl on sol.idPerfil = pfl.idPerfil
                where entr.numVacante=".$numVacante;
        $result=  mysql_query($query) or die(mysql_error());
        $datos=array();
        while($fila=  mysql_fetch_array($result)){
            $datos[]=$fila;
        }
        return $datos;
    }
    
    function con_entrevista($numVacante){
        $funciones = new funciones();
        $funciones->conectar();
        $query="select numVacante from tblentrevista where numVacante=$numVacante";
        $result = mysql_query($query) or die(mysql_error());
            if(mysql_fetch_array($result)>1)
            return 'si';
    }
    
}
?>
