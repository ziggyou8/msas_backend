<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class Formation extends Enum
{
    const Leadership = "leadership";
    const Comptabilite = "comptabilite";
    const GestionProjet = "gestion_projet";
    const Management = "management";
    const Autre = "autre";

    public static function getDescription($value): string
    {
        switch ($value) {
            case self::Comptabilite:
                return "Comptabilité";
                break;
            case self::GestionProjet:
                return "Gestion de Projet";
                break;
            default:
                return self::getKey($value);
        }
    }
}
