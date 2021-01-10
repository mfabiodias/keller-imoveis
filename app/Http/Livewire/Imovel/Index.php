<?php

namespace App\Http\Livewire\Imovel;

use App\Models\{
    Imovel,
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

    public function render()
    {
        dd(Imovel::with('cliente', 'tipo', 'subtipo')->paginate(5));

        return view('livewire.imovel.index', [
            'collection' => Imovel::with('endereco')
        ]);
    }
} 
