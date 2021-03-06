<?php

namespace App\Models\Structures;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eps extends Model
{
    use HasFactory;
    protected $table = "eps";
    public $timestamps = true;
    protected $fillable = array("structure_id", "documents", "mecanisme_financement");

    public function eps()
    {
        return $this->belongsTo(Eps::class);
    }
}
