<form>
    <ul class="nav nav-tabs" id="clienteTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="cliente-tab" data-toggle="tab" href="#cliente" role="tab" aria-controls="cliente" aria-selected="true">Cliente</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="endereco-tab" data-toggle="tab" href="#endereco" role="tab" aria-controls="endereco" aria-selected="false">Endereço</a>
        </li>
    </ul>
    <div class="tab-content" id="clienteTabContent">
        {{-- Dados do Cliente --}}
        <div class="tab-pane px-1 py-2 fade show active" id="cliente" role="tabpanel" aria-labelledby="cliente-tab">
            <div class="form-group">
                <input type="hidden" wire:model="cli_id">
                <label for="ipt1">Nome</label>
                <input type="text" class="form-control" id="ipt1" placeholder="Exe: João Paulo" wire:model="cli_nome">
                @error('cli_nome') <span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="ipt2">Email</label>
                <input type="email" class="form-control" id="ipt2" placeholder="Exe: joao@gmail.com" wire:model="cli_email">
                @error('cli_email') <span class="text-danger">{{ $message }}</span>@enderror
            </div>
            @include('livewire.endereco.crud')
        </div>
        {{-- Endereço do Cliente --}}
        <div class="tab-pane px-1 py-2 fade" id="endereco" role="tabpanel" aria-labelledby="endereco-tab">
        </div>
    </div>
</form>