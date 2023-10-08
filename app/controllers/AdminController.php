<?php

class AdminController extends Controller implements ControllerInterface
{
    public function index()
    {
        $notFoundView = $this->view('not-found', 'NotFoundView');
        $notFoundView->render();
    }

    public function addBook() 
    {
        $addBookView = $this->view('admin', 'AddBookView');
        $addBookView->render();
    }

    public function addAuthor() {
        $addAuthorView = $this->view('admin', 'AddAuthorView');
        $addAuthorView->render();   
    }

    public function addGenre() {
        $addGenreView = $this->view('admin', 'AddGenreView');
        $addGenreView->render();   
    }
}
