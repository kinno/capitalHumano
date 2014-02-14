<?php 

//session_start();

include"../libs/libs.php"; 

 //SE EJECUTA LA CONSULTA
class Vacantes{
    
    
    function Vacantes(){
        
    }
    
    function obtener_solicitudes(){
        $funciones= new funciones;
        $funciones->conectar();
        $sqlB="select * from tblsolicitud sol
                    left join tblsubproyecto sub on sub.idSubproyecto = sol.idSubproyecto
                    left join tblproyecto pry on pry.idProyecto = sub.idProyecto
                    left join tblperfil pfl on sol.idPerfil = pfl.idPerfil
                where sol.statSolici=2;";
       
        $queryB=mysql_query($sqlB) or die(mysql_error());
        $datos = array();
            while($fila=  mysql_fetch_array($queryB)){
                $datos[]=$fila;                
            }
            return $datos;
    }
    
    function obtener_candidatos(){
        $funciones = new funciones();
        $funciones->conectar();
        $query="select * from tblcandidato 
                    left join tblcandidatoda on tblcandidatoda.idCandid = tblcandidato.idCandid
                    left join tblcandidatodp on tblcandidatodp.idCandid = tblcandidato.idCandid
                    left join tblcandidatoest on tblcandidatoest.idCandid = tblcandidato.idCandid
                where tblcandidato.idCandid in (
                                                select idCandid from tblcandidatorl
                                                left join tblresreferencia on tblresreferencia.idReferencia = tblcandidatorl.idReferencia
                                                where tblresreferencia.idReferencia is not null
                                                group by tblcandidatorl.idCandid
                                                )";
        $result=  mysql_query($query) or die(mysql_error());
        $datos=array();
        while($fila=  mysql_fetch_array($result)){
            $datos[]=$fila;
        }
        return $datos;
    }
    
    function obtener_numasignadas($folio){
        $funciones = new funciones();
        $funciones->conectar();
        $query="select count(*) from tblvacante where folSolici='".$folio."' and fecbaja is null";
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
        $query="SELECT * FROM bdrh.tblusuarios where idRol in (2,5) and fecbaja is null;";
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
    
    function enviar_correo($idReclutador,$folColici){
        include_once("../libs/mail.php");
        $mail=new mail();
        $mailReclutador="SELECT mailUsuario FROM tblusuarios WHERE idUsuario=".$idReclutador;
        $result=mysql_query($mailReclutador) or die(mysql_error());
        $correo=mysql_result($result,0,'mailUsuario');
        $mensaje="Se le ha asignado una nueva vacante, con el folio $folColici, para más detalles por favor ingrese al Sistema de Capital Humano";
        $subject="Nueva asignación de vacante";
        $correorh='';
        $mail->enviarMail($correo, $mensaje, $subject, $correorh);
    }
    
    function obtener_vacantes($idUsuario){
        $funciones = new funciones();
        $funciones->conectar();
        /*$query="select vac.folSolici,vac.numVacante,vac.idCandid,pry.nomProyecto,pfl.descPerfil,rec.nomReclut,rec.appReclut,rec.apmReclut,vac.compPerfil,vac.statVacante from tblvacante vac
                    join tblsolicitud sol on vac.folSolici = sol.folSolici
                    left join
                     tblsubproyecto sub ON sub.idSubproyecto = sol.idSubproyecto
                    left join
                     tblproyecto pry ON pry.idProyecto = sub.idProyecto
                    join tblperfil pfl on sol.idPerfil = pfl.idPerfil
                    join tblreclut rec on vac.idReclutador = rec.idReclut";*/
        $query = "select 
                        vac.folSolici,
                        vac.numVacante,
                        vac.fecalta,
                        usr.idUsuario,
                        pry.nomProyecto,
                        pfl.descPerfil,
                        vac.compPerfil,
                        vac.statVacante,	
                            count(vac.folSolici) as Vacantes
                    from
                        tblvacante vac
                            join
                        tblsolicitud sol ON vac.folSolici = sol.folSolici
                            left join
                        tblsubproyecto sub ON sub.idSubproyecto = sol.idSubproyecto
                            left join
                        tblproyecto pry ON pry.idProyecto = sub.idProyecto
                            join
                        tblperfil pfl ON sol.idPerfil = pfl.idPerfil
                            join
                        tblusuarios usr ON vac.idReclutador = usr.idUsuario
                    where vac.fecbaja is null and usr.idUsuario =".$idUsuario."
                    group by folSolici, usr.idUsuario";
        
        $result=  mysql_query($query) or die(mysql_error());
        $datos=array();
        while($fila=  mysql_fetch_array($result)){
            $datos[]=$fila;
        }
        return $datos;
    }
    
    function datos_vacante($folio){
         $funciones = new funciones();
            $funciones->conectar();
            $query="SELECT * FROM bdrh.tblsolicitud
                        left join tblsubproyecto on tblsubproyecto.idSubproyecto = tblsolicitud.idSubproyecto
                        left join tblperfil on tblperfil.idPerfil = tblsolicitud.idPerfil
                    where folSolici =".$folio;
            $result=  mysql_query($query) or die(mysql_error());
            $datos=array();
            while($fila=  mysql_fetch_array($result)){
                $datos[]=$fila;
            }
            return $datos;
    }
    
    function vacante_reclutador($folio){
        $funciones = new funciones();
        $funciones->conectar();
        $query = "SELECT *,count(folSolici) asignadas FROM tblvacante
                    join tblusuarios on tblusuarios.idUsuario = tblvacante.idReclutador
                where folSolici=".$folio." and tblvacante.fecbaja is null
                group by idReclutador;";
        $result=  mysql_query($query) or die(mysql_error());
            $datos=array();
            while($fila=  mysql_fetch_array($result)){
                $datos[]=$fila;
            }
            return $datos;
    }
    
    function cambiar_reclutador($folio,$reclutadorAnterior,$reclutadorNuevo){
         $funciones = new funciones();
            $funciones->conectar();
            $query="update tblvacante set idReclutador = ".$reclutadorNuevo." where folSolici =".$folio." and idReclutador =".$reclutadorAnterior."" ;
            echo $query;
           if(mysql_query($query)){
                $resultado='ok';
                return $resultado;
            }
            else{
                echo $query;
                return mysql_error();
            }
        
    }
    
    function quitar_reclutador($folio,$idReclutador){
         $funciones = new funciones();
            $funciones->conectar();
            $query="update tblvacante set fecBaja = now() where folSolici =".$folio." and idReclutador =".$idReclutador."" ;
            echo $query;
            mysql_query($query) or die(mysql_error());
               
        
    }
    
    function candidatos_registrados($folio){
        $funciones = new funciones();
        $funciones->conectar();
        $query="SELECT * FROM relvaccand
                    left join tblcandidato on tblcandidato.idCandid = relvaccand.idCandid
                    left join tblcandidatodp on tblcandidatodp.idCandid = tblcandidato.idCandid
                WHERE relvaccand.folSolici = ".$folio;
        $result=  mysql_query($query) or die(mysql_error());
            $datos=array();
            while($fila=  mysql_fetch_array($result)){
                $datos[]=$fila;
            }
            return $datos;
    }
    
    function num_candidatosAsignados($folio){
        $funciones = new funciones();
        $funciones->conectar();
        $query="SELECT count(folSolici) FROM bdrh.relvaccand
                    where folSolici = ".$folio." and fecbaja is null;";
        $result=  mysql_query($query) or die(mysql_error());
            
            while($fila=  mysql_fetch_array($result)){
                $datos=$fila;
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
    
    function asignar_candidato($idCandid,$folioVacante,$idUsuario){
        $funciones = new funciones();
        $funciones->conectar();
        $query="insert into relvaccand(folSolici,idCandid,idUsuario,fecalta) values ($folioVacante,$idCandid,$idUsuario,now())";
        if(mysql_query($query)){
            $resultado='ok';
            return $resultado;
        }
        else{
            echo $query;
            return mysql_error();
        }
    }
    
    function agendaEntrevista($idVacCand,$fecEntrev,$horEntrev,$nomEentrev,$lugarEentrev,$idUsuario){
        $funciones = new funciones();
        $funciones->conectar();
        $query="insert into tblentrevista(idVacCand,fecEntrev,horEntrev,nomEentrev,lugarEntrev,statEntrev,idUsuario,fecalta)
                values ($idVacCand,'".$fecEntrev." ".$horEntrev."','".$horEntrev."','".$nomEentrev."','".$lugarEentrev."',5,".$idUsuario.",now())";
        if(mysql_query($query)){
            $resultado='ok';
            return $resultado;
        }
        else{
            echo $query;
            return mysql_error();
        }
    }
    
    /*function consulta_entrevista($idVacCand){
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
    }*/
    
    function entrevista_especifica($idVacCand){
        $funciones = new funciones();
        $funciones->conectar();
        $query="Select * from tblentrevista 
                    left join tbllugares on tbllugares.idlugar = tblentrevista.lugarEntrev
                    left join tblstaent on tblstaent.idStaEnt = tblentrevista.statEntrev
                    where idVacCand=".$idVacCand;
        $result=  mysql_query($query) or die(mysql_error());
        $datos=array();
        while($fila=  mysql_fetch_array($result)){
            $datos[]=$fila;
        }
        return $datos;
       
    }
    
    function registra_estatus($idEntrev,$est,$observaciones){
        $funciones = new funciones();
            $funciones->conectar();
            $query="update tblentrevista set statEntrev = ".$est.", ObsEntrev = '".$observaciones."' where idEntrev =".$idEntrev ;
            if(mysql_query($query)){
                    echo 'ok';
            }
            else{
                echo 'error';
            }
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
