<?php


namespace App\Enums;


use BenSampo\Enum\Enum;

final class Mois extends Enum
{
    const Janvier = "01";
    const Fevrier = "02";
    const Mars = "03";
    const Avril = "04";
    const Mai = "05";
    const Juin = "06";
    const Juillet = "07";
    const Aout = "08";
    const Septembre = "09";
    const Octobre = "10";
    const Novembre = "11";
    const Decembre = "12";
/*     public static function getDescription($value): string
    {
        switch ($value) {
            case self::Reunion:
                return "Réunion";
                break;
            case self::SessionE:
                return "Session Extraordinaire";
                break;
            case self::SessionO:
                return "Session Ordinaire";
                break;
            default:
                return self::getKey($value);
        }
    } */
}
