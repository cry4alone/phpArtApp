<body>
    <?php
    include_once ROOT . "/views/includes/addNewPostModal.php";
    include_once ROOT . "/views/includes/editPostModal.php";
    ?>
    <script src='./public/js/profileModal.js'></script>


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

        <div class='container-lg my-3'>
            <div class="row g-4">
                <?php foreach ($pageData['images'] as $image): ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class='card h-100'>
                            <img src="<?php echo "/public/images/uploads/" . $image["filename"] ?>" class='card-img-top rounded'
                                style="height: 200px; object-fit: cover;">
                            <div class='card-body d-flex flex-column'>
                                <h5 class='card-title'><?php echo htmlspecialchars($image["title"]); ?></h5>
                                <p class='card-text'><?php echo htmlspecialchars($image["description"]); ?></p>
                                <div class='d-flex justify-content-between align-items-center mt-auto'>
                                    <form method='post' action='profile/changePostVisibility'>
                                        <button type='submit' name='id' class='btn btn-primary form-control'>Опубликовать</button>
                                        <input type='hidden' name='id' value='<?php echo $image["id"]; ?>'>
                                    </form>
                                    <button data-filename="<?php echo $image['filename']; ?>" data-title="<?php echo $image['title']; ?>"
                                        data-description="<?php echo $image['description']; ?>" data-bs-toggle="modal" data-bs-target="#editPostModal"
                                        data-id="<?php echo $image["id"]; ?>" type='button' class="btn ms-auto editPostBtn">
                                        <img src='/public/images/icons/edit.svg' alt='edit'>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</body>