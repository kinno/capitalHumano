<?php
    include"../libs/libs.php"; 

    class Candidato{
        
        function Candidato(){
            
        }
        
        function registrarCandidato($datos,$idUsuario){
            extract($datos);
            $funciones = new funciones();
            $funciones->conectar();
            $sql="insert into tblcandidato
                    values (null,'".$nomCandid."','".$appCandid."','".$apmCandid."','".$generoCandidato."','".$fechaNCandid."','".$entidadCandid."','".$municipioCandid."','".$cpCandid."','".$coloniaCandid."','".$domCandid."','".$celCandid."','".$telCandid."','".$mailCandid."','skype','".$nacionalidadCandid."',".$idUsuario.",now(),null)";
            if(mysql_query($sql)){
                $sqlid="select last_insert_id() as idCandid";
                $resultado=mysql_query($sqlid);
                $id = mysql_fetch_array($resultado);
                
                $sqlda="insert into tblcandidatoda
                            values(".$id['idCandid'].",'".$carreraCandid."','".$nvlestudiosCandid."','".$otros."','".$idiomas."')";
                mysql_query($sqlda);
                
                $sqldp="insert into tblcandidatodp
                            values(".$id['idCandid'].",'".$tbjoactualCandid."','".$pretensionesminCandid."','".$pretensionesmaxCandid."','".$salarioCandid."','".$conocimientosCandid."','".$areasintCandid."','".$areasexpCandid."','".$viajasCandid."')";
                mysql_query($sqldp);
                
                $sqlest="insert into tblcandidatoest
                            values(".$id['idCandid'].",'".$estatusCandid."','".$colorEstatus."')";
                mysql_query($sqlest);
                
                for($i=1;$i<=$numReferencias;$i++){
                    
                    $sqlref="insert into tblcandidatorl
                            values(null,".$id['idCandid'].",'".$datos['nomrefCandid'.$i]."','".$datos['telrefCandid'.$i]."','".$datos['relrefCandid'.$i]."')"; 
                    mysql_query($sqlref);
                }
                echo 'ok';
            }else{
                die(mysql_error());
            }
        }
        
        function modificarCandidato($datos,$idUsuario){
            extract($datos);
            $funciones = new funciones();
            $funciones->conectar();
            
            $sql="UPDATE tblcandidato
                        set nomCandid='".$nomCandid."',
                            appCandid='".$appCandid."',
                            apmCandid='".$apmCandid."',
                            genCandid='".$generoCandidato."',
                            fecNCandid='".$fechaNCandid."',
                            entidadCandid='".$entidadCandid."',
                            municipioCandid='".$municipioCandid."',
                            cpCandid='".$cpCandid."',
                            coloniaCandid='".$coloniaCandid."',
                            domCandid='".$domCandid."',
                            celCandid='".$celCandid."',
                            telCandid='".$telCandid."',
                            mailCandid='".$mailCandid."',
                            nacionalidadCandid='".$nacionalidadCandid."',
                            idUsuario=".$idUsuario." 
                    WHERE idCandid=".$idCandid."
                        ";
            if(mysql_query($sql)){
               
                $sqlda="
                        UPDATE tblcandidatoda
                             set carreraCandid='".$carreraCandid."',
                                    nlvestudiosCandid='".$nvlestudiosCandid."',
                                    otros='".$otros."',
                                    idiomasCandid='".$idiomas."'
                            WHERE idCandid=".$idCandid."
                        ";
                
                mysql_query($sqlda);
                
                $sqldp="
                        UPDATE tblcandidatodp
                             set tbjoactualCandid='".$tbjoactualCandid."',
                                    pretensionesminCandid='".$pretensionesminCandid."',
                                    pretensionesmaxCandid='".$pretensionesmaxCandid."',
                                    ultimosalarioCandid='".$salarioCandid."',
                                    conocimientosCandid='".$conocimientosCandid."',
                                    areasintCandid='".$areasintCandid."',
                                    areasexpCandid='".$areasexpCandid."',
                                    viajasCandid='".$viajasCandid."'
                            WHERE idCandid=".$idCandid."
                        ";
                
                mysql_query($sqldp);
                
                $sqlest="
                        UPDATE tblcandidatoest
                            set descEstatus ='".$estatusCandid."'
                        WHERE idCandid=".$idCandid."       
                        ";

                mysql_query($sqlest);
                
                /*for($i=1;$i<=$numReferencias;$i++){
                    
                    $sqlref="insert into tblcandidatorl
                            values(null,".$id['idCandid'].",'".$datos['nomrefCandid'.$i]."','".$datos['telrefCandid'.$i]."','".$datos['relrefCandid'.$i]."')"; 
                    mysql_query($sqlref);
                }*/
                echo 'ok';
            }else{
                die(mysql_error());
            }
        }
        
        function obtener_candidatos(){
            $funciones = new funciones();
            $funciones->conectar();
            $query="select * from tblcandidato 
                        left join tblcandidatoda on tblcandidatoda.idCandid = tblcandidato.idCandid
                        left join tblcandidatodp on tblcandidatodp.idCandid = tblcandidato.idCandid
                        left join tblcandidatoest on tblcandidatoest.idCandid = tblcandidato.idCandid;";
            $result=  mysql_query($query) or die(mysql_error());
            $datos=array();
            while($fila=  mysql_fetch_array($result)){
                $datos[]=$fila;
            }
            return $datos;
        }
        
        function detalles_candidato($idCandid){
            $funciones = new funciones();
            $funciones->conectar();
            $query="select * from tblcandidato 
                        left join tblcandidatoda on tblcandidatoda.idCandid = tblcandidato.idCandid
                        left join tblcandidatodp on tblcandidatodp.idCandid = tblcandidato.idCandid
                        left join tblcandidatoest on tblcandidatoest.idCandid = tblcandidato.idCandid
                    where tblcandidato.idCandid=".$idCandid;
            $query;
            $result=  mysql_query($query) or die(mysql_error());
            $datos=array();
            while($fila=  mysql_fetch_array($result)){
                $datos[]=$fila;
            }
            return $datos;
        }
        
        function referencias_candidato($idCandid){
            $funciones = new funciones();
            $funciones->conectar();
            $query="select * from tblcandidatorl 
                    where idCandid=".$idCandid;
            $query;
            $result=  mysql_query($query) or die(mysql_error());
            $datos=array();
            while($fila=  mysql_fetch_array($result)){
                $datos[]=$fila;
            }
            return $datos;
        }
        
        function resultado_referencia($idReferencia){
            $funciones = new funciones();
            $funciones->conectar();
            $query="select * from tblresreferencia 
                    where idReferencia=".$idReferencia;
            
            $result=  mysql_query($query) or die(mysql_error());
            $datos=array();
            while($fila=  mysql_fetch_array($result)){
                $datos[]=$fila;
            }
            return $datos;
            
        }
        function guardar_resultadosReferencia($datos){
            extract($datos);
            $funciones = new funciones();
            $funciones->conectar();
            $sql="insert into tblresreferencia values (null,".$idsReferencia.",'".$periodoInicio."','".$periodoFinal."','".$sueldoPercibido."','".$motivoSalida."','".$ultimoPuesto."','".$recontratar."','".$comentarios."',".$responsabilidad.",".$asistencia.",".$puntualidad.",".$actitud.",".$compromiso.",".$honestidad.",".$relacion.",".$iniciativa.",".$lealtad.",".$apego.")";
            
            if(mysql_query($sql)){
                echo 'ok';
            }else{
                echo 'error';
            }
        }
  
    }
?>
