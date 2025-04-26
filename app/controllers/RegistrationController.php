<?php
use PHPMailer\PHPMailer\Exception;
class RegistrationController extends Controller {
    private $pageTpl = '/views/registration.tpl.php';
    public function __construct() {
        $this->model = new RegistrationModel();
        $this->view = new View();
    }

    public function index() {
        if(isset($_SESSION['isUserVerify']) && $_SESSION['isUserVerify'] === true){
            $email = $_SESSION["registration-email"];
            $login = $_SESSION["registration-login"];
            $password = $_SESSION["registration-password"];
            $this->model->addNewUser($email, $login, $password);
            unset($_SESSION['isUserVerify']);
            unset( $_SESSION['verifyCode']);
            unset( $_SESSION['registration-email']);
            unset( $_SESSION['registration-login']);
            unset( $_SESSION['registration-password']);
            header("Location: /login");
            exit;
        }

        $this->pageData['title'] = 'Регистрация';
        $this->view->render($this->pageTpl, $this->pageData);
    }

    public function checkuser() {
        if(!empty($_POST) && !empty($_POST['email']) && !empty($_POST['login']) && !empty($_POST['password'])) {
            $email = $_POST['email'];
            $login = $_POST['login'];
            $password = $_POST['password'];
            if($this->model->emailIsUse($email)){
                $_SESSION['error'] = 'Данный email уже используется';
                header("Location: /registration");
                exit;
            }
            else if($this->model->loginIsUse($login)){
                $_SESSION['error'] = 'Данный логин уже используется';
                header("Location: /registration");
                exit;
            }
            else{
                $_SESSION["registration-email"] = $email;
                $_SESSION["registration-login"] = $login;
                $_SESSION["registration-password"] = $password;

                try {
                    $code = sendVerifyCode($email);
                    $_SESSION['verifyCode'] = [
                        'code' => $code,
                        'expires_at' => time() + 300
                ];
                } catch (Exception $e) {
                    $_SESSION['error'] = $e->errorMessage();
                    header("Location: /registration");
                    exit;
                }

                header("Location: /registration/codeverify");
                exit;
            }
		}
        $_SESSION['error'] = 'Не все необходимые поля заполнены';
        header("Location: /registration");
    }
}