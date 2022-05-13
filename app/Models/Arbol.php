<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arbol extends Model
{
    use HasFactory;
    protected $guarded = ['nodo'];
    protected $table = "arbol";
    protected $primaryKey = 'nodo';
    public $timestamps = false;
}
