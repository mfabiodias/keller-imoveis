<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imovel extends Model
{
    use HasFactory;

    protected $table      = "imovel";
    protected $primaryKey = "id";
    protected $fillable   = [
        'cliente_id', 'tipo_id', 'subtipo_id', 'nome', 'quarto', 'suite', 
        'banheiro', 'vagas', 'andar', 'valor_venda', 'valor_aluguel', 
        'condominio', 'iptu', 'area_total', 'area_util', 'posicao', 'chaves', 
        'permuta', 'status', 'caracteristica', 'observacao'
    ];

    public function endereco()
    {
        return $this->hasOne("App\Models\Endereco");
    }

    public function cliente()
    {
        return $this->belongsTo("App\Models\Cliente");
    }

    public function tipo()
    {
        return $this->belongsTo("App\Models\Tipo");
    }

    public function subtipo()
    {
        return $this->belongsTo("App\Models\SubTipo");
    }
}