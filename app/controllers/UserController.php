<?php

class UserController extends Controller implements ControllerInterface
{
    public function index()
    {
        $notFoundView = $this->view('not-found', 'NotFoundView');
        $notFoundView->render();
    }

    public function login() 
    {
        $loginView = $this->view('user', 'LoginView');
        $loginView->render();
    }
}
