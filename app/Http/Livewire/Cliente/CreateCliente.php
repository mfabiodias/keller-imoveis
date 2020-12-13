<?php

namespace App\Http\Livewire\Cliente;

use App\Models\Cliente;
use Livewire\Component;

class CreateCliente extends Component
{
    public $nome;
    public $email;

    protected $rules = [
        "nome"  => "required|min:3|max:100",
        "email" => "required",
    ];

    protected $messages = [
        "nome.required"  => "Nome é obrigatório",
        "nome.min"  => "Nome deve ter :min caracteres no mínimo",
        "nome.max"  => "Nome deve ter :max caracteres no máximo",
        "email.required"  => "Email é obrigatório",
    ];

    public function render()
    {
        return view('livewire.cliente.create-cliente');
    }

    public function create()
    {
        $this->validate();

        Cliente::create([
            'nome'  => $this->nome,
            'email' => $this->email,
        ]);

        $this->cleanData();

        // return redirect()->to('/cliente');
        session()->flash('message', 'Cliente adicionado com sucesso!');
    }

    private function cleanData()
    {
        $this->nome = $this->email = "";
    }
}
