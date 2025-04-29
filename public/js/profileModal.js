document.addEventListener('DOMContentLoaded', function () {
    const modalTitle = document.querySelector("#titleEdit");
    const modalDescription = document.querySelector("#descriptionEdit");
    const modalImage = document.querySelector("#imageEdit");
    const modalId = document.querySelector("#idEdit");

    const editButtons = document.querySelectorAll(".editPostBtn");

    editButtons.forEach((button) => {
        button.addEventListener("click", () => { 
            const filename = button.dataset.filename;
            const filnamePath = "/public/images/uploads/" + filename;

            imageEdit.src = filnamePath;
            const title = button.dataset.title;
            const description = button.dataset.description;
            const id = button.dataset.id;

            modalTitle.value = title;
            modalId.value = id;
            modalDescription.value = description;

        });
    });

    const saveBtn = document.querySelector(".saveBtn");
});