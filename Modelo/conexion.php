<?php
abstract class Conexion{
    protected $conector;
    
    protected function conectar($archivoConf= 'configuracion.ini'){
        if(!$config = parse_ini_file($archivoConf, true)){
            throw new exception('No se pudo abrir el archivo de configuaracion'.$archivoConf);
        }
        $driver=$config["database"]["driver"];
        $servidor=$config["database"]["host"];
        $puerto=$config["database"]["port"];
        $nombrebd=$config["database"]["schema"]; 
        
        try{
           return  $this->conector= new PDO(
                   "mysql:host=$servidor;port=$puerto;dbname=$nombrebd",
                   $config['database']['user'],
                   $config['database']['password'],
                   array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        }catch(PDOException $e){
            echo 'Error en la conexion: ' .$e->getMessage();
        }
    }   
}
?>