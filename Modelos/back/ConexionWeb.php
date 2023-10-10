<?php
session_start();
	class Conexion{
	// Atributos

	public $MySQLServidor="localhost";
	public $MySQLUser="emesa_fox";
	public $MySQLPass="Equipos123$";
	public $MySQLDB="emesa_sia";
	public $link;

	public function set($atributo,$contenido)
	{
		$this->$atributo = $contenido;
	}
	
	public function get($atributo)
	{
		$this->$atributo;
	}

	public function __construct()
	{
		$this->link = \mysqli_connect($this->MySQLServidor,$this->MySQLUser,$this->MySQLPass,$this->MySQLDB);
	}

	// Esta consulta es cuando no se espera un retorno como el caso de un update delete, casi cualquier cosa que no sea un SELECT
	public function consultaSimple($sql){
		$this->link->query($sql);		
	}

	public function consultaRetorno($sql){

		$this->link->set_charset('utf8');
		$datos = $this->link->query($sql);
		return $datos;
	}
	public function consultaInsert($sql){
		$this->link->query($sql);
		return $this->link->insert_id;
	}
	
}
?>