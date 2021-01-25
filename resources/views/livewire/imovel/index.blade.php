<div class="pt-5">

    <div class="row justify-content-between">
        <div class="col-12 col-md-8">
            <h1 class="h4">Listagem de Imóveis</h1>
        </div>
        <div class="col-12 col-md-4 text-right">
            <button type="button" class="btn btn-sm btn-primary form-clean" data-toggle="modal" data-target="#createModal">
                <i class="fas fa-user-plus text-light"></i> {{ $comp_name }}
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            
            @if(session()->has('type') && session()->has('message'))
                <x-alert />
            @endif

            <div class="d-none d-md-block">
                <table class="table table-sm table-bordered table-striped table-md-responsive mt-5">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Cliente</th>
                            <th>Tipo</th>
                            <th>Local</th>
                            {{-- <th class="d-block d-md-none">Imóvel</th> --}}
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($collection as $item)
                        <tr>
                            <td class="align-middle text-center">{{ $item->id }}</td>
                            <td class="align-middle">{{ $item->cliente->nome }}</td>
                            <td class="align-middle">{{ $item->tipo->nome }}<br>{{ $item->subtipo->nome }}</td>
                            <td class="align-middle">{{ $item->endereco['rua'] }}<br>{{ $item->endereco['bairro'] }}</td>
                            <td class="align-middle text-center" style="width: 18%;">
                                <i class="far fa-address-card text-success app-cursor"
                                    title="Ficha do {{ $comp_name }}"
                                    wire:click="card({{ $item->id }})" 
                                    data-toggle="modal" data-target="#cardModal"
                                ></i>
                                <i class="fas fa-user-edit text-primary app-cursor" 
                                    title="Editar {{ $comp_name }}"
                                    wire:click="edit({{ $item->id }})" 
                                    data-toggle="modal" data-target="#updateModal"
                                ></i>
                                <i class="fas fa-user-minus text-danger app-cursor" 
                                    title="Excluir {{ $comp_name }}"
                                    wire:click="delete({{ $item->id }})"
                                ></i>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-block d-md-none">
                <table class="table table-sm table-bordered table-striped table-md-responsive mt-5">
                    <thead>
                        <tr>
                            <th>Imóvel</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($collection as $item)
                        <tr>
                            <td class="d-block d-md-none">
                                <strong>No.: </strong>{{ $item->id }}<br>
                                <strong>Cliente: </strong>{{ $item->cliente->nome }}<br>
                                <strong>Tipo: </strong>{{ $item->tipo->nome }}<br>
                                <strong>SubTipo: </strong>{{ $item->subtipo->nome }}<br>
                                <strong>Rua: </strong>{{ $item->endereco['rua'] }}<br> 
                                <strong>Bairro: </strong>{{ $item->endereco['bairro'] }}
                            </td>
                            <td class="align-middle text-center" style="width: 20%;">
                                <i class="far fa-address-card text-success app-cursor"
                                    title="Ficha do {{ $comp_name }}"
                                    wire:click="card({{ $item->id }})" 
                                    data-toggle="modal" data-target="#cardModal"
                                ></i>
                                <i class="fas fa-user-edit text-primary app-cursor" 
                                    title="Editar {{ $comp_name }}"
                                    wire:click="edit({{ $item->id }})" 
                                    data-toggle="modal" data-target="#updateModal"
                                ></i>
                                <i class="fas fa-user-minus text-danger app-cursor" 
                                    title="Excluir {{ $comp_name }}"
                                    wire:click="delete({{ $item->id }})"
                                ></i>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{ $collection->links() }}

    @include("components.modal", [ "modal" => [
        "id"       => "createModal",
        "label"    => "createModalLabel",
        "title"    => "Cadastrar Imóvel",
        "action"   => "Cadastrar",
        "function" => "create()",
        "valign"   => true, // true || false
        "scroll"   => true, // true || false
        "size"     => "lg", // sm, lg, xl
        "body"     => "livewire.imovel.crud",
    ]])

    @include("components.modal", [ "modal" => [
        "id"       => "updateModal",
        "label"    => "updateModalLabel",
        "title"    => "Atualizar Imóvel",
        "action"   => "Atualizar",
        "function" => "update()",
        "valign"   => true, // true || false
        "scroll"   => true, // true || false
        "size"     => "lg", // sm, lg, xl
        "body"     => "livewire.imovel.crud",
    ]])

    {{-- @include("components.modal", [ "modal" => [
        "id"       => "cardModal",
        "label"    => "cardModalLabel",
        "title"    => "Detalhes do Imóvel",
        "action"   => "",
        "function" => "",
        "valign"   => true, // true || false
        "scroll"   => false, // true || false
        "size"     => "", // sm, lg, xl
        "body"     => "livewire.imovel.card",
    ]]) --}}
    
</div>