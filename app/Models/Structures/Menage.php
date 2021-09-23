<?php

namespace App\Models\Structures;

use Illuminate\Database\Eloquent\Model;

class Menage extends Model 
{

    protected $table = "menages";
    public $timestamps = true;
    protected $fillable = array("structure_id");

}