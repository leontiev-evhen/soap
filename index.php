<?php
require_once 'config.php'; 
spl_autoload_register(function ($class_name) 
{
    require_once 'libs/'.$class_name . '.php';
});

try 
{
	if ($_SERVER['REQUEST_METHOD'] === 'POST') 
	{
		if (!empty($_POST['type'])) 
		{
			switch ($_POST['type']) 
			{
				case 'soap':
					$obj = new SoapCbr();
					break;
				case 'curl':
					$obj = new CurlCbr();
					break;
			}
			$curs = $obj->GetCursOnDate();
		}
		else
		{
			throw new Exception('Choose type');
		}
	}

} 
catch (SoapFault $fault) 
{
    $error = "Error: " . $fault->faultcode . ": " . $fault->getMessage() . "\n";
}
catch (Exception $e) 
{ 
    $error = "Error: " . $e->getMessage();
}

require_once './templates/index.php';
