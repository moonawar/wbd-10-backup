<?php

class PremiumController extends Controller implements ControllerInterface
{
    private AuthorModel $model;
    public function __construct() {
        require_once __DIR__ . '/../models/UserRole.php';
        $this->model  = $this->model('AuthorModel');
    }
    // TODO: PARAMS ROUTING
    public function index()
    {
        $premiumView = $this->view('premium', 'PremiumView');
        $premiumView->render();
    }
    public function detail()
    {
        $premiumView = $this->view('premium', 'CollectionDetailView');
        $premiumView->render();
    }
    public function book()
    {
        $premiumView = $this->view('premium', 'PremiumBookDetailView');
        $premiumView->render();
    }
    
}
