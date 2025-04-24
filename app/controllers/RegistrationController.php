<?php
class RegistrationController extends Controller {
    private $pageTpl = '/views/registration.tpl.php';
    public function __construct() {
        $this->model = new RegistrationModel();
        $this->view = new View();
    }

    public function index() {
        $this->pageData['title'] = 'Регистрация';
        $this->view->render($this->pageTpl, $this->pageData);
    }

    public function registration() {
        $email = trim($_POST['email']);
        $login = trim($_POST['login']);
        $password = $_POST['password'];
        $password_retry = $_POST['password-retry'];

        if (empty($email) || empty($login) || empty($password) || empty($password_retry)) {
            $_SESSION['error'] = 'Заполните все поля';
            header('Location: /registration');
            exit;
        }

        if (strlen($password) < 6) {
            $_SESSION['error'] = 'Пароль должен быть не менее 6 символов';
            header("Location: /register");
            exit;
        }

        if ($password !== $password_retry) {
            $_SESSION['error'] = 'Пароли не совпадают';
            header("Location: /register");
            exit;
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        try {
            $this->model->addUser($login, $passwordHash, $email);
            header("Location: /login");
            exit;
        }
        catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header("Location: /register");
            exit;
        }
    }

}