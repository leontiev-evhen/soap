<?php

class SoapFootballPool
{

	public function GetTeams () 
	{
		$client = new SoapClient(URL_FOOTBAL_POOL);
		$result = $client->Teams();
		return $result->TeamsResult->tTeamInfo;

	}

}