document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImage');

    modal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const imageUrl = button.getAttribute('data-image');
        modalImg.src = imageUrl;
    });
});