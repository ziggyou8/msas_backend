<?php

namespace App\Models;

use App\Models\Structures\Structure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investissement extends Model
{
    use HasFactory;
    protected $table = "investissements";
    public $timestamps = true;
    protected $fillable = array("structure_id","annee", "monnaie", "statut", "agent_execution", "bailleur", "montant_global");

    public function mode_financement()
    {
        return $this->hasMany(ModeFinancement::class);
    }

    public function comments()
    {
        return $this->hasMany(Commentaire::class);
    }
    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function last_comment()
    {
     return $this->hasOne(Commentaire::class)->latest();
    }

    public function piliers()
    {
        return $this->hasMany(Pilier::class)->with(['axes']);
    }
    public function structure()
    {
        return $this->belongsTo(Structure::class);
    }
}
