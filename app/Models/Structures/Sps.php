<?php

namespace App\Models\Structures;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sps extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = array("structure_id", "type_structure","numero_autorisation", "documents", "mecanisme_financement");
}
