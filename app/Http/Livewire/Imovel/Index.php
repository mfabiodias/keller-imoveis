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
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    
    public $active_tab, $caracteristicas, $clientes, $ranges, $subTipos, $tipos, $tipoSubTipos, $imovel, $endereco, $permutas;

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
            'collection' => Imovel::with('cliente', 'tipo', 'subtipo', 'endereco')->paginate(5)
        ]);
    }

    public function create() {
        $this->upsert();
    }

    public function update() {
        $this->upsert("update");
    }

    public function edit($id)
    {
        $this->updateMode = true;

        $this->permutas = Permuta::with('tipo', 'subtipo', 'range')->get()->toArray();
        
        $imovel   = Imovel::where("id", $id)->first();
        $endereco = Endereco::where("cliente_id", $id)->first();

        if(!is_null($imovel)) { 
            bindData($this, "cli_", $imovel->toArray()); 
            $this->changeTipo($imovel->toArray()["tipo_id"], true);
        }
        
        if(!is_null($endereco)) { bindData($this, "end_", $endereco->toArray()); }
    }
    
    public function delete(Imovel $imovel)
    {
        $id   = $imovel->id;
        $nome = $imovel->nome;
        
        if($id)
        {
            $enderecos = Endereco::where("imovel_id", $id)->count();

            if($enderecos > 0)
            {
                session()->flash("type", "danger");
                session()->flash("message", "Imovel {$nome} tem {$enderecos} endereço(s) e não pode ser excluído.");
            }
            else 
            {
                Imovel::where("id", $id)->delete();

                if(Imovel::where("id", $id)->count() > 0)
                {
                    session()->flash("type", "danger");
                    session()->flash("message", "Falha ao excluir o cliente {$nome}! Tente novamente e persistindo o erro contate o administrador.");
                }
                else 
                {
                    session()->flash("type", "success");
                    session()->flash("message", "Imovel {$nome} excluído com sucesso");
                }
            }
        }
    }

    public function getCep() {
        cepPromise($this);
    }

    public function addPermuta() 
    {
        if(!$this->per_id) { inputError('per_id'); }
        else if(!$this->ran_id) { inputError('ran_id'); }
        else {
            
            foreach($this->per_id as $per_id)
            {
                list($tipo_id, $sub_tipo_id) = explode("-", $per_id);

                $addPermuta = true;

                foreach($this->permutas as $permuta)
                {
                    if($permuta["tipo_id"] == $tipo_id && $permuta["subtipo_id"] == $sub_tipo_id && $permuta["range_id"] == $this->ran_id) {
                        $addPermuta = false;
                    }
                }

                # Empedir duplicidade no cadastro de permutas
                if($addPermuta)
                {
                    array_push($this->permutas, [
                        "tipo_id"    => $tipo_id,
                        "subtipo_id" => $sub_tipo_id,
                        "range_id"   => $this->ran_id
                    ]);
                }
            }
        }
    }

    private function mountPermuta($imovel_id) 
    {
        foreach($this->permutas as $key => $permuta)
        {
            $this->permutas[$key]['imovel_id'] = $imovel_id;
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
        $this->permutas = [];
        $this->subTipos = [];
        $this->active_tab = "imovel-tab";
        $this->updateMode = false;
        resetAttributes($this, 'imo_');
        resetAttributes($this, 'end_');
        resetAttributes($this, 'per_');
        resetAttributes($this, 'ran_');
        $this->dispatchBrowserEvent('closeModal');
    }

    private function upsert($type="")
    {
        $upsertStep = true;
        
        $this->formValidate($type);

        $data_cli = $this->dataForm($this, 'imo_');
        $data_imo = $this->dataForm($this, 'end_');

        if($type == "update")
        {
            $act = "atualizado";
            
            if(!$this->imo_id) 
            {
                $upsertStep = false;
                
                session()->flash("type", "error");
                session()->flash("message", "Imovel {$data_cli['nome']} não localizado na base de dados! Persistindo o erro contate o adminstrador!");
            }
            else 
            {
                $imovel = Imovel::find($this->imo_id);
                $imovel->update($data_cli);
            }
            
            $this->updateMode = false;
        }
        else 
        {
            $act = "cadastrado";
            $imovel = Imovel::create($data_cli);
        }

        if($upsertStep)
        {
            // Upsert Endereço
            $endereco_id = !!$this->end_id ? $this->end_id : "";
            $endereco    = Endereco::find($endereco_id);

            if(!!$endereco) {
                $endereco->update($data_imo);
            } else {
                $data_imo["imovel_id"] = $imovel->id;
                Endereco::create($data_imo);
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
        session()->flash("message", "Imovel {$data_cli['nome']} {$act} com sucesso!");

        resetAttributes($this, 'imo_');
        resetAttributes($this, 'end_');
        
        $this->dispatchBrowserEvent('closeModal');
    }

    private function formValidate($type="") 
    {
        return $this->validate([
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
        ]);
    }

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
                        $data->$key = json_encode($item);
                    }
                }
                else {
                    if(!is_null($data[$key]) && !empty($data[$key])) {
                        $data[$key] = json_encode($item);
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

