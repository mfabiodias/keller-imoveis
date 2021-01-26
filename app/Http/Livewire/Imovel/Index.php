<?php

namespace App\Http\Livewire\Imovel;

use App\Models\{
    Cliente,
    Endereco,
    Imovel,
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
    
    public $active_tab, $clientes, $ranges, $subTipos, $tipos, $imovel, $endereco;

    // Usar sempre prefixo. Exe: (imo_, end_) e complementar com colunas da tabela. Exe: (prefix_coluna = imo_id)
    public $imo_id, $imo_cliente_id, $imo_tipo_id, $imo_subtipo_id, $imo_nome, $imo_quarto, $imo_suite, $imo_banheiro, 
        $imo_vagas, $imo_andar, $imo_valor_venda, $imo_valor_aluguel, $imo_condominio, $imo_iptu, $imo_area_total, 
        $imo_area_util, $imo_posicao, $imo_chaves, $imo_caracteristica, $imo_observacao, $imo_status;
    public $end_id, $end_cep, $end_rua, $end_numero, $end_complemento, $end_bairro, $end_cidade, $end_estado;

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

        $this->clientes = Cliente::orderBy('nome', 'asc')->get()->toArray();
        $this->ranges   = Range::get()->toArray();
        // $this->subTipos = SubTipo::get()->toArray();
        $this->subTipos = [];
        $this->tipos    = Tipo::get()->toArray();
    }

    protected $listeners = [
        'changeTab'     => 'changeTab',
        'changeTipo' => 'changeTipo',
    ];

    public function changeTab($active_tab) {
        $this->active_tab = $active_tab;
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
        
        $this->dispatchBrowserEvent('pickerRender');
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
        
        $imovel   = Imovel::where("id", $id)->first();
        $endereco = Endereco::where("imovel_id", $id)->first();

        if($imovel)  { bindData($this, "imo_", $imovel); }
        if($endereco) { bindData($this, "end_", $endereco); }
        
        $this->changeTipo($imovel->toArray()["tipo_id"], true);
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
        $this->subTipos = [];
        $this->updateMode = false;
        resetAttributes($this, 'imo_');
        resetAttributes($this, 'end_');
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
            $endereco = Endereco::find($this->end_id);
            
            if(!!$endereco) {
                $endereco->update($data_imo);
            } else {
                $data_imo["imovel_id"] = $imovel->id;
                Endereco::create($data_imo);
            }
    
            session()->flash("type", "success");
            session()->flash("message", "Imovel {$data_cli['nome']} {$act} com sucesso!");
        }

        resetAttributes($this, 'imo_');
        resetAttributes($this, 'end_');
        
        $this->dispatchBrowserEvent('closeModal');
    }

        private function formValidate($type="") 
        {
            return $this->validate([
                'imo_nome'          => 'required',
                'imo_email'         => $type == 'update' ? 'required|email' : 'required|email|unique:cliente,email',
                'imo_nacionalidade' => 'required',
                'imo_doc_tipo'      => 'required',
                'imo_doc_numero'    => 'required',
                'imo_perfil'        => 'required',
                'imo_fase'          => 'required',
                'imo_tipo'          => 'required',
                'imo_investidor'    => 'required',
                'imo_origem'        => 'required',
                'end_cep'           => 'required',
                'end_rua'           => 'required',
                'end_numero'        => 'required',
                'end_bairro'        => 'required',
                'end_cidade'        => 'required',
                'end_estado'        => 'required',
            ]);
        }

        protected $messages = [
            'imo_nome.required'          => 'Nome é obrigatório.',
            'imo_email.required'         => 'Email é obrigatório.',
            'imo_email.email'            => 'Email inválido.',
            'imo_email.unique'           => 'Email já cadastrado no sistema.',
            'imo_nacionalidade.required' => 'Nacionalidade é obrigatório.',
            'imo_doc_tipo.required'      => 'Tipo documento é obrigatório.',
            'imo_doc_numero.required'    => 'Número do documento é obrigatório.',
            'imo_perfil.required'        => 'Perfil é obrigatório.',
            'imo_fase.required'          => 'Fase é obrigatório.',
            'imo_tipo.required'          => 'Tipo de Pessoa é obrigatório.',
            'imo_investidor.required'    => 'Investidor é obrigatório.',
            'imo_origem.required'        => 'Origem é obrigatório.',
            'end_cep.required'           => 'CEP é obrigatório.',
            'end_rua.required'           => 'Rua é obrigatório.',
            'end_numero.required'        => 'Número é obrigatório.',
            'end_bairro.required'        => 'Bairro é obrigatório.',
            'end_cidade.required'        => 'Cidade é obrigatório.',
            'end_estado.required'        => 'Estado é obrigatório.',
        ];

    private function dataForm(&$data, $prefix)
    {
        # Formatar dados
        $conv = gettype($data) === 'object';
        
        foreach($data as $key => $item)
        {
            if($key == 'imo_nome') {
                if($conv) $data->$key = ucwords($item);
                else $data[$key] = ucwords($item);    
            } 
        }

        # Renomer coluna de dados
        $rtn = array();

        foreach($data as $key => $item) {
            $key = str_replace($prefix, "", $key);
            $rtn[$key] = $item;
        }

        return $rtn;
    }
}

