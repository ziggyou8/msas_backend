<?php


namespace App\Enums;


use BenSampo\Enum\Enum;

final class TypeDepenseAutorisee extends Enum
{
    const ActifImmobilise = "actif_immobilise";
    const ActifCirculant = "actif_circulant";

    public static function getDescription($value): string
    {
        switch ($value) {
            case self::ActifImmobilise:
                return "Actifs immobilisés";
                break;
            case self::ActifCirculant:
                return "Actifs circulants";
                break;
            default:
                return self::getKey($value);
        }
    }
}
