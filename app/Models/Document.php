<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ["file", "description", "investissement_id"];

    public function investissement()
    {
        return $this->belongsTo(Investissement::class);
    }
}
