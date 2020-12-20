<div class="form-group">
    <input type="hidden" wire:model="end_id">
    <label for="ipt1">Endereço</label>
    <input type="text" class="form-control" id="ipt1" placeholder="Exe: Rua João Paulo VI" wire:model="end_rua">
    @error('end_rua') <span class="text-danger">{{ $message }}</span>@enderror
</div>
<div class="form-group">
    <label for="ipt2">Número</label>
    <input type="text" class="form-control" id="ipt2" wire:model="end_numero">
    @error('end_numero') <span class="text-danger">{{ $message }}</span>@enderror
</div>
<div class="form-group">
    <label for="ipt3">Complemento</label>
    <input type="text" class="form-control" id="ipt3" wire:model="end_complemento">
    @error('end_complemento') <span class="text-danger">{{ $message }}</span>@enderror
</div>
<div class="form-group">
    <label for="ipt4">Bairro</label>
    <input type="text" class="form-control" id="ipt4" wire:model="end_bairro">
    @error('end_bairro') <span class="text-danger">{{ $message }}</span>@enderror
</div>
<div class="form-group">
    <label for="ipt5">Cidade</label>
    <input type="text" class="form-control" id="ipt5" wire:model="end_cidade">
    @error('end_cidade') <span class="text-danger">{{ $message }}</span>@enderror
</div>
<div class="form-group">
    <label for="ipt6">Estado</label>
    <input type="text" class="form-control" id="ipt6" wire:model="end_estado">
    @error('end_estado') <span class="text-danger">{{ $message }}</span>@enderror
</div>