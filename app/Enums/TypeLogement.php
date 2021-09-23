<?php


namespace App\Enums;


use BenSampo\Enum\Enum;

final class TypeLogement extends Enum
{
    const LogementEnDur = "dur";
    const LogementEnMateriauxTraditionnels  = "traditionnel";

    public static function getDescription($value): string
    {
        switch ($value) {
            case self::LogementEnDur:
                return "Logement en dur";
                break;
            case self::LogementEnMateriauxTraditionnels:
                return "Logement en matériaux traditionnels";
                break;
            default:
                return self::getKey($value);
        }
    }
}
