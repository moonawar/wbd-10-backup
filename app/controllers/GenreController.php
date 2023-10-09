<?php

class GenreController extends Controller implements ControllerInterface
{
    private GenreModel $model;
    public function __construct() {
        require_once __DIR__ . '/../models/UserRole.php';
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
                        $genre = $this->model->getGenreById($id);

                        if (!$genre) {
                            header("Location: /genre/update", true, 301);
                            exit;
                        }

                        $editGenreView = $this->view('admin', 'UpdateGenreView', 
                        ['name' => $genre['name'], 'genre_id' => $genre['genre_id']]);
                        $editGenreView->render();

                        exit;
                    }

                    $editView = $this->view('admin', 'UpdateGenreView', 
                    ['genres' => $this->model->getGenres($page, 10),
                    'page' => $page, 'totalPages' => $this->model->getTotalPages(10)]);
                    $editView->render(); 

                    break;
                case 'POST':
                    if (isset($params)) { // editing specific user
                        $genre_id = $params;
                        $newName = $_POST['name'];

                        $succ = $this->model->updateGenre($genre_id, $newName);
                        if ($succ) {
                            header("Location: /genre/update", true, 301);
                        }
                        
                        break;
                    }

                default:
                    throw new RequestException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }          
    }
    public function delete($params = null) {
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
                    
                    if (isset($params)) {
                        $genre_id = $params;

                        $genre = $this->model->getGenreById($genre_id);

                        if (!$genre) {
                            header("Location: /genre/update", true, 301);
                            exit;
                        }


                        $deleteGenreView = $this->view('admin', 'DeleteGenreView', 
                        [
                            'genre_id' => $genre_id, 'name' => $genre['name']
                        ]);
                        $deleteGenreView->render();

                        exit;
                    }

                    break;
                case 'POST':
                    if (isset($params)) { // editing specific genre
                        $id = $params;
                        
                        $succ = $this->model->deleteGenre($id);
                        
                        if ($succ) {
                            header("Location: /genre/update", true, 301);
                        }
                        
                        echo "Failed to delete genre";
                        break;
                    }

                    $notFoundView = $this->view('not-found', 'NotFoundView');
                    $notFoundView->render();

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
