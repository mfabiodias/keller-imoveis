<div class="pt-5">

    @include('livewire.cliente.create')
    @include('livewire.cliente.update')

    @if(session()->has('type') && session()->has('message'))
        <div class="alert alert-{{ session('type') }}" style="margin-top:30px;">
            {{ session('message') }}
        </div>
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
    
    {{ $collection->links() }}
</div>