<div wire:ignore.self class="modal fade" id="{{ $modal_id }}" tabindex="-1" role="dialog" aria-labelledby="{{ $modal_label }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $modal_label }}">{{ $modal_title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">
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
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" wire:click.prevent="{{ $modal_function }}" class="btn btn-primary" data-dismiss="modal">{{ $modal_action }}</button>
            </div>
       </div>
    </div>
</div>