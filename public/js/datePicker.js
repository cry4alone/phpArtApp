document.addEventListener('DOMContentLoaded', function () {
    const datePicker = new Datepicker(document.getElementById('datepicker'), {
        format: 'yyyy-mm-dd',
        language: 'ru',
    });

    const resetBtn = document.querySelector('#reset');
    const searchInput = document.querySelector('#search');
    const userInput = document.querySelector('#user');

    resetBtn.addEventListener('click', () => {
        console.log('reset');
        datePicker.inputField.value = '';
        searchInput.value = '';
        userInput.value = '';
    });
});
