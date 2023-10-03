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
        // $userModel = $this->model('UserModel');
        // $result = $userModel->getAllUsers();

        $loginView = $this->view('user', 'LoginView');
        $loginView->render();
    }

    public function register() {
        $registerView = $this->view('user', 'RegisterView');
        $registerView->render();   
    }
}
