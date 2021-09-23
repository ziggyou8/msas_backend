<?php

namespace App\Utils;

use App\Enums\TypeUpload;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadUtil
{
    const AVATAR_USER_PATH = "/images/users/";
    const FICHIER_MEDIA_PATH = "/commune/mediatheques/";
    const ARTICLE_PHOTO_PATH = "/commune/articles/photos/";
    const ARTICLE_FILE_PATH = "/commune/articles/files/";
    const FORMULATION_PATH = "/formulations/";
    const PLANIFICATION_PATH = "/planifications/";
    const PASSATION_PATH = "/passations/";
    const DEFAULT_PATH = "/default/";
    const MARCHE_PATH = "/suivi_marche/";
    const SFD_PATH = "/suivi_sfd/";

    protected $repertoire;

    public function __construct()
    {
        $this->repertoire = self::AVATAR_USER_PATH;
    }

    public function traiterFile($fichier, $mode = "avatar")
    {
        //dd($fichier);

        if ($mode != "avatar")
            $this->repertoire = $this->selectPath($mode);

        //Création d"un nom
        $timestamp = str_replace([" ", ":"], "-", Carbon::now()->toDateTimeString());
        $name = $timestamp . "-" . Str::random(5) . "." . $fichier->getClientOriginalExtension();
        //Enregistrement
        Storage::disk("public")->putFileAs($this->repertoire, $fichier, $name);

        return $name;
    }

    public function deleteFile($nom, $mode = "avatar")
    {
        if ($mode != "avatar")
            $this->repertoire = $this->selectPath($mode);

        //Suppression du fichier
        $file = $this->repertoire . $nom;

        if (Storage::disk("public")->exists($file)) {
            Storage::disk("public")->delete($file);
            return true;
        }
        return false;
    }

    private function selectPath($mode)
    {
        switch ($mode) {
            case "formulations" :
                return $this->repertoire = self::FORMULATION_PATH;
                break;
            case "planification" :
                return $this->repertoire = self::PLANIFICATION_PATH;
                break;
            case TypeUpload::ArticlePhoto:
                return $this->repertoire = self::ARTICLE_PHOTO_PATH;
                break;
            case TypeUpload::ArticleFile:
                return $this->repertoire = self::ARTICLE_FILE_PATH;
                break;
            case TypeUpload::MediaFile:
                return $this->repertoire = self::FICHIER_MEDIA_PATH;
                break;
            case "passation" :
                return $this->repertoire = self::PASSATION_PATH;

            case "suivi_marche" :
                return $this->repertoire = self::MARCHE_PATH;

                break;
            case "suivi_sfd" :
                return $this->repertoire = self::SFD_PATH;

                break;
            default:
                return self::DEFAULT_PATH;
        }
    }

}
