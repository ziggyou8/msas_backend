<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class SuiviDocumentGestion extends Enum
{
    const Cinq = "5";
    const Trois = "3";
    const Deux = "2";
    const Un = "1";
    const Zero = "0";

    public static function getDescription($value): string
    {
        switch ($value) {
            case self::Cinq:
                return "Dispose de documents de gestion utilisés régulièrement et maitrisés (5)";
                break;
            case self::Trois:
                return "Dispose de documents de gestion utilisés régulièrement et non maitrisés (3)";
                break;
            case self::Deux:
                return "Dispose de documents de gestion utilisés irrégulièrement (2)";
                break;
            case self::Un:
                return "Dispose de documents de gestion non utilisés (1)";
                break;
            case self::Zero:
                return "Ne dispose pas de documents de gestion (0)";
                break;
            default:
                return self::getKey($value);
        }
    }
}
