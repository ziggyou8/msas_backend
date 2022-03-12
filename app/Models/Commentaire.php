<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = array("investissement_id", "description");

    public function sous_recipiandaires()
    {
        return $this->hasMany(sousRecipiandaire::class);
    }
}
