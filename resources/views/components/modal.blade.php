<div wire:ignore.self class="modal fade" id="{{ $modal["id"] }}" tabindex="-1" role="dialog" aria-labelledby="{{ $modal["label"] }}" aria-hidden="true">
    <div class="modal-dialog 
        {{ !$modal["valign"] ? '' : 'modal-dialog-centered' }} 
        {{ !$modal["scroll"] ? '' : 'modal-dialog-scrollable' }} 
        {{ !$modal["size"]   ? '' : 'modal-'.$modal["size"] }}
        " role="document"
    >
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $modal["label"] }}">{{ $modal["title"] }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">
                @include($modal["body"])
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                @if(!empty($modal["action"]) && !empty($modal["function"]))
                    <button type="button" wire:click.prevent="{{ $modal["function"] }}" class="btn btn-primary">{{ $modal["action"] }}</button>
                @endif
            </div>
       </div>
    </div>
</div>