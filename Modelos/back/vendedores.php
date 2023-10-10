<?php
function autoload($clase)
{
	include $clase.".php";	
}
spl_autoload_register('autoload');




?>