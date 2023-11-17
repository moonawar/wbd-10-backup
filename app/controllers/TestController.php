
<?php

class TestController extends Controller implements ControllerInterface
{
    private SoapConsumer $soap;

    public function __construct() {
        require_once __DIR__ . '/../clients/SOAPConsumer.php';
        $this->soap  = new SoapConsumer();
    }

    public function index() {
        
    }
    
    public function req()
    {
        echo $this->soap->makeRequest('addin', 'yusuf', 'test@gmail.com');
    }

    public function sub()
    {
        echo $this->soap->getSubscriptionOf('a');
    }
}