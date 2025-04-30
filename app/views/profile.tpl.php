<body>
    <?php include_once ROOT . "/views/includes/addNewPostModal.php" ?>
    <script src='./public/js/profileModal.js'></script>
    <div class="modal fade" id="editPostModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="/profile/editPost" method="post">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Управление постом</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex flex-row gap-3">
                        <img src='' id='imageEdit' alt='post image' class='w-50 mb-3'>
                        <div class='d-flex flex-column'>
                            <input type="hidden" name="id" id="idEdit">
                            <label for='titleEdit'>Название</label>
                            <input name='title' type='text' id='titleEdit' class='form-control'>
                            <label for='descriptionEdit'>Описание</label>
                            <textarea name='description' id='descriptionEdit' class='form-control'></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type='button' class='btn btn-danger me-auto'>
                            <img src='/public/images/icons/trash.svg' alt='delete' class='w-100 h-100'>
                        </button>
                        <div>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class='container-fluid d-flex flex-column justify-content-center align-items-center'>
        <div class='container-lg d-flex justify-content-between align-items-center mt-3 gap-5'>
            <p class='display-4 mb-0'>Ваш профиль</p>
            <div class='d-flex flex-column gap-2'>
                <div class='d-flex justify-content-between align-items-center mt-3 gap-3'>
                    <img src="<?= htmlspecialchars($pageData['pathToAvatar'])?>" class="rounded-circle" alt='person' width="50" height="50">
                    <div class='d-flex flex-column justify-content-center align-items-start'>
                        <p class='fs-4 mb-0'><?php echo $pageData['login']; ?></p>
                        <p class='fs-6 mb-0'><?php echo $pageData['email']; ?></p>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewPostModal">Добавить пост</button>
                <a href="/profile/changeprofile" class="btn btn-outline-primary">Изменить профиль</a>
            </div>
        </div>

        <div class="input-group w-50 mt-5">
            <input type="text" class="form-control" placeholder="Поиск по вашим постам">
            <span class="input-group-text">
                <img src='/public/images/icons/search.svg' alt='search'>
            </span>
        </div>

        <div class='container-lg d-flex justify-content-center align-items-center mt-3 gap-5'>
            <?php foreach ($pageData['images'] as $image): ?>
                <div class='card'>
                    <img src="<?php echo "/public/images/uploads/" . $image["filename"] ?>" class='rounded'>
                    <div class='card-body d-flex flex-column'>
                        <h5 id='title' class='card-title'><?php echo $image["title"] ?></h5>
                        <p id='descrtiption' class='card-text'><?php echo $image["description"] ?></p>
                        <div class='d-flex justify-content-between align-items-center'> <button type='button' class='btn btn-primary'>Опубликовать</button>
                            <button data-filename="<?php echo $image['filename']; ?>" data-title="<?php echo $image['title']; ?>"
                                data-description="<?php echo $image['description']; ?>" data-bs-toggle="modal" data-bs-target="#editPostModal"
                                data-id="<?php echo $image["id"]; ?>" type='button' href='/profile/editImage/<?php echo $image["id"] ?>'
                                class=" btn ms-auto editPostBtn">
                                <img src='/public/images/icons/edit.svg' alt='edit'>
                            </button>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</body>