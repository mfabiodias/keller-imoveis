<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caracteristica extends Model
{
    use HasFactory;

    protected $table      = "caracteristica";
    protected $primaryKey = "id";
    protected $fillable   = [ 'nome', 'tipo' ];
}
