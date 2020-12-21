<div class="form-group">
    <input type="hidden" wire:model.defer="end_id">
    <div class="input-group is-invalid">
        <div class="custom-file">
            <input type="text" class="form-control" id="ipt1" placeholder="Exe: 07077190" wire:model.defer="end_cep">
        </div>
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" 
            type="button" 
            wire:click="getCep()">Buscar</button>
        </div>
    </div>
    @error('end_cep') <span class="text-danger">{{ $message }}</span>@enderror
</div>
<div class="form-group">
    <label for="ipt2">Endereço</label>
    <input type="text" class="form-control" id="ipt2" placeholder="Exe: Rua João Paulo VI" wire:model.defer="end_rua">
    @error('end_rua') <span class="text-danger">{{ $message }}</span>@enderror
</div>
<div class="form-group">
    <label for="ipt3">Número</label>
    <input type="text" class="form-control" id="ipt3" wire:model.defer="end_numero">
    @error('end_numero') <span class="text-danger">{{ $message }}</span>@enderror
</div>
<div class="form-group">
    <label for="ipt4">Complemento</label>
    <input type="text" class="form-control" id="ipt4" wire:model.defer="end_complemento">
    @error('end_complemento') <span class="text-danger">{{ $message }}</span>@enderror
</div>
<div class="form-group">
    <label for="ipt5">Bairro</label>
    <input type="text" class="form-control" id="ipt5" wire:model.defer="end_bairro">
    @error('end_bairro') <span class="text-danger">{{ $message }}</span>@enderror
</div>
<div class="form-group">
    <label for="ipt6">Cidade</label>
    <input type="text" class="form-control" id="ipt6" wire:model.defer="end_cidade">
    @error('end_cidade') <span class="text-danger">{{ $message }}</span>@enderror
</div>
<div class="form-group">
    <label for="ipt7">Estado</label>
    <input type="text" class="form-control" id="ipt7" wire:model.defer="end_estado">
    @error('end_estado') <span class="text-danger">{{ $message }}</span>@enderror
</div>