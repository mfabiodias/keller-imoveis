
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
        <div wire:ignore.self class="modal fade new-modal" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Novo Cliente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="ipt1">Nome</label>
                                <input type="text" class="form-control" id="ipt1" placeholder="Exe: João Paulo" wire:model="nome">
                                @error('nome') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label for="ipt2">Email</label>
                                <input type="email" class="form-control" id="ipt2" placeholder="Exe: joao@gmail.com" wire:model="email">
                                @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Fechar</button>
                        <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
