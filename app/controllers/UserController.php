<?php

class UserController extends Controller implements ControllerInterface
{
    private UserModel $model;
    public function __construct(Db $db) {
        require_once __DIR__ . '/../models/UserRole.php';
        $this->model  = $this->model('UserModel', $db);
    }

    public function index()
    {
        $notFoundView = $this->view('not-found', 'NotFoundView');
        $notFoundView->render();
    }

    public function login() 
    {
        // $userModel = $this->model('UserModel');
        // $result = $userModel->getAllUsers();

        $loginView = $this->view('user', 'LoginView');
        $loginView->render();
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
                
                    header("Location: /home", true, 301);
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
