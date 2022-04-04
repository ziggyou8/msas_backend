<?php

namespace App\Models\Structures;

use App\Models\Investissement;
use App\Models\Pilier;
use App\Models\RegionIntervention;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{

    protected $table = "structures";
    public $timestamps = true;
    protected $fillable = array('type_acteur', 'source_financement', 'accord_siege', 'adresse_siege', "denomination", "telephone_siege", "autre_secteur_intervention", "paquet_sante_intervention", "mobilisation_ressource", "mis_en_commun_ressource", "achat_service", "email_siege", "latitude", "longitude", "altitude", "prenom_responsable", "nom_responsable", "telephone_responsable", "email_responsable", "fonction_responsable", "specialite", "autre_specialite", "categorie_rse");

    /* protected $appends = ["acteur"];
    protected $visible = ["acteur"]; */

    public function scopeByTypeActeur($query, $type)
    {
        if ($type)
            return $query->where('source_financement', $type);
        return $query;
    }


    public function regionInterventions()
    {
        return $this->hasMany(RegionIntervention::class)->with('districtsInterventions');
    }

    public function investissements()
    {
        return $this->hasMany(Investissement::class)->with(['mode_financement', "piliers"]);
    }

    public function piliers()
    {
        return $this->hasMany(Pilier::class)->with('axes');
    }

    public function ptf()
    {
        return $this->hasOne(Ptf::class);
    }

    public function ong()
    {
        return $this->hasOne(Ong::class)->with('sous_recipiandaires');
    }

    public function eps()
    {
        return $this->hasOne(Eps::class);
    }

    public function sps()
    {
        return $this->hasOne(Sps::class);
    }

    public function ct()
    {
        return $this->hasOne(CollectiviteTerritoriale::class);
    }

    public function etat()
    {
        return $this->hasOne(Etat::class);
    }

    public function secteurPriveNonSanitaire()
    {
        return $this->hasOne(SecteurPriveNonSanitaire::class);
    }

    public function secteurPriveSanitaire()
    {
        return $this->hasOne(SecteurPriveSanitaire::class);
    }

    public function menage()
    {
        return $this->hasOne(Menage::class);
    }

    public function users()
    {
        return $this->hasOne(User::class);
    }

    public function societeCivile()
    {
        return $this->hasOne(SocieteCivile::class);
    }


}