<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = array("investissement_id", "description", "user_id");

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
