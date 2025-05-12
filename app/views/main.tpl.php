<body>
    <div class='container-md d-flex flex-column justify-content-center align-items-center mt-5'>
        <form action="/main" method="get" class="w-50">        
            <div class="input-group w-100">
                <input type="text" class="form-control" id='search' name="search" 
                value="<?= htmlspecialchars($pageData['search'] ?? '') ?>" placeholder="Поиск">
                <button class="btn btn-outline-secondary" type="submit" id="search-button">
                    <img src='/public/images/icons/search.svg' alt='search' class="mb-1">
                </button>
            </div>
            <div class='input-group w-100 mt-2 gap-2'>
                <input type="text" class="form-control rounded" id="datepicker" name="date" 
                value="<?= htmlspecialchars($pageData['date'] ?? '') ?>"placeholder="Выберите дату" readonly>
                <input type='text' placeholder='Пользователь' id='user' name="createdBy" 
                value="<?= htmlspecialchars($pageData['createdBy'] ?? '') ?>" class='form-control rounded'>
                <button class='btn btn-danger rounded' id='reset'>Сбросить</button>
            </div>
        </form>

        <div class='container-lg my-3'>
            <div class='row g-4'>
                <?php foreach ($pageData['images'] as $image): ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class='card h-100'>
                            <img src="<?php echo "/public/images/uploads/" . $image["filename"] ?>" class='card-img-top rounded'
                                style="height: 200px; object-fit: cover;">
                            <div class='card-body'>
                                <h5 class='card-title'><?php echo $image["title"] ?></h5>
                                <p class='card-text'><?php echo $image["description"] ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php include(VIEW_PATH . "/includes/paginationWidget.tpl.php")?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.3.4/dist/js/datepicker.min.js"></script>
    <script src='/public/js/datePicker.js'></script>
</body>