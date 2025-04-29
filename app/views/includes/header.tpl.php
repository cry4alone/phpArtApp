<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/images/icons/favicon.ico" type="image/x-icon">
    <title><?php echo $pageData['title']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/index.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <!-- Левая часть: заголовок -->
            <a class="navbar-brand" href="/main">
                <img src='/public/images/assets/logo.png' width="40" height="40" class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Левая часть: меню -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/main">Галерея</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">О нас</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contacts">Контакты</a>
                    </li>
                </ul>

                <!-- Правая часть: элемент профиля -->
                <ul class="navbar-nav ms-auto me-3">
                    <li class="nav-item dropdown">
                        <a class="btn dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="/public/images/icons/person-circle.svg" alt="Profile" width="30" height="24" class="d-inline-block align-text-top">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="/profile">Профиль</a></li>
                            <li><a class="dropdown-item" href="/profile/logout">Выйти</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</body>

</html>
    <?php include_once(VIEW_PATH . "/includes/checkerror.tpl.php")?>