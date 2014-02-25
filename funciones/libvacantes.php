<?php 

//session_start();
 include_once 'ChromePhp.php';
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
                where sol.statSolici=2 and sol.fecbaja is null;";
       
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
    
    function obtener_contratados($folSolici,$idReclutador){
        $funciones = new funciones();
        $funciones->conectar();
        $sql ="select count(idCandid) as contratados from tblvacante where folSolici=".$folSolici." and idReclutador=".$idReclutador." and fecbaja is null";
        $result=  mysql_query($sql) or die(mysql_error());
        $datos=array();
        while($fila=  mysql_fetch_array($result)){
            $datos[]=$fila;
        }
        return $datos;
      
    }
    
    function cerrar_vacante($folSolici,$idUsuario){
        $funciones = new funciones();
            $funciones->conectar();
            $query="update tblvacante set statVacante = 1 where folSolici =".$folSolici." and idReclutador =".$idUsuario;
            
           if(mysql_query($query)){
                $resultado='ok';
                
                
                $queryA="select folSolici,numVSolici from tblsolicitud where folSolici = ".$folSolici." and fecbaja is null";
                $rA=mysql_query($queryA);
               
                $queryB="select folSolici, count(statVacante) from tblvacante where folSolici = ".$folSolici." and statVacante = 1 and fecbaja is null group by folSolici;";
                $rB=mysql_query($queryB);
               
                while ($fila = mysql_fetch_array($rA)) {
                            $numVSolici=$fila[1];
                        }
                while ($fila2 = mysql_fetch_array($rB)) {
                            $cerrada=$fila2[1];
                        }
                    ChromePhp::log($numVSolici."-".$cerrada);
                    
                if($numVSolici == $cerrada){
                   $query="update tblvacante set fecbaja = now() where folSolici =".$folSolici;
                   mysql_query($query);
                   $queryB="update tblsolicitud set fecbaja = now() where folSolici =".$folSolici;
                   mysql_query($queryB);
                   
                }
             return $resultado;
            }
            else{
               
                return mysql_error();
            }
    }
    
    function cancelar_vacante($folSolici,$idUsuario){
        $funciones = new funciones();
            $funciones->conectar();
            $query="update tblvacante set statVacante = 3,fecbaja = now() where folSolici =".$folSolici;
            $queryB="update tblsolicitud set fecbaja = now() where folSolici =".$folSolici;
                   mysql_query($queryB);
           if(mysql_query($query)){
                $resultado='ok';
                return $resultado;
            }
            else{
                return mysql_error();
            }
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
            //ACTUALIZAMOS RECLUTADOR EN TBLVACANTE
            $query="update tblvacante set idReclutador = ".$reclutadorNuevo." where folSolici =".$folio." and idReclutador =".$reclutadorAnterior."" ;
            if(mysql_query($query)){
                
                 //OBTENEMOS EL ID DE LA RELACION VACANTE CANDIDATO PARA ESA VACANTE
                $queryB="select idVacCand from relvaccand where folSolici=".$folio." and idUsuario=".$reclutadorAnterior;
                ChromePhp::log($queryB);
                $idVacCand = '';
                if($result = mysql_query($queryB)){
                    
                   while($fila = mysql_fetch_array($result)){
                       $idVacCand=$idVacCand.','.$fila['idVacCand'];
                   }
                   $idVacCand = substr($idVacCand, 1);
                   
                    //ACTUALIZAMOS RECLUTADOR EN TABLA RELACION VACANTE CANDIDATO
                    $queryC="update relvaccand set idUsuario = ".$reclutadorNuevo." where idVacCand in (".$idVacCand.")" ;
                     ChromePhp::log($queryC);
                    if(mysql_query($queryC)){
                        //CAMBIAMOS LAS ENTREVISTAS DE RECLUTADOR A RECLUTADOR
                         $queryD="update tblentrevista set idUsuario = ".$reclutadorNuevo." where idVacCand in (".$idVacCand.")";
                          ChromePhp::log($queryD);
                         if(mysql_query($queryD)){
                             echo 'ok';
                         }else{
                             return mysql_error();
                         }
                    }else{
                        return mysql_error();
                    }
                    
                }else{
                    return mysql_error();
                }
                
                
                //HASTA AQUÍ ME QUEDE!
            }else{
                return mysql_error();
            }
           
            
           
            
            
            
           /*if(mysql_query($query)){
                $resultado='ok';
                return $resultado;
            }
            else{
                echo $query;
                return mysql_error();
            }*/
        
    }
    
    function quitar_reclutador($folio,$idReclutador){
         $funciones = new funciones();
            $funciones->conectar();
            $query="update tblvacante set fecBaja = now() where folSolici =".$folio." and idReclutador =".$idReclutador."" ;
            echo $query;
            mysql_query($query) or die(mysql_error());
               
        
    }
    
    function candidatos_registrados($folio,$idUsuario){
        $funciones = new funciones();
        $funciones->conectar();
        $query="SELECT * FROM relvaccand
                    left join tblcandidato on tblcandidato.idCandid = relvaccand.idCandid
                    left join tblcandidatodp on tblcandidatodp.idCandid = tblcandidato.idCandid
                WHERE relvaccand.folSolici = ".$folio." and relvaccand.idUsuario=".$idUsuario;
        $result=  mysql_query($query) or die(mysql_error());
            $datos=array();
            while($fila=  mysql_fetch_array($result)){
                $datos[]=$fila;
            }
            return $datos;
    }
    
    function ultima_obsentrevista($idVacCand){
        $funciones = new funciones();
        $funciones->conectar();
        $query="SELECT ObsEntrev
                    FROM
                        tblentrevista
                    where
                        idVacCand = ".$idVacCand."
                            and fecEntrev = (select 
                                max(fecEntrev)
                            from
                                tblentrevista
                            where
                                idVacCand = ".$idVacCand." and ObsEntrev is not null)";
        
        $result=  mysql_query($query) or die(mysql_error());
            $datos=array();
            while($fila=  mysql_fetch_array($result)){
                $datos[]=$fila;
            }
            return $datos;
    }
    
    function num_candidatosAsignados($folio,$idUsuario){
        $funciones = new funciones();
        $funciones->conectar();
        $query="SELECT count(folSolici) FROM bdrh.relvaccand
                    where folSolici = ".$folio." and idUsuario=".$idUsuario." and fecbaja is null;";
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
    
    function busca_entrevistas($idUsuario){
        $funciones = new funciones();
        $funciones->conectar();
        $query="select
                        relvaccand.folSolici,
                        concat(tblcandidato.nomCandid,tblcandidato.appCandid,tblcandidato.apmCandid) as title,
                        fecEntrev as start,
                        nomEentrev as entrevistador,
                        tbllugares.titulolugar as lugar,
                        tblperfil.descPerfil as perfil,
                        tblproyecto.nomProyecto as proyecto,
                        tblsubproyecto.nomSubproy as subproyecto
                from tblentrevista
                left join relvaccand on relvaccand.idVacCand = tblentrevista.idVacCand
                left join tblsolicitud on tblsolicitud.folSolici = relvaccand.folSolici
                left join tblsubproyecto on tblsubproyecto.idSubproyecto = tblsolicitud.idSubproyecto
                left join tblproyecto on tblproyecto.idProyecto = tblsubproyecto.idProyecto
                left join tblperfil on tblperfil.idPerfil = tblsolicitud.idPerfil
                left join tblcandidato on tblcandidato.idCandid = relvaccand.idCandid
                left join tbllugares on tbllugares.idlugar = tblentrevista.lugarEntrev
                where tblentrevista.idUsuario =".$idUsuario;
        
        $result=  mysql_query($query) or die(mysql_error());
        $datos=array();
        while($fila=  mysql_fetch_array($result)){
            $datos[]=$fila;
        }
        return $datos;
    }
    
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
    
    function estado_candidato($idVacCand,$estado,$idUsuario){
        $funciones = new funciones();
            $funciones->conectar();
            $query="update relvaccand set estatus = ".$estado." where idVacCand =".$idVacCand;
            ChromePhp::log($query);
            if(mysql_query($query)){
                echo 'ok';
            }
            else{
                echo 'error';
            }
            
            if($estado==1){
                $queryB="select * from relvaccand where idVacCand=".$idVacCand;
                ChromePhp::log($queryB);
                $result=mysql_query($queryB) or die(mysql_error());
                
                $datos=array();
                while($fila=  mysql_fetch_array($result)){
                    $datos[]=$fila;
                }
                foreach ($datos as $key => $value) {
                    $idCandid = $value['idCandid'];
                    $folSolici = $value['folSolici'];
                }
                
                $queryC = "select numVacante from tblvacante where folSolici = ".$folSolici." and idReclutador = ".$idUsuario." and fecbaja is null
                            limit 1";
                ChromePhp::log($queryC);
                $result2=mysql_query($queryC) or die(mysql_error());
                $datos2=array();
                while($fila2=  mysql_fetch_array($result2)){
                    $datos2[]=$fila2;
                }
                foreach ($datos2 as $k => $v) {
                    $numVacante=$v['numVacante'];
                }
                $queryD = "update tblvacante set idCandid= ".$idCandid." where numVacante=".$numVacante;
                ChromePhp::log($queryD);
                mysql_query($queryD);
            }
    }
    
    function obtener_estadoCandidato($folSolici,$idVacCand,$idCandidato){
        $funciones = new funciones();
        $funciones->conectar();
        if($idVacCand==''){
            $query="select estatus from relvaccand where folSolici=".$folSolici." and idCandid=".$idCandidato;
            $result=  mysql_query($query) or die(mysql_error());
            $datos=array();
            while($fila=  mysql_fetch_array($result)){
                $datos[]=$fila;
            }
            return $datos;
        }else 
            if($folSolici==''){
            $query="select estatus from relvaccand where idVacCand=".$idVacCand;
            $result=  mysql_query($query) or die(mysql_error());
            $datos=array();
            while($fila=  mysql_fetch_array($result)){
                $datos[]=$fila;
            }
            return $datos;  
        }
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
