<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    protected $table      = "endereco";
    protected $primaryKey = "id";

    public function cliente()
    {
        return $this->belongsTo("App\Models\Cliente");
    }
}
