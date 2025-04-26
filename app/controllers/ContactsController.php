<?php
class ContactsController extends Controller {
    private $pageTpl = "/views/contacts.tpl.php";

    public function __construct() {
        $this->model = new ContactsModel();
        $this->view = new View();
    }
    public function index() {
        $this->pageData['title'] = "Контакты";
        $this->view->renderLayout($this->pageTpl, $this->pageData);
    }
    
}