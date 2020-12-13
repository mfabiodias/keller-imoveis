<div class="pt-5">
    <form method="POST" wire:submit.prevent="create">
        @if (session()->has('message'))
        <div class="form-row">
            <div class="form-group col-md-12">
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            </div>
        </div>
        @endif
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Nome</label>
                <input wire:model="nome" type="nome" class="form-control 
                    @error('nome') {{ " is-invalid" }} @enderror ">
                @error('nome')    
                    <div class="invalid-feedback"> {{ $message }} </div>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label>Email</label>
                <input wire:model="email" type="email" class="form-control 
                    @error('email') {{ " is-invalid" }} @enderror
                ">
                @error('email')    
                    <div class="invalid-feedback"> {{ $message }} </div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Criar Cliente</button>
    </form>
</div>