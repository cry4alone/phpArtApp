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
        $currentPage = (int)($_GET['page'] ?? 1);
        $perPage = 12;
        $result = $this->model->getImages($createdBy, $date, $search, $currentPage, $perPage);
        $this->pageData['images'] = $result['images'];
        $this->pageData['lastPage'] = $result['lastPage'];

        $this->pageData['title'] = 'Pixels';
        $this->pageData['queryParams'] = $_GET;
        $this->pageData['currentPage'] = $currentPage;
        $this->pageData['createdBy'] = $createdBy;
        $this->pageData['date'] = $date;
        $this->pageData['search'] = $search;
        $this->pageData['basePage'] = '/main';
        $this->view->renderLayout($this->pageTpl, $this->pageData);
    }
}