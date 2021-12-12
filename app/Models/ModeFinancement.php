<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModeFinancement extends Model
{
    use HasFactory;

    protected $fillable = array("libelle", "montant","investissement_id");

}
