<?php
class PasswordrecoveryController extends Controller {
    private $pageTpl = '/views/passwordrecovery.tpl.php';
    public function __construct() {
        $this->model = new PasswordrecoveryModel();
        $this->view = new View();
    }

    public function index() {
        $this->pageData['title'] = 'Восстановление пароля';
        $this->view->render($this->pageTpl, $this->pageData);
    }
}