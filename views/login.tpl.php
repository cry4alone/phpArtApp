<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageData['title']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</head>
<body>
<?php if (!empty($pageData['error'])): ?>
  <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 z-3" style="min-width: 300px;">
    <?= htmlspecialchars($pageData['error']) ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
<?php endif; ?>

<script>
  setTimeout(() => {
    const alert = document.querySelector('.alert');
    if (alert) {
      alert.remove();
    }
  }, 5000);
</script>

<body class="bg-light">
  <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
      <h3 class="text-center mb-4">Вход</h3>
      <form method="post" action="login">
        <div class="mb-3">
          <label for="login" class="form-label">Логин</label>
          <input type="text" class="form-control" id="login" name="login" placeholder="Введите логин">
        </div>
        <div class="mb-4">
          <label for="password" class="form-label">Пароль</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Введите пароль">
        </div>
        <div class="d-grid mb-3">
          <button type="submit" class="btn btn-primary">Войти</button>
        </div>
        <div class="d-flex justify-content-between">
          <a href="/passwordrecovery" >Забыли пароль?</a>
          <a href="/registration" >Регистрация</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>