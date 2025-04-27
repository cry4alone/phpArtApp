<?php
Class ProfileController extends Controller {
    private $pageTpl = '/views/profile.tpl.php';
    public function __construct() {
        $this->model = new ProfileModel();
        $this->view = new View();
    }
    
    public function index() {

        $this->checkCookie();
        $this->getUserImages();

        $this->pageData['title'] = 'Профиль';
        $this->pageData['login'] = $_SESSION['login'];
        $this->pageData['email'] = $_SESSION['email'];
        $this->view->renderLayout($this->pageTpl,$this->pageData);
    }

    public function logout() {
        unset($_SESSION['login']);
        unset($_SESSION['email']);
        header('Location: /login');
        exit;
    }

    private function checkCookie() {
        if (!isset($_SESSION['login'])) {
            header('Location: /login');
            exit;
        }
    }

    public function addNewPost() {
        $allowed_types = ["jpg", "png"];
        $file_extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

        if(!in_array($file_extension, $allowed_types)) {
            $_SESSION['error'] = "Неверный тип файла";
            header("Location: /profile");
            exit;
        }

        $filename = uniqid() . "." . $file_extension;

        move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . "/public/images/uploads/" . $filename);

        $title = $_POST['title'];
        $description = $_POST['description'];

        $this->model->addImage($filename, $title, $description);
        $this->getUserImages();
    }

    public function getUserImages() {
        $this->pageData['images'] = $this->model->getUserImages();
    }
}