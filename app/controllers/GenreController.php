<?php

class GenreController extends Controller implements ControllerInterface
{
    private GenreModel $model;
    public function __construct() {
        $this->model  = $this->model('GenreModel');
    }
    public function index()
    {
        $notFoundView = $this->view('not-found', 'NotFoundView');
        $notFoundView->render();
    }

    public function add() 
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // show the register page
                    $addGenreView = $this->view('admin', 'AddGenreView');
                    $addGenreView->render();
                    break;
                case 'POST':
                    $name = $_POST['genre'];

                    $this->model->createGenre($name);

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

    public function update($params = null) {
        if (!isset($_SESSION['username'])) {
            http_response_code(301);
            header("Location: /user/login", true, 301);
            exit;
        }
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    if ($_SESSION['role'] != 'admin') {
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
                        $id = (int)$params;
                        $name = $this->model->getGenreById($id);

                        if (!$this->model->getGenreById($id)) {
                            header("Location: /genre/update", true, 301);
                            exit;
                        }

                        $editGenreView = $this->view('admin', 'UpdateGenreView', 
                        ['name' => $name]);
                        $editGenreView->render();

                        exit;
                    }

                    $editView = $this->view('admin', 'UpdateGenreView', 
                    ['genres' => $this->model-> getAllGenres($page, 10),
                    'page' => $page, 'totalPages' => $this->model->getTotalPages(10)]);
                    $editView->render(); 

                    break;
                case 'POST':
                    $name = $_POST['genre'];         
                    $this->model->createGenre(
                        $name
                    );
                
                    http_response_code(301);
                    header("Location: /genre/", true, 301);

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
    // public function addAuthor() {
    //     $addAuthorView = $this->view('admin', 'AddAuthorView');
    //     $addAuthorView->render();   
    // }

    // public function addGenre() {
    //     $addGenreView = $this->view('admin', 'AddGenreView');
    //     $addGenreView->render();   
    // }
}
