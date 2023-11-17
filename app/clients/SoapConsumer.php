<?

class SoapConsumer {
    private SoapClient $subscriptionClient;
    private SoapClient $requestClient;
    private $apiKey;

    public function __construct() {
        // Set SOAP client options
        $options = [
            'trace' => 1,        // Allows you to trace request and response
            'exceptions' => true, // Enables exceptions for HTTP errors
            "encoding" => "UTF-8",
            "stream_context" => stream_context_create([
                'http' => [
                    'ApiKey' => $_ENV['SOAP_API_KEY']
                ]
            ])
        ];

        $this->subscriptionClient = new SoapClient($_ENV['SOAP_URL'] . "subscription?wsdl", $options);
        $this->requestClient = new SoapClient($_ENV['SOAP_URL'] . "request?wsdl", $options);    

        $this->apiKey = $_ENV['SOAP_API_KEY'];

        $headerBody = new SoapVar($this->apiKey, XSD_STRING, null, null, 'ApiKey', 'http://ws.soap.com/');
        $header = new SoapHeader('http://ws.soap.com/', 'ApiKey', $headerBody);

        $this->subscriptionClient->__setSoapHeaders(array(
            new SoapHeader(
                'http://ws.soap.com/',
                'ApiKey',
                $this->apiKey,
                false
            ),
            new SoapHeader(
                'ns2',
                'ApiKey',
                $this->apiKey,
                false
            ),
            new SoapHeader(
                'ns1',
                'ApiKey',
                $this->apiKey,
                false
            ),
            $header
        ));

        $this->subscriptionClient->__setSoapHeaders($header);

        $this->requestClient->__setSoapHeaders(
            new SoapHeader(
                'http://ws.soap.com/',
                'ApiKey',
                $this->apiKey,
                false
            )
        );

    }

    public function makeRequest($requestBy, $to, $requesterEmail) {
        $response = $this->requestClient->MakeRequest([
            'RequestBy' => $requestBy,
            'To' => $to,
            'RequesterEmail' => $requesterEmail,
        ]);

        

        return $response;

        // $apiKey = $this->apiKey;

        // // Construct SOAP request XML
        // $requestXml = <<<XML
        // <Envelope xmlns="http://schemas.xmlsoap.org/soap/envelope/">
        //     <Header>
        //         <ApiKey xmlns="http://ws.soap.com/">$apiKey</ApiKey>
        //     </Header>
        //     <Body>
        //         <MakeRequest xmlns="http://ws.soap.com/">
        //             <RequestBy xmlns="">$requestBy</RequestBy>
        //             <To xmlns="">$to</To>
        //             <RequesterEmail xmlns="">$requesterEmail</RequesterEmail>
        //         </MakeRequest>
        //     </Body>
        // </Envelope>
        // XML;

        // $endpoint = $_ENV['SOAP_URL'] . "request";

        // $headers = [
        //     'Content-Type: text/xml; charset=utf-8',
        //     'Content-Length: ' . strlen($requestXml),
        //     'SOAPAction: http://ws.soap.com/MakeRequest',
        // ];

        // $ch = curl_init($endpoint);
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $requestXml);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // // Send SOAP request
        // $responseXml = curl_exec($ch);
        // curl_close($ch);

        // return $responseXml;
    }

    public function getSubscriptionOf($requester) {

        // Define the SOAP request parameters
        $requestParams = array(
            'ApiKey' => $this->apiKey,
            'GetSubscriptionOf' => array(
                'Username' => $requester,
            ),
        );

        $res = $this->subscriptionClient->__soapCall('GetSubscriptionOf', array($requestParams));
    
        // Process the result
        var_dump($res);

 
        // $response = $this->subscriptionClient->GetSubscriptionOf([
        //     'Username' => $requester,
        // ]);

        // echo htmlentities( $this->subscriptionClient->__getLastRequest());

        // return $response;
        // $apiKey = $this->apiKey;

        // // Construct SOAP request XML
        // $requestXml = <<<XML
        // <Envelope xmlns="http://schemas.xmlsoap.org/soap/envelope/">
        //     <Header>
        //         <ApiKey xmlns="http://ws.soap.com/">$apiKey</ApiKey>
        //     </Header>
        //     <Body>
        //         <GetSubscriptionOf xmlns="http://ws.soap.com/">
        //             <Username xmlns="">$requester</Username>
        //         </GetSubscriptionOf>
        //     </Body>
        // </Envelope>
        // XML;

        // $endpoint = $_ENV['SOAP_URL'] . "subscription";

        // $headers = [
        //     'Content-Type: text/xml; charset=utf-8',
        //     'Content-Length: ' . strlen($requestXml),
        //     'SOAPAction: http://ws.soap.com/GetSubscriptionOf',
        // ];

        // $ch = curl_init($endpoint);
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $requestXml);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // // Send SOAP request
        // $dataString = curl_exec($ch);
        // curl_close($ch);
        
        // // Use regular expression to extract usernames
        // preg_match_all('/\+07:00(.*?)true/', $dataString, $matches);

        // // Extract the usernames from the matches array
        // $usernames = $matches[1];
        // for ($i = 0; $i < count($usernames); $i++) {
        //     // if the username started with 2023
        //     if (substr($usernames[$i], 0, 4) == "2023") {
        //         $usernames[$i] = substr($usernames[$i], 29);
        //     }
        // }
        
        // // Print the result
        // echo "usernames = [" . implode(', ', $usernames) . "]\n";
        // return $dataString;
    }
}
?>