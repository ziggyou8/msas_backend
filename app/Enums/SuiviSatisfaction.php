<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class SuiviSatisfaction extends Enum
{
    const Quatre = "4";
    const Trois = "3";
    const Deux = "2";
    const Un = "1";
    const Zero = "0";

    public static function getDescription($value): string
    {
        switch ($value) {
            case self::Quatre:
                return "Très satisfaisant (4)";
                break;
            case self::Trois:
                return "Satisfaisant (3)";
                break;
            case self::Deux:
                return "Plus ou moins satisfaisant (2)";
                break;
            case self::Un:
                return "Insatisfaisant (1)";
                break;
            case self::Zero:
                return "Pas du tout satisfaisant (0)";
                break;
            default:
                return self::getKey($value);
        }
    }
}
