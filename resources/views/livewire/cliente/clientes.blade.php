<div class="pt-5">

    @include('livewire.cliente.create')
    @include('livewire.cliente.update')

    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">
            {{ session('message') }}
        </div>
    @endif

    <table class="table table-bordered mt-5">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach($collection as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nome }}</td>
                <td>{{ $item->email }}</td>
                <td>
                    <i class="fas fa-user-edit text-primary app-cursor" 
                        wire:click="edit({{ $item->id }})" 
                        data-toggle="modal" data-target="#updateModal"
                    ></i>
                    <i class="fas fa-user-minus text-danger app-cursor" 
                        wire:click="delete({{ $item->id }})"
                    ></i>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    {{ $collection->links() }}
</div>