<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class SectionEvaluation extends Enum
{
    const Profil = "profil";
    const Projet = "projet";

    public static function getDescription($value): string
    {
        switch ($value) {
            case self::Profil:
                return "Résumé profil et expérience du promoteur";
                break;
            case self::Projet:
                return "Le projet";
                break;
            default:
                return self::getKey($value);
        }
    }
}
