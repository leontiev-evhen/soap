<?php
date_default_timezone_set('Africa/Lagos');
$client = new SoapClient('https://www.cbr.ru/DailyInfoWebServ/DailyInfo.asmx?WSDL');
 
try {

    // print_r($client->__getFunctions());
    $params["On_date"] = date("Y-m-d"); 
    $res = $client->GetCursOnDate($params);
    $movies = new SimpleXMLElement($res->GetCursOnDateResult->any
);
print_r($movies->ValuteData->ValuteCursOnDate[0]->Vname);
} catch (SoapFault $fault) {
      echo "Error: " . $fault->faultcode . ": " . $fault->getMessage() . "\n";
}
