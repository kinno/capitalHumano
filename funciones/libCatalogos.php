<?php
    include '../libs/libs.php';
    include '../funciones/ChromePhp.php';
    
    class Catalogos{
        
        function Catalogos(){
            
        }
        
        function despliega_usuarios(){
            $funciones=new funciones();
            $funciones->conectar();
            $query = "SELECT *,tblusuarios.idUsuario as usuario FROM bdrh.tblusuarios
                        left join tblroles on tblroles.idRol = tblusuarios.idRol;";
            $result = mysql_query($query) or die(mysql_error());
            $datos=array();
            while($fila=  mysql_fetch_array($result)){
                $datos[]=$fila;
            }
            return $datos;
        }
        
        function detalle_usuario($idUsuario){
            $funciones=new funciones();
            $funciones->conectar();
            $query = "SELECT * FROM bdrh.tblusuarios
                        left join tblroles on tblroles.idRol = tblusuarios.idRol
                        WHERE tblusuarios.idUsuario=".$idUsuario;
            $result = mysql_query($query) or die(mysql_error());
            $datos=array();
            while($fila=  mysql_fetch_array($result)){
                $datos[]=$fila;
            }
            return $datos;
        }
        
        function agrega_usuario($datos,$idUsuario){
             extract($datos);
            $funciones=new funciones();
            $funciones->conectar();
            $query="insert into tblusuarios values
                        (null,'".strtolower($nomUsuario).".".strtolower($appUsuario)."','".md5($pwdUsuario)."','".$nomUsuario."','".$appUsuario."','".$apmUsuario."','".$mailUsuario."',".$rol.",".$idUsuario.",now(),null,1)";
            if(mysql_query($query)){
                return 'ok';
            }else{
                return mysql_error();
            }
        }
        
        function actualiza_usuario($datos){
            extract($datos);
            $funciones=new funciones();
            $funciones->conectar();
            $query = "update tblusuarios set
                        nickUsuario = '".$nickUs."',
                        pwdUsuario = '".md5($pwdUs)."',
                        nomUsuario = '".$nombreUs."',
                        appUsuario = '".$appUs."',
                        apmUsuario = '".$apmUs."',
                        mailUsuario = '".$mailUs."',
                        idRol = ".$rolUs."
                        WHERE tblusuarios.idUsuario=".$idUs;
            
            if(mysql_query($query)){
                return 'ok';
            }else{
                return mysql_error();
            }
        }
        function elimina_usuario($id,$idUsuario){
            
            $funciones=new funciones();
            $funciones->conectar();
            $query = "update tblusuarios set
                        fecbaja = now(),
                        moUsuario= ".$idUsuario.",
                        status = 2
                        WHERE tblusuarios.idUsuario=".$id;
            
            if(mysql_query($query)){
                return 'ok';
            }else{
                return mysql_error();
            }
        }
        function activa_usuario($id,$idUsuario){
            
            $funciones=new funciones();
            $funciones->conectar();
            $query = "update tblusuarios set
                        fecbaja = null,
                        moUsuario= ".$idUsuario.",
                        status = 1
                        WHERE tblusuarios.idUsuario=".$id;
            
            if(mysql_query($query)){
                return 'ok';
            }else{
                return mysql_error();
            }
        }
        
        function despliega_perfiles(){
            $funciones=new funciones();
            $funciones->conectar();
            $query = "select * from tblperfil";
            $result = mysql_query($query) or die(mysql_error());
            $datos=array();
            while($fila=  mysql_fetch_array($result)){
                $datos[]=$fila;
            }
            return $datos;
        }
        
        //-------------------------
        
        function despliega_proyectos(){
            $funciones=new funciones();
            $funciones->conectar();
            $query = "select * from tblproyecto where fecbaja is null";
            $result = mysql_query($query) or die(mysql_error());
            $datos=array();
            while($fila=  mysql_fetch_array($result)){
                $datos[]=$fila;
            }
            return $datos;
        }
        
        function despliega_subpry($idProyecto){
            $funciones=new funciones();
            $funciones->conectar();
            $query = "select * from tblsubproyecto where idProyecto=".$idProyecto." and fecbaja is null";
            $result = mysql_query($query) or die(mysql_error());
            $datos=array();
            while($fila=  mysql_fetch_array($result)){
                $datos[]=$fila;
            }
            return $datos;
        }
        
        function guarda_proyecto($nomProyecto,$idUsuario){
            $funciones=new funciones();
            $funciones->conectar();
            $query = "insert into tblproyecto values(null,'".$nomProyecto."',".$idUsuario.",now(),null)";
            if(mysql_query($query))
                return 'ok';
            else
                return mysql_error();
        }
        
        function elimina_proyecto($idProyecto){
             $funciones=new funciones();
            $funciones->conectar();
            $query = "update tblproyecto set fecbaja=now() where idProyecto=".$idProyecto;
            if(mysql_query($query)){
                $queryB = "update tblsubproyecto set fecbaja=now() where idProyecto=".$idProyecto;
                if(mysql_query($queryB))
                    return 'ok';
            }
            else
                return mysql_error();
        }
        
        function guarda_subproyecto($nomSubproyecto,$idProyecto){
            $funciones=new funciones();
            $funciones->conectar();
            $query = "insert into tblsubproyecto values(null,".$idProyecto.",'".$nomSubproyecto."',now(),null)";
            if(mysql_query($query))
                return 'ok';
            else
                return mysql_error();
        }
        
        function elimina_subproyecto($idSubproyecto){
             $funciones=new funciones();
            $funciones->conectar();
            $query = "update tblsubproyecto set fecbaja=now() where idSubproyecto=".$idSubproyecto;
            if(mysql_query($query)){
                    return 'ok';
            }
            else
                return mysql_error();
        }
        
        function comboLimitado($Valor){
 		$funciones=new funciones();
                 $funciones->conectar();
 		$sqlC1="SELECT *  FROM  tblroles where idRol =".$Valor;
 		$queryC1=mysql_query($sqlC1) or die(mysql_error());
 		$nomRol=mysql_result($queryC1,0,'nomRol');
 		echo"<option value='".$Valor."'>".$nomRol."</option>";
 		$sqlC="SELECT *  FROM  tblroles where idRol !=".$Valor;
 		$queryC=mysql_query($sqlC) or die(mysql_error());
 		while($row=mysql_fetch_array($queryC))
 		{
 			echo"<option value=".$row['idRol'].">".$row['nomRol']."</option>";

 		}
 	}
        
    }
?>
