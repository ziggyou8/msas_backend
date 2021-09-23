<?php


namespace App\Enums;


use BenSampo\Enum\Enum;

final class PiLogement extends Enum
{
    const Prive = "1";
    const Chomage  = "2";
    const Public  = "3";
    const SousCouvert  = "4";
    public static function getDescription($value): string
    {
        switch ($value) {
            case self::Prive:
                return "Logé en famille";
                break;
            case self::Chomage:
                return "Proprietaire";
                break;
            case self::Public:
                return "Locataire";
                break;
            case self::SousCouvert:
                return "Sous couvert";
                break;
            default:
                return self::getKey($value);
        }
    }
}
