// require('./bootstrap');

window.addEventListener('closeModal', event => {
    $('.modal').modal('hide');
})

// Limpa campos de todos modals após fecha-los
$('.modal').on('hidden.bs.modal', function (e) {
    $(this).find('form').trigger('reset');
});

// Limpa campos para criar registros antes de iniciar o modal
$('.new-modal').on('show.bs.modal', function (e) {
    $(this).find('form').trigger('reset');
});

$('ul#clientTab > .nav-item > .nav-link ').on('click', function (e) {
    let active_tab = $(this).attr('id');
    Livewire.emit('changeTab', active_tab)
});