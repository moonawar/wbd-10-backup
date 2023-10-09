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
            header("Location: /user/logout", true, 301);
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
                
                if ($valid) {
                    // $res = SessionManager::getInstance()->login($username, $valid);
                    $_SESSION['username'] = $username;
                    $_SESSION['role'] = $this->model->getUserRole($username);
                    
                    header("Location: /book/", true, 301);

                    exit;
                } else {
                    $data = [
                        'error' => 'Invalid username or password'
                    ];

                    $loginView = $this->view('user', 'LoginView', $data);
                    $loginView->render();
                }

                break;
        }
    }

    public function register() {
        if (isset($_SESSION['username'])) {
            http_response_code(301);
            header("Location: /book/", true, 301);
            exit;
        }

        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // show the register page
                    $registerView = $this->view('user', 'RegisterView');
                    $registerView->render();  
                    break;
                case 'POST':
                    $username = $_POST['username'];

                    $uploadedImage = PROFILE_PIC_BASE;
                    
                    if (isset($_FILES['profile-pic'])) {
                        $fileHandler = new FileHandler();
                        
                        $imageFile = $_FILES['profile-pic']['tmp_name'];
                        
                        $uploadedImage = $fileHandler->saveImageTo($imageFile, $_POST['username'], PROFILE_PIC_PATH);
                    }

                    $email = $_POST['email'];
                    $pass = $_POST['password'];
                    
                    $this->model->addUser(
                        $username, $email, UserRole::Customer, $pass, $uploadedImage
                    );
                
                    http_response_code(301);
                    header("Location: /book/", true, 301);

                    exit;

                default:
                    throw new RequestException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }          
    }

    public function logout() {
        if (!isset($_SESSION['username'])) {
            http_response_code(301);
            header("Location: /user/login", true, 301);
            exit;
        }

        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $logoutView = $this->view('user', 'LogoutView');
                    $logoutView->render();

                    break;
                case 'POST':
                    // show the register page
                    SessionManager::getInstance()->logout();
                    
                    http_response_code(301);
                    header("Location: /user/login", true, 301);
                    
                    break;
                default:
                    throw new RequestException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }

    public function update($params = null) {
        if (!isset($_SESSION['username'])) {
            http_response_code(301);
            header("Location: /user/login", true, 301);
            exit;
        }
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    if ($_SESSION['role'] != UserRole::Admin) {
                        $unauthorizedView = $this->view('.', 'UnauthorizedView');
                        $unauthorizedView->render();
                        exit;   
                    }

                    if(!isset($_GET['page'])) {
                        $page = 1;
                    } else {
                        $page = $_GET['page'];
                    }

                    $_SESSION['page'] = $page;
                    
                    if (isset($params)) {
                        $username = $params;

                        if (!$this->model->userExists($username)) {
                            header("Location: /user/update", true, 301);
                            exit;
                        }

                        $editUserView = $this->view('admin', 'UpdateUserView', 
                        ['username' => $username,'role' => $this->model->getUserRole($username)]);
                        $editUserView->render();

                        exit;
                    }

                    $editView = $this->view('admin', 'UpdateUserView', 
                    ['users' => $this->model-> getUsers($page, 10),
                    'page' => $page, 'totalPages' => $this->model->getTotalPages(10)]);
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
                    header("Location: /book/", true, 301);

                    exit;
                case 'PATCH':
                    if ($_SESSION['role'] != UserRole::Admin) {
                        $unauthorizedView = $this->view('.', 'UnauthorizedView');
                        $unauthorizedView->render();
                        exit;   
                    }

                    $username = $params;
                    $role = $_POST['role'];

                    $this->model->updateRole($username, $role);

                    http_response_code(301);
                    header("Location: /user/update", true, 301);

                    exit;

                default:
                    throw new RequestException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }          
    }

    public function exists() {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $username = $_GET['username'];

                    $exists = $this->model->userExists($username);
                    
                    header('Content-Type: application/json');

                    if ($exists) {
                        $resp = ['exists' => true];
                    } else {
                        $resp = ['exists' => false];
                    }

                    echo json_encode($resp);

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
