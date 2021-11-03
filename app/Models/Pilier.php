<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pilier extends Model
{
    use HasFactory;

    protected $table = "piliers";
    public $timestamps = true;
    protected $fillable = array("libelle", "monnaie","structure_id");
}
