<?php
include_once '../libs/libs.php';
include '../funciones/ChromePhp.php';
class Reportes{
    function Reportes(){
    }
  // FUNCIONES PARA REPORTES VACANTES - RECLUTADOR ANUALES //  
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
//        ChromePhp::log($sql);
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
//        ChromePhp::log($sql);
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
//        ChromePhp::log($sql);
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
                            count(relvaccand.estatus) as contratados,
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
//        ChromePhp::log($sql);
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
                            count(relvaccand.estatus) as rechazados,
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
//        ChromePhp::log($sql);
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
//        ChromePhp::log($sql);
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
//        ChromePhp::log($sql);
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
//        ChromePhp::log($sql);
        $result = mysql_query($sql) or die(mysql_error());
        $datos = array();
        while($fila = mysql_fetch_array($result)){
            $datos[]=$fila;
        }
        return $datos;
    }
    
    function canceladas_proyectos($idProyecto){
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
					left join tblsubproyecto on tblsubproyecto.idSubproyecto = tblsolicitud.idSubproyecto
					left join tblproyecto on tblproyecto.idProyecto = tblsubproyecto.idProyecto
					where tblproyecto.idProyecto=".$idProyecto."
                            and tblvacante.descCancela is not null
                    group by idmes) as t1 ON t1.idmes = tblmeses.idmes
                group by tblmeses.idmes";
//        ChromePhp::log($sql);
        $result = mysql_query($sql) or die(mysql_error());
        $datos = array();
        while($fila = mysql_fetch_array($result)){
            $datos[]=$fila;
        }
        return $datos;
    }
    
    function contratados_proyectos($idProyecto){
        $funciones = new funciones();
        $funciones->conectar();
        $sql="select 
                        tblmeses.descmes, ifnull(contratados, 0) as contratados
                    from
                        tblmeses
                            left join
                        (select 
                            count(relvaccand.estatus) as contratados,
                                idmes,
                                descmes

                        from
                            tblmeses
                        left join relvaccand ON month(relvaccand.fecbaja) = tblmeses.idmes
                        left join tblvacante ON tblvacante.folSolici = relvaccand.folSolici
                        left join tblsolicitud on tblsolicitud.folSolici = tblvacante.folSolici
                        left join tblsubproyecto on tblsubproyecto.idSubproyecto = tblsolicitud.idSubproyecto
                        left join tblproyecto on tblproyecto.idProyecto = tblsubproyecto.idProyecto
                        where tblproyecto.idProyecto = ".$idProyecto." 
                        and relvaccand.estatus=1
                        group by idmes, relvaccand.idVacCand) as t1 ON t1.idmes = tblmeses.idmes
                    group by tblmeses.idmes";
//        ChromePhp::log($sql);
        $result = mysql_query($sql) or die(mysql_error());
        $datos = array();
        while($fila = mysql_fetch_array($result)){
            $datos[]=$fila;
        }
        return $datos;
        
    }
    
    function rechazados_proyectos($idProyecto){
        $funciones = new funciones();
        $funciones->conectar();
        $sql="select 
                    tblmeses.descmes, ifnull(rechazados, 0) as rechazados
                from
                    tblmeses
                        left join
                    (select 
                        count(relvaccand.estatus) as rechazados,
                            idmes,
                            descmes
                    from
                        tblmeses
                    left join relvaccand ON month(relvaccand.fecbaja) = tblmeses.idmes
                    left join tblvacante ON tblvacante.folSolici = relvaccand.folSolici
                    left join tblsolicitud ON tblsolicitud.folSolici = tblvacante.folSolici
                    left join tblsubproyecto ON tblsubproyecto.idSubproyecto = tblsolicitud.idSubproyecto
                    left join tblproyecto ON tblproyecto.idProyecto = tblsubproyecto.idProyecto
                    where
                        tblproyecto.idProyecto = ".$idProyecto."
                            and relvaccand.estatus in (2 , 3)
                    group by idmes, relvaccand.idVacCand) as t1 ON t1.idmes = tblmeses.idmes
                group by tblmeses.idmes";
//        ChromePhp::log($sql);
        $result = mysql_query($sql) or die(mysql_error());
        $datos = array();
        while($fila = mysql_fetch_array($result)){
            $datos[]=$fila;
        }
        return $datos;
        
    }
   // FIN DE  FUNCIONES PARA REPORTES VACANTES - RECLUTADOR ANUALES //   
    
//-----------------------------------------------------------------------------------------------------------//    
//-----------------------------------------------------------------------------------------------------------//    
//-----------------------------------------------------------------------------------------------------------//    
//-----------------------------------------------------------------------------------------------------------//    
//-----------------------------------------------------------------------------------------------------------//    
//-----------------------------------------------------------------------------------------------------------//    
    
   // FUNCIONES PARA REPORTES VACANTES - RECLUTADOR POR PERIODO // 
   
    function totalvacantes_reclutadorP($idReclutador,$inicio,$final){
        $funciones = new funciones;
        $funciones->conectar();
        $sql="select 
                    count(tblvacante.folSolici) as total,                         
                    idReclutador
                from
                    tblsolicitud
                left join tblvacante ON tblvacante.folSolici = tblsolicitud.folSolici
                where
                    idReclutador =".$idReclutador." and
                    iniSolici between '".date("Y-m-d",strtotime($inicio))."' and '".date("Y-m-d",strtotime($final))."'
                ";
        $result = mysql_query($sql) or die(mysql_error());
        $datos = array();
        while($fila = mysql_fetch_array($result)){
            $datos[]=$fila;
        }
        return $datos;
        
    }
    
    function totalproyecto_reclutadorP($idReclutador,$idProyecto,$inicio,$final){
        $funciones = new funciones();
        $funciones->conectar();
        $sql="select 
                    tblproyecto.idProyecto,
                    nomProyecto,
                    count(tblvacante.folSolici) as total
                from tblsolicitud
                left join tblsubproyecto ON tblsubproyecto.idSubproyecto = tblsolicitud.idSubproyecto
                left join tblproyecto ON tblproyecto.idProyecto = tblsubproyecto.idProyecto
                left join tblvacante ON tblvacante.folSolici = tblsolicitud.folSolici
                where
                    tblvacante.idReclutador = ".$idReclutador."
                    and tblproyecto.idProyecto = ".$idProyecto."
                    and tblvacante.fecalta between '".date("Y-m-d",strtotime($inicio))."' and '".date("Y-m-d",strtotime($final))."'
                    ";
//        ChromePhp::log($sql);
        $result = mysql_query($sql) or die(mysql_error());
        $datos = array();
        while($fila = mysql_fetch_array($result)){
            $datos[]=$fila;
        }
        return $datos;
        
    }
    
    function canceladas_reclutadorP($idReclutador,$inicio,$final){
        $funciones = new funciones();
        $funciones->conectar();
        $sql="select 
                        count(tblvacante.folSolici) as canceladas
                    from
                        tblsolicitud
                    left join tblvacante ON tblvacante.folSolici = tblsolicitud.folSolici
                    where
                        tblvacante.idReclutador = ".$idReclutador."
                            and tblvacante.descCancela is not null
                            and tblvacante.fecbaja between '".date("Y-m-d",strtotime($inicio))."' and '".date("Y-m-d",strtotime($final))."'
                    ";
//        ChromePhp::log($sql);
        $result = mysql_query($sql) or die(mysql_error());
        $datos = array();
        while($fila = mysql_fetch_array($result)){
            $datos[]=$fila;
        }
        return $datos;
        
    }
    
    
    function enviados_reclutadorP($idReclutador,$inicio,$final){
        $funciones = new funciones();
        $funciones->conectar();
        $sql="select 
                    count(DISTINCT tblentrevista.idVacCand) as enviados,
                    idUsuario
                from tblentrevista
                where
                    tblentrevista.idUsuario = ".$idReclutador."
                    and tblentrevista.fecalta between '".date("Y-m-d",strtotime($inicio))."' and '".date("Y-m-d",strtotime($final))."'    
                        ";
//        ChromePhp::log($sql);
        $result = mysql_query($sql) or die(mysql_error());
        $datos = array();
        while($fila = mysql_fetch_array($result)){
            $datos[]=$fila;
        }
        return $datos;
        
    }
    
    function contratados_reclutadorP($idReclutador ,$inicio,$final){
        $funciones = new funciones();
        $funciones->conectar();
        $sql="select 
                    count(relvaccand.estatus) as contratados,
                    idUsuario
                from
                    relvaccand
                where
                    relvaccand.idUsuario = ".$idReclutador." and relvaccand.estatus=1
                    and relvaccand.fecbaja between '".date("Y-m-d",strtotime($inicio))."' and '".date("Y-m-d",strtotime($final))."'     
                        ";
//        ChromePhp::log($sql);
        $result = mysql_query($sql) or die(mysql_error());
        $datos = array();
        while($fila = mysql_fetch_array($result)){
            $datos[]=$fila;
        }
        return $datos;
        
    }

    function rechazados_reclutadorP($idReclutador ,$inicio,$final){
        $funciones = new funciones();
        $funciones->conectar();
        $sql="select 
                    count(relvaccand.estatus) as rechazados,
                    idUsuario
                from
                    relvaccand
                where
                    relvaccand.idUsuario = ".$idReclutador." and relvaccand.estatus in(2,3)
                        and relvaccand.fecbaja between '".date("Y-m-d",strtotime($inicio))."' and '".date("Y-m-d",strtotime($final))."'
                        ";
//        ChromePhp::log($sql);
        $result = mysql_query($sql) or die(mysql_error());
        $datos = array();
        while($fila = mysql_fetch_array($result)){
            $datos[]=$fila;
        }
        return $datos;
        
    }
    
    function totalvacantes_proyectosP($idProyecto,$inicio,$final){
         $funciones = new funciones();
        $funciones->conectar();
        $sql="select count(tblvacante.folSolici) as total
		from tblsolicitud
                    left join tblvacante on tblvacante.folSolici = tblsolicitud.folSolici
                    left join tblsubproyecto on tblsubproyecto.idSubproyecto = tblsolicitud.idSubproyecto
                    left join tblproyecto on tblproyecto.idProyecto = tblsubproyecto.idProyecto
                where tblproyecto.idProyecto=".$idProyecto." and iniSolici between '".date("Y-m-d",strtotime($inicio))."' and '".date("Y-m-d",strtotime($final))."';";
//        ChromePhp::log($sql);
        $result = mysql_query($sql) or die(mysql_error());
        $datos = array();
        while($fila = mysql_fetch_array($result)){
            $datos[]=$fila;
        }
        return $datos;
    }
    
    function vacantesreclutador_proyectosP($idProyecto,$idReclutador,$inicio,$final){
        $funciones = new funciones();
        $funciones->conectar();
        $sql="select count(tblvacante.folSolici) as total
                            from tblsolicitud
                                left join tblvacante on tblvacante.folSolici = tblsolicitud.folSolici
                                left join tblsubproyecto on tblsubproyecto.idSubproyecto = tblsolicitud.idSubproyecto
                                left join tblproyecto on tblproyecto.idProyecto = tblsubproyecto.idProyecto
                                where tblproyecto.idProyecto=".$idProyecto." and tblvacante.idReclutador = ".$idReclutador."
                                    and tblvacante.fecalta between '".date("Y-m-d",strtotime($inicio))."' and '".date("Y-m-d",strtotime($final))."'";
//        ChromePhp::log($sql);
        $result = mysql_query($sql) or die(mysql_error());
        $datos = array();
        while($fila = mysql_fetch_array($result)){
            $datos[]=$fila;
        }
        return $datos;
    }
    
    function enviados_proyectosP($idProyecto,$inicio,$final){
        $funciones = new funciones();
        $funciones->conectar();
        $sql="select 
                        count(DISTINCT tblentrevista.idVacCand) as enviados
                from tblentrevista
                left join relvaccand ON relvaccand.idVacCand = tblentrevista.idVacCand
                left join tblvacante ON tblvacante.folSolici = relvaccand.folSolici
                left join tblsolicitud on tblsolicitud.folSolici = tblvacante.folSolici
                left join tblsubproyecto on tblsubproyecto.idSubproyecto = tblsolicitud.idSubproyecto
                left join tblproyecto on tblproyecto.idProyecto = tblsubproyecto.idProyecto
                where tblproyecto.idProyecto = ".$idProyecto." and tblentrevista.fecalta between '".date("Y-m-d",strtotime($inicio))."' and '".date("Y-m-d",strtotime($final))."'"; 

//        ChromePhp::log($sql);
        $result = mysql_query($sql) or die(mysql_error());
        $datos = array();
        while($fila = mysql_fetch_array($result)){
            $datos[]=$fila;
        }
        return $datos;
    }
    
    function canceladas_proyectosP($idProyecto,$inicio,$final){
        $funciones = new funciones();
        $funciones->conectar();
        $sql="select 
                        ifnull(count(tblvacante.folSolici),0) as canceladas
                    from
                        tblsolicitud
                    left join tblvacante ON tblvacante.folSolici = tblsolicitud.folSolici
					left join tblsubproyecto on tblsubproyecto.idSubproyecto = tblsolicitud.idSubproyecto
					left join tblproyecto on tblproyecto.idProyecto = tblsubproyecto.idProyecto
					where tblproyecto.idProyecto=".$idProyecto." and tblvacante.fecbaja between '".date("Y-m-d",strtotime($inicio))."' and '".date("Y-m-d",strtotime($final))."'
                            and tblvacante.descCancela is not null
                    ";
//        ChromePhp::log($sql);
        $result = mysql_query($sql) or die(mysql_error());
        $datos = array();
        while($fila = mysql_fetch_array($result)){
            $datos[]=$fila;
        }
        return $datos;
    }
    
    function contratados_proyectosP($idProyecto,$inicio,$final){
        $funciones = new funciones();
        $funciones->conectar();
        $sql="select count(t1.estatus) as contratados   from
                (select 
                    relvaccand.estatus
                from
                   relvaccand
                left join tblvacante ON tblvacante.folSolici = relvaccand.folSolici
                left join tblsolicitud on tblsolicitud.folSolici = tblvacante.folSolici
                left join tblsubproyecto on tblsubproyecto.idSubproyecto = tblsolicitud.idSubproyecto
                left join tblproyecto on tblproyecto.idProyecto = tblsubproyecto.idProyecto
                where tblproyecto.idProyecto = ".$idProyecto." and relvaccand.fecbaja between '".date("Y-m-d",strtotime($inicio))."' and '".date("Y-m-d",strtotime($final))."'
                and relvaccand.estatus=1
                group by relvaccand.idVacCand)as t1
                       ";
        ChromePhp::log($sql);
        $result = mysql_query($sql) or die(mysql_error());
        $datos = array();
        while($fila = mysql_fetch_array($result)){
            $datos[]=$fila;
        }
        return $datos;
        
    }
    
    function rechazados_proyectosP($idProyecto,$inicio,$final){
        $funciones = new funciones();
        $funciones->conectar();
        $sql=" select count(t1.estatus) as rechazados from
                (select 
                    relvaccand.estatus
                from relvaccand
                left join tblvacante ON tblvacante.folSolici = relvaccand.folSolici
                left join tblsolicitud ON tblsolicitud.folSolici = tblvacante.folSolici
                left join tblsubproyecto ON tblsubproyecto.idSubproyecto = tblsolicitud.idSubproyecto
                left join tblproyecto ON tblproyecto.idProyecto = tblsubproyecto.idProyecto
                where
                    tblproyecto.idProyecto = ".$idProyecto."
                        and relvaccand.fecbaja between '".date("Y-m-d",strtotime($inicio))."' and '".date("Y-m-d",strtotime($final))."'
                        and relvaccand.estatus in (2 , 3)
                group by relvaccand.idVacCand) as t1
                    ";
       //ChromePhp::log($sql);
        $result = mysql_query($sql) or die(mysql_error());
        $datos = array();
        while($fila = mysql_fetch_array($result)){
            $datos[]=$fila;
        }
        return $datos;
        
    }
    
   // FIN DE  FUNCIONES PARA REPORTES VACANTES - RECLUTADOR ANUALES //   
    
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

