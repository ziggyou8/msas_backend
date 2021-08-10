<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SourceFinancement extends Model
{
    use HasFactory;

    protected $fillable = ['denomination'];

    public function acteurs()
    {
        return $this->hasMany(TypeActeur::class);
    }
}
