<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
$formData = $_SESSION['registration_form_data'] ?? [];
unset($_SESSION['registration_form_data']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $pageData['title']; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</head>
<?php include_once(VIEW_PATH . "/includes/checkerror.tpl.php")?>
<body class="bg-light">
  <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
      <h3 class="text-center mb-4">Регистрация</h3>
      <form id="registration-form" method="post" action="/registration/checkuser" enctype="multipart/form-data">
        <div class="d-flex flex-column align-items-center">
          <img id="profileImage" src="/public/images/icons/upload-photo.svg" alt="Фото профиля" 
          class="img-fluid rounded-circle mb-3 mt-3" style="width: 150px; height: 150px; cursor: pointer;">
          <input type="file" id="avatarInput" name="avatar" class="form-control" style="display: none;" accept="image/*">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email"
           value="<?= htmlspecialchars($formData['email'] ?? '') ?>" placeholder="Введите почту" required>
        </div>
        <div class="mb-3">
          <label for="login" class="form-label">Логин</label>
          <input type="text" class="form-control" id="login" name="login"
          value="<?= htmlspecialchars($formData['login'] ?? '') ?>" placeholder="Введите логин" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Пароль</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Введите пароль" required>
        </div>
        <div class="mb-4">
          <label for="password-retry" class="form-label">Повтор пароля</label>
          <input type="password" class="form-control" id="password-retry" name="password-retry" placeholder="Повторите пароль" required>
        </div>
        <div id="error-message" class="text-danger mb-3" style="display: none;"></div>
        <div class="d-grid mb-3">
          <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
        </div>
      </form>
    </div>
  </div>

  <script src="/public/js/chooseAvatar.js"></script>
</body>
</html>
