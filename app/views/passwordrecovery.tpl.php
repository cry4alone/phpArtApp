<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
$formData = $_SESSION['password_recovery_form_data'] ?? [];
unset($_SESSION['password_recovery_form_data']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="public/images/icons/favicon.ico" type="image/x-icon">
    <title><?php echo $pageData['title']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</head>
    <?php include_once(VIEW_PATH . "/includes/checkerror.tpl.php")?>
<body class="bg-light">
  <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
      <h3 class="text-center mb-3">Восстановление пароля</h3>
      <form method="post" action="/passwordrecovery/resetpassword">
        <div class="mb-4">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" 
          value="<?= htmlspecialchars($formData['email'] ?? '') ?>" placeholder="Введите почту">
        </div>
        <div class="mb-3">
          <label for="newpassword" class="form-label">Новый пароль</label>
          <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Введите пароль" required>
        </div>
        <div class="mb-4">
          <label for="password-retry" class="form-label">Повтор пароля</label>
          <input type="password" class="form-control" id="password-retry" name="password-retry" placeholder="Повторите пароль" required>
        </div>
        <div class="d-grid mb-3">
          <button type="submit" class="btn btn-primary">Отправить код</button>
        </div>
        <div class="d-flex justify-content-end mb-2 me-1">
          <a href="/login" style="text-decoration: underline; text-underline-offset: 3px;">Назад</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>