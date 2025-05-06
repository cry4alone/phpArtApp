<?php
class MainController extends Controller {
    private $pageTpl = '/views/main.tpl.php';
    public function __construct() {
        $this->model = new MainModel();
        $this->view = new View();
    }

    public function index() {
        $createdBy = $_GET['createdBy'] ?? null;
        $date = $_GET['date'] ?? null;
        $search = $_GET['search'] ?? null;
        $this->getImages($createdBy, $date, $search);

        $this->pageData['title'] = 'Главная';
        $this->pageData['createdBy'] = $createdBy;
        $this->pageData['date'] = $date;
        $this->pageData['search'] = $search;
        $this->view->renderLayout($this->pageTpl, $this->pageData);
    }

    public function getImages($createdBy, $date, $search) {


        $this->pageData['images'] = $this->model->getImages($createdBy, $date, $search);
    }
}