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

window.addEventListener('bootstrapSelectValues', event => {
    $(`.${event.detail.attr}`).selectpicker('val', event.detail.values);
})

/* #####################
#######  Jquery  #######
##################### */

$('ul.toggle-tab > .nav-item > .nav-link').on('click', function (e) {
    let active_tab = $(this).attr('id');
    Livewire.emit('changeTab', active_tab);
});

$('#getCep').on('click', function (e) {
    $("#loader").show();
    setTimeout(function() { $("#loader").hide(); }, 30000);
});

$('.cep').on('keyup', function() {
    $(this).val(numberOnly($(this).val()));
});

$(document).ready(function() 
{
    $('.datatable-default tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Buscar '+title+'" />' );
    } );

    $('.datatable-default').DataTable( {
        lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todos"]],
        language: {
            lengthMenu: "Exibir _MENU_ por página",
            zeroRecords: "Nenhum registro encontrado!",
            info: "Página _PAGE_ de _PAGES_",
            infoEmpty: "Nenhum registro",
            infoFiltered: "(Filtrado de _MAX_ registros totais)",
            search: "Buscar",
            next: "Próximo",
            paginate: {
                first:    "Primeiro",
                last:     "Último",
                next:     "Próximo",
                previous: "Anterior"
            }
        },
        initComplete: function () {
            this.api().columns().every( function () {
                var that = this;
                $( 'input', this.footer() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that.search( this.value ).draw();
                    }
                });
            });
        }
    });
});


/* #####################
#########  JS  #########
##################### */

function numberOnly(str) {
    return str.replace(/[^0-9.]/g, "");
}