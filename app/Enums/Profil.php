<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class Profil extends Enum
{
    const Chercheur = "chercheur";
    const Medecin = "medecin";

    public static function getDescription($value): string
    {
        switch ($value) {
            case self::Chercheur:
                return 'Chercheur';
                break;
            case self::Medecin:
                return 'Medecin';
                break;
            default:
                return $value;
        }
    }
}
