<?php

class ChangeprofileController extends Controller {
    private $pageTpl = "/views/changeprofile.tpl.php";

    public function __construct() {
        $this->model = new ChangeprofileModel();
        $this->view = new View();
    }
    public function index() {
        $this->checkCookie();
        print_r($_SESSION);
        $this->pageData['title'] = "Редактирование профиля";
        $this->view->renderLayout($this->pageTpl, $this->pageData);
    }

    private function checkCookie() {
        if (!isset($_SESSION['login'])) {
            header('Location: /login');
            exit;
        }
    }
    
    public function changedatadismissed() {
        unset($_SESSION['awaitingOldPassword']);
        header("Location: /profile/changeprofile");
        exit;
    }
    public function checkolddata() {
        if(!empty($_POST) && !empty($_POST['email']) && !empty($_POST['login'])){
            $postEmail = $_POST['email'];
            $postLogin = $_POST['login'];
            $_SESSION['changeProfileFormData'] = $_POST;
            $_SESSION['changeProfileDataIsCorrect'] = true;
            $dataIsChanged = false;

            if($postEmail != $_SESSION['email']){
                if (!filter_var($postEmail, FILTER_VALIDATE_EMAIL)) {
                    $_SESSION['changeProfileDataIsCorrect'] = false;
                    $_SESSION['error'] = 'Некорректный email';
                    header("Location: /profile/changeprofile");
                    exit;
                }
                else if($this->model->emailIsUse($postEmail)){
                    $_SESSION['changeProfileDataIsCorrect'] = false;
                    $_SESSION['error'] = 'Данный email уже используется';
                    header("Location: /profile/changeprofile");
                    exit;
                }

                $dataIsChanged = true;
            }

            if($postLogin != $_SESSION['login']){
                $dataIsChanged = true;
            }

            if(!empty($_POST['newPassword'])){
                $newPassword = $_POST['newPassword'];
                $confirmPassword = $_POST['confirmPassword'];

                if($newPassword != $confirmPassword) {
                    $_SESSION['changeProfileDataIsCorrect'] = false;
                    $_SESSION['error'] = 'Пароли не совпадают';
                    header("Location: /profile/changeprofile");
                    exit;
                }

                if(strlen($newPassword) < 5){
                    $_SESSION['changeProfileDataIsCorrect'] = false;
                    $_SESSION['error'] = 'Пароль не может быть меньше 5 символов';
                    header("Location: /profile/changeprofile");
                    exit;
                }
                $dataIsChanged = true;
            }

            if($dataIsChanged && $_SESSION['changeProfileDataIsCorrect'] === true){
                $_SESSION['awaitingOldPassword'] = true;
            }
        }
        header("Location: /profile/changeprofile");
    }

    public function checkoldpassword() {
        unset($_SESSION['awaitingOldPassword']);

        if(!empty($_POST) && !empty($_POST['oldPassword'])){
            $oldPassword = $_POST['oldPassword'];
            if ((password_verify($oldPassword, $_SESSION['password']))) {
                if (isset($_SESSION['changeProfileDataIsCorrect']) && $_SESSION['changeProfileDataIsCorrect'] === true){

                    $result = $this->model->updateLoginAndEmail($_SESSION['login'], $_SESSION['changeProfileFormData']['login'],
                            $_SESSION['changeProfileFormData']['email']);
                    $this->checkResult( $result);

                    $_SESSION['email'] = $_SESSION['changeProfileFormData']['email'];
                    $_SESSION['login'] = $_SESSION['changeProfileFormData']['login'];

                    $newPassword = $_SESSION['changeProfileFormData']['newPassword'];
                    if(!empty($newPassword)){
                        $hashNewPassword = password_hash($_SESSION['changeProfileFormData']['newPassword'], PASSWORD_DEFAULT);
                        $_SESSION['password'] = $hashNewPassword;
                        $result = $this->model->updatePassword($_SESSION['login'],$hashNewPassword);
                        $this->checkResult( $result);
                    }

                    unset($_SESSION['changeProfileFormData']);
                    unset($_SESSION['changeProfileDataIsCorrect']);
                    $_SESSION['success'] = 'Данные успешно обновлены';
                    header("Location: /profile/changeprofile");
                    exit;
                }
            }
            $_SESSION['error'] = 'Пароли не совпадают';
        }
        header("Location: /profile/changeprofile");
    }

    private function checkResult($result) {
        if (!$result) {
            $_SESSION['error'] = 'Не удалось обновить данные.';
            header("Location: /profile/changeprofile");
            exit;
        }
    }
}