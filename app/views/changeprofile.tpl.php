<body>
    <div class="container d-flex flex-column" style="min-height: 80vh;">
        <h1 class="display-4 text-start mt-5">Редактировать профиль</h1>

        <div class="row align-items-start mt-5">
            <div class="d-flex flex-column align-items-center col-12 col-md-3 text-center">
                <img src="/public/images/icons/person-circle.svg" alt="Фото профиля" class="img-fluid rounded-circle mb-3 mt-3" style="width: 150px; height: 150px;">
                <button class="btn btn-secondary">Изменить фото</button>
            </div>

            <div class="col-12 col-md-5 col-lg-4">
                <form id="editProfileForm" action="/profile/changeprofile/checkolddata" method="POST" class="h-100 d-flex flex-column justify-content-start">
                    <div class="mb-3">
                        <label for="login" class="form-label">Логин</label>
                        <input type="text" class="form-control" id="login" name="login" value="<?php echo $_SESSION['login']; ?>" placeholder="Ваш логин">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Почта</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION['email']; ?>" placeholder="example@email.com">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Новый пароль</label>
                        <input type="password" class="form-control" id="password" name="newPassword" placeholder="Новый пароль">
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Повторите пароль</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Повторите пароль">
                    </div>
                </form>
            </div>
        </div>

        <div class="row mt-5">
            <div class="d-flex justify-content-end">
                <button type="submit" form="editProfileForm" class="btn btn-primary col-6 col-md-4 col-lg-2">Сохранить</button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/profile/changeprofile/checkoldpassword" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="passwordModalLabel">Подтверждение пароля</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                    </div>
                    <div class="modal-body">
                        <label for="oldPassword" class="form-label">Введите текущий пароль</label>
                        <input type="password" class="form-control" name="oldPassword" id="oldPassword" placeholder="Текущий пароль">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-primary">Подтвердить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        var modalElement = document.getElementById('passwordModal');
        modalElement.addEventListener('hidden.bs.modal', function () {
            window.location.href = '/profile/changeprofile/changedatadismissed';
        });
        <?php if (isset($_SESSION['awaitingOldPassword']) && $_SESSION['awaitingOldPassword'] === true): ?>
            var myModal = new bootstrap.Modal(document.getElementById('passwordModal'));
            window.addEventListener('load', function () {
                myModal.show();
            });
        <?php endif; ?>
    </script>
</body>
