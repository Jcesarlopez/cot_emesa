<?php
session_start();
	class Conexion{
	// Atributos

	public $MySQLServidor;
	public $MySQLUser;
	public $MySQLPass;
	public $MySQLdb;
	public $link;



	//private $MySQLDB="emesa_sap";
	

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
		$this->MySQLServidor=$_SESSION['MySQLServidor'];
		$this->MySQLUser=$_SESSION['MySQLUser'];
		$this->MySQLPass=$_SESSION['MySQLPass'];
		$this->MySQLdb=$_SESSION['MySQLdb'];

		$this->link = \mysqli_connect($this->MySQLServidor,$this->MySQLUser,$this->MySQLPass,$this->MySQLdb);

		//$this->link = \mysqli_connect("localhost","emesa_saptest","Equipos123#","emesa_saptest");
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