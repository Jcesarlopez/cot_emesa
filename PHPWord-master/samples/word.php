<?php 

require_once dirname(__FILE__).'/PHPWord-master/src/PhpWord/Autoloader.php';
\PhpOffice\PhpWord\Autoloader::register();

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Style\Font;

//Instancia phpWord.
$documento = new PhpWord();

// Nueva seccion
$seccion = $documento->addSection();


// New portrait section
$header = $seccion->addHeader();


$table = $header->addTable();
$table->addRow();
$table->addCell(4500)->addImage('imagenes/logocot.jpg',array('width' => 200, 'height' => 85, 'align' => 'left'));


$formatNoCot = array('bold' => true, 'align' => 'center');
$table->addCell(4500)->addText(htmlspecialchars('COTIZACION No.: 88525'), $formatNoCot,array('align' => 'right'));


// Linea azul
$table->addRow();
$cellColSpan = array('gridSpan' => 2, 'valign' => 'top');
$fontStyle = array('bold' => false, 'align' => 'right');
$fontStyleFecha = array('bold' => false, 'align' => 'right');



$table->addCell(4500,$cellColSpan)->addImage('imagenes/linea.jpg',array('width' => 700, 'height' => 3, 'align' => 'left'));

//Fecha
$seccion->addTextBreak(1);
$seccion->addText(htmlspecialchars('Cuernavaca Morelos a 25 de abril de 2017'), $fontStyleFecha,array('align' => 'right'));


$seccion->addTextBreak(1);
$seccion->addText(htmlspecialchars('Nombre del cliente'), $fontStyleFecha,array('align' => 'left'));

$paragraphStyle = array('spacing' => 100, 'size' => 1);
$seccion->addTextBreak(0,null,$paragraphStyle); // Direccion
$seccion->addText(htmlspecialchars('Direccion del cliente'), $fontStyleFecha,array('align' => 'left'));

$seccion->addTextBreak(0,null,$paragraphStyle); // Ciudad, estado
$seccion->addText(htmlspecialchars('Ciudad, Estado'), $fontStyleFecha,array('align' => 'left'));


$seccion->addTextBreak(0,null,$paragraphStyle); // Pais
$seccion->addText(htmlspecialchars('Pais'), $fontStyleFecha,array('align' => 'left'));



$seccion->addTextBreak(0,null,$paragraphStyle); // Atencion
$seccion->addText(htmlspecialchars("AT'N: ATENCION CLIENTE"), $fontStyleFecha,array('align' => 'right'));




$table = $seccion->addTable();
$table->addRow();

$cellTit = array('gridSpan' => 2, 'valign' => 'center');
$cellTit2 = array('valign' => 'center');
$table->addCell(9000,$cellTit)->addText(htmlspecialchars('PLANTA DE TRATAMIENTO DE AGUAS NEGRAS'), $cellTit2,array('align' => 'center'));



// Parrafo1 Hoja1
$texto="A su solicitud y tomando en cuenta los datos y requerimientos proporcionados por usted, en la presente haga favor de encontrar nuestra propuesta técnica y económica para la proyección, construcción, equipamiento y puesta en marcha de una Planta de Tratamiento de Aguas negra en: SS  ";
$seccion->addTextBreak(1,null,$paragraphStyle); 
$seccion->addText(htmlspecialchars($texto), $fontStyleFecha,array('align' => 'left'));


// Parrafo2 Hoja1
$texto="Considerando que el agua tratada será utilizada en Servicios al Público, y que por lo mismo deberá cumplir con la Norma Oficial Mexicana NOM-003-SEMARNAT-1997, para la elaboración de esta propuesta hemos seleccionado una PLANTA SERIE SELECTOR MODELO 1100, con capacidad de 11.000 l.p.s. (950.40 metros cúbicos por día)";

$seccion->addTextBreak(1,null,$paragraphStyle); // Atencion
$seccion->addText(htmlspecialchars($texto), $fontStyleFecha,array('align' => 'left'));


// Parrafo2 Hoja1
$texto="Proponemos el uso de la nuestra tecnología, proceso mejorado de lodos activados (aerobio) en la modalidad de aireación extendida, bajo un sistema secuencial que permite la oxidación total, y que aunado a su sencillez, versatilidad y confiabilidad ha permitido que actualmente se traten con nuestras plantas más de 100 millones de litros de agua por día en México, debido a las ventajas que representa, tales como:";

$seccion->addTextBreak(1,null,$paragraphStyle); // Atencion
$seccion->addText(htmlspecialchars($texto), $fontStyleFecha,array('align' => 'left'));












//$table->addRow();

//$unicoHead->addImage('imagenes/logocot.jpg', array('width'=> 250,'height'=> 106,'marginTop'=> 5,'marginLeft'=> -1,'wrappingStyle' => 'inline'));
//$unicoHead->addText(htmlspecialchars('Subsequent pages in Section 1 will Have this!'));












































//Guardando documento
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($documento, 'Word2007');
$objWriter->save('Documento01.docx');

header("Content-Disposition: attachment; filename='Documento01.docx'");
echo file_get_contents('Documento01.docx');



?>
