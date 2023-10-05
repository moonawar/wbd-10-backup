<?php

class HomeController extends Controller implements ControllerInterface
{
    public function index()
    {
        $homeView = $this->view('home', 'HomeView');
        $homeView->render();
    }
}
