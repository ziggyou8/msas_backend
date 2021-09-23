<?php


namespace App\Enums;


use BenSampo\Enum\Enum;

final class ModePassation extends Enum
{
    const DRPR = "drp_restreinte";
    const DRPCO = "drp_ouverte";
    const AON = "appel_offre_national";
    const AOI = "appel_offre_international";
    const APMI = "appel_public_manifestation";

    public static function getDescription($value): string
    {
        switch ($value) {
            case self::DRPR:
                return "Demande de renseignement des prix restreinte";
                break;
            case self::DRPCO:
                return "Demande de renseignement des prix à compétition ouverte";
                break;
            case self::AON:
                return "Appel d’offres National";
                break;
            case self::AOI:
                return "Appel d’offres international";
                break;
            case self::APMI:
                return "Appel public à manifestation d’intérêts";
                break;
            default:
                return self::getKey($value);
        }
    }
}
