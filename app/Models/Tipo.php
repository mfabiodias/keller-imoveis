<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    use HasFactory;

    protected $table      = "tipo";
    protected $primaryKey = "id";
    protected $fillable   = ['tipo_id', 'nome'];

    public function imovel()
    {
        return $this->hasMany("App\Models\Imovel");
    }

    public function subtipo()
    {
        return $this->hasMany("App\Models\SubTipo");
    }

    public function permuta()
    {
        return $this->hasMany("App\Models\Permuta");
    }
}
