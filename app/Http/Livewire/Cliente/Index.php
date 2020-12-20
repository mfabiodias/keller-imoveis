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
    
    public $cliente, $endereco;
    public $cli_id, $cli_nome, $cli_email;
    public $end_id, $end_rua, $end_numero, $end_complemento, $end_bairro, $end_cidade, $end_estado;

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.cliente.index', [
            'collection' => Cliente::paginate(5)
        ]);
    }

    public function create()
    {
        $validatedData = $this->validate([
            'cli_nome'   => 'required',
            'cli_email'  => 'required|email|unique:cliente,email',
            'end_rua'    => 'required',
            'end_numero' => 'required',
            'end_bairro' => 'required',
            'end_cidade' => 'required',
            'end_estado' => 'required',
        ]);

        $data_cli = $this->dataForm($validatedData, 'cli_');
        $data_end = $this->dataForm($validatedData, 'end_');

        $cliente  = Cliente::create($data_cli);
        $endereco = Endereco::find($this->end_id);
        
        if(!!$endereco) {
            $endereco->update($data_end);
        } else {
            $data_end["cliente_id"] = $cliente->id;
            Endereco::create($data_end);
        }

        session()->flash("type", "success");
        session()->flash("message", "Cliente {$data_cli['nome']} cadastrado com sucesso!");

        resetAttributes($this, 'cli_');
        resetAttributes($this, 'end_');
        
        $this->dispatchBrowserEvent('closeModal');
    }

    public function edit($id)
    {
        $this->updateMode = true;
        
        $cliente  = Cliente::where("id", $id)->first();
        $endereco = Endereco::where("cliente_id", $id)->first();
        
        $this->cli_id    = $cliente->id;
        $this->cli_nome  = $cliente->nome;
        $this->cli_email = $cliente->email;

        $this->end_id          = $endereco->id;
        $this->end_rua         = $endereco->rua;
        $this->end_numero      = $endereco->numero;
        $this->end_complemento = $endereco->complemento;
        $this->end_bairro      = $endereco->bairro;
        $this->end_cidade      = $endereco->cidade;
        $this->end_estado      = $endereco->estado;
    }

    public function address($id)
    {
        resetAttributes($this, 'end_');

        $endereco = Endereco::where("cliente_id", $id)->first();
        
        if(!!$endereco)
        {
            $this->end_id          = $endereco->id; 
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
        $this->updateMode = false;
        resetAttributes($this, 'cli_');
        $this->dispatchBrowserEvent('closeModal');
    }

    public function update()
    {
        $validatedData = $this->validate([
            'cli_nome'  => 'required',
            'cli_email' => 'required|email',
        ]);

        if($this->cli_id) 
        {
            $data = $this->dataForm($this, 'cli_');

            $cliente = Cliente::find($this->cli_id);
            $cliente->update($data);
            
            $this->updateMode = false;
            
            session()->flash("type", "success");
            session()->flash("message", "Cliente {$data['nome']} atualizado com sucesso");
            
            resetAttributes($this, 'cli_');
            // $this->dispatchBrowserEvent('closeModal');
        }
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

    private function dataForm(&$data, $prefix)
    {
        # Formatar dados
        $conv = gettype($data) === 'object';
        
        foreach($data as $key => $item)
        {
            if($key == 'cli_nome') {
                if($conv) $data->$key = ucwords($item);
                else $data[$key] = ucwords($item);    
            } else if($key == 'cli_email') {
                if($conv) $data->$key = strtolower($item);
                else $data[$key] = strtolower($item); 
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
