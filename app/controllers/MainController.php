<?php
class MainController extends Controller {
    private $pageTpl = '/views/main.tpl.php';
    public function __construct() {
        $this->model = new MainModel();
        $this->view = new View();
    }

    public function index() {
        $this->getImages();

        $this->pageData['title'] = 'Главная';
        $this->view->renderLayout($this->pageTpl, $this->pageData);
    }

    public function getImages() {
        $this->pageData['images'] = $this->model->getImages();
    }
}