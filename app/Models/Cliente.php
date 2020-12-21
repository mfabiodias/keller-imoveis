<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table      = "cliente";
    protected $primaryKey = "id";
    protected $fillable   = [
        'nome', 'email', 'tel_residencial', 'tel_comercial', 'cel', 'cel_operadora', 
        'nextel_id', 'nacionalidade', 'ocupacao', 'doc_tipo', 'doc_numero', 'nome_pai',
        'nome_mae', 'investidor'
    ];

    public function endereco()
    {
        return $this->hasOne("App\Models\Endereco");
    }
}