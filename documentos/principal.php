<?

	session_start();
	$_SESSION["rutaFileXajax"]="/home/emesa/public_html/_iessus/xajax/xajax.inc.php";
	$_SESSION["rutaDirXajax"]="http://www.emesa.com.mx/_iessus/xajax/";
	require ($_SESSION["rutaFileXajax"]);
	$xajax = new xajax();
	function prueba($contenido)
	{
		$respuesta = new xajaxResponse('ISO-8859-1');
		$respuesta->addAssign("divprueba","innerHTML","$contenido");
		return $respuesta;
	}
	$xajax->registerFunction("prueba");
	$xajax->processRequests();
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<?
	
	$xajax->printJavascript($_SESSION["rutaDirXajax"]);
	
?>

<script type="text/javascript" src="../../../ckeditor/ckeditor.js"></script>

</head>

<body>
<p>

    
  <form action="guardar.php" method="post" name="form1">
  
  <textarea name="editor" id="editor">
  
  
  
  
<table width='850' border='0' cellspacing='4' cellpadding='0'>
 <tr>
    <td width="218"><img src="logo_emesa.jpg" width="218" height="84" /></td>
    <td width="620"><div align="right"><strong>COTIZACI&Oacute;N:&nbsp; </strong><strong>16611</strong></div></td>
  </tr>
  <tr>
    <td colspan="2"><font size="2" face="Arial, Helvetica, sans-serif">Emesa Tratamiento de Aguas S.A de C.V. </font></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><strong><font size="2" face="Arial, Helvetica, sans-serif">ING.  JUAN CARLOS RENDON<br />
    
        CENTRO, DISTRITO FEDERAL <br />
        M&Eacute;XICO</font></strong> </td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="31" colspan="2" bgcolor="#003399"><div align="center"><strong><font color="#FFFFFF" face="Arial, Helvetica, sans-serif">PLANTA DE TRATAMIENTO DE AGUAS NEGRAS</font></strong></div></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><p><font size="2" face="Arial, Helvetica, sans-serif">A su solicitud y tomando en cuenta los datos y  requerimientos proporcionados por usted, en la presente haga favor de encontrar  nuestra propuesta t&eacute;cnica  y econ&oacute;mica para el suministro de una planta de tratamiento de agua negra  Marca&nbsp; <strong>LAOTSSmr&nbsp; </strong>tipo paquete <strong>con capacidad de tratar 1.30 m3/d&iacute;a (equivalente  a 0.015 l.p.s.) </strong>&nbsp;en: <strong>OFICINAS</strong> </font></p>
    <p><font size="2" face="Arial, Helvetica, sans-serif">Considerando que el agua tratada ser&aacute;  utilizada en Servicios al P&uacute;blico, y que por lo mismo deber&aacute; cumplir con la Norma  Oficial Mexicana <strong>NOM-003-SEMARNAT-1997</strong>, para la elaboraci&oacute;n de esta  propuesta hemos seleccionado una <strong>PLANTA  LAOTSSmr SERIE SELECTOR PK MODELO 015.</strong></font></p>
    <p><font size="2" face="Arial, Helvetica, sans-serif">La tecnolog&iacute;a <strong>LAOTSSmr</strong> es un proceso mejorado de lodos activados (aerobio) en la modalidad de aireaci&oacute;n  extendida y un sistema secuencial que permite la oxidaci&oacute;n total, lo que aunado  a su <strong>sencillez,</strong> <strong>versatilidad y confiabilidad </strong>ha permitido que actualmente se traten m&aacute;s  de 100 millones de litros de agua por d&iacute;a en M&eacute;xico con las plantas <strong>LAOTSSmr</strong>,  esto gracias a que representa ventajas, tales como:</font></p>
	
	<font size="2" face="Arial, Helvetica, sans-serif">      </font>
      <ul>
        <li><font size="2" face="Arial, Helvetica, sans-serif">Ausencia  de malos olores</font></li>
        <li><font size="2" face="Arial, Helvetica, sans-serif">Bajo  costo de operaci&oacute;n y mantenimiento</font></li>
        <li><font size="2" face="Arial, Helvetica, sans-serif">Baja  producci&oacute;n de lodos de desecho.</font></li>
        <li><font size="2" face="Arial, Helvetica, sans-serif">No  requiere agregados de productos especiales o bacteria.</font></li>
        <li><font size="2" face="Arial, Helvetica, sans-serif">Alta  remoci&oacute;n de contaminantes.</font></li>
        <li><font size="2" face="Arial, Helvetica, sans-serif">Puede  permanecer sin energ&iacute;a el&eacute;ctrica hasta 6 horas</font></li>
        <li><font size="2" face="Arial, Helvetica, sans-serif">Permite  la colocaci&oacute;n de losas en la parte superior, por lo que el &aacute;rea de la planta  puede ser aprovechada como &aacute;rea ajardinada.</font></li>
      </ul>   
    <p><font size="2" face="Arial, Helvetica, sans-serif">Anexo encontrara nuestra propuesta t&eacute;cnica  econ&oacute;mica, as&iacute; como los anexos de soporte correspondientes.</font></p></td>
  </tr>
  

  <tr>
    <td colspan="2"> </td>
  </tr>
</table>
	<div style="page-break-before: always;"></div>

  <table width="849" border="0" cellspacing="4" cellpadding="0">
  <tr>
    <td width="368"><img src="logo_emesa.jpg" width="218" height="84" /></td>
    <td width="469"><p align="right"><strong>COTIZACI&Oacute;N:&nbsp; </strong><strong>16611</strong><strong> </strong></p></td>
  </tr>
  <tr>
    <td colspan="2"><font size="2" face="Arial, Helvetica, sans-serif">Emesa Tratamiento de Aguas S.A de C.V. </font></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><table border="1" cellspacing="0" cellpadding="0" width="710">
      <tr>
        <td width="710"><p><strong>PROPUESTA TECNICA</strong></p></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="27" colspan="2" bgcolor="#003399"><div align="center"><strong><font color="#FFFFFF" face="Arial, Helvetica, sans-serif">ESPESIFICACIONES GENERALES</font></strong></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#CCCCCC">PLANTA DE TRATAMIENTO LAOTSS SERIE <strong>SELECTOR  PK</strong> MODELO <strong>015</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="left"><strong>CAPACIDAD (1)</strong></div></td>
    <td><div align="center"><strong>NOMINAL</strong></div></td>
  </tr>
  <tr>
    <td>Litros por segundo</td>
    <td><div align="center"><strong>0.015</strong></div></td>
  </tr>
  <tr>
    <td><strong>HABITANTES(2)&nbsp; @ de 140 lt/dia de descarga por habitante</strong></td>
    <td><strong>9</strong></td>
  </tr>
  <tr>
    <td><strong>HABITANTES(2)&nbsp; @ de 180 lt/dia de descarga por habitante</strong></td>
    <td><strong>7</strong></td>
  </tr>
  <tr>
    <td>CAPACIDAD ORGANICA</td>
    <td><strong>300  ppm de DBO5</strong></td>
  </tr>
  <tr>
    <td><strong>DIMENSIONES PLANTA (3)</strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>DIAMETRO </td>
    <td>1.00 mts</td>
  </tr>
  <tr>
    <td>ALTO</td>
    <td>1.20 mts</td>
  </tr>
  <tr>
    <td>POTENCIA  INSTALADA</td>
    <td>0.25 HPS </td>
  </tr>
  <tr>
    <td>POTENCIA  UTILIZADA</td>
    <td>0.25  HPS</td>
  </tr>
  <tr>
    <td>OLORES</td>
    <td>NINGUNO</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><p><strong><em><u>NOTAS:</u></em></strong></p></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><p>(1)  La planta puede operar correctamente a partir de&nbsp; 1/6 de su capacidad nominal.</p></td>
  </tr>
  <tr>
    <td colspan="2">2) Se considera una descarga por habitante de 180.  lt/d&iacute;a de aguas negras. Este dato solo es indicativo por lo que la capacidad de  la planta queda indicada solo por el gasto.</td>
  </tr>
  <tr>
    <td colspan="2">(3) La propuesta presupone una carga org&aacute;nica  m&aacute;xima de 300 ppm de DBO5 (Es importante verificar que el agua a  tratar no exceda este valor, de lo contrario, favor de avisarnos para  reconsiderarlo en la propuesta.</td>
  </tr>
  <tr>
    <td colspan="2"><p>(5) <em>NOM-001</em> para descarga a cuerpo  receptor tipo A y B. <em>NOM-002</em> para  descarga a drenaje sanitario. <em>NOM-003</em> para uso de servicios p&uacute;blicos (Reciclado).</p></td>
  </tr>
  <tr>
    <td colspan="2"><p>(6)  El &aacute;rea especificada es para la planta de tratamiento. No incluye vialidades ni  jardiner&iacute;a. Las dimensiones finales son las que resulten del proyecto  ejecutivo.</p></td>
  </tr>
  <tr>
    <td colspan="2"><p>(7)  Esta planta utiliza una conexi&oacute;n trif&aacute;sica a 220volts. En caso de que no  cuenten con este tipo de conexi&oacute;n, nos lo tendr&aacute; que hacer saber antes de su  fabricaci&oacute;n &nbsp;para adecuar los equipos.</p></td>
  </tr>
</table>
<table width="849" border="0" cellspacing="4" cellpadding="0">
  <tr>
    <td width="216"><img width="192" height="60" src="principal_clip_image002.jpg" align="left" hspace="12" /></td>
    <td width="621"><div align="right"><strong>COTIZACI&Oacute;N:&nbsp; </strong><strong>16611</strong></div></td>
  </tr>
  <tr>
    <td colspan="2"><font size="2" face="Arial, Helvetica, sans-serif">Emesa Tratamiento de Aguas S.A de C.V. </font></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="28" colspan="2" bgcolor="#003399"><div align="center"><strong><font color="#FFFFFF">DIAGRAMA DE INSTALACI&Oacute;N</font></strong></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><div align="center"><img src="diagrama_pk.jpg" width="687" height="530" /></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="849" border="0" cellspacing="4" cellpadding="0">
  <tr>
    <td width="218"><img src="logo_emesa.jpg" width="218" height="84" /></td>
    <td width="619"><div align="right"><strong>COTIZACI&Oacute;N:&nbsp; </strong><strong>16611</strong></div></td>
  </tr>
  <tr>
    <td colspan="2"><font size="2" face="Arial, Helvetica, sans-serif">Emesa Tratamiento de Aguas S.A de C.V. </font></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#003399"><div align="center"><font color="#FFFFFF">FOTOGRAF&Iacute;A DE OBRA  TERMINADA - LAOTSSmr SERIE <strong>SELECTOR PK</strong>(TIPO)</font></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><div align="center"><img src="plantas_pk.jpg" width="659" height="648" /></div></td>
  </tr>
  <tr>
    <td colspan="2"><p><em>El c&aacute;rcamo de bombeo y pretratamiento se  requieren cuando el drenaje llega metros debajo del nivel de terreno natural, y  que por lo mismo ser&iacute;a necesaria una excavaci&oacute;n muy profunda para la  construcci&oacute;n de la planta de tratamiento.</em><strong></strong></p></td>
  </tr>
</table>
<table width="849" border="0" cellspacing="4" cellpadding="0">
  <tr>
    <td width="218"><img src="logo_emesa.jpg" width="218" height="84" /></td>
    <td width="619"><div align="right"><strong>COTIZACI&Oacute;N:&nbsp; </strong><strong>16611</strong></div></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#CCCCCC"><strong>PROPUESTA ECON&Oacute;MICA</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><p><strong>PLANTA </strong><strong>LAOTSSMR</strong><strong> SERIE SELECTOR  PK MODELO 015</strong></p></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><p><strong><em><u>NOTAS:</u></em></strong></p></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">1.-</td>
  </tr>
  <tr>
    <td colspan="2">2.-</td>
  </tr>
  <tr>
    <td colspan="2">3.-</td>
  </tr>
  <tr>
    <td colspan="2">4.-</td>
  </tr>
  <tr>
    <td colspan="2">5.-</td>
  </tr>
  <tr>
    <td colspan="2">6.-</td>
  </tr>
  <tr>
    <td colspan="2">7.-</td>
  </tr>
  <tr>
    <td colspan="2">8.-</td>
  </tr>
  <tr>
    <td colspan="2">9.-</td>
  </tr>
  <tr>
    <td colspan="2">10.-</td>
  </tr>
  <tr>
    <td colspan="2">11.-</td>
  </tr>
  <tr>
    <td colspan="2">12.-</td>
  </tr>
  <tr>
    <td colspan="2">13.-</td>
  </tr>
  <tr>
    <td colspan="2">14.-</td>
  </tr>
</table>
 
 
 <table width="849" border="0" cellspacing="4" cellpadding="0">
  <tr>
    <td width="218"><img src="logo_emesa.jpg" width="218" height="84" /></td>
    <td width="619"><div align="right"><strong>COTIZACI&Oacute;N:&nbsp; </strong><strong>16611</strong></div></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td colspan="2"><strong><em>LA PROPUESTA INCLUYE</em> </strong></td>
   </tr>
  <tr>
    <td colspan="2"><p>&nbsp;</p></td>
  </tr>
  <tr>
    <td colspan="2">Desde la elaboraci&oacute;n del Proyecto  Arquitect&oacute;nico, Proyecto Estructural tipo, Dise&ntilde;o, Equipamiento. Construcci&oacute;n.  (Opcional), Puesta en Marcha y entrega  de obra terminada y funcionando <strong>con  garant&iacute;a de un a&ntilde;o</strong> en equipos y  cumplimiento de la norma dada en las especificaciones generales de las  instalaciones de Tratamiento,&nbsp; y  entrenamiento a operadores.</td>
   </tr>
  <tr>
    <td><p>&nbsp;</p></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><p><strong>El equipo  de l&iacute;nea de una planta LAOTSSmr de la serie SELECTOR es:</strong></p></td>
   </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"> <ul>
        <li>Soplador       acoplado a motor de alta eficiencia.</li>
   
        <li>L&iacute;neas       de conducci&oacute;n de aire: primarias secundarias y terciarias.</li>
     
        <li>Difusores       de polietileno de alta densidad, burbuja fina, alta eficiencia, con       v&aacute;lvula interna de no retorno.</li>
    
        <li>Dosificador       de cloro con tanque.</li>
     
        <li>Reja       o canasta para desbaste de s&oacute;lidos inorg&aacute;nicos mayores a 1&rdquo; de di&aacute;metro.</li>
    
        <li>Barandales       y/o rejillas (seg&uacute;n dise&ntilde;o particular).</li>
     
        <li>Tablero       de control.</li>
   
        <li>Sistema       el&eacute;ctrico de tablero a soplador.</li>
    
        <li>Instalaci&oacute;n,       incluyendo todas las piezas especiales requeridas para la misma. </li>
    </ul></td>
  </tr>
  
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><p><strong>Para la entrega de la planta se proporcionan:</strong></p></td>
  </tr>
  <tr>
    <td colspan="2"><ul></td>
  </tr>
  <tr>
    <td colspan="2">
      <ul>
        <li>Dos manuales  de operaci&oacute;n y mantenimiento.</li>
     
        <li>Rastrillo,       pala, grasera y aceitera.</li>
      
        <li>1       filtro de aire para el soplador (de repuesto).</li>
     
        <li>Un       frasco de aceite (si este aplica para el modelo).</li>
      
        <li>Un       cartucho de grasa (si este aplica para el modelo)</li>
     
        <li>Dos       d&iacute;as para supervis&oacute;n de arranque de la planta y entrenamiento a       operador(es).</li>
      </ul></td>
  </tr>
  
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><strong>Previo al arranque de la planta, el  cliente deber&aacute; designar a personal calificado que ser&aacute; capacitado por nuestros  t&eacute;cnicos para la operaci&oacute;n de la planta.</strong></td>
  </tr>
  <tr>
    <td colspan="2"><p>&nbsp;</p></td>
  </tr>
</table>
 
 
 
 <table width="849" border="0" cellspacing="4" cellpadding="0">
  <tr>
    <td width="218"><img src="logo_emesa.jpg" width="218" height="84" /></td>
    <td width="619"><div align="right"><strong>COTIZACI&Oacute;N:&nbsp; </strong><strong>16611</strong></div></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td colspan="2"><strong><em>LA PROPUESTA NO INCLUYE </em></strong></td>
   </tr>
  <tr>
    <td colspan="2"><p>&nbsp;</p></td>
  </tr>
  <tr>
    <td colspan="2"><p>Obras complementarias como son:</p></td>
   </tr>
  <tr>
    <td><p>&nbsp;</p></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><ol start="1" type="1">
      <li>Electrificaci&oacute;n       exterior a Tablero General de Control </li>
    
        <li>Conducciones       ni descargas de agua externa a la planta, salvo las espec&iacute;ficamente       indicadas.</li>
   
        <li>Excavaciones,       rellenos ni acondicionamiento de terreno. El cliente entregar&aacute; terreno       firme y plano con plantilla nivelada de 5 cm de espesor concreto fc 150,       con capacidad de carga m&iacute;nima de 7 Ton/m2.</li>
   
        <li>Tr&aacute;mites       y gestiones </li>
    </ol></td>
   </tr>
  
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><p><strong><em><u>TIEMPO  DE ENTREGA </u></em></strong></p></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><p><strong><em><u>CONDICIONES  DE PAGO</u></em></strong></p></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  
  <tr>
    <td colspan="2"><p><strong>Nota: En caso de requerir anteproyecto  para aprobaci&oacute;n o licencia se solicitar&aacute; un 10% adelantado, restando el 50%  para el inicio del proyecto)</strong></p></td>
  </tr>
  <tr>
    <td colspan="2"><p>&nbsp;</p></td>
  </tr>
  <tr>
    <td colspan="2"><ul></td>
  </tr>
  <tr>
    <td colspan="2">
      <ul>
        <li>Dos manuales  de operaci&oacute;n y mantenimiento.</li>
      
        <li>Rastrillo,       pala, grasera y aceitera.</li>
      
        <li>1       filtro de aire para el soplador (de repuesto).</li>
      
        <li>Un       frasco de aceite (si este aplica para el modelo).</li>
      
        <li>Un       cartucho de grasa (si este aplica para el modelo)</li>
     
        <li>Dos       d&iacute;as para supervis&oacute;n de arranque de la planta y entrenamiento a       operador(es).</li>
      </ul></td>
  </tr>
  
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><strong>Previo al arranque de la planta, el  cliente deber&aacute; designar a personal calificado que ser&aacute; capacitado por nuestros  t&eacute;cnicos para la operaci&oacute;n de la planta.</strong></td>
  </tr>
  <tr>
    <td colspan="2"><p>&nbsp;</p></td>
  </tr>
</table>
 
 
  </textarea>

  <div id="divprueba">
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>Este es el div</p>
  </div>  
  	<input name="Aceptar" value="Aceptar" type="submit"  />
  </form>  
  

  <script type="text/javascript">
	CKEDITOR.replace('editor');
	CKEDITOR.config.height = 1000;

</script> 


</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<p>&nbsp;</p>
</body>
</html>
