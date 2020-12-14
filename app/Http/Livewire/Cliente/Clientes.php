<?php

namespace App\Http\Livewire\Cliente;

use App\Models\Cliente;
use Livewire\{
    Component,
    WithPagination
};

class Clientes extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    
    public $table_id, $nome, $email;
    public $updateMode = false;

    public function render()
    {
        return view('livewire.cliente.clientes', [
            'collection' => Cliente::paginate(5)
        ]);
    }

    private function resetInputFields(){
        $this->table_id = '';
        $this->nome     = '';
        $this->email    = '';

        $this->dispatchBrowserEvent('closeModal');
    }

    public function store()
    {
        $validatedDate = $this->validate([
            'nome'  => 'required',
            'email' => 'required|email',
        ]);

        Cliente::create($validatedDate);

        session()->flash("message", 'Cliente cadastrado com sucesso!');

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
        $validatedDate = $this->validate([
            'nome'  => 'required',
            'email' => 'required|email',
        ]);

        if($this->table_id) 
        {
            $cliente = Cliente::find($this->table_id);
            $cliente->update([
                'nome'  => $this->nome,
                'email' => $this->email,
            ]);
            
            $this->updateMode = false;
            
            session()->flash("message", "Cliente {$this->nome} atualizado com sucesso");
            
            $this->resetInputFields();
        }
    }

    public function delete(Cliente $cliente)
    {
        if($cliente->id)
        {
            Cliente::where("id", $cliente->id)->delete();
            session()->flash("message", "Cliente {$this->nome} excluído com sucesso");
        }
    }
}
