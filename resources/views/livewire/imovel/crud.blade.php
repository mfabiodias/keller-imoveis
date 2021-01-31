<?php
if($errors->any()) 
{
    foreach ($required_inputs as $linput) 
    {
        if ($errors->has($linput)) 
        {
            list($lp, $li) = explode("_", $linput);
            $active_tab = $type_tab[$lp];
        }
    }
}
?>
<ul class="nav nav-tabs toggle-tab" id="imovelTab" role="tablist">
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
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ $active_tab == 'permuta-tab' ? 'active' : '' }}" id="permuta-tab" 
        data-toggle="tab" href="#permuta" role="tab" aria-controls="permuta" 
        aria-selected="{{ $active_tab == 'permuta-tab' ? 'true' : 'false' }}">Permuta</a>
    </li>
</ul>
<div class="tab-content" id="imovelTabContent" >

    {{-- Dados do Imóvel --}}
    <div class="tab-pane pt-3 fade {{ empty($active_tab) || $active_tab == 'imovel-tab' ? 'show active' : '' }}" id="imovel" role="tabpanel" aria-labelledby="imovel-tab">
        <div class="form-row">

            <div class="col-12 col-md-4">
                <div class="form-group" >
                    <div wire:ignore>
                        <input type="hidden" wire:model.defer="imo_id">
                        <label for="ipt1">Cliente</label>
                        <select id="ipt1" class="selectpicker" data-live-search="true" data-width="100%" wire:model.defer="imo_cliente_id" >
                            <option value="" {{ !$imo_cliente_id ? 'selected' : '' }}>Selecione o Cliente</option>
                            @foreach ($clientes as $cliente)
                                <option 
                                    value="{{ $cliente["id"] }}" 
                                    {{ $imo_cliente_id == $cliente["id"] ? 'selected' : '' }}
                                >
                                    {{ $cliente["nome"] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('imo_cliente_id') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group" >
                    <div wire:ignore>
                        <label for="ipt2">Tipo</label>
                        <select id="ipt2" class="custom-select" wire:model.defer="imo_tipo_id" >
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
                    @error('imo_tipo_id') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="ipt3">SubTipo</label>
                    <select id="ipt3" class="custom-select" wire:model.defer="imo_subtipo_id" >
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
                    @error('imo_subtipo_id') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="ipt4">Nome (Torrem, Emprendimento e etc...)</label>
                    <input id="ipt4" type="text" class="form-control" maxlength="100" placeholder="Edifício Las Vegas" wire:model.defer="imo_nome">
                    @error('imo_nome') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="col-12 col-md-2">
                <div class="form-group">
                    <label for="ipt5">Quartos</label>
                    <input id="ipt5" type="number" class="form-control" step="1" min="0" wire:model.defer="imo_quarto">
                    @error('imo_quarto') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="col-12 col-md-2">
                <div class="form-group">
                    <label for="ipt6">Suítes</label>
                    <input id="ipt6" type="number" class="form-control" step="1" min="0" wire:model.defer="imo_suite">
                    @error('imo_suite') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="col-12 col-md-2">
                <div class="form-group">
                    <label for="ipt7">Banheiros</label>
                    <input id="ipt7" type="number" class="form-control" step="1" min="0" wire:model.defer="imo_banheiro">
                    @error('imo_banheiro') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="col-12 col-md-2">
                <div class="form-group">
                    <label for="ipt8">Vagas</label>
                    <input id="ipt8" type="number" class="form-control" step="1" min="0" wire:model.defer="imo_vagas">
                    @error('imo_vagas') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="col-12 col-md-2">
                <div class="form-group">
                    <label for="ipt9">Andar</label>
                    <input id="ipt9" type="number" class="form-control" step="1" min="0" wire:model.defer="imo_andar">
                    @error('imo_andar') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="col-12 col-md-2">
                <div class="form-group">
                    <label for="ipt10">Valor Venda</label>
                    <input id="ipt10" type="number" class="form-control" step="0.1" min="0" wire:model.defer="imo_valor_venda">
                    @error('imo_valor_venda') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="col-12 col-md-2">
                <div class="form-group">
                    <label for="ipt11">Valor Aluguel</label>
                    <input id="ipt11" type="number" class="form-control" step="0.1" min="0" wire:model.defer="imo_valor_aluguel">
                    @error('imo_valor_aluguel') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="col-12 col-md-2">
                <div class="form-group">
                    <label for="ipt12">Condomínio</label>
                    <input id="ipt12" type="number" class="form-control" step="0.1" min="0" wire:model.defer="imo_condominio">
                    @error('imo_condominio') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="col-12 col-md-2">
                <div class="form-group">
                    <label for="ipt13">IPTU</label>
                    <input id="ipt13" type="number" class="form-control" step="0.1" min="0" wire:model.defer="imo_iptu">
                    @error('imo_iptu') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="col-12 col-md-2">
                <div class="form-group">
                    <label for="ipt14">Área Total (m²)</label>
                    <input id="ipt14" type="number" class="form-control" step="0.1" min="0" wire:model.defer="imo_area_total">
                    @error('imo_area_total') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="col-12 col-md-2">
                <div class="form-group">
                    <label for="ipt15">Área Útil (m²)</label>
                    <input id="ipt15" type="number" class="form-control" step="0.1" min="0" wire:model.defer="imo_area_util">
                    @error('imo_area_util') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="col-12 col-md-2">
                <div class="form-group">
                    <label for="ipt16">Posição</label>
                    <select id="ipt16" class="custom-select" wire:model.defer="imo_posicao">
                        <option value="">Selecione</option>
                        <option value="norte/leste">Norte/Leste</option>
                        <option value="norte/oeste">Norte/Oeste</option>
                        <option value="sul/leste">Sul/Leste</option>
                        <option value="sul/oeste">Sul/Oeste</option>
                    </select>
                    @error('imo_posicao') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="col-12 col-md-2">
                <div class="form-group">
                    <label for="ipt17">Chaves</label>
                    <select id="ipt17" class="custom-select" wire:model.defer="imo_chaves">
                        <option value="">Selecione</option>
                        <option value="imobiliaria">Imobiliaria</option>
                        <option value="portaria">Portaria</option>
                        <option value="proprietario">Proprietário</option>
                        <option value="inquilino">Inquilino</option>
                        <option value="posse">Em posse</option>
                    </select>
                    @error('imo_chaves') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="col-12 col-md-2">
                <div class="form-group">
                    <label for="ipt18">Permuta</label>
                    <select id="ipt18" class="custom-select" wire:model.defer="imo_permuta">
                        <option value="sim">Sim</option>
                        <option value="nao">Não</option>
                    </select>
                    @error('imo_permuta') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="col-12 col-md-2">
                <div class="form-group">
                    <label for="ipt19">Status</label>
                    <select id="ipt19" class="custom-select" wire:model.defer="imo_status">
                        <option value="ativo">Ativo</option>
                        <option value="inativo">Inativo</option>
                    </select>
                    @error('imo_status') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="col-12 col-md-12">
                <div class="form-group">
                    <div wire:ignore>
                        <label for="ipt20">Caracteresticas</label>
                        <select id="ipt20" class="selectpicker" multiple data-width="100%" wire:model.defer="imo_caracteristica" >
                            <?php 
                            foreach($caracteristicas as $tipo => $tipo_caracteristicas) 
                            {
                                echo  '<optgroup label="'.$tipo.'" >';
    
                                foreach($tipo_caracteristicas as $id => $caracteristica) {
                                    echo '<option value="'.$id.'" >'.$caracteristica.'</option>';
                                }
    
                                echo  '</optgroup>';
                            }
                            ?>
                        </select>
                    </div>
                    @error('imo_caracteristica') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>


            <div class="col-12 col-md-12">
                <div class="form-group">
                    <label for="ipt21">Observações</label>
                    <textarea id="ipt21" rows="4" class="form-control" wire:model.defer="imo_observacao"></textarea>
                    @error('imo_observacao') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>

        </div>
    </div>

    {{-- Endereço do Imóvel --}}
    <div class="tab-pane pt-3 fade {{ $active_tab == 'endereco-tab' ? 'show active' : '' }}" id="endereco" role="tabpanel" aria-labelledby="endereco-tab">
        @include('livewire.endereco.crud')
    </div>

    {{-- Permuta do Imóvel --}}
    <div class="tab-pane pt-3 fade {{ $active_tab == 'permuta-tab' ? 'show active' : '' }}" id="permuta" role="tabpanel" aria-labelledby="permuta-tab">

        <div class="form-row">

            <div class="col-10">
                
                <div class="form-row">
        
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <div wire:ignore >
                                <label for="ipt22">Tipo Imóvel</label>
                                <select id="ipt22" class="selectpicker" multiple data-width="100%" wire:model.defer="per_id" >
                                    <?php 
                                    foreach($tipoSubTipos as $tipo) 
                                    {
                                        echo  '<optgroup label="'.$tipo["nome"].'" >';
            
                                        foreach ($tipo["subtipo"] as $subtipo) {
                                            echo '<option value="'.$subtipo["tipo_id"].'-'.$subtipo["id"].'" >'.$subtipo["nome"].'</option>';
                                        }
            
                                        echo  '</optgroup>';
                                    }
                                    ?>
                                </select>
                            </div>
                            @error('per_id') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="ipt23">Range de Valor</label>
                            <select id="ipt23" class="custom-select" wire:model.defer="ran_id">
                                <option value="">Selecione</option>
                                <?php 
                                foreach($ranges as $range) 
                                {
                                    echo  '<option value="'.$range['id'].'">'.$range['nome'].'</option>';
                                }
                                ?>
                            </select>
                            @error('ran_id') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
        
                </div>

            </div>
            <div class="col-2 my-align-buttom" >
                <div class="form-group text-right">
                    <label for="ipt24" class="w-100">&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <button id="ipt24" type="button" 
                        class="btn btn-outline-success" 
                        wire:click="addPermuta()" 
                    ><i class="fas fa-plus-circle"></i> Adicionar</button>
                </div>
            </div>
            
            <div class="col-12 mt-3" >

                <hr class="my-3" />

                <table class="table table-sm table-striped table-borderless">
                    <thead>
                        <tr>
                            <th>Tipo Imóveis</th>
                            <th>Range Valor</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="small" >
                    <?php
                    foreach ($permutas as $permuta) 
                    {
                        echo 
                            '<tr>
                                <td class="align-middle">
                                    <strong>'.$permuta['tipo']['nome'].':</strong>
                                    <ul>
                                        <li>Flat</li>
                                        <li>Duplex</li>
                                    </ul>
                                    <strong>Casa:</strong>
                                    <ul>
                                        <li>Terrea</li>
                                        <li>Sobrado</li>
                                    </ul>
                                </td>
                                <td class="align-middle">
                                    De R$ 100.000,00 <br />
                                    a R$ 200.000,00 
                                </td>
                                <td class="align-middle text-center" style="width: 100px !important">
                                    <button type="button" class="btn btn-sm btn-success w-100 my-2" >ON/OFF</button>
                                    <button type="button" class="btn btn-sm btn-outline-danger w-100 my-2" ><i class="fas fa-minus-circle"></i></button>
                                </td>
                            </tr>'
                        ;
                    }
                    ?>
                    </tbody>
                </table>

            </div>

        </div>


    </div>
</div>