<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class EtatDemandeInformation extends Enum
{
    const Traitee = "traitee";
    const NonTraitee = "non_traitee";

    public static function getDescription($value): string
    {
        switch ($value) {
            case self::Traitee:
                return "Traitée";
                break;
            case self::NonTraitee:
                return "Non traitée";
                break;
            default:
                return self::getKey($value);
        }
    }
}
