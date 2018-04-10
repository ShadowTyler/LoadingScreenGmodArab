<?php

include('settings.php');

if($CONFIG['ENABLED'])
{
	try
	{
		$con = new PDO('mysql:host=' . $CONFIG['DB_HOST'] . ';dbname=' . $CONFIG['DB_DBNAME'] . ';charset=' . $CONFIG['DB_CHARSET'], $CONFIG['DB_USER'], $CONFIG['DB_PASS']);
	}
	catch(PDOException $e)
	{
		die($e->getMessage());
	}
}

?>