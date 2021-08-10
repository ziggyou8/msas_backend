<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeActeur extends Model
{
    use HasFactory;

    protected $fillable = ['libelle', 'source_financement_id'];

    public function sourceFiancement()
    {
        return $this->belongsTo(SourceFinancement::class);
    }
}
