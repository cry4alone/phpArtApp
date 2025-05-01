<?php
use PHPMailer\PHPMailer\Exception;
class RegistrationController extends Controller {
    private $pageTpl = '/views/registration.tpl.php';
    public function __construct() {
        $this->model = new RegistrationModel();
        $this->view = new View();
    }

    public function index() {
        if (isset($_SESSION['isUserVerify']) && $_SESSION['isUserVerify'] === true) {
            $email = $_SESSION["registration-email"];
            $login = $_SESSION["registration-login"];
            $password = $_SESSION["registration-password"];
    
            $avatarPath = null;
    
            if (!empty($_SESSION["tempPathToAvatar"])) {
                $filename = basename($_SESSION["tempPathToAvatar"]);
                $avatarsDir = $_SERVER['DOCUMENT_ROOT'] . "/public/images/uploads/avatars/" . $filename;
    
                if (rename($_SESSION["tempPathToAvatar"], $avatarsDir)) {
                    $avatarPath = "/public/images/uploads/avatars/" . $filename;
                }
            }
    
            $this->model->addNewUser($email, $login, $password, $avatarPath);
    
            unset($_SESSION['isUserVerify']);
            unset($_SESSION['verifyCode']);
            unset($_SESSION['registration-email']);
            unset($_SESSION['registration-login']);
            unset($_SESSION['registration-password']);
            unset($_SESSION['registration_form_data']);
            unset($_SESSION["tempPathToAvatar"]);
    
            header("Location: /login");
            exit;
        }
    
        $this->pageData['title'] = 'Регистрация';
        $this->view->render($this->pageTpl, $this->pageData);
    }
    

    public function checkuser() {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $_SESSION['registration_form_data'] = $_POST;

            if(!empty($_POST) && !empty($_POST['email']) && !empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['password-retry'])) {
                $email = $_POST['email'];
                $login = $_POST['login'];
                $password = $_POST['password'];
                $passwordRetry = $_POST['password-retry'];
    
                if($password != $passwordRetry){
                    $_SESSION['error'] = 'Пароли не совпадают';
                    header("Location: /registration");
                    exit;
                }

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $_SESSION['error'] = 'Некорректный email';
                    header("Location: /registration");
                    exit;
                }

                if(strlen($password) < 5){
                    $_SESSION['error'] = 'Пароль не может быть меньше 5 символов';
                    header("Location: /registration");
                    exit;
                }

                if($this->model->emailIsUse($email)){
                    $_SESSION['error'] = 'Данный email уже используется';
                    header("Location: /registration");
                    exit;
                }
                
                if($this->model->loginIsUse($login)){
                    $_SESSION['error'] = 'Данный логин уже используется';
                    header("Location: /registration");
                    exit;
                }
                else{
                    if(isset($_FILES['avatar']) && $_FILES['avatar']['error'] !== UPLOAD_ERR_NO_FILE){
                        $avatar = $_FILES['avatar'];

                        if ($avatar['error'] !== UPLOAD_ERR_OK) {
                            throw new Exception('Ошибка загрузки файла');
                        }

                        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/public/images/uploads/tmp/";
                        $filePath = $uploadDir . uniqid('avatar_', true) . '.' . pathinfo($avatar['name'], PATHINFO_EXTENSION);

                        if (!move_uploaded_file($avatar['tmp_name'], $filePath)) {
                            $_SESSION['error'] = 'Не удалось загрузить аватар';
                        }

                        $_SESSION["tempPathToAvatar"] = $filePath;
                    }

                    $_SESSION["registration-email"] = $email;
                    $_SESSION["registration-login"] = $login;
                    $_SESSION["registration-password"] = password_hash($password, PASSWORD_DEFAULT);
    
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
}