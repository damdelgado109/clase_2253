<?php

require_once("modelos/generico.php");

class contenidos extends generico{

	public $titulo;

	public $descripcion;

	public $anio;

	public $idioma;

	public $pais;

	public $duracion;

	public $tipoContenido;

	public $idDirector;

	public $idProveedor;

	public $estado;

	protected $tabla = "contenidos";

	public $listaIdioma = [
		"ES_ES" => "Español España",
		"ES_LA" => "Español Latinoamerica",
		"EN_US" => "Ingles USA",
		"EN_UK" => "Ingles Reino Unido",
		"FR_FR" => "Frances",
		"PT_PO" => "Portugues Portugal",
		"PT_BR" => "Portugues Brasil"
	];

	public $listaTipoContenidos = ['Peliculas','Series','Video Clip'];


	public function constructor($arrayDatos = array()){

		$this->titulo 		= $arrayDatos['titulo'];
		$this->descripcion 	= $arrayDatos['descripcion'];
		$this->anio 		= $arrayDatos['anio'];		
		$this->idioma 		= $arrayDatos['idioma'];
		$this->pais 		= $arrayDatos['pais'];
		$this->duracion 	= $arrayDatos['duracion'];
		$this->tipoContenido = $arrayDatos['tipoContenido'];
		$this->idDirector 	= $arrayDatos['idDirector'];
		$this->idProveedor	= $arrayDatos['idProveedor'];

	}

	public function ingresar(){
		/*
			En este metodo se encarga de ingresar los regisros
		*/		
	
		$sql = "INSERT contenidos SET
					titulo 		= :titulo,
					descripcion = :descripcion,
					anio 		= :anio,
					idioma 		= :idioma,
					pais 		= :pais,
					duracion 	= :duracion,
					tipo_contenido = :tipoContenido,
					id_director = :idDirector,
					id_proveedor= :idProveedor,
					estado 		= 1;
				";
		$arrayDatos = array(
			"titulo" 		=> $this->titulo,
			"descripcion" 	=> $this->descripcion,
			"anio" 			=> $this->anio,
			"idioma" 		=> $this->idioma,
			"pais" 			=> $this->pais,
			"duracion" 		=> $this->duracion,
			"tipoContenido" => $this->tipoContenido,
			"idDirector" 	=> $this->idDirector,
			"idProveedor" 	=> $this->idProveedor,
		);
		
		$respuesta = $this->ejecutar($sql, $arrayDatos);

		return $respuesta;

	}


	public function listar($filtro = array()){
		/*
			Este metodo se encarga de retornar una lista de registro de la base de datos
		*/
		$estado = isset($filtro['estado'])?$filtro['estado']:"1";	

		$sql = "SELECT * FROM contenidos
					WHERE estado = :estado 
				ORDER BY id";

		if(isset($filtro['inicio']) && isset($filtro['cantidad'])){
			$sql .= " LIMIT ".$filtro['inicio'].", ".$filtro['cantidad']."";
		}		
					
		$arraySQL = array("estado" => $estado);

		$lista = $this->traerRegistros($sql, $arraySQL);

		return $lista;

	}

	public function totalRegistros(){

	
		$sql = "SELECT count(*) as total FROM ".$this->tabla." WHERE estado = 1";
		$lista = $this->traerRegistros($sql);
		if(isset($lista[0]['total'])){
			$retorno = $lista[0]['total'];		
		}else{
			$retorno = 0;		
		}
		return $retorno;

	}


}






?>