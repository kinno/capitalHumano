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
                echo 'ok';
            }else{
                die(mysql_error());
            }
        }
        
        function obtenerCandidatos(){
            $funciones = new funciones();
            $funciones->conectar();
            $sql = "Select * from tblcandidato";
            $resultado = mysql_query($sql) or die(mysql_error());
            $datos = array();
            while($fila=  mysql_fetch_array($resultado)){
                $datos[]=$fila;                
            }
            return $datos;
        }
        
        
    }
?>
