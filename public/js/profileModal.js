document.addEventListener('DOMContentLoaded', function () {
    const modalTitle = document.querySelector("#titleEdit");
    const modalDescription = document.querySelector("#descriptionEdit");
    const modalImage = document.querySelector("#imageEdit");
    const modalIds = document.querySelectorAll(".idEdit");

    const editButtons = document.querySelectorAll(".editPostBtn");

    editButtons.forEach((button) => {
        button.addEventListener("click", () => { 
            const filename = button.dataset.filename;
            const filnamePath = "/public/images/uploads/" + filename;

            imageEdit.src = filnamePath;
            const title = button.dataset.title;
            const description = button.dataset.description;
            const id = button.dataset.id;

            modalDescription.value = description;
            modalTitle.value = title;
            modalIds.forEach((modalId) => {
                modalId.value = id;
            })
        });
    });

    const saveBtn = document.querySelector(".saveBtn");
});
