<?php
if($_SESSION['PTARPropiedades']['IdTipo']==1) // PK
{
	$arrayNotas1[]="(1) La planta puede operar correctamente a partir de  1/6 de su capacidad nominal.";
	$arrayNotas1[]="(2) Se considera una descarga por habitante de 180. lt/día de aguas negras. Este dato solo es indicativo por lo que la capacidad de la planta queda indicada solo por el gasto.";
	$arrayNotas1[]="(3) La propuesta presupone una carga orgánica máxima de 300 ppm de DBO5 (Es importante verificar que el agua a tratar no exceda este valor, de lo contrario, favor de avisarnos para reconsiderarlo en la propuesta. ";
	$arrayNotas1[]="(4) En caso del que el agua de entrada este fuera de rango de la tabla anterior, se tendrá que informar a EMESA ya que podría variar el diseño y precio de la planta.";
	$arrayNotas1[]="(5) NOM-001 para descarga a cuerpo receptor tipo A y B. NOM-002 para descarga a drenaje sanitario. NOM-003 para uso de servicios públicos (Reciclado).";
	$arrayNotas1[]="(6) El área especificada es para la planta de tratamiento. No incluye vialidades ni jardinería. Las dimensiones finales son las que resulten del proyecto ejecutivo.";
	$arrayNotas1[]="(7) Esta planta utiliza una conexión trifásica a 220volts. En caso de que no cuenten con este tipo de conexión, nos lo tendrá que hacer saber antes de su fabricación  para adecuar los equipos.";
}
if($_SESSION['PTARPropiedades']['IdTipo']==2) // Obra civil
{
	$arrayNotas1[]="(1) La planta puede operar correctamente a partir de  1/6 de su capacidad nominal.";
	$arrayNotas1[]="(2) Se considera una descarga por habitante de 180. lt/día de aguas negras. Este dato solo es indicativo por lo que la capacidad de la planta queda indicada solo por el gasto.";
	$arrayNotas1[]="(3) El área especificada es para la planta de tratamiento. No incluye vialidades ni jardinería. Las dimensiones finales son las    que resulten del proyecto ejecutivo.";
	$arrayNotas1[]="(4) En caso del que el agua de entrada este fuera de rango de la tabla anterior, se tendrá que informar a EMESA ya que podría variar el diseño y precio de la planta.";
}
if($_SESSION['PTARPropiedades']['IdTipo']==15) // Casera
{
	$arrayNotas1[]="(1) La planta puede operar correctamente a partir de  1/6 de su capacidad nominal.";
	$arrayNotas1[]="(2) Se considera una descarga por habitante de 180. lt/día de aguas negras. Este dato solo es indicativo por lo que la capacidad de la planta queda indicada solo por el gasto.";
	$arrayNotas1[]="(3) La propuesta presupone una carga orgánica máxima de 300 ppm de DBO5 (Es importante verificar que el agua a tratar no exceda este valor, de lo contrario, favor de avisarnos para reconsiderarlo en la propuesta.";
	$arrayNotas1[]="(4) En caso del que el agua de entrada este fuera de rango de la tabla anterior, se tendrá que informar a EMESA ya que podría variar el diseño y precio de la planta.";
	$arrayNotas1[]="(5) NOM-001 para descarga a cuerpo receptor tipo A y B. NOM-002 para descarga a drenaje sanitario. NOM-003 para uso de servicios públicos (Reciclado).";
	$arrayNotas1[]="(6) El área especificada es para la planta de tratamiento. No incluye vialidades ni jardinería. Las dimensiones finales son las que resulten del proyecto ejecutivo.";
}
?>