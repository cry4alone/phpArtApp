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
      <form id="registration-form" method="post" action="/registration/checkuser">
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Введите почту" required>
        </div>
        <div class="mb-3">
          <label for="login" class="form-label">Логин</label>
          <input type="text" class="form-control" id="login" name="login" placeholder="Введите логин" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Пароль</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Введите пароль" required>
        </div>
        <div class="mb-4">
          <label for="password-retry" class="form-label">Повтор пароля</label>
          <input type="password" class="form-control" id="password-retry" placeholder="Повторите пароль" required>
        </div>
        <div id="error-message" class="text-danger mb-3" style="display: none;"></div>
        <div class="d-grid mb-3">
          <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    document.getElementById('registration-form').addEventListener('submit', function (e) {
      const email = document.getElementById('email').value.trim();
      const login = document.getElementById('login').value.trim();
      const password = document.getElementById('password').value;
      const passwordRetry = document.getElementById('password-retry').value;
      const errorDiv = document.getElementById('error-message');
      errorDiv.style.display = 'none';
      errorDiv.textContent = '';

      if (!email || !login || !password || !passwordRetry) {
        e.preventDefault();
        errorDiv.textContent = 'Пожалуйста, заполните все поля.';
        errorDiv.style.display = 'block';
        return;
      }

      if (password !== passwordRetry) {
        e.preventDefault();
        errorDiv.textContent = 'Пароли не совпадают.';
        errorDiv.style.display = 'block';
        return;
      }

      if (password.length < 5) {
        e.preventDefault();
        errorDiv.textContent = 'Пароль должен быть не менее 5 символов.';
        errorDiv.style.display = 'block';
        return;
      }
    });
  </script>
</body>
</html>
