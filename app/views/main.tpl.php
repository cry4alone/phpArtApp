<body class="d-flex flex-column min-vh-100">
    <script src='./public/js/imageModal.js'></script>
    <?php include(VIEW_PATH . "/includes/imageModal.php") ?>
    <div class='container-md d-flex flex-column justify-content-center align-items-center flex-grow-1 mt-3'>
        <form action="/main" method="get" class="w-100 sm-w-50">
            <div class="input-group w-100">
                <input type="text" class="form-control" id='search' name="search" value="<?= htmlspecialchars($pageData['search'] ?? '') ?>"
                    placeholder="Поиск">
                <button class="btn btn-outline-secondary" type="submit" id="search-button">
                    <img src='/public/images/icons/search.svg' alt='search' class="mb-1">
                </button>
            </div>
            <div class="d-flex flex-column flex-md-row gap-2 mt-2 w-100">
                <input type="text" class="form-control rounded flex-grow-1" id="datepicker" name="date" value="<?= htmlspecialchars($pageData['date'] ?? '') ?>"
                    placeholder="Выберите дату" readonly>
                <input type='text' placeholder='Пользователь' id='user' name="createdBy" value="<?= htmlspecialchars($pageData['createdBy'] ?? '') ?>"
                    class='form-control rounded flex-grow-1'>
                <button class='btn btn-danger rounded flex-shrink-0 sm-w-50' id='reset'>Сбросить</button>
            </div>
        </form>

        <div class='container-lg my-3'>
            <div class='row g-4'>
                <?php foreach ($pageData['images'] as $image): ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <button class="btn btn-link p-0 text-decoration-none" data-bs-toggle="modal" data-bs-target="#imageModal"
                            data-image="<?php echo "/public/images/uploads/" . $image['filename']; ?>">
                            <div class='card h-100'>
                                <img src="<?php echo "/public/images/uploads/thumbnails/" . $image["filename"] ?>" class='card-img-top rounded'
                                    style="height: 200px; object-fit: cover;">
                                <div class='card-body'>
                                    <h5 class='card-title '><?php echo $image["title"] ?></h5>
                                    <p class='card-text'><?php echo $image["description"] ?></p>
                                </div>
                            </div>
                        </button>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php include(VIEW_PATH . "/includes/paginationWidget.tpl.php") ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.3.4/dist/js/datepicker.min.js"></script>
    <script src='/public/js/datePicker.js'></script>
</body>