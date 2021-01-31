<?php

namespace App\Http\Livewire\Cliente;

use App\Models\{
    Cliente,
    Endereco
};
use Livewire\{
    Component,
    WithPagination
};

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    
    public $active_tab, $cliente, $endereco;

    // Usar sempre prefixo. Exe: (cli_, end_) e complementar com colunas da tabela. Exe: (prefix_coluna = cli_id)
    public $cli_id, $cli_nome, $cli_email, $cli_tel_residencial, $cli_tel_comercial, $cli_cel, $cli_cel_operadora, 
        $cli_nextel_id, $cli_nacionalidade, $cli_doc_tipo, $cli_doc_numero, $cli_perfil, $cli_fase, $cli_tipo, 
        $cli_investidor, $cli_origem;
    public $end_id, $end_cep, $end_rua, $end_numero, $end_complemento, $end_bairro, $end_cidade, $end_estado;


    public function __construct() 
    {
        // Default Values
        $this->cli_nacionalidade = "Brasileira";
        $this->cli_fase          = "Novo";
        $this->cli_tipo          = "Pessoa Física";
        $this->cli_investidor    = "Não";
    }

    protected $listeners = [
        'changeTab' => 'changeTab'
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
        return view('livewire.cliente.index', [
            'comp_name'  => 'Cliente',
            'collection' => Cliente::paginate(5)
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
        
        $cliente  = Cliente::where("id", $id)->first();
        $endereco = Endereco::where("cliente_id", $id)->first();

        if(!is_null($cliente)) { bindData($this, "cli_", $cliente->toArray()); }
        if(!is_null($endereco)) { bindData($this, "end_", $endereco->toArray()); }
    }
    
    public function delete(Cliente $cliente)
    {
        $id   = $cliente->id;
        $nome = $cliente->nome;
        
        if($id)
        {
            $enderecos = Endereco::where("cliente_id", $id)->count();

            if($enderecos > 0)
            {
                session()->flash("type", "danger");
                session()->flash("message", "Cliente {$nome} tem {$enderecos} endereço(s) e não pode ser excluído.");
            }
            else 
            {
                Cliente::where("id", $id)->delete();

                if(Cliente::where("id", $id)->count() > 0)
                {
                    session()->flash("type", "danger");
                    session()->flash("message", "Falha ao excluir o cliente {$nome}! Tente novamente e persistindo o erro contate o administrador.");
                }
                else 
                {
                    session()->flash("type", "success");
                    session()->flash("message", "Cliente {$nome} excluído com sucesso");
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

        $endereco = Endereco::where("cliente_id", $id)->first();
        
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
        $this->cliente  = Cliente::where("id", $id)->first();
        $this->endereco = Endereco::where("cliente_id", $id)->first();
    }

    public function cancel()
    {
        $this->active_tab = "cliente-tab";
        $this->updateMode = false;
        resetAttributes($this, 'cli_');
        resetAttributes($this, 'end_');
        $this->dispatchBrowserEvent('closeModal');
    }

    private function upsert($type="")
    {
        $upsertStep = true;
        
        $this->formValidate($type);

        $data_cli = $this->dataForm($this, 'cli_');
        $data_end = $this->dataForm($this, 'end_');

        if($type == "update")
        {
            $act = "atualizado";
            
            if(!$this->cli_id) 
            {
                $upsertStep = false;
                
                session()->flash("type", "error");
                session()->flash("message", "Cliente {$data_cli['nome']} não localizado na base de dados! Persistindo o erro contate o adminstrador!");
            }
            else 
            {
                $cliente = Cliente::find($this->cli_id);
                $cliente->update($data_cli);
            }
            
            $this->updateMode = false;
        }
        else 
        {
            $act = "cadastrado";
            $cliente = Cliente::create($data_cli);
        }

        if($upsertStep)
        {
            // Upsert Endereço
            $endereco_id = !!$this->end_id ? $this->end_id : "";
            $endereco    = Endereco::find($endereco_id);
            
            if(!!$endereco) {
                $endereco->update($data_end);
            } else {
                $data_end["cliente_id"] = $cliente->id;
                Endereco::create($data_end);
            }
    
        }
        
        session()->flash("type", "success");
        session()->flash("message", "Cliente {$data_cli['nome']} {$act} com sucesso!");

        resetAttributes($this, 'cli_');
        resetAttributes($this, 'end_');
        
        $this->dispatchBrowserEvent('closeModal');
    }

    private function formValidate($type="") 
    {
        return $this->validate([
            'cli_nome'          => 'required',
            'cli_email'         => $type == 'update' ? 'required|email' : 'required|email|unique:cliente,email',
            'cli_nacionalidade' => 'required',
            'cli_doc_tipo'      => 'required',
            'cli_doc_numero'    => 'required',
            'cli_perfil'        => 'required',
            'cli_fase'          => 'required',
            'cli_tipo'          => 'required',
            'cli_investidor'    => 'required',
            'cli_origem'        => 'required',
            'end_cep'           => 'required',
            'end_rua'           => 'required',
            'end_numero'        => 'required',
            'end_bairro'        => 'required',
            'end_cidade'        => 'required',
            'end_estado'        => 'required',
        ]);
    }

    protected $messages = [
        'cli_nome.required'          => 'Nome é obrigatório.',
        'cli_email.required'         => 'Email é obrigatório.',
        'cli_email.email'            => 'Email inválido.',
        'cli_email.unique'           => 'Email já cadastrado no sistema.',
        'cli_nacionalidade.required' => 'Nacionalidade é obrigatório.',
        'cli_doc_tipo.required'      => 'Tipo documento é obrigatório.',
        'cli_doc_numero.required'    => 'Número do documento é obrigatório.',
        'cli_perfil.required'        => 'Perfil é obrigatório.',
        'cli_fase.required'          => 'Fase é obrigatório.',
        'cli_tipo.required'          => 'Tipo de Pessoa é obrigatório.',
        'cli_investidor.required'    => 'Investidor é obrigatório.',
        'cli_origem.required'        => 'Origem é obrigatório.',
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
        
        # Normaliza dados
        foreach($data as $key => $item)
        {
            if($key == 'cli_nome') {
                if($conv) $data->$key = ucwords($item);
                else $data[$key] = ucwords($item);    
            }
            
            if($key == 'cli_email') {
                if($conv) $data->$key = strtolower($item);
                else $data[$key] = strtolower($item); 
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
}
