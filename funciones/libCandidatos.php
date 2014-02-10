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
                            values(".$id['idCandid'].",'".$tbjoactualCandid."','".$pretensionesCandid."','".$conocimientosCandid."','".$areasintCandid."','".$areasexpCandid."','".$viajasCandid."')";
                mysql_query($sqldp);
                
                $sqlest="insert into tblcandidatoest
                            values(".$id['idCandid'].",'".$estatusCandid."','".$colorEstatus."')";
                mysql_query($sqlest);
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
        
        
    }
?>
