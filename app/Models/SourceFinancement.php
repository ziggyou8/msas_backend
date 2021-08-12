<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SourceFinancement extends Model
{
    use HasFactory;

    protected $fillable = ['denomination', 'structure_id'];

    public function acteurs()
    {
        return $this->hasMany(TypeActeur::class);
    }

    public function structure()
    {
        return $this->hasOne(Structure::class);
    }
}
