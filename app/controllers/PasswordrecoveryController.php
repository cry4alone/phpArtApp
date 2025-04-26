<?php
use PHPMailer\PHPMailer\Exception;
class PasswordrecoveryController extends Controller {
    private $pageTpl = '/views/passwordrecovery.tpl.php';
    public function __construct() {
        $this->model = new PasswordrecoveryModel();
        $this->view = new View();
    }

    public function index() {
        if(isset($_SESSION['isUserVerify']) && $_SESSION['isUserVerify'] === true){
            $email = $_SESSION["reset-password-email"];
            $newpassword = $_SESSION["newpassword"];
            $this->model->resetUserPassword($email, $newpassword);
            unset($_SESSION['isUserVerify']);
            unset( $_SESSION['verifyCode']);
            unset( $_SESSION['reset-password-email']);
            unset( $_SESSION['newpassword']);
            header("Location: /login");
            exit;
        }

        $this->pageData['title'] = 'Восстановление пароля';
        $this->view->render($this->pageTpl, $this->pageData);
    }

    public function resetpassword() {
        if(!empty($_POST) && !empty($_POST['email']) && !empty($_POST['newpassword'])){
            $email = $_POST['email'];
            $newpassword = $_POST['newpassword'];
            if(!$this->model->emailIsUse($email)){
                $_SESSION['error'] = 'Данный email не используется';
                header("Location: /passwordrecovery");
                exit;
            }
            else{
                $_SESSION["reset-password-email"] = $email;
                $_SESSION["newpassword"] = $newpassword;

                try {
                    $code = sendVerifyCode($email);
                    $_SESSION['verifyCode'] = [
                        'code' => $code,
                        'expires_at' => time() + 300
                ];
                } catch (Exception $e) {
                    $_SESSION['error'] = $e->errorMessage();
                    header("Location: /passwordrecovery");
                    exit;
                }

                header("Location: /passwordrecovery/codeverify");
                exit;
            }
        }
        $_SESSION['error'] = 'Не все необходимые поля заполнены';
        header("Location: /passwordrecovery");
    }
}