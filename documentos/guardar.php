<?
	session_start();
	require ($_SESSION["rutaFileXajax"]);
	$xajax = new xajax(); 
	$xajax->registerFunction("grabarhtml");
	$xajax->processRequests();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?
	$xajax->printJavascript($_SESSION["rutaDirXajax"]);
?>
<head>
<object id="factory" style="display:none"  classid="clsid:1663ed61-23eb-11d2-b92f-008048fdd814"
  codebase="http://www.emesa.com.mx/_iessus/cgi-bin/smsx.cab#Version=6,6,440,26">
</object>
<script type="text/javascript">
	function printWindow() {
	factory.printing.header = "";
	factory.printing.footer = "Tabachin # 78 Col. Bellavista, Cuernavaca Morelos, Tel�fonos: (777) 3130227, emesa@emesa.com.mx, www.emesa.com.mx";
	factory.printing.portrait = true;
	factory.printing.leftMargin = 0;
	factory.printing.topMargin = 0;
	factory.printing.rightMargin = 0;
	factory.printing.bottomMargin = 1;
	factory.printing.Print(true); //<------------------------------------ este para que esss
	factory.printing.printer = "Adobe PDF";
}
</script>
<body onload="xajax_grabarhtml();" marginheight="0">
<?
$_POST = stripslashses_gpc($_POST);
$HTML=$_POST['editor'];
$CotNum=$_SESSION['Cotizacion']['CotNum'];
$_SESSION['HTML']=$HTML; 
function stripslashses_gpc($buffer){
 if(!function_exists('get_magic_quotes_gpc'))
  return $buffer;
 if(get_magic_quotes_gpc()){
  if(is_array($buffer)){
   foreach($buffer as $variable => $valor){
    $temp[$variable] = stripslashses_gpc($valor);
   }
   return $temp;
  }else{
   return stripslashes($buffer);
  }
 }else{
  return $buffer;
 }
}
$HTML=stripslashses_gpc($_POST['editor']);
function grabarhtml()
{
	$respuesta = new xajaxResponse('ISO-8859-1');
	include("../conexion.php");
	$HTML=$_SESSION['HTML'];
	$CotNum=$_SESSION['Cotizacion']['CotNum'];
	$Tipo=$_SESSION['cotizacion']['Tipo']; 
	$Serie=$_SESSION['cotizacion']['Serie'];
		
	$datoscap = "SELECT * FROM cotizaciones_html WHERE IdCotizacion=".$CotNum ;
	$querycap = mysql_db_query("emesa_sap",$datoscap) or die (mysql_error());
	if  (mysql_num_rows($querycap)==1)
	{
		mysql_db_query("emesa_sap","UPDATE cotizaciones_html SET HTML='$HTML' WHERE IdCotizacion='$CotNum'");
		mysql_db_query("emesa_sap","UPDATE cotizaciones_html SET Serie='$Serie' WHERE IdCotizacion='$CotNum'");
		mysql_db_query("emesa_sap","UPDATE cotizaciones_html SET Tipo='$Tipo' WHERE IdCotizacion='$CotNum'");
	}else
	{
		mysql_db_query("emesa_sap","insert into cotizaciones_html(IdCotizacion,HTML,Serie,Tipo) 
		VALUES ('$CotNum','$HTML','$Serie','$Tipo')")or die
		('Ha ocurrido un error al intentar grabar los datos, vuelva a innetntarlo mas tarde'.$Modelo."sas");	
	}
	$script='alert("La cotizaci�n est� lista para imprimirse");';
	$respuesta->addScript($script);			
	return $respuesta;	
}
echo stripslashses_gpc($_POST['editor']);
// GENERAR ARCHIVO HTML
/*$body_top = "--Message-Boundary\n";
$body_top .= "Content-type: text/plain; charset=US-ASCII\n";
$body_top .= "Content-transfer-encoding: 7BIT\n";
$body_top .= "Content-description: Mail message body\n\n";

$HTML='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
</head>
<body style="background-color:#CCCCCC">
<table style="background-color:#FFFFFF; border:none;"><tr><td style="text-align: left">'.stripslashses_gpc($_POST['editor'])."</td></tr></table></body></html>";
echo $HTML;

$nombrefile="wh/".$CotNum.'.html';
$fp = fopen($nombrefile, "w");
fwrite($fp,$HTML);
fclose($fp);
// GENERAR ARCHIVO WORD
include("../../php/html_to_doc.php");      
$htmltodoc= new HTML_TO_DOC();      
$htmltodoc->createDoc("wh/".$CotNum.".html","wh/".$CotNum); 
//$htmltodoc->createDocFromURL("http://www.emesa.com.mx","test"); 
*/
?>
</body>
</html>

