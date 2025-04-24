<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageData['title']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</head>
    <?php include_once(VIEW_PATH . "/layout/checkerror.tpl.php")?>
    <body class="bg-light">
  <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
      <h3 class="text-center mb-1">Введите код</h3>
      <p class="text-center text-muted small mb-3">Поищите код в спаме :D</p>
      <form method="post" action="<?php echo $pageData['actionUrl']; ?>">
        <div class="mb-4">
          <label for="code" class="form-label">Код</label>
          <input type="text" class="form-control" id="code" name="code" placeholder="Введите код">
        </div>
        <div class="d-grid mb-2">
          <button type="submit" class="btn btn-primary">Подтвердить</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>