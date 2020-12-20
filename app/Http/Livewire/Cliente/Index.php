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
    
    public $table_id, $nome, $email;
    public $updateMode = false;

    public function render()
    {
        return view('livewire.cliente.index', [
            'collection' => Cliente::paginate(5)
        ]);
    }

    private function resetInputFields(){
        $this->table_id = '';
        $this->nome     = '';
        $this->email    = '';

        $this->dispatchBrowserEvent('closeModal');
    }

    public function create()
    {
        $validatedData = $this->validate([
            'nome'  => 'required',
            'email' => 'required|email',
        ]);

        $this->dataForm($validatedData);

        Cliente::create($validatedData);

        session()->flash("type", "success");
        session()->flash("message", "Cliente {$validatedData['nome']} cadastrado com sucesso!");

        $this->resetInputFields();
    }

    public function edit($id)
    {
        $this->updateMode = true;
        
        $cliente = Cliente::where("id", $id)->first();
        
        $this->table_id = $id;
        $this->nome     = $cliente->nome;
        $this->email    = $cliente->email;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {
        $validatedData = $this->validate([
            'nome'  => 'required',
            'email' => 'required|email',
        ]);

        if($this->table_id) 
        {
            $this->dataForm($this);

            $cliente = Cliente::find($this->table_id);
            $cliente->update([
                'nome'  => $this->nome,
                'email' => $this->email,
            ]);
            
            $this->updateMode = false;
            
            session()->flash("type", "success");
            session()->flash("message", "Cliente {$this->nome} atualizado com sucesso");
            
            $this->resetInputFields();
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

    private function dataForm(&$data)
    {
        $conv = gettype($data) === 'object';
        
        foreach($data as $key => $item)
        {
            if($key == 'nome') {
                if($conv) $data->$key = ucwords($item);
                else $data[$key] = ucwords($item);    
            } else if($key == 'email') {
                if($conv) $data->$key = strtolower($item);
                else $data[$key] = strtolower($item); 
            } 
        }
    }
}
