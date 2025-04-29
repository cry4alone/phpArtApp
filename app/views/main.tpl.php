<body>
    <div class='container-md d-flex flex-column justify-content-center align-items-center mt-5'>
        <div class="input-group w-50">
            <input type="text" class="form-control" placeholder="Поиск">
            <span class="input-group-text">
                <img src='./public/images/icons/search.svg' alt='search'>
            </span>
        </div>
        <div class='container-lg d-flex justify-content-center align-items-center mt-3 gap-5'>
            <?php foreach ($pageData['images'] as $image): ?>
                <div class='card'>
                    <img width='400' height='400' src="<?php echo "./public/images/uploads/" . $image["filename"] ?>" class='rounded'>
                    <div class='card-body'>
                        <h5 class='card-title'><?php echo $image["title"] ?></h5>
                        <p class='card-text'><?php echo $image["description"] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>