<div class="modal fade" id="editPostModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Управление постом</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex flex-row gap-3">
                <img src='' id='imageEdit' alt='post image' class='w-50 mb-3'>
                <div class='d-flex flex-column'>
                    <form action="/profile/editPost" method="post" id='editPostForm'>
                        <input type="hidden" name="id" class="idEdit">
                        <label for='titleEdit'>Название</label>
                        <input name='title' type='text' id='titleEdit' class='form-control'>
                        <label for='descriptionEdit'>Описание</label>
                        <textarea name='description' id='descriptionEdit' class='form-control'></textarea>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <form action='profile/deletePost' method='post' id='deletePostForm'>
                    <input type="hidden" name="id" class="idEdit">
                    <button type='submit' class='btn me-auto form-control' form='deletePostForm'>
                        <img src='/public/images/icons/trash.svg' alt='delete' class='w-100 h-100'>
                    </button>
                </form>
                <div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary" form='editPostForm'>Сохранить изменения</button>
                </div>
            </div>
        </div>
    </div>
</div>