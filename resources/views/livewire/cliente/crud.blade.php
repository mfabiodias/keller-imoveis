<ul class="nav nav-tabs" id="clientTab" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ empty($active_tab) || $active_tab == 'cliente-tab' ? 'active' : '' }}" id="cliente-tab" 
        data-toggle="tab" href="#cliente" role="tab" aria-controls="cliente" 
        aria-selected="{{ empty($active_tab) || $active_tab == 'cliente-tab' ? 'true' : 'false' }}">{{ $comp_name }}</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ $active_tab == 'endereco-tab' ? 'active' : '' }}" id="endereco-tab" 
        data-toggle="tab" href="#endereco" role="tab" aria-controls="endereco" 
        aria-selected="{{ $active_tab == 'endereco-tab' ? 'true' : 'false' }}">Endereço</a>
    </li>
</ul>
<div class="tab-content" id="clientTabContent">
    {{-- Dados do Cliente --}}
    <div class="tab-pane pt-3 fade {{ empty($active_tab) || $active_tab == 'cliente-tab' ? 'show active' : '' }}" id="cliente" role="tabpanel" aria-labelledby="cliente-tab">
        <div class="form-row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <input type="hidden" wire:model.defer="cli_id">
                    <label for="ipt1">Nome</label>
                    <input type="text" class="form-control" maxlength="100" id="ipt1" placeholder="Exe: João Paulo" wire:model.defer="cli_nome">
                    @error('cli_nome') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="ipt2">Email</label>
                    <input type="email" class="form-control" maxlength="255" id="ipt2" placeholder="Exe: joao@gmail.com" wire:model.defer="cli_email">
                    @error('cli_email') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="ipt3">Telefone Residencial</label>
                    <input type="text" class="form-control" id="ipt3" maxlength="30" placeholder="(41) 4299-9090" wire:model.defer="cli_tel_residencial">
                    @error('cli_tel_residencial') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="ipt4">Telefone Comercial</label>
                    <input type="text" class="form-control" id="ipt4" maxlength="30" placeholder="(41) 4299-9090" wire:model.defer="cli_tel_comercial">
                    @error('cli_tel_comercial') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="ipt5">Celular</label>
                    <input type="text" class="form-control" id="ipt5" maxlength="30" placeholder="(41) 94299-9090" wire:model.defer="cli_cel">
                    @error('cli_cel') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="ipt6">Celular Operadora</label>
                    <select id="ipt6" class="custom-select" wire:model.defer="cli_cel_operadora">
                        <option value="">Escolha uma Operadora</option>
                        <option value="Claro">Claro</option>
                        <option value="CTBC">CTBC</option>
                        <option value="OI">OI</option>
                        <option value="Sercomtel">Sercomtel</option>
                        <option value="Tim">Tim</option>
                        <option value="Vivo">Vivo</option>
                        <option value="Nextel">Nextel</option>
                    </select>
                    @error('cli_cel_operadora') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="ipt7">ID Nextel</label>
                    <input type="text" class="form-control" id="ipt7" maxlength="20" placeholder="55*925*7777" wire:model.defer="cli_nextel_id">
                    @error('cli_nextel_id') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="ipt8">Nacionalidade</label>
                    <select id="ipt8" class="custom-select" wire:model.defer="cli_nacionalidade">
                        <option value="Brasileira">Brasileira</option>
                        <option value="Estrangeira">Estrangeira</option>
                    </select>
                    @error('cli_nacionalidade') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="ipt9">Tipo de Documento</label>
                    <select id="ipt9" class="custom-select" wire:model.defer="cli_doc_tipo">
                        <option value="">Selecione Tipo de Documento</option>
                        <option value="RG">RG</option>
                        <option value="CPF">CPF</option>
                        <option value="CNPJ">CNPJ</option>
                        <option value="RNE">RNE</option>
                        <option value="CNH">CNH</option>
                        <option value="Passaporte">Passaporte</option>
                        <option value="Carteira de Trabalho">Carteira de Trabalho</option>
                        <option value="Título Eleitor">Título Eleitor</option>
                        <option value="Certidão Nascimento">Certidão Nascimento</option>
                    </select>
                    @error('cli_doc_tipo') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="ipt10">Número de Documento</label>
                    <input type="text" class="form-control" id="ipt10" maxlength="20" placeholder="50.203.232-9" wire:model.defer="cli_doc_numero">
                    @error('cli_doc_numero') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="ipt11">Perfil</label>
                    <select id="ipt11" class="custom-select" wire:model.defer="cli_perfil">
                        <option value="">Selecione o Perfil</option>
                        <option value="Proprietário">Proprietário</option>
                        <option value="Cliente Interessado">Cliente Interessado</option>
                    </select>
                    @error('cli_perfil') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="ipt12">Fase</label>
                    <select id="ipt12" class="custom-select" wire:model.defer="cli_fase">
                        <option value="Novo">Novo</option>
                        <option value="Em Atendimento">Em Atendimento</option>
                        <option value="Com Proposta">Com Proposta</option>
                        <option value="Ganhou">Ganhou</option>
                        <option value="Perdeu">Perdeu</option>
                        <option value="Inativo">Inativo</option>
                    </select>
                    @error('cli_fase') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="ipt13">Tipo</label>
                    <select id="ipt13" class="custom-select" wire:model.defer="cli_tipo">
                        <option value="Pessoa Física">Pessoa Física</option>
                        <option value="Pessoa Jurídica">Pessoa Jurídica</option>
                    </select>
                    @error('cli_tipo') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="ipt14">Investidor</label>
                    <select id="ipt14" class="custom-select" wire:model.defer="cli_investidor">
                        <option value="Sim">Sim</option>
                        <option value="Não">Não</option>
                    </select>
                    @error('cli_investidor') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="ipt15">Origem</label>
                    <select id="ipt15" class="custom-select" wire:model.defer="cli_origem">
                        <option value="">Escolha uma Origem</option>
                        <option value="Email">Email</option>
                        <option value="Jornal">Jornal</option>
                        <option value="Pessoal">Pessoal</option>
                        <option value="Placa">Placa</option>
                        <option value="Revista">Revista</option>
                        <option value="Site">Site</option>
                        <option value="Telefone">Telefone</option>
                        <option value="Outros">Outros</option>
                    </select>
                    @error('cli_origem') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>
    </div>
    {{-- Endereço do Cliente --}}
    <div class="tab-pane pt-3 fade {{ $active_tab == 'endereco-tab' ? 'show active' : '' }}" id="endereco" role="tabpanel" aria-labelledby="endereco-tab">
        @include('livewire.endereco.crud')
    </div>
</div>