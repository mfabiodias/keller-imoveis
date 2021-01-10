<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTipo extends Model
{
    use HasFactory;

    protected $table      = "subtipo";
    protected $primaryKey = "id";
    protected $fillable   = ['tipo_id', 'nome'];

    public function imovel()
    {
        return $this->hasMany("App\Models\Imovel");
    }

    public function permuta()
    {
        return $this->hasMany("App\Models\Permuta");
    }

    public function tipo()
    {
        return $this->belongsTo("App\Models\Tipo");
    }
}
