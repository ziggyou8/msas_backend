<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;
    protected $table = "projets";
    public $timestamps = true;
    protected $fillable = array("libelle", "perspective", "opportunite", "structure_id");
}
