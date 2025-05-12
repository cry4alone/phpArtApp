<?php

class ProfileController extends Controller {
    private $pageTpl = '/views/profile.tpl.php';
    private $allowedFileTypes = ["jpg", "png"];

    public function __construct() {
        $this->model = new ProfileModel();
        $this->view = new View();
    }

    public function index() {
        $this->checkCookie();
        $this->pageData['pathToAvatar'] =  "/public/images/icons/person-circle.svg";
        if(!empty($_SESSION['pathToAvatar'])) {
            $this->pageData['pathToAvatar'] = $_SESSION['pathToAvatar'];
        }
        
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

    public function addWatermark() {
        $id = $this->validateId($_POST['id']);
        try {
            $result = $this->model->getImageNameAndOwner($id);
            if (!$result) {
                throw new Exception('Ошибка при получении названия изображения.');
            }

            if (!isset($_SESSION['id']) || $result['user_id'] !== $_SESSION['id']) {
                throw new Exception('Ошибка доступа.');
            }

            $filename = $result['filename'];
            $this->addWatermarkToImage($filename);
            $_SESSION['success'] = 'Водяной знак успешно добавлен.';

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

    private function getTextDimensions($text, $fontSize, $fontPath): array {
        $box = imagettfbbox($fontSize, 0, $fontPath, $text);
        return [
            'width' => $box[2] - $box[0],
            'height' => $box[1] - $box[7],
            'aboveBaseline' => abs($box[7]),
        ];
    }

    private function getMaxTextWidth($lines, $fontSize, $fontPath): int {
        $width = [];
        foreach ($lines as $line) {
            $box = imagettfbbox($fontSize, 0, $fontPath, $line);
            array_push($width, $box[2] - $box[0]);
        }
        return max($width);
    }
    private function addMultipleLineText($image, $lines, $padding, $lineSpacing){
        $lines = array_reverse($lines);
        $fontPath = $_SERVER['DOCUMENT_ROOT'] . "/public/font/Montserrat-SemiBoldItalic.ttf";
        $grey = imagecolorallocatealpha($image, 4, 41, 60, 10);
        $imageWidth = imagesx($image);
        $imageHeight = imagesy($image);

        $fontSize = max(12, intval($imageHeight / 20));
        $maxTextWidth = $this->getMaxTextWidth($lines, $fontSize, $fontPath);
        $textX = $imageWidth - $maxTextWidth - $padding;
        $textY = $imageHeight - $padding;

        $currentTextHeight = null;
        foreach ($lines as $line) {
            imagettftext($image, $fontSize, 0, $textX, $textY, $grey, $fontPath, $line);
            $box = imagettfbbox($fontSize, 0, $fontPath, $line);
            $currentTextHeight = $box[1] - $box[7];
            $textY -= ($currentTextHeight + $lineSpacing);
        }

        $dimentions = [$textX, $imageHeight - $padding, $maxTextWidth, ($imageHeight - $padding) - ($textY+$lineSpacing)];
        return $dimentions;
    }

    private function addWatermarkToImage($filename) {
        $sourceImagePath = $_SERVER['DOCUMENT_ROOT'] . "/public/images/uploads/$filename";

        $login = $_SESSION['login'];
        $watermarkLines = ["Pixels", "$login"];

        $ext = pathinfo($sourceImagePath, PATHINFO_EXTENSION);
        $image = null;
        if ($ext == 'jpg' || $ext == 'jpeg') {
            $image = imagecreatefromjpeg($sourceImagePath);
        } elseif ($ext == 'png') {
            $image = imagecreatefrompng($sourceImagePath);
        } else {
            throw new Exception("Неподдерживаемый формат изображения.");
        }
        $imageHeight = imagesy($image);
        $padding = intval($imageHeight / 25);
        $lineSpacing = intval($padding / 3);

        $textDimentions = $this->addMultipleLineText($image, $watermarkLines, $padding, $lineSpacing);
        $bottomLeftTextX = $textDimentions[0];
        $bottomLeftTextY = $textDimentions[1];
        $textHeight = $textDimentions[3];
    

        $logoPath = $_SERVER['DOCUMENT_ROOT'] . "/public/images/assets/logo_no_padding.png";
        $logo = @imagecreatefrompng($logoPath);
        $logoOrigWidth = imagesx($logo);
        $logoOrigHeight = imagesy($logo);

        $newLogoWidth = $textHeight;
        $newLogoHeight = $textHeight;

        $resizedLogo = imagecreatetruecolor($textHeight, $textHeight);
        imagealphablending($resizedLogo, false);
        imagesavealpha($resizedLogo, true);
        imagecopyresampled(
            $resizedLogo, $logo,
            0, 0, 0, 0,
            $newLogoWidth, $newLogoHeight,
            $logoOrigWidth, $logoOrigHeight
        );

        $logoPadding = intval($padding / 2);
        $logoX = $bottomLeftTextX - $newLogoWidth -  $logoPadding ;
        $logoY = $bottomLeftTextY - $newLogoHeight;

        imagecopy($image, $resizedLogo, $logoX, $logoY, 0, 0, $newLogoWidth, $newLogoHeight);

        imagejpeg($image, $sourceImagePath, 90);

        imagedestroy($image);
        imagedestroy($logo);
        imagedestroy($resizedLogo);
    }

    private function checkCookie() {
        if (!isset($_SESSION['login'])) {
            $_SESSION['redirectAfterLogin'] = $_SERVER['REQUEST_URI'];
            $this->redirect('/login');
        }
    }

    private function preparePageData() {
        $search = $_GET['search'] ?? null;
        $currentPage = (int)($_GET['page'] ?? 1);
        $perPage = 12;
        $this->pageData['queryParams'] = $_GET;
        $this->pageData['currentPage'] = $currentPage;
        $this->pageData['search'] = $search;
        $this->pageData['title'] = 'Профиль';
        $this->pageData['login'] = $_SESSION['login'];
        $this->pageData['email'] = $_SESSION['email'];
        $result = $this->model->getUserImages($this->getUserId(), $search, $currentPage, $perPage);
        $this->pageData['images'] = $result['images'];
        $this->pageData['lastPage'] = $result['lastPage'];
        $this->pageData['basePage'] = '/profile';
    }

    private function clearSession() {
        unset($_SESSION['id']);
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