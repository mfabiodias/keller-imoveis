<?php

namespace App\Http\Livewire\Imovel;

use App\Models\{
    Caracteristica,
    Cliente,
    Endereco,
    Imovel,
    Permuta,
    Range,
    SubTipo,
    Tipo,
};
use Livewire\{
    Component,
    WithPagination
};

class Index extends Component
{
    // use WithPagination;
    // protected $paginationTheme = 'bootstrap';

    public $type_tab = [
        "imo" => "imovel-tab",
        "end" => "endereco-tab",
        "per" => "permuta-tab",
    ];
    
    public $required_inputs, $active_tab, $caracteristicas, $clientes, $ranges, $subTipos, $tipos, $tipoSubTipos, 
        $imovel, $endereco, $permutas, $list_permutas, $confirmDelete, $confirmLabel;

    // Usar sempre prefixo. Exe: (imo_, end_) e complementar com colunas da tabela. Exe: (prefix_coluna = imo_id)
    public $imo_id, $imo_cliente_id, $imo_tipo_id, $imo_subtipo_id, $imo_nome, $imo_quarto, $imo_suite, $imo_banheiro, 
        $imo_vagas, $imo_andar, $imo_valor_venda, $imo_valor_aluguel, $imo_condominio, $imo_iptu, $imo_area_total, 
        $imo_area_util, $imo_posicao, $imo_chaves, $imo_permuta, $imo_status, $imo_caracteristica, $imo_observacao;
    public $end_id, $end_cep, $end_rua, $end_numero, $end_complemento, $end_bairro, $end_cidade, $end_estado;
    public $per_id;
    public $ran_id;

    public function __construct() 
    {
        // Default Values
        $this->imo_quarto        = 0;
        $this->imo_suite         = 0;
        $this->imo_banheiro      = 0;
        $this->imo_vagas         = 0;
        $this->imo_andar         = 0;
        $this->imo_valor_venda   = 0;
        $this->imo_valor_aluguel = 0;
        $this->imo_condominio    = 0;
        $this->imo_iptu          = 0;
        $this->imo_area_total    = 0;
        $this->imo_area_util     = 0;
        $this->imo_permuta       = 'nao';
        $this->imo_status        = 'ativo';
        $this->imo_observacao    = '';

        $this->caracteristicas = $this->getCaracteristicas();
        $this->clientes        = Cliente::orderBy('nome', 'asc')->get()->toArray();
        $this->permutas        = [];
        $this->list_permutas   = [];
        $this->ranges          = Range::get()->toArray();
        $this->subTipos        = [];
        $this->tipos           = Tipo::get()->toArray();
        $this->tipoSubTipos    = Tipo::with('subtipo')->get()->toArray();

        // dd(Imovel::whereJsonContains('caracteristica', [1])->get());
    }

    protected $listeners = [
        'changeTab'  => 'changeTab',
        'changeTipo' => 'changeTipo',
    ];

    public function changeTab($active_tab) {
        $this->active_tab = $active_tab;
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.imovel.index', [
            'comp_name'  => 'Imóvel',
            // 'collection' => Imovel::with('cliente', 'tipo', 'subtipo', 'endereco')->paginate(5)
            'collection' => Imovel::with('cliente', 'tipo', 'subtipo', 'endereco')->get()
        ]);
    }

    public function create() {
        $this->upsert();
    }

    public function update() {
        $this->upsert("update");
    }

    public function statusPermuta($range_id) 
    {
        foreach($this->permutas as $key => $permuta)
        {
            if($this->permutas[$key]["range_id"] == $range_id) {
                $this->permutas[$key]["status"] = $this->permutas[$key]["status"] == 'ativo' ? 'inativo' : 'ativo'; 
            }
        }

        $this->listPermutas();
    }

    public function delPermuta($range_id) 
    {
        foreach($this->permutas as $key => $permuta)
        {
            if($this->permutas[$key]["range_id"] == $range_id) {
                unset($this->permutas[$key]); 
            }
        }

        $this->listPermutas();
    }

    private function listPermutas() 
    {
        $this->list_permutas = [];

        foreach($this->permutas as $permuta)
        {
            if(!array_key_exists($permuta['range_id'], $this->list_permutas)) {
                $this->list_permutas[$permuta['range_id']] = [ "min" => 0, "max" => 0, "status" => "", "tipo" => [] ];
                $this->list_permutas[$permuta['range_id']]['tipo'][$permuta['tipo_id']] = ["nome" => "", "subtipo" => []];
            }

            $this->list_permutas[$permuta['range_id']]['status'] = $permuta['status'];

            foreach($this->tipoSubTipos as $tipoSubTipo)
            {
                if($permuta['tipo_id'] == $tipoSubTipo['id']) {
                    $this->list_permutas[$permuta['range_id']]['tipo'][$permuta['tipo_id']]['nome'] = $tipoSubTipo['nome'];
                }
                
                foreach($tipoSubTipo['subtipo'] as $subTipo)
                {
                    if($permuta['subtipo_id'] == $subTipo['id']) {
                        $this->list_permutas[$permuta['range_id']]['tipo'][$permuta['tipo_id']]['subtipo'][$subTipo['id']] = $subTipo['nome'];
                    }
                }
            }
        }

        foreach($this->ranges as $range)
        {
            if(isset($this->list_permutas[$range['id']])) 
            {
                $this->list_permutas[$range['id']]['min'] = $range['min'];
                $this->list_permutas[$range['id']]['max'] = $range['max'];
            }
        }
        
        // Modelo de estrutura
        $list_permutas['range_id'] = [
            "min" => 0,
            "max" => 0,
            "status" => 'ativo',
            "tipo" => [
                1 => [ "nome" => "apartamento", "subtipo" => [ 10 => "terraco", 22 => "flat" ] ],
                2 => [ "nome" => "casa",        "subtipo" => [ 20 => "terraco", 12 => "flat" ] ],
            ]
        ];

        // dd([$this->ranges, $this->tipoSubTipos, $this->permutas, $this->list_permutas, $list_permutas]);
    }

    public function edit($id)
    {
        $this->updateMode = true;

        $this->permutas = Permuta::where("imovel_id", $id)->get()->toArray();
        $this->listPermutas();

        $imovel   = Imovel::where("id", $id)->first();
        $endereco = Endereco::where("imovel_id", $id)->first();

        // dd([$imovel->caracteristica, json_decode($imovel->caracteristica, true)]);

        if(!is_null($imovel)) { 
            bindData($this, "imo_", $imovel->toArray()); 
            $this->changeTipo($imovel->toArray()["tipo_id"], true);
        }
        
        if(!is_null($endereco)) { bindData($this, "end_", $endereco->toArray()); }

        $this->dispatchBrowserEvent('bootstrapSelectValues', ['attr' => "imo_cliente_id", 'values' => $imovel->cliente_id]);
        $this->dispatchBrowserEvent('bootstrapSelectValues', ['attr' => "imo_caracteristica", 'values' => json_decode($imovel->caracteristica, true)]);
    }
    
    public function confirm(Imovel $imovel)
    {
        $this->confirmDelete = $imovel;
        $this->confirmLabel  = $imovel->nome;
    }
    
    public function delete()
    {
        $id   = $this->confirmDelete->id;
        $nome = $this->confirmDelete->nome;
        
        if($id)
        {
            Endereco::where("imovel_id", $id)->delete();
            Permuta::where("imovel_id", $id)->delete();
            Imovel::where("id", $id)->delete();

            if(Imovel::where("id", $id)->count() > 0)
            {
                session()->flash("type", "danger");
                session()->flash("message", "Falha ao excluir o imóvel {$nome}! Tente novamente e persistindo o erro contate o administrador.");
            }
            else 
            {
                session()->flash("type", "success");
                session()->flash("message", "Imovel {$nome} excluído com sucesso");
            }
        }
        else 
        {
            session()->flash("type", "danger");
            session()->flash("message", "Falha ao excluir o imóvel! Tente novamente e persistindo o erro contate o administrador.");
        }

        $this->cleanFormData();
    }

    public function getCep() {
        cepPromise($this);
    }

    public function addPermuta() 
    {
        if(!$this->per_id) { $this->addError('per_id', 'Campo Obrigatório'); }
        if(!$this->ran_id) { $this->addError('ran_id', 'Campo Obrigatório'); }

        if(!!$this->per_id && !!$this->ran_id) {
            
            foreach($this->per_id as $per_id)
            {
                list($tipo_id, $sub_tipo_id) = explode("-", $per_id);

                $addPermuta = true;

                # Atualiza range de tipo e subtipo existente
                foreach($this->permutas as $key => $permuta)
                {
                    if($permuta["tipo_id"] == $tipo_id && $permuta["subtipo_id"] == $sub_tipo_id) {
                        if($permuta["range_id"] != $this->ran_id) { 
                            $this->permutas[$key]["range_id"] = (int) $this->ran_id;
                        }
                        
                        $addPermuta = false;
                    }
                }

                # Empedir duplicidade no cadastro de permutas
                if($addPermuta)
                {
                    array_push($this->permutas, [
                        "tipo_id"    => $tipo_id,
                        "subtipo_id" => $sub_tipo_id,
                        "range_id"   => $this->ran_id,
                        "status"     => "ativo"
                    ]);
                }
            }
        }

        $this->listPermutas();
    }

    private function mountPermuta($imovel_id) 
    {
        foreach($this->permutas as $key => $permuta)
        {
            $this->permutas[$key]['imovel_id'] = $imovel_id;
            $this->permutas[$key]['status']    = $permuta['status'];
        }
    }

    public function address($id)
    { 
        resetAttributes($this, 'end_');

        $endereco = Endereco::where("imovel_id", $id)->first();
        
        if(!!$endereco)
        {
            $this->end_id          = $endereco->id; 
            $this->end_cep         = $endereco->cep; 
            $this->end_rua         = $endereco->rua; 
            $this->end_numero      = $endereco->numero; 
            $this->end_complemento = $endereco->complemento; 
            $this->end_bairro      = $endereco->bairro; 
            $this->end_cidade      = $endereco->cidade; 
            $this->end_estado      = $endereco->estado;
        }
    }

    public function card($id)
    {
        $this->cliente  = Imovel::where("id", $id)->first();
        $this->endereco = Endereco::where("imovel_id", $id)->first();
    }

    public function cancel()
    {
        $this->cleanFormData();
    }

    private function upsert($type="")
    {
        $upsertStep = true;
        
        $this->required_inputs = getFormInputs($this->rules);
        $this->formValidate($type);

        $data_imo = $this->dataForm($this, 'imo_');
        $data_end = $this->dataForm($this, 'end_');

        //dd([$type, $this->list_permutas, $data_imo, $data_end]);

        if($type == "update")
        {
            $act = "atualizado";
            
            if(!$this->imo_id) 
            {
                $upsertStep = false;
                
                session()->flash("type", "error");
                session()->flash("message", "Imovel {$data_imo['nome']} não localizado na base de dados! Persistindo o erro contate o adminstrador!");
            }
            else 
            {
                $imovel = Imovel::find($this->imo_id);
                $imovel->update($data_imo);
            }
            
            $this->updateMode = false;
        }
        else 
        {
            $act = "cadastrado";
            $imovel = Imovel::create($data_imo);
        }

        if($upsertStep)
        {
            // Upsert Endereço
            $endereco_id = !!$this->end_id ? $this->end_id : "";
            $endereco    = Endereco::find($endereco_id);

            if(!!$endereco) {
                $endereco->update($data_end);
            } else {
                $data_end["imovel_id"] = $imovel->id;
                Endereco::create($data_end);
            }

            // Upsert Permuta
            $this->mountPermuta($imovel->id);

            foreach($this->permutas as $p)
            {
                $getPermuta = Permuta::where([
                    'tipo_id'    => $p['tipo_id'], 
                    'subtipo_id' => $p['subtipo_id'], 
                    'imovel_id'  => $p['imovel_id'],
                ])->get()->toArray();

                if(empty($getPermuta)) {
                    Permuta::create($p);
                } else {
                    $permuta = Permuta::find($getPermuta[0]['id']);
                    $permuta->update($p);
                }
            }
        }
        
        session()->flash("type", "success");
        session()->flash("message", "Imovel {$data_imo['nome']} {$act} com sucesso!");

        $this->cleanFormData();
    }

    private function cleanFormData()
    {
        $this->list_permutas = [];
        $this->permutas      = [];
        $this->subTipos      = [];
        $this->confirmDelete = false;
        $this->confirmLabel  = false;
        $this->updateMode    = false;
        $this->changeTab("imovel-tab");
        resetAttributes($this, 'imo_');
        resetAttributes($this, 'end_');
        resetAttributes($this, 'per_');
        resetAttributes($this, 'ran_');
        $this->dispatchBrowserEvent('bootstrapSelectValues', ['attr' => "imo_cliente_id", 'values' => ""]);
        $this->dispatchBrowserEvent('bootstrapSelectValues', ['attr' => "imo_caracteristica", 'values' => ""]);
        $this->dispatchBrowserEvent('closeModal');
    }

    private function formValidate($type="") 
    {
        return $this->validate();
    }

    protected $rules = [
        'imo_cliente_id' => 'required',
        'imo_tipo_id'    => 'required',
        'imo_subtipo_id' => 'required',
        'imo_nome'       => 'required',
        'imo_posicao'    => 'required',
        'imo_chaves'     => 'required',
        'imo_permuta'    => 'required',
        'imo_status'     => 'required',
        'end_cep'        => 'required',
        'end_rua'        => 'required',
        'end_numero'     => 'required',
        'end_bairro'     => 'required',
        'end_cidade'     => 'required',
        'end_estado'     => 'required',
    ];
    
    protected $messages = [
        'imo_cliente_id.required' => 'Cliente é obrigatório.',
        'imo_tipo_id.required'    => 'Tipo é obrigatório.',
        'imo_subtipo_id.required' => 'Subtipo é obrigatório.',
        'imo_nome.required'       => 'Nome é obrigatório.',
        'imo_posicao.required'    => 'Posição é obrigatório.',
        'imo_chaves.required'     => 'Chaves é obrigatório.',
        'imo_permuta.required'    => 'Permuta é obrigatório.',
        'imo_status.required'     => 'Status é obrigatório.',
        'end_cep.required'        => 'CEP é obrigatório.',
        'end_rua.required'        => 'Rua é obrigatório.',
        'end_numero.required'     => 'Número é obrigatório.',
        'end_bairro.required'     => 'Bairro é obrigatório.',
        'end_cidade.required'     => 'Cidade é obrigatório.',
        'end_estado.required'     => 'Estado é obrigatório.',
    ];

    private function dataForm(&$data, $prefix)
    {
        # Formatar dados
        $conv = gettype($data) === 'object';
        
        # Normaliza dados
        foreach($data as $key => $item)
        {
            if($key == 'imo_nome') 
            {
                if($conv) $data->$key = ucwords($item);
                else $data[$key] = ucwords($item);    
            } 

            if($key == 'imo_caracteristica') 
            {
                if($conv) {
                    if(!is_null($data->$key) && !empty($data->$key)) {
                        $data->$key = is_array($item) ? json_encode($item) : $item;
                    }
                }
                else {
                    if(!is_null($data[$key]) && !empty($data[$key])) {
                        $data[$key] = is_array($item) ? json_encode($item) : $item;
                    } 
                }     
            }
        }

        # Separa dados da tabela com base no prefix
        $rtn = array();

        foreach($data as $key => $item) 
        {
            if(strpos($key, $prefix) !== false)
            {
                $key = str_replace($prefix, "", $key);
                $rtn[$key] = $item;
            }
        }

        return $rtn;
    }

    public function changeTipo($tipo_id, $edit=false) 
    {
        if(!!$tipo_id) {
            $this->subTipos = SubTipo::where('tipo_id', $tipo_id)->get()->toArray();

            $this->imo_tipo_id = $tipo_id;
            
            if(!$edit) {
                $this->imo_subtipo_id = "";
            }
        }
    }

    private function getCaracteristicas() 
    {
        $caracteristicas = [];
        
        $rtn = Caracteristica::orderBy('tipo', 'asc')->orderBy('nome', 'desc')->get()->toArray();

        foreach($rtn as $r)
        {
            if(!array_key_exists($r['tipo'], $caracteristicas)) {
                $caracteristicas[$r['tipo']] = [];
            }

            $caracteristicas[$r['tipo']][$r['id']] = $r['nome'];
        }

        return $caracteristicas;
    }
}

