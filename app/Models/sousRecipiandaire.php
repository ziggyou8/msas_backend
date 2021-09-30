<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sousRecipiandaire extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = array("ong_id", "projet", "montant");
}
