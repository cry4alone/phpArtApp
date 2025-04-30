<?php

class ProfileController extends Controller {
    private $pageTpl = '/views/profile.tpl.php';
    private $allowedFileTypes = ["jpg", "png"];

    public function __construct() {
        $this->model = new ProfileModel();
        $this->view = new View();
    }

    public function index() {
        $user = $this->model->getUser($_SESSION['login']);
        $this->pageData['pathToAvatar'] =  "/public/images/icons/person-circle.svg";
        if(!empty($user) && !empty($user['pathtoavatar'])) {
            $this->pageData['pathToAvatar'] = $user['pathtoavatar'];
        }
        
        $this->checkCookie();
        $this->preparePageData();
        $this->view->renderLayout($this->pageTpl, $this->pageData);
    }

    public function logout() {
        $this->clearSession();
        $this->redirect('/login');
    }

    public function addNewPost() {
        try {
            $this->validateFileUpload();
            $filename = $this->saveUploadedFile();

            $title = trim($_POST['title']);
            $description = trim($_POST['description']);

            $this->validatePostData($title, $description);

            $userId = $this->getUserId();
            $success = $this->model->addImage($filename, $title, $description, $userId);

            if (!$success) {
                throw new Exception('Не удалось добавить изображение');
            }

            $_SESSION['success'] = 'Пост успешно добавлен';
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        }

        $this->redirect('/profile');
    }

    public function editPost() {
        try {
            $id = (int)$_POST['id'];
            $title = trim($_POST['title']);
            $description = trim($_POST['description']);

            $this->validatePostData($title, $description);

            $success = $this->model->editPost($title, $description, $id);
            if (!$success) {
                throw new Exception('Ошибка при сохранении изменений');
            }

            $_SESSION['success'] = 'Изменения сохранены';
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        }

        $this->redirect('/profile');
    }

    public function deletePost() {
        $id = $this->validateId($_POST['id']);
        try {
            $success = $this->model->deletePost($id);
            
            if (!$success) {
                throw new Exception('Ошибка при удалении изображения');
            }

            $_SESSION['success'] = 'Пост успешно удален';
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        }

        $this->redirect('/profile');
    }

    public function changePostVisibility() {
        $id = $this->validateId($_POST['id']);
        try {
            $success = $this->model->changePostVisibility($id);
            if (!$success) {
                throw new Exception('Ошибка при изменении видимости изображния');
            }
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        }

        $this->redirect('/profile');
    }

    private function checkCookie() {
        if (!isset($_SESSION['login'])) {
            $this->redirect('/login');
        }
    }

    private function preparePageData() {
        $this->pageData['title'] = 'Профиль';
        $this->pageData['login'] = $_SESSION['login'];
        $this->pageData['email'] = $_SESSION['email'];
        $this->pageData['images'] = $this->model->getUserImages($this->getUserId());
    }

    private function clearSession() {
        unset($_SESSION['login']);
        unset($_SESSION['email']);
    }

    private function validateFileUpload() {
        if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('Ошибка загрузки файла');
        }

        $fileExtension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        if (!in_array(strtolower($fileExtension), $this->allowedFileTypes)) {
            throw new Exception('Недопустимый тип файла');
        }
    }

    private function saveUploadedFile(): string {
        $fileExtension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . "." . $fileExtension;

        $uploadPath = $_SERVER['DOCUMENT_ROOT'] . "/public/images/uploads/" . $filename;
        if (!move_uploaded_file($_FILES['file']['tmp_name'], $uploadPath)) {
            throw new Exception('Не удалось сохранить файл');
        }

        return $filename;
    }

    private function validatePostData(string $title, string $description) {
        if (empty($title) || empty($description)) {
            throw new Exception('Все поля обязательны для заполнения');
        }
    }

    private function validateId($id): int {
        $id = (int)$id;
        if ($id <= 0) {
            throw new Exception('Некорректный ID');
        }
        return $id;
    }

    private function getUserId(): int {
        return (int)($_SESSION['id'] ?? 0);
    }

    private function redirect(string $url) {
        header("Location: $url");
        exit;
    }
}