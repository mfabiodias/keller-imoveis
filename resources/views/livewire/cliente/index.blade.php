<div class="pt-5">

    <div class="row justify-content-between">
        <div class="col-12 col-md-8">
            <h1 class="h4">Listagem de Clientes</h1>
        </div>
        <div class="col-12 col-md-4 text-right">
            <button type="button" class="btn btn-sm btn-primary form-clean" data-toggle="modal" data-target="#createModal">
                <i class="fas fa-user-plus text-light"></i> Cliente
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            
            @if(session()->has('type') && session()->has('message'))
                <x-alert />
            @endif

            <table class="table table-sm table-bordered table-striped table-md-responsive mt-5">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nome</th>
                        <th class="d-none d-md-block">Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($collection as $item)
                    <tr>
                        <td class="text-center">{{ $item->id }}</td>
                        <td>{{ $item->nome }}</td>
                        <td class="d-none d-md-block">{{ $item->email }}</td>
                        <td class="text-center">
                            <i class="far fa-address-card text-success app-cursor"
                                title="Ficha do Cliente"
                                wire:click="card({{ $item->id }})" 
                                data-toggle="modal" data-target="#cardModal"
                            ></i>
                            <i class="fas fa-user-edit text-primary app-cursor" 
                                title="Editar Cliente"
                                wire:click="edit({{ $item->id }})" 
                                data-toggle="modal" data-target="#updateModal"
                            ></i>
                            <i class="fas fa-user-minus text-danger app-cursor" 
                                title="Excluir Cliente"
                                wire:click="delete({{ $item->id }})"
                            ></i>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{ $collection->links() }}

    @include("components.modal", [ "modal" => [
        "id"       => "createModal",
        "label"    => "createModalLabel",
        "title"    => "Cadastrar Cliente",
        "action"   => "Cadastrar",
        "function" => "create()",
        "valign"   => true, // true || false
        "scroll"   => true, // true || false
        "size"     => "lg", // sm, lg, xl
        "body"     => "livewire.cliente.crud",
    ]])

    @include("components.modal", [ "modal" => [
        "id"       => "updateModal",
        "label"    => "updateModalLabel",
        "title"    => "Atualizar Cliente",
        "action"   => "Atualizar",
        "function" => "update()",
        "valign"   => true, // true || false
        "scroll"   => true, // true || false
        "size"     => "lg", // sm, lg, xl
        "body"     => "livewire.cliente.crud",
    ]])

    @include("components.modal", [ "modal" => [
        "id"       => "cardModal",
        "label"    => "cardModalLabel",
        "title"    => "Detalhes do Cliente",
        "action"   => "",
        "function" => "",
        "valign"   => true, // true || false
        "scroll"   => false, // true || false
        "size"     => "", // sm, lg, xl
        "body"     => "livewire.cliente.card",
    ]])
    
</div>