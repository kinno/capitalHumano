<?php
include_once '../libs/libs.php';
include_once '../funciones/ChromePhp.php';
class Reportes{
    function Reportes(){
        
    }
    
    function totalvacantes_reclutador($idReclutador){
        $funciones = new funciones;
        $funciones->conectar();
        $sql="select 
                    tblmeses.descmes,ifnull(total,0) as total
                from
                    tblmeses
                        left join
                    (select 
                        count(tblvacante.folSolici) as total,
                            idmes,
                            descmes,
                            idReclutador
                    from
                        tblmeses
                    left join tblsolicitud ON month(tblsolicitud.iniSolici) = tblmeses.idmes
                    left join tblvacante ON tblvacante.folSolici = tblsolicitud.folSolici
                    where
                        idReclutador =".$idReclutador."
                    group by idmes , idReclutador) as t1 ON t1.idmes = tblmeses.idmes
                group by tblmeses.idmes
                ";
        $result = mysql_query($sql) or die(mysql_error());
        $datos = array();
        while($fila = mysql_fetch_array($result)){
            $datos[]=$fila;
        }
        return $datos;
        
    }
    
    function totalproyecto_reclutador($idReclutador,$idProyecto){
        $funciones = new funciones();
        $funciones->conectar();
        $sql="select 
                    tblmeses.descmes, ifnull(total, 0) as total
                from
                    tblmeses
                        left join
                    (select 
                        tblproyecto.idProyecto,
                            nomProyecto,
                            count(tblvacante.folSolici) as total,
                            idmes,
                            descmes
                    from
                        tblmeses
                    left join tblsolicitud ON month(tblsolicitud.iniSolici) = tblmeses.idmes
                    left join tblsubproyecto ON tblsubproyecto.idSubproyecto = tblsolicitud.idSubproyecto
                    left join tblproyecto ON tblproyecto.idProyecto = tblsubproyecto.idProyecto
                    left join tblvacante ON tblvacante.folSolici = tblsolicitud.folSolici
                    where
                        tblvacante.idReclutador = ".$idReclutador."
                            and tblproyecto.idProyecto = ".$idProyecto."
                    group by idmes , tblproyecto.idProyecto) as t1 ON t1.idmes = tblmeses.idmes
                group by tblmeses.idmes , t1.idProyecto";
        ChromePhp::log($sql);
        $result = mysql_query($sql) or die(mysql_error());
        $datos = array();
        while($fila = mysql_fetch_array($result)){
            $datos[]=$fila;
        }
        return $datos;
        
    }
    
    function canceladas_reclutador($idReclutador){
        $funciones = new funciones();
        $funciones->conectar();
        $sql="select 
                    tblmeses.descmes, ifnull(canceladas, 0) as canceladas
                from
                    tblmeses
                        left join
                    (select 
                        count(tblvacante.folSolici) as canceladas, idmes, descmes
                    from
                        tblmeses
                    left join tblsolicitud ON month(tblsolicitud.iniSolici) = tblmeses.idmes
                    left join tblvacante ON tblvacante.folSolici = tblsolicitud.folSolici
                    where
                        tblvacante.idReclutador = ".$idReclutador."
                            and tblvacante.descCancela is not null
                    group by idmes) as t1 ON t1.idmes = tblmeses.idmes
                group by tblmeses.idmes";
        ChromePhp::log($sql);
        $result = mysql_query($sql) or die(mysql_error());
        $datos = array();
        while($fila = mysql_fetch_array($result)){
            $datos[]=$fila;
        }
        return $datos;
        
    }
    
    
    function enviados_reclutador($idReclutador){
        $funciones = new funciones();
        $funciones->conectar();
        $sql="select 
                        tblmeses.descmes, ifnull(enviados, 0) as enviados
                    from
                        tblmeses
                            left join
                        (select 
                            count(DISTINCT tblentrevista.idVacCand) as enviados,
                                idmes,
                                descmes,
                                idUsuario
                        from
                            tblmeses
                        left join tblentrevista ON month(tblentrevista.fecalta) = tblmeses.idmes
                        where
                            tblentrevista.idUsuario = ".$idReclutador."
                        group by idmes) as t1 ON t1.idmes = tblmeses.idmes
                    group by tblmeses.idmes";
        ChromePhp::log($sql);
        $result = mysql_query($sql) or die(mysql_error());
        $datos = array();
        while($fila = mysql_fetch_array($result)){
            $datos[]=$fila;
        }
        return $datos;
        
    }
    
    function contratados_reclutador($idReclutador){
        $funciones = new funciones();
        $funciones->conectar();
        $sql="select 
                        tblmeses.descmes, ifnull(contratados, 0) as contratados
                    from
                        tblmeses
                            left join
                        (select 
                            count(DISTINCT relvaccand.estatus) as contratados,
                                idmes,
                                descmes,
                                idUsuario
                        from
                            tblmeses
                        left join relvaccand ON month(relvaccand.fecbaja) = tblmeses.idmes
                        where
                            relvaccand.idUsuario = ".$idReclutador." and relvaccand.estatus=1
                        group by idmes) as t1 ON t1.idmes = tblmeses.idmes
                    group by tblmeses.idmes";
        ChromePhp::log($sql);
        $result = mysql_query($sql) or die(mysql_error());
        $datos = array();
        while($fila = mysql_fetch_array($result)){
            $datos[]=$fila;
        }
        return $datos;
        
    }

    function rechazados_reclutador($idReclutador){
        $funciones = new funciones();
        $funciones->conectar();
        $sql="select 
                        tblmeses.descmes, ifnull(rechazados, 0) as rechazados
                    from
                        tblmeses
                            left join
                        (select 
                            count(DISTINCT relvaccand.estatus) as rechazados,
                                idmes,
                                descmes,
                                idUsuario
                        from
                            tblmeses
                        left join relvaccand ON month(relvaccand.fecbaja) = tblmeses.idmes
                        where
                            relvaccand.idUsuario = ".$idReclutador." and relvaccand.estatus in(2,3)
                        group by idmes) as t1 ON t1.idmes = tblmeses.idmes
                    group by tblmeses.idmes";
        ChromePhp::log($sql);
        $result = mysql_query($sql) or die(mysql_error());
        $datos = array();
        while($fila = mysql_fetch_array($result)){
            $datos[]=$fila;
        }
        return $datos;
        
    }
    
    function totalvacantes_proyectos($idProyecto){
         $funciones = new funciones();
        $funciones->conectar();
        $sql="select 
                        tblmeses.descmes, ifnull(total, 0) as total
                    from
                        tblmeses
                            left join
                        (select count(tblvacante.folSolici) as total,idmes,descmes 
                                from tblmeses
                                    left join tblsolicitud on month(tblsolicitud.iniSolici) = tblmeses.idmes
                                    left join tblvacante on tblvacante.folSolici = tblsolicitud.folSolici
                                    left join tblsubproyecto on tblsubproyecto.idSubproyecto = tblsolicitud.idSubproyecto
                                    left join tblproyecto on tblproyecto.idProyecto = tblsubproyecto.idProyecto
                                    where tblproyecto.idProyecto=".$idProyecto."
                                ) as t1 ON t1.idmes = tblmeses.idmes
                    group by tblmeses.idmes";
        ChromePhp::log($sql);
        $result = mysql_query($sql) or die(mysql_error());
        $datos = array();
        while($fila = mysql_fetch_array($result)){
            $datos[]=$fila;
        }
        return $datos;
    }
    
    function vacantesreclutador_proyectos($idProyecto,$idReclutador){
        $funciones = new funciones();
        $funciones->conectar();
        $sql="select 
                        tblmeses.descmes, ifnull(total, 0) as total
                    from
                        tblmeses
                            left join
                        (select count(tblvacante.folSolici) as total,idmes,descmes 
                                from tblmeses
                                    left join tblsolicitud on month(tblsolicitud.iniSolici) = tblmeses.idmes
                                    left join tblvacante on tblvacante.folSolici = tblsolicitud.folSolici
                                    left join tblsubproyecto on tblsubproyecto.idSubproyecto = tblsolicitud.idSubproyecto
                                    left join tblproyecto on tblproyecto.idProyecto = tblsubproyecto.idProyecto
                                    where tblproyecto.idProyecto=".$idProyecto." and tblvacante.idReclutador = ".$idReclutador."
                                ) as t1 ON t1.idmes = tblmeses.idmes
                    group by tblmeses.idmes";
        ChromePhp::log($sql);
        $result = mysql_query($sql) or die(mysql_error());
        $datos = array();
        while($fila = mysql_fetch_array($result)){
            $datos[]=$fila;
        }
        return $datos;
    }
    
    function enviados_proyectos($idProyecto){
        $funciones = new funciones();
        $funciones->conectar();
        $sql="select 
                        tblmeses.descmes, ifnull(enviados, 0) as enviados
                from
                        tblmeses
                                left join
                        (select 
                                count(DISTINCT tblentrevista.idVacCand) as enviados,
                                        idmes,
                                        descmes

                        from
                                tblmeses
                        left join tblentrevista ON month(tblentrevista.fecalta) = tblmeses.idmes
                        left join relvaccand ON relvaccand.idVacCand = tblentrevista.idVacCand
                        left join tblvacante ON tblvacante.folSolici = relvaccand.folSolici
                        left join tblsolicitud on tblsolicitud.folSolici = tblvacante.folSolici
                        left join tblsubproyecto on tblsubproyecto.idSubproyecto = tblsolicitud.idSubproyecto
                        left join tblproyecto on tblproyecto.idProyecto = tblsubproyecto.idProyecto
                        where tblproyecto.idProyecto = ".$idProyecto." 
                        group by idmes) as t1 ON t1.idmes = tblmeses.idmes
                group by tblmeses.idmes";
        ChromePhp::log($sql);
        $result = mysql_query($sql) or die(mysql_error());
        $datos = array();
        while($fila = mysql_fetch_array($result)){
            $datos[]=$fila;
        }
        return $datos;
    }
    
    function obtiene_proyectos(){
        $funciones = new funciones();
        $funciones->conectar();
        $sql="Select idProyecto,nomProyecto from tblproyecto where fecbaja is null";
        $result = mysql_query($sql) or die(mysql_error());
        $datos=array();
        while($fila = mysql_fetch_array($result)){
            $datos[]=$fila;
        }
        return $datos;
    }
    
    function obtiene_reclutadores(){
        $funciones = new funciones();
        $funciones->conectar();
        $sql="select * from tblusuarios where idRol in (2,5) and fecbaja is null";
        $result = mysql_query($sql) or die(mysql_error());
        $datos=array();
        while($fila = mysql_fetch_array($result)){
            $datos[]=$fila;
        }
        return $datos;
    }
}
?>
