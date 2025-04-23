<?php
class LoginController extends Controller {
    private $pageTpl = '/views/login.tpl.php';
    public function __construct() {
        $this->model = new LoginModel();
        $this->view = new View();
    }

    public function index() {
        $this->pageData['title'] = 'Вход';

        if(!empty($_POST)) {
            $login = $_POST['login'];
            $password =$_POST['password'];

            if($this->checklogin($login, $password)){
                header("Location: /main");
            }
            else{
                $this->pageData['error'] = "Неверный логин или пароль";
            }
		}

        $this->view->render($this->pageTpl, $this->pageData);
    }

    public function checklogin($login, $password) {
		return $this->model->checklogin($login, $password);
    }
}