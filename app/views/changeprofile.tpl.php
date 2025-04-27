<body >
    <div class="container d-flex flex-column" style="min-height: 80vh;">
        <h1 class="display-4 text-start mt-5">Редактировать профиль</h1>

        <div class="row align-items-start mt-5">
            <div class="d-flex flex-column align-items-center col-12 col-md-3 text-center">
                <img src="/public/images/icons/person-circle.svg" alt="Фото профиля" class="img-fluid rounded-circle mb-3 mt-3" style="width: 150px; height: 150px;">
                <button class="btn btn-secondary">Изменить фото</button>
            </div>

            <div class="col-12 col-md-5 col-lg-4">
                <form class="h-100 d-flex flex-column justify-content-start">
                    <div class="mb-3">
                        <label for="username" class="form-label">Логин</label>
                        <input type="text" class="form-control" id="username" placeholder="Ваш логин">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Почта</label>
                        <input type="email" class="form-control" id="email" placeholder="example@email.com">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Новый пароль</label>
                        <input type="password" class="form-control" id="password" placeholder="Новый пароль">
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Повторите пароль</label>
                        <input type="password" class="form-control" id="confirmPassword" placeholder="Повторите пароль">
                    </div>
                </form>
            </div>
        </div>

        <div class="row mt-5">
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary col-6 col-md-4 col-lg-2">Сохранить</button>
            </div>
        </div>
    </div>
</body>
