<?php

class CurlCbr
{
	public function GetCursOnDate () 
	{
		if (!empty($_POST['date']))
        {
        	$date = trim(htmlspecialchars($_POST['date']));
			$request = '<?xml version="1.0" encoding="utf-8"?>
					<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
					  <soap:Body>
					    <GetCursOnDate xmlns="http://web.cbr.ru/">
					      <On_date>'.$date.'</On_date>
					    </GetCursOnDate>
					  </soap:Body>
					</soap:Envelope>
			';

			$headers = [
				'POST /DailyInfoWebServ/DailyInfo.asmx HTTP/1.1',
				'Host: www.cbr.ru',
				'Content-Type: text/xml; charset=utf-8',
				'Content-Length: '.strlen($request),
			];

		
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, URL_CBR);
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
		else 
		{
			throw new Exception('Choose date');
		}
	}

	private function parseXml ($data)
	{
   		if (!$this->validXml($data)) {
   			$result = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $data);
	    	$xml = new SimpleXMLElement($result);

	    	return $xml->soapBody->GetCursOnDateResponse->GetCursOnDateResult->diffgrdiffgram->ValuteData->ValuteCursOnDate;
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