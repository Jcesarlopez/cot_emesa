<?php
session_start();
$formatNotas2 = array('size'=>'7','bold' => false, 'align' => 'center');
$arrayNotas2 = array();


$numeralNotaPre = 0;
if($_SESSION['PTARPropiedades']['IdTipo']==1) // PK
{
	$arrayNotas2[]='1. Los precios de la propuesta económica están en Pesos Mexicanos y no incluyen I.V.A. ';

	$arrayNotas2[]='2. Tanto el equipamiento como la fabricación de las plantas quedan bajo las especificaciones de Grupo EMESA quien se reserva el derecho de hacer los cambios pertinentes para la realización de la obra.';
	$arrayNotas2[]='3. La planta no opera con descargas de productos químicos y/o tóxicos. Por lo que la garantía se invalidara en caso de encontrase estos en el influente.';
	$arrayNotas2[]='4. Requiere plantilla para apoyo e instalación de la planta en terreno firme y plano, con capacidad de carga mínima de 4 Ton/m2, ';
	$arrayNotas2[]='5. Venta exclusivos del titular, salvo contrato y pago específico de los derechos.';
	$arrayNotas2[]='6. El cliente deberá tener instalada, conectada eléctrica e hidráulicamente la Planta de Tratamiento y proporcionar agua limpia para las pruebas de arranque. Si al acudir nuestro personal al arranque, la Planta no estuviera lista para arrancar, o no se tiene disponible el personal del cliente para recibir la Capacitación y el Entrenamiento, el técnico se retirará de la instalación y se programará un nuevo viaje con cargo al cliente.';
	$arrayNotas2[]='7. En caso de que la planta se pretenda instalar enterrada, se deberá informar la profundidad, a fin de considerarlo en el cálculo estructural correspondiente.';
	$arrayNotas2[]='8. El agua debe venir libre de basura y arena.';
	$arrayNotas2[]='9. Vigencia de cotización por 30 días.';
	$arrayNotas2[]='10. La cancelación total o parcial del pedido causará un cargo del 25% del monto total de este presupuesto.';
	$arrayNotas2[]='11. Previo al arranque de la planta, el cliente deberá designar a personal calificado que será capacitado por nuestros técnicos para la operación de la planta.';
	$arrayNotas2[]='12. L.A.B. su obra.';
	$arrayNotas2[]='13. El cliente se hará responsable de la vigilancia y/o veladores (para el resguardo de los equipos), en el proceso de construcción y entrega de la planta.';
	$arrayNotas2[]='14. Una vez terminada la obra el cliente deberá suministrar a los tanques agua residual o agua limpia para realizar las pruebas de estanqueidad y en caso de que la planta no se arranque las estructuras de obra civil deberán permanecer llenas de agua hasta la fecha de arranque para evitar fisuras en la estructura.';
	$arrayNotas2[]='15. No se incluye en esta cotización el costo de seguro o fianzas, en caso de ser requeridas por el cliente se cotizarán por separado y adicionado al precio de esta cotización.';
	$numeralNotaPre = '16';
}

if($_SESSION['PTARPropiedades']['IdTipo']==2) // Obra civil
{
	$arrayNotas2[]='1. Los precios de la propuesta económica son en pesos  y no incluyen I.V.A.';
	$arrayNotas2[]='2. Las Plantas con nuestra tecnología, han demostrado su prácticamente nula producción de lodos de desecho.';
	$arrayNotas2[]='3. El cliente estará encargado de suministrar aguas negras y energía eléctrica para la puesta en marcha y pruebas, en caso contrario el cliente finiquitará el total de la planta a cambio de la garantía.';
	$arrayNotas2[]='4. Se considera prueba a la demostración visual del encendido de los equipos eléctricos.';
	$arrayNotas2[]='5. Tanto el equipamiento como la construcción de las plantas quedan bajo las especificaciones de Grupo EMESA quien se reserva el derecho de hacer los cambios que considere pertinentes para la realización de la obra.';
	$arrayNotas2[]='6. La planta no opera con descargas de productos químicos y/o  tóxicos. Por lo que la garantía se invalidará en caso de encontrarse estos en el influente.';
	$arrayNotas2[]='7. Las grasas y aceites que ingresen a la planta deben ser menores a 70 ppm.';
	$arrayNotas2[]='8. El cliente puede optar por hacer la Obra Civil, en cuyo caso se le proporcionará toda  la información necesaria por parte de Grupo EMESA, esta información tendrá un costo del 10% del total de la obra civil.';
	$arrayNotas2[]='9. El pretratamiento puede evitarse, si se construye la planta de forma que el agua a tratar llegue a la misma por gravedad.';
	$arrayNotas2[]='10. Vigencia de cotización por 30 días.';
	$arrayNotas2[]='11. La cancelación total o parcial del pedido causará un cargo del 25% del monto total de este presupuesto.';
	$arrayNotas2[]='12. El cliente se hará responsable de la vigilancia y/o veladores (para el resguardo de los equipos), en el proceso de construcción y entrega de la planta.';
	$arrayNotas2[]='13. El cliente deberá entregar la plantilla nivelada, limpia y seca para iniciar los trabajos, y deberá mantener la zona libre de agua en todo el proceso de construcción de la planta. En caso de deslaves es responsabilidad del cliente limpiar y entregar el área seca y limpia para continuar con los trabajos.';
	$arrayNotas2[]='14. El tiempo de entrega de la obra, será de acuerdo al programa de obra. Y este iniciará a partir de que el cliente entregue la plantilla en las condiciones antes descritas de la planta de tratamiento y del pretratamiento. La demora en la entrega de cualquiera de ellas retrasará el programa en ese mismo tiempo.';
	$arrayNotas2[]='15. Una vez terminada la obra el cliente deberá suministrar a los tanques agua residual o agua limpia para realizar las pruebas de estanqueidad y en caso de que la planta no se arranque las estructuras de obra civil deberán permanecer llenas de agua hasta la fecha de arranque para evitar fisuras en la estructura.';
	$arrayNotas2[]='16. No se incluye en esta cotización el costo de seguro o fianzas, en caso de ser requeridas por el cliente se cotizarán por separado y adicionado al precio de esta cotización.';
}
if($_SESSION['PTARPropiedades']['IdTipo']==15) // Casera
{
	$arrayNotas2[]='1. Los precios de la propuesta económica están en Pesos Mexicanos y no incluyen I.V.A.';
	$arrayNotas2[]='2. La planta ha sido diseñada para que pueda ser instalada de forma sencilla por el cliente. Si se requiere que está operación se haga por parte de emesa, favor solicitarlo.';
	$arrayNotas2[]='3. Tanto el equipamiento como la fabricación de las nuestras plantas quedan bajo las especificaciones de Grupo EMESA quien se reserva el derecho de hacer los cambios pertinentes para la realización de la obra.';
	$arrayNotas2[]='4. La planta no opera con descargas de productos químicos y/o tóxicos. Por lo que la garantía se invalidara en caso de encontrarse estos en el influente.';
	$arrayNotas2[]='5. Requiere plantilla para apoyo e instalación de la planta en terreno firme y plano, con capacidad de carga mínima de 4 Ton/m2.';
	$arrayNotas2[]='6. Venta exclusivos del titular, salvo contrato y pago específico de los derechos.';
	$arrayNotas2[]='7. El agua debe venir libre de basura y arena.';
	$arrayNotas2[]='8. Vigencia de cotización por 30 días.';
	$arrayNotas2[]='9. La cancelación total o parcial del pedido causará un cargo del 25% del monto total de este presupuesto.';
	$arrayNotas2[]='10. L.A.B. Cuernavaca.';
	$arrayNotas2[]='11. No se incluye en esta cotización el costo de seguro o fianzas, en caso de ser requeridas por el cliente se cotizarán por separado y adicionado al precio de esta cotización.';
	$numeralNotaPre = "12";
}

// Nota adicional


if($crearNotaPr && $IdTipo!=2)
{


	$TextoNota="Se recomienda se instale la planta de forma que el agua a tratar llegue a la misma por gravedad. ";
	$TextoNota.="En caso de requerir rebombeo, favor solicitar el equipo, indicando profundidad del drenaje (máximo 2 metros), ";
	$TextoNota.="costo $ ".number_format($costoCarcamoNota)." más IVA (Una bomba, controles, rejillas, tablero, y los componentes requeridos para su ";
	$TextoNota.="correcta instalación.) La profundidad máxima contemplada es de 2.5 mts.";
	$arrayNotas2[]="$numeralNotaPre. $TextoNota";
}






?>