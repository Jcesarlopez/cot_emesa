<?php
session_start();
if($_SESSION['Sesion']!=='Activo')
{
	header('Location: index.php');		
}

$NoCotVerWeb = $_SESSION['NoCotVerWeb'];


$VarMes = substr($_GET['Fecha'],5,2); 
if(substr($VarMes,0,1)=="0")
{
	$VarMes=substr($VarMes,1,1);
}
$VarMes = $_SESSION['meses'][$VarMes-1];


$Fecha=substr($_GET['Fecha'],8,2)." de ".$VarMes." de ".substr($_GET['Fecha'],0,4);
$IdVend=$_GET['IdVend'];
$Ref = $_GET['Ref'];
$IVA = $_GET['IVA'];



// Variables cliente
require_once($_SESSION['PathModel']."Modelos.php");
$Cliente = new DatosCliente();
$Query = $Cliente->Datos($_SESSION['IdCliente']);
// Esto si funciono
while($row = $Query->fetch_array(MYSQL_ASSOC))
{
	//$DataCliente[]=$row;
	$nombreCliente=$row['Nombre'];
	$DireccionCliente=$row['Calle'];
	$CiudadEstadoPaisCliente=$row['Ciudad'].", ".$row['Estado'].", ".$row['Pais'];
	$AtnCliente=$row['Contacto'];
}


// Variables usuario
$Usuario = new DatosUsuarios();
$Query = $Usuario->usuario($_GET['IdVend']);
while($row = $Query->fetch_array(MYSQL_ASSOC))
{
	$nombreCompletoUsr=strtoupper($row['Nombre'])." ".strtoupper($row['ApPaterno'])." ".strtoupper($row['ApMaterno']);
}
// Variables planta
$lps = $_SESSION['PTARPropiedades']['Capacidad'];

$m3dia = $lps*86.4;

$IdModelo = $_SESSION['PTARPropiedades']['IdModelo']; //1 Selector 2 Urbana 3 Premium
if($IdModelo==1){$ModeloPTAR = "SELECTOR";}
if($IdModelo==2){$ModeloPTAR = "URBANA";}


$ModeloLPS = $_SESSION['PTARPropiedades']['ModeloLPS'];

$NoCot = $_SESSION['NoCot'];


$NormaSel = "NOM-003-SEMARNAT-1997";
$NormaUrb = "NOM-002-SEMARNAT-1996 y NOM-001-SEMARNAT-1996 CUERPO RECEPTOR TIPO A O B";


$Capacidad = $_SESSION['PTARPropiedades']['Capacidad'];
$m3Dia = ($Capacidad*86.4);
$hab140 = number_format(round(($Capacidad*86400)/140));
$hab180 = number_format(round(($Capacidad*86400)/180));

$IdTipo = $_SESSION['PTARPropiedades']['IdTipo'];
$AltoPlanta = $_SESSION['PTARPropiedades']['AltoPlanta'];
$LargoPlanta = $_SESSION['PTARPropiedades']['LargoPlanta'];
$AnchoPlanta = $_SESSION['PTARPropiedades']['AnchoPlanta'];
$AreaPlanta = $LargoPlanta*$AnchoPlanta;

$DiametroPlanta = $_SESSION['PTARPropiedades']['DiametroPlanta'];
$LodosSecos = $_SESSION['PTARPropiedades']['LodosSecos'];
$Lechosm2 = $_SESSION['PTARPropiedades']['Lechosm2']. " m3";	
$BHPPlanta = $_SESSION['PTARPropiedades']['BHPPlanta'];
$HPPlanta = $_SESSION['PTARPropiedades']['HPPlanta'];
$GrupoLPS = $_SESSION['PTARPropiedades']['GrupoLPS'];
$ModeloLPS = $_SESSION['PTARPropiedades']['ModeloLPS'];
$AltoCarcamo = $_SESSION['PTARPropiedades']['AltoCarcamo']." mts";
$LargoCarcamo = $_SESSION['PTARPropiedades']['LargoCarcamo']." mts";
$AnchoCarcamo = $_SESSION['PTARPropiedades']['AnchoCarcamo']." mts";
$AreaCarcamo = ($LargoCarcamo*$AnchoCarcamo)." M2";

$BHPCarcamo = $_SESSION['PTARPropiedades']['BHPCarcamo'];
$HPCarcamo = $_SESSION['PTARPropiedades']['HPCarcamo'];
$DescModelo = $_SESSION['PTARPropiedades']['DescModelo'];

$PK=false;
if($IdTipo!=2)
{
	$PK=true;
}






$AreaRequerida = 0;
$ExisteCarcamo = false;
$ExisteLecho = false;
$AreaRequerida = ($LargoPlanta*$AnchoPlanta);  //Area planta
for($c=0;$c<count($_SESSION['PTARPartidas']);$c++) // Comprobamos la existencia del carcamo y los lechos de secado
{
	if($_SESSION['PTARPartidas'][$c+1]['label']=="ocpr" or $_SESSION['PTARPartidas'][$c+1]['label']=="empr") // Area carcamo
	{		
		$ExisteCarcamo = true;
	}		
	if($_SESSION['PTARPartidas'][$c+1]['label']=="lese") // Area Lecho de lodos
	{		
		$ExisteLecho = true;		
	}
	
			
}
if(!$PK)
{
	if($ExisteCarcamo){$AreaRequerida = $AreaRequerida + ($LargoCarcamo*$AnchoCarcamo);}else{$LargoCarcamo = "N/A";$AnchoCarcamo = "N/A";$AreaCarcamo= "N/A";}
	if($ExisteLecho){$AreaRequerida = $AreaRequerida + ($Lechosm2);}else{$Lechosm2 = "N/A";}
}



require_once dirname(__FILE__).'/PHPWord-master/src/PhpWord/Autoloader.php';
\PhpOffice\PhpWord\Autoloader::register();

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Style\Font;

//Instancia phpWord.
$documento = new PhpWord();

// Nueva seccion
$seccion = $documento->addSection(array('marginLeft' => 800, 'marginRight' => 800, 'marginTop' => 600, 'marginBottom' => 600));
//$seccion = $documento->addSection();



// Encabezado
$header = $seccion->addHeader();

$table = $header->addTable();
$table->addRow();
$cellHead = array('borderBottomSize' => 8, 'borderBottomColor' => '1E88E5');
$table->addCell(7500,$cellHead)->addImage('imagenes/logocot.jpg',array('width' => 180, 'height' => 76, 'align' => 'left'),array('spaceBefore' => 0,'spaceAfter' => 900));
$table->addCell(7500,$cellHead)->addText(htmlspecialchars("COTIZACION No.: $NoCot"), $formatNoCot,array('align' => 'right','spaceBefore' => 0,'spaceAfter' => 900));

// Pie de pagina
$formatFoot = array('size' => 8,'bold' => flase, 'align' => 'center','color' => '777777');


$cellFoot = array('borderTopSize' => 8, 'borderTopColor' => '1E88E5');
$Footer = $seccion->addFooter();
$table = $Footer->addTable();
$table->addRow();
$dir = "Tabachin 78 Col. Bellavista, Cuernavaca Morelos, C.P.62130 • Tel:. 01 (777) 313 02 27";
$table->addCell(10000,$cellFoot)->addText(htmlspecialchars($dir), $formatFoot,array('align' => 'center','spaceBefore' => 0,'spaceAfter' => 0));
$table->addRow();

$dir = "www.emesa.com.mx • emesa@emesa.com.mx";
$table->addCell(10000,'')->addText(htmlspecialchars($dir), $formatFoot,array('align' => 'center','spaceBefore' => 0,'spaceAfter' => 0));







///////////////////////// Estilos

$cellTit = array('bgColor' => '1E88E5 ','gridSpan' => 2, 'valign' => 'center');
$cellSubTit = array('bgColor' => 'EEEEEE ','gridSpan' => 2, 'valign' => 'center');


$TextTit = array('size'=>12,'color' => 'FFFFFF','valign' => 'center','bold'=>true);
$TextSubTit = array('color' => '333333','valign' => 'center');
$TextSubTitTabla = array('size' => 10, 'bold' => true,'valign' => 'left','color' => '055fc3');
$formatNoCot = array('size' => 8,'bold' => true, 'align' => 'center','color' => '333333');


$fontStyleParrafo = array('name' => 'Calibri','size' => 10, 'bold' => false, 'color' => '222222','valign' => 'left');
$fontStyleNegrita = array('name' => 'Calibri','size' => 10, 'bold' => true, 'color' => '222222','valign' => 'left');


////////////////////////////////////////////////////////////////////////////////////////////////////// Pagina 1
//Fecha
$seccion->addTextBreak(1,array('size' => 8));
$seccion->addText(htmlspecialchars('Cuernavaca Morelos a '.$Fecha), $fontStyleNegrita,array('align' => 'right'));

// Datos Cliente
$seccion->addTextBreak(0);
$seccion->addText(htmlspecialchars(may(strtoupper($nombreCliente))), $fontStyleNegrita,array('align' => 'left'));

$paragraphStyle = array('spacing' => 100, 'size' => 1);
$seccion->addTextBreak(0,null,$paragraphStyle); // Direccion
$seccion->addText(htmlspecialchars(may(strtoupper($DireccionCliente))), $fontStyleNegrita,array('align' => 'left','spaceBefore' => 20,'spaceAfter' => 20));

$seccion->addTextBreak(0,null,$paragraphStyle); // Ciudad, estado
$seccion->addText(htmlspecialchars(may(strtoupper($CiudadEstadoPaisCliente))), $fontStyleNegrita,array('align' => 'left','spaceBefore' => 20,'spaceAfter' => 20));

$seccion->addTextBreak(0,null,$paragraphStyle); // Atencion
$seccion->addText(htmlspecialchars("AT'N: ".may(strtoupper($AtnCliente))), $fontStyleNegrita,array('align' => 'right','spaceBefore' => 20,'spaceAfter' => 20));
$seccion->addTextBreak(1,array('size' => 1));


function may($string)
{

	$min = array('á','é','í','ó','ú','ñ');
	$may = array('Á','É','Í','Ó','Ú','Ñ');

	$resultado = str_replace($min,$may,$string);
	return $resultado;

}



$table = $seccion->addTable();
$table->addRow();



$table->addCell(15000,$cellTit)->addText(htmlspecialchars(' PLANTA DE TRATAMIENTO DE AGUAS NEGRAS'), $TextTit,array('align' => 'center','spaceBefore' => 200,'spaceAfter' => 120));

//$seccion->addTextBreak(1,null,$paragraphStyle);

$seccion->addTextBreak(1,array('size' => 1));


// Parrafo 1
if($PK)
{
	$bloque1 = "A su solicitud y tomando en cuenta los datos y requerimientos proporcionados por usted, en la presente haga favor de encontrar nuestra propuesta técnica y económica para el suministro de una planta de tratamiento de agua negra tipo paquete ";

	$bloque2 = "con capacidad a tratar ".$m3dia." m3/dia (equivalente a ".$lps." L.P.S)";
	$bloque3 = " en ";

	$textrun = $seccion->addTextRun(array('align' => 'justify'));
	$textrun->addText(htmlspecialchars($bloque1),$fontStyleParrafo);

	$textrun->addText(htmlspecialchars($bloque2),$fontStyleNegrita);
	$textrun->addText(htmlspecialchars($bloque3),$fontStyleParrafo);
	$textrun->addText(htmlspecialchars($Ref),$fontStyleNegrita);
}else
{
	$bloque1 = "A su solicitud y tomando en cuenta los datos y requerimientos proporcionados por usted, en la presente haga favor de encontrar nuestra propuesta técnica y económica para la proyección, construcción, equipamiento y puesta en marcha de una Planta de Tratamiento de Aguas negra en: ";	
	$textrun = $seccion->addTextRun(array('align' => 'justify'));
	$textrun->addText(htmlspecialchars($bloque1),$fontStyleParrafo);
	$textrun->addText(htmlspecialchars($Ref),$fontStyleNegrita);	
} 

$seccion->addTextBreak(0,null,$paragraphStyle); 

// Parrafo 2
if($PK)
{
	if($IdModelo==1) //Selector PK
	{
		$bloque1 = "Considerando que el agua tratada será utilizada en Servicios al Público, y que por lo mismo deberá cumplir con la Norma Oficial Mexicana ";
		$bloque2 = "$NormaSel ";
		$bloque3 = ", para la elaboración de esta propuesta hemos seleccionado una";
		$bloque4 = " PLANTA SERIE $ModeloPTAR PK MODELO $ModeloLPS";
	}
	if($IdModelo==2) //Urbana PK
	{
		$bloque1 = "Considerando que su descarga se realizará a un drenaje público y/o, y que por lo mismo deberá cumplir con las normas oficiales Mexicanas vigentes: ";
		$bloque2 = "$NormaUrb ";
		$bloque3 = ", para la elaboración de esta propuesta hemos seleccionado una";
		$bloque4 = " PLANTA SERIE $ModeloPTAR PK MODELO $ModeloLPS";
	}
	$textrun = $seccion->addTextRun(array('align' => 'justify'));
	$textrun->addText(htmlspecialchars($bloque1),$fontStyleParrafo);
	$textrun->addText(htmlspecialchars($bloque2),$fontStyleNegrita);
	$textrun->addText(htmlspecialchars($bloque3),$fontStyleParrafo);
	$textrun->addText(htmlspecialchars($bloque4),$fontStyleNegrita);
}else
{
	if($IdModelo==1) //Selector
	{
		$bloque1 = "Considerando que el agua tratada será utilizada en Servicios al Público, y que por lo mismo deberá cumplir con la Norma Oficial Mexicana ";
		$bloque2 = "$NormaSel ";
	}
	if($IdModelo==2) // Rubana
	{
		$bloque1 = "Considerando que su descarga se realizará a drenaje sanitario y/o a un cuerpo receptor tipo A o B, y que por lo mismo deberá cumplir con las normas oficiales Mexicanas vigentes: ";
		$bloque2 = "$NormaUrb ";
	}
	$bloque3 = ", Para la elaboración de esta propuesta hemos seleccionado una";
	$bloque4 = " PLANTA SERIE $ModeloPTAR MODELO ".$ModeloLPS;
	
	$bloque5 = " con capacidad de ";
	$bloque6 = round($lps,2)." L.P.S ";
	$bloque7 = " (";
	$bloque8 = "$m3dia ";
	$bloque9 = " metros cúbicos por día).";

	$textrun = $seccion->addTextRun(array('align' => 'justify'));
	$textrun->addText(htmlspecialchars($bloque1),$fontStyleParrafo);
	$textrun->addText(htmlspecialchars($bloque2),$fontStyleNegrita);
	$textrun->addText(htmlspecialchars($bloque3),$fontStyleParrafo);
	$textrun->addText(htmlspecialchars($bloque4),$fontStyleNegrita);
	$textrun->addText(htmlspecialchars($bloque5),$fontStyleParrafo);
	$textrun->addText(htmlspecialchars($bloque6),$fontStyleNegrita);
	$textrun->addText(htmlspecialchars($bloque7),$fontStyleParrafo);
	$textrun->addText(htmlspecialchars($bloque8),$fontStyleNegrita);
	$textrun->addText(htmlspecialchars($bloque9),$fontStyleParrafo);
}


// Parrafo 3
if($PK)
{	
	$bloque1 = "Nuestra tecnología consiste en proceso mejorado de lodos activados (aerobio) en la modalidad de aireación extendida y un sistema secuencial que permite la oxidación total, lo que aunado a su ";
	$bloque2 = "sencillez, versatilidad y confiabilidad ";
	$bloque3 = "ha permitido que actualmente se traten más de 100 millones de litros de agua por día en México con nuestras plantas, esto gracias a que representa ventajas, tales como:";
}else
{

	$bloque1 = "Proponemos el uso de la nuestra tecnología, proceso mejorado de lodos activados (aerobio) en la modalidad de aireación extendida, bajo un sistema secuencial que permite la oxidación total, y que aunado a su ";
	$bloque2 = "sencillez, versatilidad y confiabilidad ";
	$bloque3 = "ha permitido que actualmente se traten con nuestras plantas más de 100 millones de litros de agua por día en México, debido a las ventajas que representa, tales como:";
}



$seccion->addTextBreak(0,array('size' => 2));

$textrun = $seccion->addTextRun(array('align' => 'justify'));
$textrun->addText(htmlspecialchars($bloque1),$fontStyleParrafo);
$textrun->addText(htmlspecialchars($bloque2),$fontStyleNegrita);
$textrun->addText(htmlspecialchars($bloque3),$fontStyleParrafo); 






// Ventajas plantas
//$seccion->addTextBreak(0,array('size' => 1));
$seccion->addText(htmlspecialchars($texto), $fontStyleParrafo,array('align' => 'left'));


if($IdTipo==15)
{	
	$seccion->addImage(
		'imagenes/pk/casera.png',
		array(
		    'width'            => \PhpOffice\PhpWord\Shared\Converter::cmToPixel(7),
		    'height'           => \PhpOffice\PhpWord\Shared\Converter::cmToPixel(9),
		    'positioning'      => \PhpOffice\PhpWord\Style\Image::POSITION_RELATIVE,
		    'posHorizontal'    => \PhpOffice\PhpWord\Style\Image::POSITION_HORIZONTAL_RIGHT,
		    'posHorizontalRel' => \PhpOffice\PhpWord\Style\Image::POSITION_RELATIVE_TO_COLUMN,
		    'posVertical'      => \PhpOffice\PhpWord\Style\Image::POSITION_VERTICAL_TOP,
		    'posVerticalRel'   => \PhpOffice\PhpWord\Style\Image::POSITION_RELATIVE_TO_LINE,
		    'wrappingStyle'    => \PhpOffice\PhpWord\Style\Image::WRAPPING_STYLE_SQUARE,
		)
	);
}
//'wrappingStyle' => 'tight'

// Ventajas
$arrayVentajas = array();
// Parrafo 2
if($PK)
{
	if($IdTipo==15)
	{

		$arrayVentajas[] = "- Ausencia de malos olores.";
		$arrayVentajas[] = "- Portatil.";
		$arrayVentajas[] = "- Bajo costo de operación y mantenimiento.";
		$arrayVentajas[] = "- Baja producción de lodos de desecho.";
		$arrayVentajas[] = "- No requiere agregados de productos especiales o bacteria.";
		$arrayVentajas[] = "- Alta remoción de contaminantes.";
		$arrayVentajas[] = "- Puede permanecer sin energía eléctrica hasta 6 horas.";
	}else
	{
		$arrayVentajas[] = "- Ausencia de malos olores.";
		$arrayVentajas[] = "- Baja producción de lodos de desecho.";
		$arrayVentajas[] = "- Alta remoción de contaminantes.";
		$arrayVentajas[] = "- Bajo costo de operación y mantenimiento";
		$arrayVentajas[] = "- Puede permanecer sin energía eléctrica hasta 6 horas.";
		$arrayVentajas[] = "- Diseño modular que permite futuras ampliaciones.";
	}
}else
{
	$arrayVentajas[] = "-	Ausencia de malos olores.";
	$arrayVentajas[] = "-	Baja producción de lodos de desecho.";
	$arrayVentajas[] = "-	Alta remoción de contaminantes.";
	$arrayVentajas[] = "-	Bajo costo de operación y mantenimiento";
	$arrayVentajas[] = "-	Puede permanecer sin energía eléctrica hasta 6 horas.";
	$arrayVentajas[] = "-	Diseño modular que permite futuras ampliaciones.";
}





for($c=0;$c<count($arrayVentajas);$c++)
{
	$seccion->addTextBreak(0,null,$paragraphStyle); // Atencion
	$seccion->addText(htmlspecialchars($arrayVentajas[$c]), $fontStyleParrafo,array('align' => 'left','spaceBefore' => 20,'spaceAfter' => 20));	
}

$seccion->addTextBreak(1,null,$paragraphStyle); // Atencion
$texto = "Anexo encontrara nuestra propuesta técnica económica, así como los anexos de soporte correspondientes.";
$seccion->addText(htmlspecialchars($texto), $fontStyleParrafo,array('align' => 'left','spaceBefore' => 20,'spaceAfter' => 20));	

$seccion->addTextBreak(0,null,$paragraphStyle); // Atencion
$seccion->addTextBreak(1,null,$paragraphStyle); 
$seccion->addText(htmlspecialchars("ATENTAMENTE"), $fontStyleNegrita,array('align' => 'left','spaceBefore' => 20,'spaceAfter' => 20));
$seccion->addTextBreak(2,array('size' => 8));
$seccion->addText(htmlspecialchars("____________________________________"), $fontStyleFecha,array('align' => 'left','spaceBefore' => 0,'spaceAfter' => 0));

$seccion->addTextBreak(0,null,$paragraphStyle); 
$seccion->addText(htmlspecialchars($nombreCompletoUsr), $fontStyleNegrita,array('align' => 'left','spaceBefore' => 20,'spaceAfter' => 20));
$seccion->addTextBreak(0,null,$paragraphStyle); 
$seccion->addText(htmlspecialchars("REPRESENTANTE DE VENTAS"), $fontStyleNegrita,array('align' => 'left','spaceBefore' => 20,'spaceAfter' => 20));


////////////////////////////////////////////////////////////////////////////////////////////////////// Pagina 2
$seccion->addPageBreak();

$seccion->addTextBreak(1,array('size' => 1));

$table = $seccion->addTable(array('cellMargin' => 0,'spaceBefore' => 0,'spaceAfter' => 0,'spacing' => 0));
	
$table->addRow();


$table->addCell(15000,$cellSubTit)->addText(htmlspecialchars(' PROPUESTA TÉCNICA'), $TextSubTit,array('align' => 'left','spaceBefore' => 200,'spaceAfter' => 120));

$seccion->addTextBreak(1,array('size' => 5));
$table = $seccion->addTable();
$table->addRow();

$table->addCell(15000,$cellTit)->addText(htmlspecialchars(' ESPECIFICACIONES GENERALES'), $TextTit,array('align' => 'center','spaceBefore' => 200,'spaceAfter' => 120));







// TABLA ESPESIFICACIONES DE LA PLANTA
// Capacidad
$seccion->addTextBreak(1,array('size' => 2));

$table = $seccion->addTable();
$table->addRow();

$cellColSpanTitTabla = array('gridSpan' => 3, 'valign' => 'bottom', 'bgColor' => 'ffffff','borderBottomSize' => 4, 'borderBottomColor' => '777777');



$cellBordeRight = array('borderRightSize' => 4, 'borderRightColor' => '777777');

$table->addCell(15000,$cellColSpanTitTabla)->addText(htmlspecialchars(' Capacidad Nominal (1)'), $TextSubTitTabla,array('align' => 'left','spaceBefore' => 0,'spaceAfter' => 20));
$table->addRow();
$table->addCell(5000,$cellBordeRight)->addText(htmlspecialchars(" Litros por segundo: $Capacidad"), $formatNoCot,array('align' => 'left','spaceBefore' => 50,'spaceAfter' => 20));
$table->addCell(5000,$cellBordeRight)->addText(htmlspecialchars(" M3/Dia: $m3Dia"), $formatNoCot,array('align' => 'left','spaceBefore' => 50,'spaceAfter' => 20));
$table->addCell(5000,$cellBordeRight)->addText(htmlspecialchars(" Habitantes: $hab180 a $hab140 "), $formatNoCot,array('align' => 'left','spaceBefore' => 50,'spaceAfter' => 20));

// Dimensiones planta

$seccion->addTextBreak(1,array('size' => 2));
$table = $seccion->addTable();
$table->addRow();

if($PK)
{
	$cellColSpanTitTabla['gridSpan'] = 2;

	$table->addCell(15000,$cellColSpanTitTabla)->addText(htmlspecialchars(' Dimensiones planta de tratamiento'), $TextSubTitTabla,array('align' => 'left','spaceBefore' => 0,'spaceAfter' => 20));
	$table->addRow();
	$table->addCell(8000,$cellBordeRight)->addText(htmlspecialchars(" Diámetro: $DiametroPlanta mts"), $formatNoCot,array('align' => 'left','spaceBefore' => 50,'spaceAfter' => 20));
	$table->addCell(8000,$cellBordeRight)->addText(htmlspecialchars(" Alto: $AltoPlanta mts"), $formatNoCot,array('align' => 'left','spaceBefore' => 50,'spaceAfter' => 20));	
}else
{	
	$cellColSpanTitTabla['gridSpan'] = 4;

	$table->addCell(15000,$cellColSpanTitTabla)->addText(htmlspecialchars(' Dimensiones planta de tratamiento'), $TextSubTitTabla,array('align' => 'left','spaceBefore' => 0,'spaceAfter' => 20));
	$table->addRow();
	$table->addCell(4000,$cellBordeRight)->addText(htmlspecialchars(" Largo: $LargoPlanta mts"), $formatNoCot,array('align' => 'left','spaceBefore' => 50,'spaceAfter' => 20));
	$table->addCell(4000,$cellBordeRight)->addText(htmlspecialchars(" Ancho: $AnchoPlanta mts"), $formatNoCot,array('align' => 'left','spaceBefore' => 50,'spaceAfter' => 20));
	$table->addCell(4000,$cellBordeRight)->addText(htmlspecialchars(" Alto: $AltoPlanta mts"), $formatNoCot,array('align' => 'left','spaceBefore' => 50,'spaceAfter' => 20));
	$table->addCell(4000,$cellBordeRight)->addText(htmlspecialchars(" Área planta: $AreaPlanta m2"), $formatNoCot,array('align' => 'left','spaceBefore' => 50,'spaceAfter' => 20));
}





if(!$PK)
{
	// Dimensiones pretratamiento
	$seccion->addTextBreak(1,array('size' => 2));
	$table = $seccion->addTable();
	$table->addRow();

	$cellColSpanTitTabla['gridSpan'] = 3;

	$table->addCell(15000,$cellColSpanTitTabla)->addText(htmlspecialchars(' Dimensiones pretratamiento'), $TextSubTitTabla,array('align' => 'left','spaceBefore' => 0,'spaceAfter' => 20));
	$table->addRow();
	$table->addCell(5000,$cellBordeRight)->addText(htmlspecialchars(" Largo: $LargoCarcamo "), $formatNoCot,array('align' => 'left','spaceBefore' => 50,'spaceAfter' => 20));
	$table->addCell(5000,$cellBordeRight)->addText(htmlspecialchars(" Ancho: $AnchoCarcamo "), $formatNoCot,array('align' => 'left','spaceBefore' => 50,'spaceAfter' => 20));
	$table->addCell(5000,$cellBordeRight)->addText(htmlspecialchars(" Área pretratamiento: $AreaCarcamo "), $formatNoCot,array('align' => 'left','spaceBefore' => 50,'spaceAfter' => 20));
}

if(!$PK)
{
	// Lodos
	$seccion->addTextBreak(1,array('size' => 2));
	$table = $seccion->addTable();
	$table->addRow();

	$cellColSpanTitTabla['gridSpan'] = 2;

	$table->addCell(15000,$cellColSpanTitTabla)->addText(htmlspecialchars(' Lodos'), $TextSubTitTabla,array('align' => 'left','spaceBefore' => 0,'spaceAfter' => 20));
	$table->addRow();
	$table->addCell(7500,$cellBordeRight)->addText(htmlspecialchars(" Lodos producidos al mes: $LodosSecos mts"), $formatNoCot,array('align' => 'left','spaceBefore' => 50,'spaceAfter' => 20));
	$table->addCell(7500,$cellBordeRight)->addText(htmlspecialchars(" Área lecho de lodos: $Lechosm2"), $formatNoCot,array('align' => 'left','spaceBefore' => 50,'spaceAfter' => 20));
}


if($PK)
{
// Totates
	$seccion->addTextBreak(1,array('size' => 2));
	$table = $seccion->addTable();
	$table->addRow();
	$cellColSpanTitTabla['gridSpan'] = 1;
	$table->addCell(15000,$cellColSpanTitTabla)->addText(htmlspecialchars(' Capacidad orgánica'), $TextSubTitTabla,array('align' => 'left','spaceBefore' => 0,'spaceAfter' => 20));
	$table->addRow();
	$table->addCell(15000,$cellBordeRight)->addText(htmlspecialchars('300 ppm de DBO5'), $formatNoCot,array('align' => 'left','spaceBefore' => 50,'spaceAfter' => 20));
}



// Totates
$seccion->addTextBreak(1,array('size' => 2));
$table = $seccion->addTable();
$table->addRow();


if(!$PK)
{
	$cellColSpanTitTabla['gridSpan'] = 4;
	$table->addCell(15000,$cellColSpanTitTabla)->addText(htmlspecialchars(" Totales"), $TextSubTitTabla,array('align' => 'left','spaceBefore' => 0,'spaceAfter' => 20));
	$table->addRow();
	$table->addCell(3750,$cellBordeRight)->addText(htmlspecialchars(" Total área requerida: $AreaRequerida mts"), $formatNoCot,array('align' => 'left','spaceBefore' => 50,'spaceAfter' => 20));	
}else
{
	$cellColSpanTitTabla['gridSpan'] = 3;

	$table->addCell(15000,$cellColSpanTitTabla)->addText(htmlspecialchars(' Totales'), $TextSubTitTabla,array('align' => 'left','spaceBefore' => 0,'spaceAfter' => 20));
	$table->addRow();	
}
$table->addCell(3750,$cellBordeRight)->addText(htmlspecialchars(" HP'S Instalados: $HPPlanta mts"), $formatNoCot,array('align' => 'left','spaceBefore' => 50,'spaceAfter' => 20));
$table->addCell(3750,$cellBordeRight)->addText(htmlspecialchars(" HP'S a utilizar: $BHPPlanta mts"), $formatNoCot,array('align' => 'left','spaceBefore' => 50,'spaceAfter' => 20));
$table->addCell(3750,$cellBordeRight)->addText(htmlspecialchars(" Malos olores: NINGUNO"), $formatNoCot,array('align' => 'left','spaceBefore' => 50,'spaceAfter' => 20));



// Nota garantizar calidad del efluente
$seccion->addTextBreak(1,array('size' => 2));
//$table = $seccion->addTable();
//$table->addRow();



$texto = "Para garantizar la calidad del efluente, el agua del cliente deberá cumplir con los parámetros de la siguiente tabla (4).";
$formatCalidadEfluente = array('size'=>'11','bold' => false, 'align' => 'center','color' => '055fc3');
$seccion->addText(htmlspecialchars($texto),$formatCalidadEfluente,array('align' => 'left','spaceBefore' => 20,'spaceAfter' => 20));
$seccion->addTextBreak(1,array('size' => 2));	



// Imagen de tabla
//$seccion->addTextBreak(1,array('size' => 2));
/*$seccion->addImage(
    'imagenes/carga.jpg',
    array(
        'positioning'   => 'relative',
        'marginTop'     => -1,
        'marginLeft'    => 200,
        'width'         => 580,
        'height'        => 225,
        'wrappingStyle' => 'tight'
    )
);*/


$seccion->addImage(
			    'imagenes/carga.jpg',
			    array(
			        'width'            => \PhpOffice\PhpWord\Shared\Converter::cmToPixel(15),
			        'height'           => \PhpOffice\PhpWord\Shared\Converter::cmToPixel(6),
			        'positioning'      => \PhpOffice\PhpWord\Style\Image::POSITION_RELATIVE,
			        'posHorizontal'    => \PhpOffice\PhpWord\Style\Image::POSITION_HORIZONTAL_CENTER,
			        'posHorizontalRel' => \PhpOffice\PhpWord\Style\Image::POSITION_RELATIVE_TO_COLUMN,
			        'posVertical'      => \PhpOffice\PhpWord\Style\Image::POSITION_VERTICAL_TOP,
			        'posVerticalRel'   => \PhpOffice\PhpWord\Style\Image::POSITION_RELATIVE_TO_LINE,
			    )
			);











$seccion->addTextBreak(6);
$seccion->addTextBreak(2,array('size' => 5));	


// Notas //Aqui reviso Eduardo la Ultima vez

$seccion->addText(htmlspecialchars("NOTAS"), $fontStyleNegrita,array('align' => 'left','spaceBefore' => 20,'spaceAfter' => 20));


$arrayNotas1 = array();
$formatNotas = array('size'=>'8','bold' => false, 'align' => 'center');


require_once("word/Notas1.php");

for($c=0;$c<count($arrayNotas1);$c++)
{
	$seccion->addText(htmlspecialchars($arrayNotas1[$c]), $formatNotas,array('align' => 'left','spaceBefore' => 20,'spaceAfter' => 20));	
}

$seccion->addPageBreak();

/////////////////////////////////////////////////////////////////////////////////////////// Pagina 3
if($IdTipo!=15) // Si no es planta casera
{
		$seccion->addTextBreak(1);
		$table = $seccion->addTable();
		$table->addRow();

		if($PK)
		{
			$table->addCell(15000,$cellTit)->addText(htmlspecialchars('DIAGRAMA DE INSTALACIÓN'), $TextTit,array('align' => 'center','spaceBefore' => 200,'spaceAfter' => 120));	
		}else
		{
			$table->addCell(15000,$cellTit)->addText(htmlspecialchars("PLANO SERIE $ModeloPTAR (TIPO)"), $TextTit,array('align' => 'center','spaceBefore' => 200,'spaceAfter' => 120));	
		}
	

		if(!$PK)
		{
			$seccion->addTextBreak(1);
			$formatSubtitPlanos = array('size'=>'10','bold' => true, 'align' => 'left');
			$seccion->addText(htmlspecialchars("REPRESENTACIÓN ARQUITECTONICA Y DIMENSIONES GENERALES"), $formatSubtitPlanos,array('align' => 'left','spaceBefore' => 20,'spaceAfter' => 20));
		}
		// Imagen Plano Planta
		$seccion->addTextBreak(1);
		if($PK)
		{
			$seccion->addImage(
			    'imagenes/pk/inoxidable_superficial_bombeo.jpg',
			    array(
			        'positioning'   => 'relative',
			        'marginTop'     => 0,
			        'marginLeft'    => 800,
			        'width'         => 685,
			        'height'        => 490,
			        'wrappingStyle' => 'tight'
			    )
		    );
		}else
		{
			if($IdModelo==1) //Selector PK
			{				
				$seccion->addImage(
			    'imagenes/planoSelector.jpg',
			    array(
			        'width'            => \PhpOffice\PhpWord\Shared\Converter::cmToPixel(8),
			        'height'           => \PhpOffice\PhpWord\Shared\Converter::cmToPixel(10),
			        'positioning'      => \PhpOffice\PhpWord\Style\Image::POSITION_RELATIVE,
			        'posHorizontal'    => \PhpOffice\PhpWord\Style\Image::POSITION_HORIZONTAL_RIGHT,
			        'posHorizontalRel' => \PhpOffice\PhpWord\Style\Image::POSITION_RELATIVE_TO_COLUMN,
			        'posVertical'      => \PhpOffice\PhpWord\Style\Image::POSITION_VERTICAL_TOP,
			        'posVerticalRel'   => \PhpOffice\PhpWord\Style\Image::POSITION_RELATIVE_TO_LINE,
			        )
			    );

			}else
			{

				$seccion->addImage(
			    'imagenes/planoUrbana.jpg',
			    array(
			        'width'            => \PhpOffice\PhpWord\Shared\Converter::cmToPixel(9),
			        'height'           => \PhpOffice\PhpWord\Shared\Converter::cmToPixel(10),
			        'positioning'      => \PhpOffice\PhpWord\Style\Image::POSITION_RELATIVE,
			        'posHorizontal'    => \PhpOffice\PhpWord\Style\Image::POSITION_HORIZONTAL_RIGHT,
			        'posHorizontalRel' => \PhpOffice\PhpWord\Style\Image::POSITION_RELATIVE_TO_COLUMN,
			        'posVertical'      => \PhpOffice\PhpWord\Style\Image::POSITION_VERTICAL_TOP,
			        'posVerticalRel'   => \PhpOffice\PhpWord\Style\Image::POSITION_RELATIVE_TO_LINE,
			        )
			    );

			}
		}


		if(!$PK)
		{
			// Tabla dimensiones
			$table = $seccion->addTable();
			$table->addRow();

			

			$tablaDimensiones = array('borderSize' => 4, 'borderColor' => '777777');


			$cellColSpanTitTablaDim = array('gridSpan' => 2, 'valign' => 'bottom', 'bgColor' => 'ffffff','borderSize' => 4, 'borderColor' => '777777');			

			$formatTextTablaDim = array('size' => 10,'bold' => true, 'align' => 'center','color' => '333333');

			$table->addCell(4500,$cellColSpanTitTablaDim)->addText(htmlspecialchars(' DIMENSIONES GENERALES'), $TextSubTitTabla,array('align' => 'left','spaceBefore' => 0,'spaceAfter' => 20));
			$table->addRow();
			$table->addCell(1500,$tablaDimensiones)->addText(htmlspecialchars(' Ancho'), $formatTextTablaDim ,array('align' => 'left','spaceBefore' => 50,'spaceAfter' => 20));
			$table->addCell(3000,$tablaDimensiones)->addText(htmlspecialchars(" $AnchoPlanta mts"), $formatTextTablaDim ,array('align' => 'left','spaceBefore' => 50,'spaceAfter' => 20));







			$table->addRow();
			$table->addCell(1500,$tablaDimensiones)->addText(htmlspecialchars(' Largo'), $formatTextTablaDim ,array('align' => 'left','spaceBefore' => 50,'spaceAfter' => 20));
			$table->addCell(3000,$tablaDimensiones)->addText(htmlspecialchars(" $LargoPlanta mts"), $formatTextTablaDim ,array('align' => 'left','spaceBefore' => 50,'spaceAfter' => 20));

			$table->addRow();
			$table->addCell(1500,$tablaDimensiones)->addText(htmlspecialchars(' Altura'), $formatTextTablaDim ,array('align' => 'left','spaceBefore' => 50,'spaceAfter' => 20));
			$table->addCell(3000,$tablaDimensiones)->addText(htmlspecialchars(" $AltoPlanta mts"), $formatTextTablaDim ,array('align' => 'left','spaceBefore' => 50,'spaceAfter' => 20));


			// Imagen obra tipica
			$seccion->addTextBreak(11);


			$seccion->addText(htmlspecialchars("FOTOGRAFÍA DE OBRA TIPICA"), $formatSubtitPlanos,array('align' => 'center','spaceBefore' => 20,'spaceAfter' => 20));
			$seccion->addTextBreak(1);

			$seccion->addImage(
			    'imagenes/selectorObra.jpg',
			    array(
			        'width'            => \PhpOffice\PhpWord\Shared\Converter::cmToPixel(9),
			        'height'           => \PhpOffice\PhpWord\Shared\Converter::cmToPixel(5),
			        'positioning'      => \PhpOffice\PhpWord\Style\Image::POSITION_RELATIVE,
			        'posHorizontal'    => \PhpOffice\PhpWord\Style\Image::POSITION_HORIZONTAL_CENTER,
			        'posHorizontalRel' => \PhpOffice\PhpWord\Style\Image::POSITION_RELATIVE_TO_COLUMN,
			        'posVertical'      => \PhpOffice\PhpWord\Style\Image::POSITION_VERTICAL_TOP,
			        'posVerticalRel'   => \PhpOffice\PhpWord\Style\Image::POSITION_RELATIVE_TO_LINE,
			    )
			);
		}


		$seccion->addPageBreak();
}

////////////////////////////////////////////////////////////////////////////////////////// Pagina 4 planta PK

if($PK and $IdTipo!=15)
{
	$seccion->addTextBreak(4);
	$seccion->addImage(
	    'imagenes/pk/obra_terminada.jpg',
	    array(
	        'positioning'   => 'relative',
	        'marginTop'     => 0,
	        'marginLeft'    => 0,
	        'width'         => 685,
	        'height'        => 600,
	        'wrappingStyle' => 'tight'
	    )
    );
    $seccion->addPageBreak();
    
}









/////////////////////////////////////////////////////////////////////////////////////////// Pagina 4
$seccion->addTextBreak(1,null,$paragraphStyle);

$table = $seccion->addTable(array('cellMargin' => 0,'spaceBefore' => 0,'spaceAfter' => 0,'spacing' => 0));
	
$table->addRow();


$table->addCell(15000,$cellSubTit)->addText(htmlspecialchars(' PROPUESTA ECONÓMICA'), $TextSubTit,array('align' => 'left','spaceBefore' => 200,'spaceAfter' => 120));

$seccion->addTextBreak(1,null,$paragraphStyle);
$formatTitPartidas = array('size'=>'10','bold' => true, 'align' => 'left');
$seccion->addText(htmlspecialchars("PLANTA SERIE $ModeloPTAR MODELO $ModeloLPS"), $formatTitPartidas,array('align' => 'left','spaceBefore' => 20,'spaceAfter' => 20));

$seccion->addTextBreak(1,null,$paragraphStyle);


// Tabla partidas planta
$table = $seccion->addTable();
$table->addRow();


//$cellTit = array('bgColor' => '1E88E5 ','gridSpan' => 2, 'valign' => 'center');

$cellPartidas = array('borderSize' => 4, 'borderRightColor' => '333333','bgColor' => '1E88E5 ');
$cellInfoAd = array('borderTopSize' => 0, 'borderTopColor' => 'FFFFFF');

//$cellHead = array('borderBottomSize' => 8, 'borderBottomColor' => '1E88E5');

$fontStyleTablaTit = array('name' => 'Calibri','size' => 9, 'bold' => true, 'color' => 'FFFFFF','valign' => 'left');
$table->addCell(10000,$cellPartidas)->addText(htmlspecialchars('CONCEPTO'), $fontStyleTablaTit,array('align' => 'center','spaceBefore' => 100,'spaceAfter' => 30));
$table->addCell(1000,$cellPartidas)->addText(htmlspecialchars('CANT.'), $fontStyleTablaTit,array('align' => 'center','spaceBefore' => 100,'spaceAfter' => 30));
$table->addCell(2000,$cellPartidas)->addText(htmlspecialchars('PRECIO'), $fontStyleTablaTit,array('align' => 'center','spaceBefore' => 100,'spaceAfter' => 30));
$table->addCell(2000,$cellPartidas)->addText(htmlspecialchars('TOTAL'), $fontStyleTablaTit,array('align' => 'center','spaceBefore' => 100,'spaceAfter' => 30));



//////// Utilidad
$utilidad = 1+($_SESSION['Utilidad']/100);
$tipoUtilidad = $_SESSION['TipoUtilidad'];

$equipSubtotal = 0;
$Subtotal = 0;

// Este calculo es util para cuando la utilidad solo va para el equipamiento.
for($c=0;$c<count($_SESSION['PTARPartidas']);$c++)
{
	if($_SESSION['PTARPartidas'][$c+1]['label']=="empl" or $_SESSION['PTARPartidas'][$c+1]['label']=="empr")
	{		
		$equipSubtotal = $equipSubtotal+($_SESSION['PTARPartidas'][$c+1]['CUnitario']*$_SESSION['PTARPartidas'][$c+1]['Cantidad']);
	}
	$Subtotal = ($Subtotal+ ($_SESSION['PTARPartidas'][$c+1]['CUnitario']*$_SESSION['PTARPartidas'][$c+1]['Cantidad']));
}

$utilidadTotal = $Subtotal * ($_SESSION['Utilidad']/100);
// Aqui finaliza bloque



// Tabla 1
$SubtotalConUtil = 0;
$crearTablaUlustrativa = false;
$crearNotaPr = flase;
$costoCarcamoNota = 0;
for($c=0;$c<count($_SESSION['PTARPartidas']);$c++)
{
	// Simplificacion de variables
	$desc = $_SESSION['PTARPartidas'][$c+1]['Descripcion'];
	$infoAd = $_SESSION['PTARPartidas'][$c+1]['InfoAdicional'];
	$cant = $_SESSION['PTARPartidas'][$c+1]['Cantidad'];
	$CU = $_SESSION['PTARPartidas'][$c+1]['CUnitario'];
	$label = $_SESSION['PTARPartidas'][$c+1]['label'];

	// Si esto sucede no se crea la partida	
	
	if($IdTipo==2 && $_SESSION['lustrativa']==1 && ($label=="ocpl" || $label=="ocpr"))	
	{
		$crearTablaUlustrativa = true;
	}else
	{
		if($tipoUtilidad==0) // Si la utilidad es pareja
		{
			$CU = $CU * $utilidad; 
		}
		$Total = $CU * $cant;	
		if($tipoUtilidad==1 and ($label == "empl" or $label == "empr")) // Si la utilidad total es solo para el equipamiento y la partida en cuestion es equipamiento
		{
			$proporcion = ($CU * $cant)/$equipSubtotal; // Parte proporcional del total de la partida con respecto al total de las partidas correspondientes al equipamiento
			$Total = ($CU*$cant) + ($proporcion*$utilidadTotal);
			$CU = $Total/$cant;
		}
		if($_SESSION['NotaPartida']==0 && $label=="empr"  && $IdTipo!=2)
		{
			$crearNotaPr = true;
			$costoCarcamoNota = $CU;
		}else
		{
			$table = $seccion->addTable();
			$table->addRow();

			// Utilidad al costo unitario y al importe			
			if($infoAd=="") // Si existe informacion adicional
			{	
				$cellPartidas['borderBottomSize'] = 1;
				$cellPartidas['borderBottomColor'] = '333333';			
				
			}else
			{
				$cellPartidas['borderBottomSize'] = 0;
				$cellPartidas['borderBottomColor'] = 'FFFFFF';		
			}

			$SubtotalConUtil = $SubtotalConUtil + $Total;

			
			$cellPartidas = array('borderSize' => 4, 'borderRightColor' => '333333','bgColor' => 'FFFF','borderBottomColor' => 'FFFFFF');		
			$table->addCell(10000,$cellPartidas)->addText(htmlspecialchars($desc), $fontStyleNegrita,array('align' => 'left','spaceBefore' => 100,'spaceAfter' => 30));
			$table->addCell(1000,$cellPartidas)->addText(htmlspecialchars($cant), $fontStyleParrafo,array('align' => 'center','spaceBefore' => 100,'spaceAfter' => 30));
			$table->addCell(2000,$cellPartidas)->addText(htmlspecialchars("$ ".number_format($CU)."   "), $fontStyleParrafo,array('align' => 'right','spaceBefore' => 100,'spaceAfter' => 30));
			$table->addCell(2000,$cellPartidas)->addText(htmlspecialchars("$ ".number_format($Total)."   "), $fontStyleParrafo,array('align' => 'right','spaceBefore' => 100,'spaceAfter' => 30));

			if($infoAd!="") // Si existe informacion adicional
			{				
				$cellConcepInfoAd = array('borderSize' => 4,'borderTopColor' => 'FFFFFF','borderTopSize'=>0);
				$table->addRow();
				$table->addCell(10000,$cellConcepInfoAd)->addText(htmlspecialchars($infoAd), $fontStyleParrafo,array('align' => 'left','spaceBefore' => 100,'spaceAfter' => 30));
				$table->addCell(1000,$cellConcepInfoAd)->addText(htmlspecialchars(""), $fontStyleParrafo,array('align' => 'center','spaceBefore' => 100,'spaceAfter' => 30));
				$table->addCell(2000,$cellConcepInfoAd)->addText(htmlspecialchars(""), $fontStyleParrafo,array('align' => 'right','spaceBefore' => 100,'spaceAfter' => 30));
				$table->addCell(2000,$cellConcepInfoAd)->addText(htmlspecialchars(""), $fontStyleParrafo,array('align' => 'right','spaceBefore' => 100,'spaceAfter' => 30));
			}
		}		
	}
}

$table = $seccion->addTable();
$table->addRow();


$cellPrimeraFila = array('borderSize' => 4, 'borderRightColor' => '333333');
$cellVaciaCol2 = array('marginRight' => 200, 'gridSpan' => 2, 'borderSize' => 4, 'borderRightColor' => '333333');

$table->addCell(10650,$cellVaciaCol2)->addText(htmlspecialchars(''), $TextSubTitTabla,array('align' => 'center','spaceBefore' => 100,'spaceAfter' => 30));
$table->addCell(2000,$cellPrimeraFila)->addText(htmlspecialchars('TOTAL'), $fontStyleNegrita,array('align' => 'center','spaceBefore' => 100,'spaceAfter' => 30));
$table->addCell(2000,$cellPrimeraFila)->addText(htmlspecialchars("$ ".number_format($SubtotalConUtil)), $fontStyleNegrita,array('align' => 'right','spaceBefore' => 100,'spaceAfter' => 30));



// Tabla 2 cuando es ilustrativa la obra civil en las plantas de concreto
if($crearTablaUlustrativa)
{
	$seccion->addTextBreak(1,array('size' => 2));
	$txtIlus = "OBRA CIVIL PLANTA EMESA SERIE $ModeloPTAR DE $lps L.P.S (*Solo ilustrativo)";	
	$seccion->addText(htmlspecialchars($txtIlus), $formatSubtitPlanos,array('align' => 'left','spaceBefore' => 20,'spaceAfter' => 20));
	$seccion->addTextBreak(1,array('size' => 2));


	// Tabla partidas plantas
	$table = $seccion->addTable();
	$table->addRow();

	

	$cellPartidas = array('borderSize' => 4, 'borderRightColor' => '333333','bgColor' => '1E88E5 ');
	$table->addCell(10000,$cellPartidas)->addText(htmlspecialchars('CONCEPTO'), $fontStyleTablaTit,array('align' => 'center','spaceBefore' => 100,'spaceAfter' => 30));
	$table->addCell(1000,$cellPartidas)->addText(htmlspecialchars('CANT.'), $fontStyleTablaTit,array('align' => 'center','spaceBefore' => 100,'spaceAfter' => 30));
	$table->addCell(2000,$cellPartidas)->addText(htmlspecialchars('PRECIO'), $fontStyleTablaTit,array('align' => 'center','spaceBefore' => 100,'spaceAfter' => 30));
	$table->addCell(2000,$cellPartidas)->addText(htmlspecialchars('TOTAL'), $fontStyleTablaTit,array('align' => 'center','spaceBefore' => 100,'spaceAfter' => 30));


	for($c=0;$c<count($_SESSION['PTARPartidas']);$c++)
	{
		// Simplificacion de variables
		$desc = $_SESSION['PTARPartidas'][$c+1]['Descripcion'];
		$infoAd = $_SESSION['PTARPartidas'][$c+1]['InfoAdicional'];
		$cant = $_SESSION['PTARPartidas'][$c+1]['Cantidad'];
		$CU = $_SESSION['PTARPartidas'][$c+1]['CUnitario'];
		$label = $_SESSION['PTARPartidas'][$c+1]['label'];
	
		if($IdTipo==2 && $_SESSION['lustrativa']==1 && ($label=="ocpl" || $label=="ocpr"))	
		{				
			$table = $seccion->addTable();
			$table->addRow();


			// Utilidad al costo unitario y al importe
			if($tipoUtilidad==0) // Si la utilidad es pareja
			{
				$CU = $CU * $utilidad; 
			}
			$Total = $CU * $cant;	
			if($tipoUtilidad==1 and ($label == "empl" or $label == "empr")) // Si la utilidad total es solo para el equipamiento y la partida en cuestion es equipamiento
			{
				$proporcion = ($CU * $cant)/$equipSubtotal; // Parte proporcional del total de la partida con respecto al total de las partidas correspondientes al equipamiento
				$Total = ($CU*$cant) + ($proporcion*$utilidadTotal);

				$CU = $Total/$cant;
			}


			if($infoAd=="") // Si existe informacion adicional
			{	
				$cellPartidas['borderBottomSize'] = 1;
				$cellPartidas['borderBottomColor'] = '333333';			
				
			}else
			{
				$cellPartidas['borderBottomSize'] = 0;
				$cellPartidas['borderBottomColor'] = 'FFFFFF';		
			}


			$cellPartidas = array('borderSize' => 4, 'borderRightColor' => '333333','bgColor' => 'FFFF','borderBottomColor' => 'FFFFFF');		
			$table->addCell(10000,$cellPartidas)->addText(htmlspecialchars($desc), $fontStyleNegrita,array('align' => 'left','spaceBefore' => 100,'spaceAfter' => 30));
			$table->addCell(1000,$cellPartidas)->addText(htmlspecialchars($cant), $fontStyleParrafo,array('align' => 'center','spaceBefore' => 100,'spaceAfter' => 30));
			$table->addCell(2000,$cellPartidas)->addText(htmlspecialchars("$ ".number_format($CU)."   "), $fontStyleParrafo,array('align' => 'right','spaceBefore' => 100,'spaceAfter' => 30));
			$table->addCell(2000,$cellPartidas)->addText(htmlspecialchars("$ ".number_format($Total)."   "), $fontStyleParrafo,array('align' => 'right','spaceBefore' => 100,'spaceAfter' => 30));

			if($infoAd!="") // Si existe informacion adicional
			{

				//$cellConcepInfoAd = array('borderLeftColor' => '333333','borderLeftSize'=>1,'borderRightColor' => '333333','borderRightSize'=>1);
				$cellConcepInfoAd = array('borderSize' => 0,'borderTopColor' => 'FFFFFF','borderTopSize'=>0);

				$table->addRow();
				$table->addCell(10000,$cellConcepInfoAd)->addText(htmlspecialchars($infoAd), $fontStyleParrafo,array('align' => 'left','spaceBefore' => 100,'spaceAfter' => 30));
				$table->addCell(1000,$cellConcepInfoAd)->addText(htmlspecialchars(""), $fontStyleParrafo,array('align' => 'center','spaceBefore' => 100,'spaceAfter' => 30));
				$table->addCell(2000,$cellConcepInfoAd)->addText(htmlspecialchars(""), $fontStyleParrafo,array('align' => 'right','spaceBefore' => 100,'spaceAfter' => 30));
				$table->addCell(2000,$cellConcepInfoAd)->addText(htmlspecialchars(""), $fontStyleParrafo,array('align' => 'right','spaceBefore' => 100,'spaceAfter' => 30));
			}		
			
		}
	}




}

$seccion->addTextBreak(1,null,$paragraphStyle);

$seccion->addText(htmlspecialchars("NOTAS"), $fontStyleNegrita,array('align' => 'left','spaceBefore' => 20,'spaceAfter' => 20));






require_once("word/Notas2.php");

for($c=0;$c<count($arrayNotas2);$c++)
{
	$seccion->addText(htmlspecialchars($arrayNotas2[$c]), $formatNotas2,array('align' => 'left','spaceBefore' => 20,'spaceAfter' => 20));	
}
$seccion->addPageBreak();

//////////////////////////////////////////////////////////////////////////////////////// Pagina 4 (incluye no incluye)
$seccion->addTextBreak(1,null,$paragraphStyle);
if($IdTipo!=15)
{
	$seccion->addText(htmlspecialchars("LA PROPUESTA INCLUYE:"), $fontStyleNegrita,array('align' => 'left','spaceBefore' => 20,'spaceAfter' => 20));	

	require_once("word/Incluye.php");
	$texto = parrafoIncluye();
	$seccion->addText(htmlspecialchars($texto), $fontStyleParrafo,array('align' => 'left','spaceBefore' => 20,'spaceAfter' => 20));


	// Lista incluye
	if($_SESSION['PTARPropiedades']['IdModelo']==1 and $IdTipo==2) // Si es selector obra civil
	{
		$seccion->addTextBreak(1,null,$paragraphStyle);
		$seccion->addText(htmlspecialchars("El equipo de línea de una planta de la serie $ModeloPTAR es:"), $fontStyleNegrita,array('align' => 'left','spaceBefore' => 20,'spaceAfter' => 20));	
	}

		

	for($c=0;$c<=count($_SESSION['PTARIncluye']);$c++)
	{
		if($_SESSION['PTARIncluye'][$c]['Activa'])
		{
			$seccion->addText(htmlspecialchars("- ".$_SESSION['PTARIncluye'][$c]['Concepto']), $fontStyleParrafo,array('align' => 'left','spaceBefore' => 20,'spaceAfter' => 20));
		}
	}
}


// Lista entrega
if($_SESSION['PTARPropiedades']['IdModelo']==1 and $IdTipo==2) // Si es selector obra civil
{

	$seccion->addTextBreak(1,null,$paragraphStyle);
	$seccion->addText(htmlspecialchars("Para la entrega de la planta se proporcionan:"), $fontStyleNegrita,array('align' => 'left','spaceBefore' => 20,'spaceAfter' => 20));	

	for($c=0;$c<=count($_SESSION['PTAREntregar']);$c++)
	{
		if($_SESSION['PTAREntregar'][$c]['Activa'])
		{
			$seccion->addText(htmlspecialchars("- ".$_SESSION['PTAREntregar'][$c]['Concepto']), $fontStyleParrafo,array('align' => 'left','spaceBefore' => 20,'spaceAfter' => 20));
		}
	}	

}

if($IdTipo==2)
{
	$seccion->addTextBreak(1,null,$paragraphStyle);
	$texto = "Previo al arranque de la planta, el cliente deberá designar a personal calificado que será capacitado por nuestros técnicos para la operación de la planta.";
	$seccion->addText(htmlspecialchars($texto), $fontStyleNegrita,array('align' => 'left','spaceBefore' => 20,'spaceAfter' => 20));
}


// Lista No incluye
$seccion->addTextBreak(1,null,$paragraphStyle);
$seccion->addText(htmlspecialchars("ESTA PROPUESTA NO INCLUYE:"), $fontStyleNegrita,array('align' => 'left','spaceBefore' => 20,'spaceAfter' => 20));	
$seccion->addText(htmlspecialchars("Obras complementarias como son:"), $fontStyleParrafo,array('align' => 'left','spaceBefore' => 20,'spaceAfter' => 20));	

for($c=0;$c<=count($_SESSION['PTARNoIncluye']);$c++)
{
	if($_SESSION['PTARNoIncluye'][$c]['Activa'])
	{
		$seccion->addText(htmlspecialchars("- ".$_SESSION['PTARNoIncluye'][$c]['Concepto']), $fontStyleParrafo,array('align' => 'left','spaceBefore' => 20,'spaceAfter' => 20));
	}
}





if($IdTipo==2)
{
	$seccion->addPageBreak();
	///////////////////////////////////////////////////////////////////////////// Pagina 5
}

// Tiempo de entrega
$seccion->addTextBreak(1,null,$paragraphStyle);
$seccion->addText(htmlspecialchars("TIEMPO DE ENTREGA"), $fontStyleNegrita,array('align' => 'left','spaceBefore' => 20,'spaceAfter' => 100));	



$TextSubTitTablaGraf = $fontStyleParrafo;

$TextSubTitTablaGraf['size'] = 8;
$TextSubTitTablaGraf['bold'] = true;



$cellConcepto = array('borderSize' => 4, 'borderColor' => 'AAAAAA');


if($IdTipo==2)
{
	$table = $seccion->addTable();
	$table->addRow();

	$table->addCell(15000,$cellConcepto)->addText(htmlspecialchars('CONCEPTO'), $fontStyleNegrita,array('align' => 'center','spaceBefore' => 100,'spaceAfter' => 30));
	$cellColSpanTitTabla = array('gridSpan' => 15, 'valign' => 'bottom', 'bgColor' => 'ffffff','borderSize' => 4, 'borderColor' => 'AAAAAA');	
	$table->addCell(10000,$cellColSpanTitTabla)->addText(htmlspecialchars('QUINCENAS'), $fontStyleNegrita,array('align' => 'center','spaceBefore' => 0,'spaceAfter' => 20));

	for($c=0;$c<count($_SESSION['PTARGrafica']);$c++)
	{

		$table = $seccion->addTable();
		$table->addRow();
		$concepto = "  ".$_SESSION['PTARGrafica'][$c+1]['concepto'];
		$table->addCell(15000,$cellConcepto)->addText(htmlspecialchars($concepto),$TextSubTitTablaGraf ,array('align' => 'left','spaceBefore' => 100,'spaceAfter' => 30));

		$inicio = $_SESSION['PTARGrafica'][$c+1]['inicio'];
		$duracion = $_SESSION['PTARGrafica'][$c+1]['duracion'];

		
		
		for($c2=0;$c2<15;$c2++)
		{
			$cellQuincena = array('borderSize' => 4,'bgColor' => 'FFFFFF','borderColor' => 'AAAAAA');
			if($c2+1>=$inicio and $c2+1<$duracion+$inicio)
			{
				$cellQuincena['bgColor'] = '1E88E5';
			}
			$table->addCell(1000,$cellQuincena)->addText(htmlspecialchars(""), $TextSubTitTabla,array('align' => 'center','spaceBefore' => 100,'spaceAfter' => 30));

		}

	}

}
else
{	
	switch ($Capacidad) 
	{
	    case ($Capacidad <= .15):
	       $textoTE = 'De 6 a 8 semanas a partir de que el cliente entrega losa de cimentación.';
	        break;
	    case ($Capacidad > .15 and $Capacidad <= .35):
	        $textoTE = 'De 8 a 10 semanas a partir de que el cliente entrega losa de cimentación.';
	        break;
	    case ($Capacidad > .35 and $Capacidad <= 1.75):
	        $textoTE = 'De 10 a 12 semanas a partir de que el cliente entrega losa de cimentación.';
	        break;
	    case ($Capacidad > 1.75 ):
	        $textoTE = 'De 12 a 14 semanas a partir de que el cliente entrega losa de cimentación.';
	        break;
	}

	$seccion->addText(htmlspecialchars($textoTE), $fontStyleNegrita,array('align' => 'left','spaceBefore' => 20,'spaceAfter' => 20));	
}

// Condiciones de pago
$seccion->addTextBreak(1,null,$paragraphStyle);
$seccion->addText(htmlspecialchars("CONDICIONES DE PAGO"), $fontStyleNegrita,array('align' => 'left','spaceBefore' => 20,'spaceAfter' => 100));


$CondicionesPago = array();
if($IdTipo==2)
{
	$CondicionesPago[]="ANTICIPO 60%";
	$CondicionesPago[]="Habilitado de acero 7.5%";
	$CondicionesPago[]="1er colado (cimentación y muros a 1m) 7.5%";
	$CondicionesPago[]="2o colado (muros a 3m) 7.5%";
	$CondicionesPago[]="3er colado (pasillos) 5.0%";
	$CondicionesPago[]="Aviso de embarque de los equipos 5.0%";
	$CondicionesPago[]="Instalación 5.0%";
	$CondicionesPago[]="Arranque 2.5%";
}else
{
	$CondicionesPago[]="ANTICIPO: 70%. (En caso de requerir anteproyecto para aprobación o licencia se solicitará un 10% adelantado, restando el 60% para el inicio del proyecto)";
	$CondicionesPago[]="25 % Contra aviso de embarque";
	$CondicionesPago[]="5% Contra instalación.";
}
	
for($cp=0;$cp<count($CondicionesPago);$cp++)
{
	$seccion->addTextBreak(0,null,$paragraphStyle); 
	$seccion->addText(htmlspecialchars("» ".$CondicionesPago[$cp]), $fontStyleFecha,array('align' => 'left','spaceBefore' => 20,'spaceAfter' => 20));	
}




//Guardando documento
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($documento, 'Word2007');

$objWriter->save("$NoCot.docx");
header("Content-Disposition: attachment; filename='$NoCot.docx'");
echo file_get_contents("$NoCot.docx");



?>