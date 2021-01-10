<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permuta extends Model
{
    use HasFactory;

    protected $table      = "permuta";
    protected $primaryKey = "id";
    protected $fillable   = ['cliente_id', 'tipo_id', 'subtipo_id', 'range_id', 'status'];

    public function cliente()
    {
        return $this->belongsTo("App\Models\Cliente");
    }

    public function range()
    {
        return $this->belongsTo("App\Models\Range");
    }

    public function tipo()
    {
        return $this->belongsTo("App\Models\Tipo");
    }

    public function subtipo()
    {
        return $this->belongsTo("App\Models\Subtipo");
    }
}
