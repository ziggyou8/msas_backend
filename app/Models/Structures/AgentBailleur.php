<?php

namespace App\Models\Structures;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentBailleur extends Model
{
    use HasFactory;
    protected $table = "agent_bailleurs";
    public $timestamps = true;
    protected $fillable = array("ong_id","ong_id");

    public function ong()
    {
        return $this->belongsTo(Eps::class);
    }

    public function ptf()
    {
        return $this->belongsTo(Sps::class);
    }
}
