<ul class="nav nav-tabs" id="imovelTab" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ empty($active_tab) || $active_tab == 'imovel-tab' ? 'active' : '' }}" id="imovel-tab" 
        data-toggle="tab" href="#imovel" role="tab" aria-controls="imovel" 
        aria-selected="{{ empty($active_tab) || $active_tab == 'imovel-tab' ? 'true' : 'false' }}">{{ $comp_name }}</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ $active_tab == 'endereco-tab' ? 'active' : '' }}" id="endereco-tab" 
        data-toggle="tab" href="#endereco" role="tab" aria-controls="endereco" 
        aria-selected="{{ $active_tab == 'endereco-tab' ? 'true' : 'false' }}">Endereço</a>
    </li>
</ul>
<div class="tab-content" id="imovelTabContent">
    {{-- Dados do Cliente --}}
    <div class="tab-pane pt-3 fade {{ empty($active_tab) || $active_tab == 'imovel-tab' ? 'show active' : '' }}" id="imovel" role="tabpanel" aria-labelledby="imovel-tab">
        <div class="form-row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <input type="hidden" wire:model.defer="imo_id">
                    <label for="ipt1">Nome</label>
                    <input type="text" class="form-control" maxlength="100" id="ipt1" placeholder="Exe: João Paulo" wire:model.defer="imo_nome">
                    
                </div>
            </div>
            <div class="col-12 col-md-12">
                <div class="form-group">
                    <label for="ipt9">Tipo</label>
                    <select id="ipt9" class="custom-select" wire:model.defer="imo_tipo_id" wire:ignore >
                        <option value="" {{ !$imo_tipo_id ? 'selected="selected"' : '' }}>Selecione o Tipo</option>
                        @foreach ($tipos as $tipo)
                            {{-- <option value="{{ $tipo["id"] }}" {{ $imo_tipo_id == $tipo["id"] ? 'selected' : '' }}>{{ $tipo["nome"] }}</option> --}}
                            <option 
                                value="{{ $tipo["id"] }}" 
                                wire:click="changeTipo({{$tipo["id"]}})" 
                                {{ $imo_tipo_id == $tipo["id"] ? 'selected="selected"' : '' }}
                            >
                                {{ $tipo["nome"] }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-12">
                <div class="form-group">
                    <label for="ipt9">SubTipo</label>
                    <select id="ipt9" class="custom-select" wire:model.defer="imo_subtipo_id" >
                        <option value="" {{ !$imo_subtipo_id ? 'selected' : '' }}>Selecione o SubTipo</option>
                        @foreach ($subTipos as $subTipo)
                            <option 
                                value="{{ $subTipo["id"] }}" 
                                {{ $imo_subtipo_id == $subTipo["id"] ? 'selected' : '' }}
                            >
                                {{ $subTipo["nome"] }}
                            </option>
                        @endforeach
                    </select>
                    
                </div>
            </div>
        </div>
    </div>
    {{-- Endereço do Cliente --}}
    <div class="tab-pane pt-3 fade {{ $active_tab == 'endereco-tab' ? 'show active' : '' }}" id="endereco" role="tabpanel" aria-labelledby="endereco-tab">
        @include('livewire.endereco.crud')
    </div>
</div>