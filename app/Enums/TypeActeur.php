<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class TypeActeur extends Enum
{
    const Etat = "Etat";
    const ONG = "ONG";
    const PTF = "PTF";
    const EPS = "EPS";
    const SPS = "SPS";
    const SecteurPriveNonSanitaire = "Secteur privé non sanitaire";
    const SecteurPriveSanitaire = "Secteur privé sanitaire";
    const Menages = "Ménages";
    const CT = "CT";
    const SocieteCivile = "Société civile";
    
    public static function getDescription($value): string
    {
        switch ($value) {
            case self::CT:
                return "Collectivité territoriale";
                break;
            case self::ONG:
                return "ONG et PTF";
                break;
            case self::PTF:
                return "ONG et PTF";
                break;
            default:
                return self::getKey($value);
        }
    }
}
