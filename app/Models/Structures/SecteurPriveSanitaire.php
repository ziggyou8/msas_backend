<?php

namespace App\Models\Structures;

use Illuminate\Database\Eloquent\Model;

class SecteurPriveSanitaire extends Model 
{

    protected $table = "secteur_prive_sanitaires";
    public $timestamps = true;
    protected $fillable = array("structure_id");

}