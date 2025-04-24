<body>
    <div class='container-fluid d-flex flex-column justify-content-center align-items-center'>
        <div class='container-lg d-flex justify-content-between align-items-center mt-3 gap-5'>
            <p class='display-4 mb-0'>Ваш профиль</p>
            <div class='d-flex justify-content-between align-items-center mt-3 gap-3'>
                <img src='./images/icons/person-circle.svg' alt='person' width="50" height="50">
                <div class='d-flex flex-column justify-content-center align-items-start'>
                    <p class='fs-4 mb-0'><?php echo $pageData['login']; ?></p>
                    <p class='fs-6 mb-0'><?php echo $pageData['email']; ?></p>
                </div>
            </div>
        </div>

        <div class="input-group w-50 mt-5">
            <input type="text" class="form-control" placeholder="Поиск по вашим постам">
            <span class="input-group-text">
                <img src='./images/icons/search.svg' alt='search'>
            </span>
        </div>

        <div class='container-lg d-flex justify-content-center align-items-center mt-3 gap-5'>
            <div class='card'>
            <img src='./images/assets/example.jpg' class='rounded'>
            <div class='card-body'>
                <h5 class='card-title'>Card title</h5>
                <p class='card-text'>Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href='profile/publish' class="btn btn-primary">Опубликовать</a>
            </div>
            </div>
            <div class='card'>
            <img src='./images/assets/example.jpg' class='rounded'>
            <div class='card-body'>
                <h5 class='card-title'>Card title</h5>
                <p class='card-text'>Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href='profile/publish' class="btn btn-primary">Опубликовать</a>
            </div>
            </div>
            <div class='card'>
            <img src='./images/assets/example.jpg' class='rounded'>
            <div class='card-body'>
                <h5 class='card-title'>Card title</h5>
                <p class='card-text'>Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href='profile/publish' class="btn btn-primary">Опубликовать</a>
            </div>
            </div>
        </div>
    </div>

</body>