<?php

namespace App\Models\Structures;

use App\Enums\TypeActeur;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Structure extends Model 
{

    protected $table = "structures";
    public $timestamps = true;
    protected $fillable = array('type_acteur', 'source_financement', 'accord_siege', 'adresse_siege', "denomination", "telephone_siege", "autre_secteur_intervention", "paquet_sante_intervention", "region_intervention", "departement_intervention", "commune_intervention", "districte_intervention", "mobilisation_ressource", "mis_en_commun_ressource", "achat_service", "email_siege", "latitude", "longitude", "prenom_responsable", "nom_responsable", "telephone_responsable", "email_responsable");
    /* protected $appends = ["acteur"];
    protected $visible = ["acteur"]; */

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
        return $this->belongsToMany(User::class);
    }

    public function societeCivile()
    {
        return $this->hasOne(SocieteCivile::class);
    }

    public function acteurType(){
        switch ($this->type_acteur) {
            case TypeActeur::PTF:
                return $this->ptf;
                break;
            case TypeActeur::ONG:
                return $this->ong;
                break;
            case TypeActeur::EPS:
                return $this->eps;
                break;
            case TypeActeur::SPS:
                return $this->sps;
                break;
            case TypeActeur::Etat:
                return $this->etat;
                break;
            case TypeActeur::CT:
                return $this->ct;
                break;
            case TypeActeur::SecteurPriveNonSanitaire:
                return $this->secteurPriveNonSanitaire;
                break;
            case TypeActeur::SecteurPriveSanitaire:
                return $this->secteurPriveSanitaire;
                break;
            case TypeActeur::SocieteCivile:
                return $this->societeCivile;
                break;
            default:
                return;
                break;
        }
    }

    /* public function getActeurAttribute()
    {
        return $this->acteurType();
    } */

    

}