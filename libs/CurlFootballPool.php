<?php

class CurlFootballPool
{
	public function GetTeams () 
	{
		$request = '<?xml version="1.0" encoding="utf-8"?>
			<soap12:Envelope xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
			  <soap12:Body>
			    <Teams xmlns="http://footballpool.dataaccess.eu">
			    </Teams>
			  </soap12:Body>
			</soap12:Envelope>
		';

		$headers = [
			'POST /data/info.wso HTTP/1.1',
			'Host: footballpool.dataaccess.eu',
			'Content-Type: application/soap+xml; charset=utf-8',
			'Content-Length: '.strlen($request),
		];

	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, URL_FOOTBAL_POOL);
		curl_setopt($ch, CURLOPT_USERAGENT , "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT , 30); 
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);

		if(curl_errno($ch))
    	{
        	curl_close($ch);
        	throw new Exception('Curl error: '. curl_error($ch));
    	}
    	else
    	{
        	curl_close($ch);
			return $this->parseXml($result);
    	}
	}

	private function parseXml ($data)
	{
   		if (!$this->validXml($data)) {
   			$result = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $data);
	    	$xml = new SimpleXMLElement($result);
	    	return $xml->soapBody->mTeamsResponse->mTeamsResult->mtTeamInfo;
   		}
   	
    	throw new Exception('Invalid xml data');
	}

	private function validXml ($xml) 
	{
	    libxml_use_internal_errors(true);
	    $doc = new DOMDocument('1.0', 'utf-8');
	    $doc->loadXML($xml);
	    $errors = libxml_get_errors();
	    return $errors;
	}
}
