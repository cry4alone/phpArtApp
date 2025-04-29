<body>
    <?php include_once ROOT . "/views/includes/addNewPostModal.php" ?>
    <?php include_once VIEW_PATH . "/includes/checkerror.tpl.php" ?>
    <div class='container-fluid d-flex flex-column justify-content-center align-items-center'>
        <div class='container-lg d-flex justify-content-between align-items-center mt-3 gap-5'>
            <p class='display-4 mb-0'>Ваш профиль</p>
            <div class='d-flex flex-column gap-2'>
                <div class='d-flex justify-content-between align-items-center mt-3 gap-3'>
                    <img src='./public/images/icons/person-circle.svg' alt='person' width="50" height="50">
                    <div class='d-flex flex-column justify-content-center align-items-start'>
                        <p class='fs-4 mb-0'><?php echo $pageData['login']; ?></p>
                        <p class='fs-6 mb-0'><?php echo $pageData['email']; ?></p>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewPostModal">Добавить пост</button>
                <button type="button" class="btn btn-outline-primary">Изменить профиль</button>
            </div>
        </div>

        <div class="input-group w-50 mt-5">
            <input type="text" class="form-control" placeholder="Поиск по вашим постам">
            <span class="input-group-text">
                <img src='./public/images/icons/search.svg' alt='search'>
            </span>
        </div>

        <div class='container-lg d-flex justify-content-center align-items-center mt-3 gap-5'>
            <?php foreach ($pageData['images'] as $image): ?>
                <div class='card'>
                    <img src="<?php echo "/public/images/uploads/" . $image["filename"] ?>" class='rounded'>
                    <div class='card-body d-flex flex-column'>
                        <h5 class='card-title'><?php echo $image["title"] ?></h5>
                        <p class='card-text'><?php echo $image["description"] ?></p>
                        <a href='/profile/editImage/<?php echo $image["id"] ?>' class="btn ms-auto">
                            <img src='/public/images/icons/edit.svg' alt='edit'>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</body>