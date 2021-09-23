<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class TypeProgramme extends Enum
{
    const Padess = "padess";
    const Pides = "pides";
    const Autres = "autres";

    public static function getDescription($value): string
    {
        switch ($value) {
            case self::Padess:
                return "PADESS";
                break;
            case self::Pides:
                return "PIDES";
                break;
            default:
                return self::getKey($value);
        }
    }
}
