<?php

namespace App\Utils;

use App\Enums\TypeBeneficiaire;
use App\Enums\TypeNumeroOrdre;
use App\Enums\TypeProgramme;
use App\Repositories\NumeroOrdreRepository;
use App\Repositories\NumeroRepository;
use App\Repositories\PaysRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

class NumeroUtil
{
    protected $numeroOrdreRepository;

    public function __construct(NumeroOrdreRepository $numeroOrdreRepository)
    {
        $this->numeroOrdreRepository = $numeroOrdreRepository;
    }

    public function getNumeroBeneficiaire($typeBeneficiaire, $programme)
    {
        $ordre = $this->getFormatedNumber(TypeNumeroOrdre::Beneficiaire);

        return $this->getCodeProgramme($programme) . "-" . $ordre . "/" . $this->getCodeBeneficiaire($typeBeneficiaire). "/". Carbon::now()->format("d-m-Y");
    }

    private function getFormatedNumber($type, $taille = 5)
    {
        $numeroOrdre = $this->numeroOrdreRepository->getLast($type);
        $numero = !empty($numeroOrdre) ? ++$numeroOrdre->numero : 1;
        //Sauvegarde
        $numero = $this->sauvegarde($numero, $type);
        //Formatage 0001
        return str_pad($numero, $taille, "0", STR_PAD_LEFT);
    }

    private function sauvegarde($numero, $type)
    {
        $infos = [
            "numero" => $numero,
            "type_numero" => $type,
        ];

        while (!$this->numeroOrdreRepository->store($infos)) {
            $infos["numero"]++;
        }
        return $infos["numero"];
    }

    private function getCodeProgramme($programme)
    {
        switch ($programme) {
            case TypeProgramme::Padess :
                return strtoupper(Config::get("constants.sigles.padess"));
            case TypeProgramme::Pides :
                return strtoupper(Config::get("constants.sigles.pides"));
            default :
                return "AUT";
        }
    }

    private function getCodeBeneficiaire($beneficiaire)
    {
        switch ($beneficiaire) {
            case TypeBeneficiaire::Collectif :
                return strtoupper(Config::get("constants.sigles.collectif"));
            case TypeBeneficiaire::Individuel :
                return strtoupper(Config::get("constants.sigles.individuel"));
            default :
                return "";
        }
    }
}