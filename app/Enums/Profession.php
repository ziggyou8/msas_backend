<?php


namespace App\Enums;


use BenSampo\Enum\Enum;

final class Profession extends Enum
{
    const Prive = "prive";
    const Chomage  = "chomage";
    const Public  = "public";
    const Retraite  = "retraite";
    public static function getDescription($value): string
    {
        switch ($value) {
            case self::Prive:
                return "Chomage";
                break;
            case self::Chomage:
                return "Privé";
                break;
            case self::Public:
                return "Public";
                break;
            case self::Retraite:
                return "Retraité(e)";
                break;
            default:
                return self::getKey($value);
        }
    }
}
