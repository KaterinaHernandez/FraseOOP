<?php
require_once 'Consultora.php';
class Frase{
	public $id;
	public $frase;
	public $autor;
	public $titulo;
	public $fecha;
	public $categoria;
	
	function agregar(){
            $registrar=false;
            $consulta=null;
            $valores=array();
            if($this->id > 0){
		$consulta= "update frase set
		titulo= :titulo,
		frase= :frase,
		categoria= :categoria,
		autor= :autor
		where id= :id";
                
		$valores=array(
                    "titulo" =>$this->titulo,
                    "frase" =>$this->frase,
                    "categoria" =>$this->categoria,
                    "autor" =>$this->autor,
                    "id" =>$this->id);
                $objConsulta= new Consultora();
                $registrar=$objConsulta->consultar($consulta, $valores);
                if($registrar !== false){
                    return true;
                }else{
                    return false;
                }
                    
            }else{
		$consulta="insert into frase(frase,titulo,autor, categoria)
		values(:frase, :titulo, :autor, :categoria)";
		$valores= array(
                    "frase" =>$this->frase,
                    "titulo" =>$this->titulo,
                    "autor" =>$this->autor,
                    "categoria" =>$this->categoria);
                $objConsulta= new Consultora();
                $registrar= $objConsulta->consultar($consulta, $valores);
               // $this->id=mysqli_insert_id($objConsulta);
                if($registrar !== false){
                    return true;
                }
                else{
                    return false;
                }
            }
           }

	function borrar(){	
                $consulta="delete from frase where id= :id";
                $valores= array(
                    "id"=>$this->id);
                $objConsultora=new Consultora();
                $objConsultora->consultar($consulta, $valores);

	}

	function cargar(){
		$consulta="select * from frase where id= :id";
                $valores= array(
                    "id"=>$this->id);
                $objConsultora= new Consultora();
		$recurso= $objConsultora->consultarPorUnidad($consulta,$valores);
		if(!empty($recurso)){                               
			$this->autor=$recurso['autor'];
			$this->titulo=$recurso['titulo'];
			$this->frase=$recurso['frase'];
			$this->categoria=$recurso['categoria'];
		}
        }
	 function obtenerFrases(){
                $valores= null;
		$consulta="select * from frase";
                $objconsulta=new Consultora();
                $frases=$objconsulta->consultar($consulta, $valores);
		return $frases;
                //var_dump($frases);
                //exit();
	}

	function obtenerFrasePorId($idFrase){
		$consulta= "select * from frase where id=:id";
                $valores=array(
                    "id"=>$this->id);
		$objConsultora=new Consultora();
                $resultado=$objConsultora->consultarPorUnidad($consulta, $valores);
		return $resultado;

	}
	 function obtenerUltimoRegistro(){
                $valores= null;
		$consulta="select * from frase order by id DESC LIMIT 1";
		$objConsultora=new Consultora();
                $rs=$objConsultora->consultar($consulta, $valores);
                return $rs;
               // var_dump($rs);
                //exit();
	}
	function convertirFecha(){
                $valores= null;
		$sql="SELECT DATE_FORMAT( fechaDePublicacion,  '%d-%m-%Y %h:%i' ) AS fechaConvertida
		FROM frase
		ORDER BY id DESC 
		LIMIT 1";
		$objConsultora= new Consultora();
                $resultado=$objConsultora->consultar($sql, $valores);
                foreach($resultado as $fecha){
                     $fechaConvertida=$fecha['fechaConvertida'];
               }
		return $fechaConvertida;
	}

	function traerCategorias(){
                $valores=null;
		$sql="select distinct categoria from frase";
                $objConsultora= new Consultora();
		$rs=$objConsultora->consultar($sql,$valores);
		return $rs;
	}

	function traerCategoriasParaAgregar(){
                $valores=null;
		$sql="select nombre from categoria";
		$objConsultora= new Consultora();
		$rs=$objConsultora->consultar($sql,$valores);
                return $rs;
	}

	function traerFrasesCategorizadas($categoria){
		$sql="select * from frase where categoria= :categoria";
		$valores=array(
                    "categoria"=>$categoria
                );
                $objConsultora= new Consultora();
		$rs=$objConsultora->consultar($sql,$valores);
                return $rs;

	}

}


