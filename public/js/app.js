// require('./bootstrap');

/* #####################
######  Livewire  ######
##################### */

window.addEventListener('closeModal', event => {
    $('.modal').modal('hide');
});

window.addEventListener('closeLoader', event => {
    $("#loader").hide();
});

window.addEventListener('pickerRender', event => {
    $('.selectpicker').selectpicker('render');
});



/* #####################
#######  Jquery  #######
##################### */

$('ul#clientTab > .nav-item > .nav-link').on('click', function (e) {
    let active_tab = $(this).attr('id');
    Livewire.emit('changeTab', active_tab)
});

$('#getCep').on('click', function (e) {
    $("#loader").show();
    setTimeout(function() { $("#loader").hide(); }, 30000);
});

$('.cep').on('keyup', function() {
    $(this).val(numberOnly($(this).val()));
});


/* #####################
#########  JS  #########
##################### */

function numberOnly(str) {
    return str.replace(/[^0-9.]/g, "");
}