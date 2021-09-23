<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class SuiviPortefeuilleRisque extends Enum
{
    const Par30 = "par_30";
    const Par90 = "par_90";
    const ParPlus90 = "par_plus_90";

    public static function getDescription($value): string
    {
        switch ($value) {
            case self::Par30:
                return "P.A.R 30 jours";
                break;
            case self::Par90:
                return "P.A.R 90 jours";
                break;
            case self::ParPlus90:
                return "P.A.R +90 jours";
                break;
            default:
                return self::getKey($value);
        }
    }
}
