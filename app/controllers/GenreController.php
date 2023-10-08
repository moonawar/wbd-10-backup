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

    // public function addAuthor() {
    //     $addAuthorView = $this->view('admin', 'AddAuthorView');
    //     $addAuthorView->render();   
    // }

    // public function addGenre() {
    //     $addGenreView = $this->view('admin', 'AddGenreView');
    //     $addGenreView->render();   
    // }
}
