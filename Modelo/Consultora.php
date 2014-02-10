<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Consulta
 *
 * @author Katerina
 */
require_once 'conexion.php';
class Consultora extends Conexion {
   private $conexion;
   
   public function __construct(){
       $this->conexion=  parent::conectar();
       return $this->conexion;
   }
   
   public function consultar($consulta, $valores = array()){
       if($st=$this->conexion->prepare($consulta)){
           if(preg_match_all("/(:\w+)/", $consulta, $campo, PREG_PATTERN_ORDER)){
               $campo=  array_pop($campo);
               foreach ($campo as $parametro){
                   $st->bindValue($parametro, $valores[substr($parametro, 1)]);
               }
           }
           try{
             if(!$resultado=$st->execute()){
                 print_r($st->errorInfo());  
             }           
             $resultado=$st->fetchAll(PDO::FETCH_ASSOC);
             $st->closeCursor();
               
           }catch(PDOException $e){
               echo "Error de ejecucion \n";
               print_r($e->getMessage());
           }   
       }
       return $resultado;
       $this->conexion=null;
   }
   
    public function consultarPorUnidad($consulta, $valores = array()){
       if($st=$this->conexion->prepare($consulta)){
           if(preg_match_all("/(:\w+)/", $consulta, $campo, PREG_PATTERN_ORDER)){
               $campo=  array_pop($campo);
               foreach ($campo as $parametro){
                   $st->bindValue($parametro, $valores[substr($parametro, 1)]);
               }
           }
           try{
             if(!$resultado=$st->execute()){
                 print_r($st->errorInfo());  
             }           
             $resultado=$st->fetch(PDO::FETCH_ASSOC);
             $st->closeCursor();
               
           }catch(PDOException $e){
               echo "Error de ejecucion \n";
               print_r($e->getMessage());
           }   
       }
       return $resultado;
       $this->conexion=null;
   }
}

?>
