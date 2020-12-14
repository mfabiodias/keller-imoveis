
<div class="row justify-content-between">
    <div class="col-8">
        <h1 class="h4">Listagem de Clientes</h1>
    </div>
    <div class="col-4 text-right">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
            <i class="fas fa-user-plus text-light"></i> Novo Cliente
        </button>
    </div>
</div>
<div class="row">
    <div class="col-12">
        @include('livewire.cliente.crud', [
            "modal_id"       => "createModal",
            "modal_label"    => "createModalLabel",
            "modal_title"    => "Cadastrar Cliente",
            "modal_action"   => "Cadastrar",
            "modal_function" => 'store()',
        ])
    </div>
</div>
