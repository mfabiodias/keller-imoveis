<?php

namespace App\Http\Livewire\Cliente;

use App\Models\Cliente;
use Livewire\{
    Component,
    WithPagination
};

class ListCliente extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.cliente.list-cliente', [
            'collection' => Cliente::paginate(5)
        ]);
    }
}
