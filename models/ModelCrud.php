<?php
	
	class sqlModel extends conexion
	{
		/**
		 * Extrae los datos de la clase padre osea la conexion
		 */
		public function CrudModel (){
			$this->connection();
		}

		/**
		 * Método estandarizado para extraer los datos que se le indique a la base de datos
		 * 
		 * @param mixed $query - la query a ejecutar en la bd
		 */
		public function getDatos($query){
				$stmt = $this->con->prepare($query);
				$stmt->execute();
				return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		/**
		 * Método estandarizado para actualizar los datos que se le indique a la base de datos
		 * 
		 * @param mixed $tabla - la tabla a actualizar
		 * @param mixed $datos - los datos a actualizar
		 * @param mixed $condicion - las condiciones a cumplir
		 */
		public function editDatos($tabla, $datos, $condicion){
			$stmt = $this->con->prepare("UPDATE $tabla SET $datos WHERE $condicion");
			if($stmt->execute()){
				return 'ok';
			}else{
				return $stmt->errorInfo();
			}
			$stmt->close();
			$stmt = null;
		}

		
		public function mdlCrear($tabla, $campos, $valores){
			// $pdo  = Conexion::conectar();
			$stmt = $this->con->prepare("INSERT INTO $tabla ($campos) VALUES($valores)");
			if($stmt->execute()){
				return 'ok';
			}else{
				return 'error';
			}
			$stmt->close();
			$stmt = null;
		}
		
		/**
		 * Función para eliminar items de la base de datos
		 * 
		 * @param mixed $tabla - tabla de donde se eliminaran los items
		 * @param mixed $condicion - condición de borrado
		 */
		public function mdlBorrar($tabla, $condicion){
			if($condicion==""){
				$stmt = $this->con->prepare("DELETE FROM $tabla");
			}else{
				$stmt = $this->con->prepare("DELETE FROM $tabla WHERE $condicion");
			}
			if($stmt -> execute()){
				return "ok";
			}else{
				return $stmt->errorInfo();	
			}
			$stmt->close();
			$stmt = null;
		}
		
		// static public function mdlMostrar($campo,$tabla,$condicion){
		// 	if($condicion==""){
		// 		//si no tiene condicion
		// 		$stmt = Conexion::conectar()->prepare("SELECT $campo FROM $tabla");
		// 		$stmt->execute();
		// 		return $stmt->fetchAll(PDO::FETCH_ASSOC);
		// 	}else{
		// 		//si tiene condicion
		// 		$stmt = Conexion::conectar()->prepare("SELECT $campo FROM $tabla WHERE $condicion");
		// 		$stmt->execute();
		// 		return $stmt->fetchAll(PDO::FETCH_ASSOC);
		// 	}
			
		// 	$stmt->close();
		// 	$stmt = null;

		// }

		// static public function mdlMostrarGroupAndOrder($campo,$tabla,$condicion, $groupBy = null, $orderBy = null, $limit=null){
		// 	if($condicion==""){
		// 		//si no tiene condicion
		// 		$stmt = Conexion::conectar()->prepare("SELECT $campo FROM $tabla $groupBy $orderBy $limit");
		// 		$stmt->execute();
		// 		return $stmt->fetchAll(PDO::FETCH_ASSOC);
		// 	}else{
		// 		//si tiene condicion
		// 		$stmt = Conexion::conectar()->prepare("SELECT $campo FROM $tabla WHERE $condicion $groupBy $orderBy $limit");
		// 		$stmt->execute();
		// 		return $stmt->fetchAll(PDO::FETCH_ASSOC);
		// 	}
			
		// 	$stmt->close();
		// 	$stmt = null;

		// }

		// static public function mdlMostrarUnitario($campo,$tabla,$condicion){
		// 	if($condicion==""){
		// 		//si no tiene condicion
		// 		$stmt = Conexion::conectar()->prepare("SELECT $campo FROM $tabla");
		// 		$stmt->execute();
		// 		return $stmt->fetch();
		// 	}else{
		// 		//si tiene condicion
		// 		$stmt = Conexion::conectar()->prepare("SELECT $campo FROM $tabla WHERE $condicion");
		// 		$stmt->execute();
		// 		return $stmt->fetch();
		// 	}
			
		// 	$stmt->close();
		// 	$stmt = null;

		// }




	

		

		// static public function mdlAlter($tabla,$opciones){

		// 	//si no tiene condicion
		// 	$stmt = Conexion::conectar()->prepare("ALTER TABLE $tabla $opciones");
		// 	if($stmt -> execute()){
		// 		return 'ok';
		// 	}else{
		// 		return $stmt->errorInfo();	
		// 	}
		// 	$stmt->close();
		// 	$stmt = null;

		// }

		// static public function mdlGetNumrows_number($tabla, $condicion){
		// 	if($condicion==""){
		// 		$stmt = Conexion::conectar()->prepare("SELECT count(*) as cantidad FROM $tabla");
		// 	}else{
		// 		$stmt = Conexion::conectar()->prepare("SELECT count(*) as cantidad FROM $tabla WHERE $condicion");
		// 	}

		// 	$stmt -> execute();
		// 	$totales = $stmt->fetch();
		// 	return $totales['cantidad'];
		// 	$stmt -> close();
		// 	$stmt = null;
		// }

	}
	?>