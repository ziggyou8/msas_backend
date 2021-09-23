<?php

namespace App\Models\Structures;

use Illuminate\Database\Eloquent\Model;

class SocieteCivile extends Model 
{

    protected $table = "societe_civiles";
    public $timestamps = true;
    protected $fillable = array("structure_id");

}