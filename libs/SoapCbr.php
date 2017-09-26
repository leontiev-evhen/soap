<?php

class SoapCbr
{

	public function GetCursOnDate () 
	{
		if (!empty($_POST['date']))
        {
        	$date = trim(htmlspecialchars($_POST['date']));
			$params["On_date"] = $date; 
			$client = new SoapClient(URL_CBR);
			$result = $client->GetCursOnDate($params);
			return $this->parseXml($result->GetCursOnDateResult->any);
		} 
		else 
		{
			throw new Exception('Choose date');
		}
	}

	private function parseXml ($data)
	{
   		$xmlData = new SimpleXMLElement($data);
		return $xmlData->ValuteData->ValuteCursOnDate;
	}
}