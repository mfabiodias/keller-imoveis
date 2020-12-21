<form>
    <ul class="nav nav-tabs" id="clientTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ empty($active_tab) || $active_tab == 'cliente-tab' ? 'active' : '' }}" id="cliente-tab" 
            data-toggle="tab" href="#cliente" role="tab" aria-controls="cliente" 
            aria-selected="{{ empty($active_tab) || $active_tab == 'cliente-tab' ? 'true' : 'false' }}">Cliente</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ $active_tab == 'endereco-tab' ? 'active' : '' }}" id="endereco-tab" 
            data-toggle="tab" href="#endereco" role="tab" aria-controls="endereco" 
            aria-selected="{{ $active_tab == 'endereco-tab' ? 'true' : 'false' }}">Endereço</a>
        </li>
    </ul>
    <div class="tab-content" id="clientTabContent">
        {{-- Dados do Cliente --}}
        <div class="tab-pane fade {{ empty($active_tab) || $active_tab == 'cliente-tab' ? 'show active' : '' }}" id="cliente" role="tabpanel" aria-labelledby="cliente-tab">
            <div class="form-group">
                <input type="hidden" wire:model.defer="cli_id">
                <label for="ipt1">Nome</label>
                <input type="text" class="form-control" id="ipt1" placeholder="Exe: João Paulo" wire:model.defer="cli_nome">
                @error('cli_nome') <span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="ipt2">Email</label>
                <input type="email" class="form-control" id="ipt2" placeholder="Exe: joao@gmail.com" wire:model.defer="cli_email">
                @error('cli_email') <span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        {{-- Endereço do Cliente --}}
        <div class="tab-pane fade {{ $active_tab == 'endereco-tab' ? 'show active' : '' }}" id="endereco" role="tabpanel" aria-labelledby="endereco-tab">
            @include('livewire.endereco.crud')
        </div>
    </div>
</form>