<div class="modal fade" id="addNewPostModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="/profile/addNewPost" method="post" enctype="multipart/form-data">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Добавление поста</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class='h6'>Поддерживаются только файлы формата .jpg .png</h4>
                    <input name='file' class='form-control' type='file' action="/profile/publish" method="post" enctype="multipart/form-data">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
            </div>
        </div>
    </form>
</div>