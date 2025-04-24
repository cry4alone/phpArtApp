<?php
class LoginController extends Controller {
    private $pageTpl = '/views/login.tpl.php';
    public function __construct() {
        $this->model = new LoginModel();
        $this->view = new View();
    }

    public function index() {
        $this->pageData['title'] = 'Вход';
        $this->view->render($this->pageTpl, $this->pageData);
    }

    public function checklogin() {
        if(!empty($_POST)) {
            $login = $_POST['login'];
            $password =$_POST['password'];

            if($this->model->checklogin($login, $password)){
                header("Location: /main");
                exit;
            }
            else{
                $_SESSION['error'] = 'Неверный логин или пароль';
                header("Location: /login");
                exit;
            }
		}
    }
}