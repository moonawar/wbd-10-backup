<?php

class AuthorController extends Controller implements ControllerInterface
{
    private AuthorModel $model;
    public function __construct() {
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

    // public function addAuthor() {
    //     $addAuthorView = $this->view('admin', 'AddAuthorView');
    //     $addAuthorView->render();   
    // }

    // public function addGenre() {
    //     $addGenreView = $this->view('admin', 'AddGenreView');
    //     $addGenreView->render();   
    // }
}
