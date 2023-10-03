<?php
class Main {
    protected $controller;
    protected $method;
    protected $params = [];
    public function __construct()
    {
        // require_once __DIR__ . '/../pages/Example.php';
        // require_once __DIR__ . '/../controllers/NotFoundController.php';

        // $this->controller = new NotFoundController();
        $this->method = 'index';

        $url = $this->parseUrl();
        
        $controllerPart = $url[0] ?? null;

        if (isset($controllerPart) && file_exists(__DIR__ . '/../controllers/' . $controllerPart . 'Controller.php')) {
            require_once __DIR__ . '/../controllers/' . $controllerPart . 'Controller.php';
            $controllerClass = $controllerPart . 'Controller';
            $this->controller = new $controllerClass();
        }else{
            require_once __DIR__ . '/../controllers/NotFoundController.php';
            $this->controller = new NotFoundController();
        }
        unset($url[0]);

        // Cek Method
        $methodPart = $url[1] ?? null;
        if (isset($methodPart) && method_exists($this->controller, $methodPart)) {
            $this->method = $methodPart;
        }
        unset($url[1]);

        // Cek bagian parameter
        if (!empty($url)) {
            $this->params = array_values($url);
        } else {
            $this->params = [];
        }

        // Panggil method dari kelas controller, dengan parameter params
        call_user_func_array([$this->controller, $this->method], $this->params);
    }
    
    public function parseUrl()
    {
        if (isset($_SERVER['PATH_INFO'])) {
            $url = trim($_SERVER['PATH_INFO'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            return $url;
        }
    }
}