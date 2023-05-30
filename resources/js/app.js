import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])

const btnDelete = document.getElementById('btn-delete');

btnDelete.addEventListener('click', function () {
    const formDelete = document.getElementById('form-delete');
    formDelete.submit();
});


