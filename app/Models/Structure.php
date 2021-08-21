<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    use HasFactory;
    protected $fillable = ['denomination', 'addresse_siege','telephone','source_financement_id'];

    public function sourceFiancement()
    {
        return $this->hasOne(SourceFinancement::class);
    }
}
