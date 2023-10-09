<?php

class UserController extends Controller implements ControllerInterface
{
    private UserModel $model;
    public function __construct() {
        require_once __DIR__ . '/../models/UserRole.php';
        $this->model  = $this->model('UserModel');
    }

    public function index()
    {
        $notFoundView = $this->view('not-found', 'NotFoundView');
        $notFoundView->render();
    }

    public function login() 
    {
        if (isset($_SESSION['username'])) {
            http_response_code(301);
            header("Location: /home/", true, 301);
            exit;
        }

        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                // show the login page
                $loginView = $this->view('user', 'LoginView');
                $loginView->render();  
                break;
            case 'POST':
                // login the user
                $username = $_POST['username'];
                $pass = $_POST['password'];

                $valid = $this->model->verifyUser($username, $pass);
                echo $valid;

                // $user = $this->model->getUser($username, $pass);

                // if ($user) {
                //     SessionManager::getInstance()->login($user->username, $user->role);
                //     http_response_code(301);
                //     header("Location: /home/", true, 301);
                //     exit;
                // } else {
                //     $loginView = $this->view('user', 'LoginView');
                //     $loginView->render();  
                // }
                break;
        }
    }

    public function register() {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // show the register page
                    $registerView = $this->view('user', 'RegisterView');
                    $registerView->render();  
                    break;
                case 'POST':

                    $uploadedImage = PROFILE_PIC_BASE;
                    
                    if (isset($_FILES['profile-pic'])) {
                        $fileHandler = new FileHandler();
                        
                        $imageFile = $_FILES['profile-pic']['tmp_name'];
                        
                        $uploadedImage = $fileHandler->saveImageTo($imageFile, $_POST['username'], PROFILE_PIC_PATH);
                    }

                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $pass = $_POST['password'];
                    
                    $this->model->addUser(
                        $username, $email, UserRole::Customer, $pass, $uploadedImage
                    );
                
                    http_response_code(301);
                    header("Location: /home/", true, 301);

                    exit;

                default:
                    throw new RequestException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }          
    }

    public function edit() {
        if (!isset($_SESSION['username'])) {
            http_response_code(301);
            header("Location: /user/login", true, 301);
            exit;
        }
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    if ($_SESSION['role'] != UserRole::Admin) {
                        $unauthorizedView = $this->view('', 'UnauthorizedView');
                        $unauthorizedView->render();
                        exit;   
                    }
                    
                    $editView = $this->view('user', 'EditView');
                    $editView->render();  
                    break;
                case 'POST':
                    $uploadedImage = PROFILE_PIC_BASE;
                    
                    if (isset($_FILES['profile-pic'])) {
                        $fileHandler = new FileHandler();
                        
                        $imageFile = $_FILES['profile-pic']['tmp_name'];
                        
                        $uploadedImage = $fileHandler->saveImageTo($imageFile, $_POST['username'], PROFILE_PIC_PATH);
                    }

                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $pass = $_POST['password'];
                    
                    $this->model->addUser(
                        $username, $email, UserRole::Customer, $pass, $uploadedImage
                    );
                
                    http_response_code(301);
                    header("Location: /home/", true, 301);

                    exit;

                default:
                    throw new RequestException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }          
    }
}
