<?php

class AuthorController extends Controller implements ControllerInterface
{
    private AuthorModel $model;
    public function __construct() {
        require_once __DIR__ . '/../models/UserRole.php';
        $this->model  = $this->model('AuthorModel');
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
                    $addBookView = $this->view('admin', 'AddAuthorView');
                    $addBookView->render();
                    break;
                case 'POST':
                    $authorName = $_POST['author-name'];
                    $authorAge = (int)$_POST['author-age'];
                    
                    $this->model->addAuthor($authorName, $authorAge);

                    header("Location: /author/update", true, 301);
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
                        $author_id = $params;

                        if (!$this->model->authorExist($author_id)) {
                            header("Location: /author/update", true, 301);
                            exit;
                        }

                        $author = $this->model->getAuthorById($author_id);

                        $editAuthorView = $this->view('admin', 'UpdateAuthorView', 
                        [
                            'author_id' => $author_id, 'full_name' => $author['full_name'],
                            'age' => $author['age']
                        ]);
                        $editAuthorView->render();

                        exit;
                    }

                    $editView = $this->view('admin', 'UpdateAuthorView', 
                    ['authors' => $this->model->getAuthors($page, 10),
                    'page' => $page, 'totalPages' => $this->model->getTotalPages(10)]);
                    $editView->render(); 

                    break;
                case 'POST':
                    if (isset($params)) { // editing specific user
                        $author_id = $params;
                        $newName = $_POST['full_name'];
                        $newAge = $_POST['age'];

                        $succ = $this->model->updateAuthor($author_id, $newName, $newAge);
                        if ($succ) {
                            header("Location: /author/update", true, 301);
                        }
                        
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
                        $author_id = $params;

                        if (!$this->model->authorExist($author_id)) {
                            header("Location: /author/update", true, 301);
                            exit;
                        }

                        $author = $this->model->getAuthorById($author_id);

                        $deleteAuthorView = $this->view('admin', 'DeleteAuthorView', 
                        [
                            'author_id' => $author_id, 'full_name' => $author['full_name'],
                            'age' => $author['age']
                        ]);
                        $deleteAuthorView->render();

                        exit;
                    }

                    break;
                case 'POST':
                    if (isset($params)) { // editing specific author
                        $id = $params;
                        
                        $succ = $this->model->deleteAuthor($id);
                        
                        if ($succ) {
                            header("Location: /author/update", true, 301);
                        }
                        
                        echo "Failed to delete author";
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
