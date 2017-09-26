<?php
require_once 'config.php'; 
spl_autoload_register(function ($class_name) 
{
    require_once 'libs/'.$class_name . '.php';
});

try 
{
	
	$obj = new SoapFootballPool();
	$soap_teams = $obj->getTeams();

	$obj = new CurlFootballPool();
	$curl_teams = $obj->getTeams();
} 
catch (SoapFault $fault) 
{
    $error = "Error: " . $fault->faultcode . ": " . $fault->getMessage() . "\n";
}
catch (Exception $e) 
{ 
    $error = "Error: " . $e->getMessage();
}

require_once './templates/index2.php';