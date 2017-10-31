<?php
/**
 * @author lolkittens
 * @copyright 2017
 */
 require("conexion.php");
 
 ob_start();
 
 $bases_datos = "sp_helpdb";		
 $resultado = mssql_query($bases_datos);
 
 while($fila=mssql_fetch_array($resultado))
 {
    
    mssql_select_db ($fila["name"],$con) or die("No pudo seleccionarse la BD SQL-SERVER.". mssql_get_last_message());
    
    mssql_query("use " . $fila["name"]);
    
    $reduccion1 = "ALTER DATABASE " . $fila["name"]. " SET RECOVERY SIMPLE;";
    
   if(mssql_query($reduccion1))
   {
    
        $reduccionLog = "DBCC SHRINKFILE (".$fila["name"]."_Log, 1);";
        
        if(mssql_query($reduccionLog))
        {
            echo "<br>Se redujo log para: " . $fila["name"] . "_Log";
        }
        else
        {
            echo "<br>error, no se redujo log para ".$fila["name"]. "_Log";
            
            $reduccionLog = "DBCC SHRINKFILE (".$fila["name"]."_log, 1);";
            
            if(mssql_query($reduccionLog)){    
                echo "<br>Se redujo log para: " . $fila["name"] . "_log";
            }
            else{
                echo "<br>error, no se redujo log para ".$fila["name"]. "_log";
            }
            //exit();
        }
   }
   else
   {
        echo "error: ";
        //exit();
   }
        $recuperar = "ALTER DATABASE ".$fila["name"]." SET RECOVERY FULL;";
   if(mssql_query($recuperar))
   {
        echo "<br>Se recuperó la condición para " . $fila["name"];
   }  
   else
   {
        echo "<br>No se recuperó la condición para " . $fila["name"];
   }
 }
ob_flush();
 //SET RECOVERY SIMPLE;"
 /*   
 USE miBaseDeDatos;
GO
-- cambiamos el recovery a nodo simple
ALTER DATABASE miBaseDeDatos
SET RECOVERY SIMPLE;
GO
-- reducirmos el archivo log a 1 MB.
DBCC SHRINKFILE (miBaseDeDatos_Log, 1);
GO
-- devolvemos el nivel de recovery a full
ALTER DATABASE miBaseDeDatos
SET RECOVERY FULL;
GO
 */        
?>