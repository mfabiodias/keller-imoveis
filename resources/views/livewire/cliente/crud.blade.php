<form>
    <div class="form-group">
        <input type="hidden" wire:model="table_id">
        <label for="ipt1">Nome</label>
        <input type="text" class="form-control" id="ipt1" placeholder="Exe: João Paulo" wire:model="nome">
        @error('nome') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group">
        <label for="ipt2">Email</label>
        <input type="email" class="form-control" id="ipt2" placeholder="Exe: joao@gmail.com" wire:model="email">
        @error('email') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
</form>