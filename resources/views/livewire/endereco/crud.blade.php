<div class="form-row">
    <div class="col-12 col-md-4">
        <div class="form-group">
            <label for="ipt1">Cep</label>
            <input type="hidden" wire:model.defer="end_id">
            <div class="input-group is-invalid">
                <div class="custom-file">
                    <input type="text" class="form-control cep" id="ipt1" maxlength="8" placeholder="Exe: 07077190" wire:model.defer="end_cep">
                </div>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" 
                    type="button" 
                    wire:click="getCep()">Buscar</button>
                </div>
            </div>
            @error('end_cep') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
    </div>
    <div class="col-12 col-md-8">
        <div class="form-group">
            <label for="ipt2">Endereço</label>
            <input type="text" class="form-control" id="ipt2" maxlength="100" placeholder="Exe: Rua João Paulo VI" wire:model.defer="end_rua">
            @error('end_rua') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="form-group">
            <label for="ipt3">Número</label>
            <input type="text" class="form-control" id="ipt3" maxlength="10" wire:model.defer="end_numero">
            @error('end_numero') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
    </div>
    <div class="col-12 col-md-8">
        <div class="form-group">
            <label for="ipt4">Complemento</label>
            <input type="text" class="form-control" id="ipt4" maxlength="100" wire:model.defer="end_complemento">
            @error('end_complemento') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="ipt5">Bairro</label>
            <input type="text" class="form-control" id="ipt5" maxlength="100" wire:model.defer="end_bairro">
            @error('end_bairro') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="ipt6">Cidade</label>
            <input type="text" class="form-control" id="ipt6" maxlength="50" wire:model.defer="end_cidade">
            @error('end_cidade') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="ipt7">Estado</label>
            <select id="ipt7" class="custom-select" wire:model.defer="end_estado">
                <option value="">Selecione um Estado</option>
                <option value="AC">Acre</option>
                <option value="AL">Alagoas</option>
                <option value="AP">Amapá</option>
                <option value="AM">Amazonas</option>
                <option value="BA">Bahia</option>
                <option value="CE">Ceará</option>
                <option value="DF">Distrito Federal</option>
                <option value="ES">Espírito Santo</option>
                <option value="GO">Goiás</option>
                <option value="MA">Maranhão</option>
                <option value="MT">Mato Grosso</option>
                <option value="MS">Mato Grosso do Sul</option>
                <option value="MG">Minas Gerais</option>
                <option value="PA">Pará</option>
                <option value="PB">Paraíba</option>
                <option value="PR">Paraná</option>
                <option value="PE">Pernambuco</option>
                <option value="PI">Piauí</option>
                <option value="RJ">Rio de Janeiro</option>
                <option value="RN">Rio Grande do Norte</option>
                <option value="RS">Rio Grande do Sul</option>
                <option value="RO">Rondônia</option>
                <option value="RR">Roraima</option>
                <option value="SC">Santa Catarina</option>
                <option value="SP">São Paulo</option>
                <option value="SE">Sergipe</option>
                <option value="TO">Tocantins</option>
              </select>
            @error('end_estado') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
    </div>
</div>














