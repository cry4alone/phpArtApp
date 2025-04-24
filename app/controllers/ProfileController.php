<?php
Class ProfileController extends Controller {
    private $pageTpl = '/views/profile.tpl.php';
    public function __construct() {
        $this->model = new ProfileModel();
        $this->view = new View();
    }
    
    public function index() {

        $this->checkCookie();

        $this->pageData['title'] = 'Профиль';
        $this->pageData['login'] = $_SESSION['login'];
        $this->pageData['email'] = $_SESSION['email'];
        $this->view->renderLayout($this->pageTpl,$this->pageData);
    }

    public function logout() {
        unset($_SESSION['login']);
        unset($_SESSION['email']);
        header('Location: /login');
        exit;
    }

    private function checkCookie() {
        if (!isset($_SESSION['login'])) {
            header('Location: /login');
            exit;
        }
    }
}