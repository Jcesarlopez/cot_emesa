<?php
	session_start();
				

	echo $_SESSION['NomUser']."<br><br>";				
	echo $_SESSION['ApPatUser']."<br><br>";
	echo $_SESSION['ApMatUser']."<br><br>";

	echo $_SESSION['IdUser']."<br><br>";
	
	echo $_SESSION['MailUser']."<br><br>";
	echo $_SESSION['TitUser']."<br><br>";

	echo $_SESSION['NameUser']."<br><br>";

	$hola="como estas";
	echo "$hola cesar";
	echo "<br><br><br><br><br>Sql:";
	print_r($_SESSION['sqls']);


?>