<?php

class PremiumController extends Controller implements ControllerInterface
{
    private AuthorModel $model;
    public function __construct() {
        require_once __DIR__ . '/../models/UserRole.php';
        $this->model  = $this->model('AuthorModel');
    }
    // TODO: PARAMS ROUTING
    public function index()
    {
        if (!isset($_SESSION['username'])) {
            http_response_code(301);
            header("Location: /user/login", true, 301);
            exit;
        }
        $premiumView = $this->view('premium', 'PremiumView');
        $premiumView->render();
    }
    public function detail($params = null){
        if (!isset($_SESSION['username'])) {
            http_response_code(301);
            header("Location: /user/login", true, 301);
            exit;
        }
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $collectionId = (int)$params;
                    // User
                    if(isset($_SESSION['username'])){
                        $userData = $this->model('UserModel');
                        $user = $userData->getUserByUsername($_SESSION['username']);
                        $username = $user['username'];
                        $nav = ['username'=>$username];
                    }else{
                        $nav = ['username'=>null];
                    }
                    $premiumView = $this->view('premium', 'CollectionDetailView', array_merge($nav, ['collectionId'=>$collectionId]));
                    $premiumView->render();
                    break;
                default:
                    throw new RequestException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
             http_response_code($e->getCode());
             exit;
        }          
    }
    public function book($params=null){
        if (!isset($_SESSION['username'])) {
            http_response_code(301);
            header("Location: /user/login", true, 301);
            exit;
        }
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $bookId = (int)$params;
                    // User
                    if(isset($_SESSION['username'])){
                        $userData = $this->model('UserModel');
                        $user = $userData->getUserByUsername($_SESSION['username']);
                        $username = $user['username'];
                        $nav = ['username'=>$username];
                    }else{
                        $nav = ['username'=>null];
                    }
                    $premiumView = $this->view('premium', 'PremiumBookDetailView',array_merge($nav, ['bookId'=>$bookId]));
                    $premiumView->render();
                    break;
                default:
                    throw new RequestException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
             http_response_code($e->getCode());
             exit;
        }          
    }
    
}
