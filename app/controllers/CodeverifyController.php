<?php
class CodeverifyController extends Controller {
    private $pageTpl = '/views/codeverify.tpl.php';
    public function __construct() {
        $this->model = new CodeverifyModel();
        $this->view = new View();
    }

    public function index() {
        $this->pageData['title'] = 'Подтверждение почты';

        $requestUri = $_SERVER['REQUEST_URI'];
        $this->pageData['actionUrl'] = $requestUri . "/checkcode";

        $this->view->render($this->pageTpl, $this->pageData);
    }

    public function checkcode() {
        $requestUri = $_SERVER['REQUEST_URI'];
        $uriParts = explode('/', trim($requestUri, '/'));
        array_splice($uriParts, -2);
        $previousSegmentURL = '/' . implode('/', $uriParts);
        $currControllerURL = $previousSegmentURL . "/codeverify";

        if(!empty($_POST) && !empty($_POST['code'])){
            $code = $_POST['code'];
            if (isset($_SESSION['verifyCode'])) {
                if (time() > $_SESSION['verifyCode']['expires_at']) {
                    unset($_SESSION['verifyCode']);
                    $_SESSION['error'] = 'Неверный код';
                    header("Location: $currControllerURL");
                    exit;
                } else {
                    if($code == $_SESSION['verifyCode']['code']) {
                        $_SESSION['isUserVerify'] = true;
                        header("Location: $previousSegmentURL");
                    }
                    else {
                        $_SESSION['error'] = 'Неверный код';
                        header("Location: $currControllerURL");
                    }
                    exit;
                }
            }
        }
        $_SESSION['error'] = 'Неверный код';
        header("Location: $currControllerURL");
        exit;
    }
}