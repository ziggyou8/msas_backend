<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investissement extends Model
{
    use HasFactory;
    protected $table = "investissements";
    public $timestamps = true;
    protected $fillable = array("libelle", "montant","structure_id");
}
