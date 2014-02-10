<?php

/*class Administrador{

	public $id;
	public $usuario;
	public $clave;
	public $autenticado;
	public static $conexion;

	function __construct($usuario, $clave){
		self::$conexion=Conexion::getInstancia();
		$this->autenticado=false;
		$usuario=mysqli_real_escape_string(self::$conexion->conectar(),$usuario);
		$clave= mysqli_real_escape_string(self::$conexion->conectar(), $clave);
		$sql="select * from administrador where nombre='{$usuario}' and clave= '{$clave}'";
		$rs=mysqli_query(self::$conexion->conectar(), $sql);

		if(mysqli_num_rows($rs) > 0){
			$fila= mysqli_fetch_array($rs);
			$this->usuario=$usuario;
			$this->id=$fila['id'];
			$this->autenticado=true;
		}
	}
}*/