<?php


namespace App\Enums;


use BenSampo\Enum\Enum;

final class TypeActivite extends Enum
{
    const Reunion = "reunion";
    const SessionO  = "sessionO";
    const SessionE  = "sessionE";
    public static function getDescription($value): string
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
    }
}
