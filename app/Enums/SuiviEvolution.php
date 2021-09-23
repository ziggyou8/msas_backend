<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class SuiviEvolution extends Enum
{
    const Trois = "3";
    const Deux = "2";
    const Un = "1";
    const Zero = "0";

    public static function getDescription($value): string
    {
        switch ($value) {
            case self::Trois:
                return "A la hausse (3)";
                break;
            case self::Deux:
                return "Stagnation (2)";
                break;
            case self::Un:
                return "En dent de scie (1)";
                break;
            case self::Zero:
                return "A la baisse (0)";
                break;
            default:
                return self::getKey($value);
        }
    }
}
