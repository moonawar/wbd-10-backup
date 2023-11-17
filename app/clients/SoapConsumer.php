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
                'http' => array(
                    'header' => 'ApiKey: ' . $_ENV['SOAP_API_KEY'],
                ),
            ])
        ];

        $this->subscriptionClient = new SoapClient($_ENV['SOAP_URL'] . "subscription?wsdl", $options);
        $this->requestClient = new SoapClient($_ENV['SOAP_URL'] . "request?wsdl", $options);    

        $this->apiKey = $_ENV['SOAP_API_KEY'];
    }

    public function makeRequest($requestBy, $to, $requesterEmail) {
        $response = $this->requestClient->MakeRequest([
            'RequestBy' => $requestBy,
            'To' => $to,
            'RequesterEmail' => $requesterEmail,
        ]);

        $soapData = json_encode($response);
        $soapData = json_decode($soapData, true);

        return $soapData;
    }

    public function getSubscriptionOf($requester) {
 
        $response = $this->subscriptionClient->GetSubscriptionOf([
            'Username' => $requester,
        ]);

        $soapData = json_encode($response);
        $soapData = json_decode($soapData, true);

        return $soapData;
    }
}
?>