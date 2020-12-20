<div class="pt-5">

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
            
            @if(session()->has('type') && session()->has('message'))
                <x-alert />
            @endif

            <table class="table table-bordered mt-5">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($collection as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->nome }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                            <i class="far fa-address-card text-success app-cursor"
                                title="Ficha do Cliente"
                            ></i>
                            <i class="fas fa-house-user text-warning app-cursor"
                                title="Endereços do Cliente"
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

    @include('components.modal', [ "modal" => [
        "id"       => "createModal",
        "label"    => "createModalLabel",
        "title"    => "Cadastrar Cliente",
        "action"   => "Cadastrar",
        "function" => 'create()',
        "valign"   => false, // true || false
        "scroll"   => false, // true || false
        "size"     => '', // sm, lg, xl
        "body"     => 'livewire.cliente.crud',
    ]])

    @include('components.modal', [ "modal" => [
        "id"       => "updateModal",
        "label"    => "updateModalLabel",
        "title"    => "Atualizar Cliente",
        "action"   => "Atualizar",
        "function" => 'update()',
        "valign"   => true, // true || false
        "scroll"   => false, // true || false
        "size"     => '', // sm, lg, xl
        "body"     => 'livewire.cliente.crud',
    ]])
    
</div>