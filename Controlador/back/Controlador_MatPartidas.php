<?php
session_start();
class partidas
{
	public $accion = '';


    public $DelIdPartida = '';
    public $CambiarIdPartida;
	public $Descripcion = '';
	public $Cantidad ='';

	public $Unidad = '';
	public $Costo = '';
	public $InfoAdicional ='';
	public $objModPartidas;

    public $indexPartida;


    
	public function __construct()
    {  


    	$this->accion = $_POST['Accion'];



        require($_SESSION['PathModel']."Modelo_MatPartidas.php");
        $this->objModPartidas = new DatosMatPartidas();     

		$this->Descripcion = $_POST['Descripcion'];
		$this->Cantidad = $_POST['Cantidad'];
		$this->Unidad = $_POST['Unidad'];
		$this->Costo = $_POST['Costo'];
		$this->InfoAdicional = $_POST['InfoAdicional'];


        if($this->accion == "AddPart")
        {           
			$this->AddPart();
    	}
    	if($this->accion=="MostrarPartidas")
    	{
    		$this->MostrarPartidas();
    	}
    	if($this->accion=="MostrarUnidades")
    	{
    		$this->MostrarUnidades();	
    	}
        if($this->accion=="DelPart")
        {
            $this->DelIdPartida= intval($_POST['IdPartida']);
            $this->DelPart();   
        }
        if($this->accion=="MostrarPartida")
        {                  
            echo json_encode($_SESSION['PartidasMaterial'][intval($_POST['IdPartida'])]);
        }


        if($this->accion=="CambiarPartida")
        {     
            $this->CambiarIdPartida = intval($_POST['IdPartida']);
            $this->CambiarPartida();
        }
        if($this->accion=="TotalesPartidas")
        {
            $this->TotalesPartidas();

        } 
        if($this->accion=="ObtenerIVA")       
        {
            echo $_SESSION['IVAPartidasMat'];
        }
        if($this->accion=="CambiarIVA")       
        {
            echo $_SESSION['IVAPartidasMat'] = intval($_POST['valorIVA']);;
        }


        if($this->accion=="CrearPartidasDB")       
        {            

            
            $partidas="";
            $_SESSION["PartidasMaterial"]=array(); 

            $query = $this->objModPartidas->PartidasCot($_POST['IdCotizacion']);           

            while($row = $query->fetch_array(MYSQL_ASSOC))
            {
                $partidas = "ok";

                $_SESSION['PartidasMaterial'][] = array("Descripcion" => $row['concepto'],
                                               "Cantidad" => $row['cantidad'],
                                               "Unidad" => $row['unidad'],
                                               "Costo" => $row['costounitario'], 
                                               "Adicional" => $row['concepto2']);
                
            }


            echo $partidas;


                


            
     
            

            //$this->MostrarPartidas();        

        }

        
    }
    public function MostrarPartidasCot($IdCotizacion)
    {

        $this->objModPartidas->PartidasCot($IdCotizacion);
    }
    public function TotalesPartidas()
    {        
        $c=0;

        $subtotal = 0;
        $IVA = $_SESSION['IVAPartidasMat'];
        $total = 0;
        foreach($_SESSION["PartidasMaterial"] as $fila){               
            $subtotal = $subtotal+($_SESSION["PartidasMaterial"][$c]['Cantidad']*$_SESSION["PartidasMaterial"][$c]['Costo']);         
            $c++;           
         }

         echo json_encode(array('subtotal'=>'$ '.number_format($subtotal),'IVA'=>'$ '.number_format($subtotal*($IVA/100)),"total"=>'$ '.number_format($subtotal*(1+($IVA/100)))));
         
    }
    public function CambiarPartida()
    {
        $_SESSION["PartidasMaterial"][$this->CambiarIdPartida] = array("Descripcion" => $this->Descripcion,
                  "Cantidad" => $this->Cantidad,
                  "Unidad" => $this->Unidad,
                  "Costo" => $this->Costo, 
                  "Adicional" => $this->InfoAdicional);
        echo $this->CambiarIdPartida;
    }
    public function AddPart()
    {
    	$_SESSION['PartidasMaterial'][] = array("Descripcion" => $this->Descripcion,
    										   "Cantidad" => $this->Cantidad,
    										   "Unidad" => $this->Unidad,
    										   "Costo" => $this->Costo, 
    										   "Adicional" => $this->InfoAdicional);	
    	echo json_encode(array("estado" => 0, "mensaje" => "La partida se agrego correctamente" ));
    }
    public function DelPart()
    {

        if(count($_SESSION['PartidasMaterial'])==1)
        {
            unset($_SESSION['PartidasMaterial']);
            echo "1";
        }else
        {
            // Duplicar Array
            $PTARPartidasMat2=$_SESSION['PartidasMaterial'];

            
            // Borrar Array1
            unset($_SESSION['PartidasMaterial']);
            
            // Declaramos Array1
            $_SESSION['PartidasMaterial'] = Array();
            
            
           
            $c=0;          
            foreach($PTARPartidasMat2 as $fila){
               
                if($c!=$this->DelIdPartida)
                {
                    $_SESSION['PartidasMaterial'][]=$fila;
                } 
                $c++;           
            }
            echo count($_SESSION['PartidasMaterial']);
        }

    }
    public function MostrarPartidas()
    {    	
		echo json_encode($_SESSION['PartidasMaterial']);
    }
    public function MostrarUnidades()
    {
    	$resultado = $this->objModPartidas->unidades();

		$datos = array();	
		while($row = $resultado->fetch_array(MYSQL_BOTH))			
		{
			$datos[] = $row; 			
		}
        echo json_encode($datos);        
    }

}
$partidas = new partidas();
?>