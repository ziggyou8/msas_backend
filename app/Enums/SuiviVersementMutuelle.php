<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class SuiviVersementMutuelle extends Enum
{
    const Totalement = "totalement";
    const Partiel = "partiel";
    const Rien = "rien";

    public static function getDescription($value): string
    {
        switch ($value) {
            case self::Totalement:
                return "Totalement à la MEC";
                break;
            case self::Partiel:
                return "En parties à la MEC et à domicile";
                break;
            case self::Rien:
                return "Pas du tout";
                break;
            default:
                return self::getKey($value);
        }
    }
}
