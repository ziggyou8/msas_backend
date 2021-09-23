<?php


namespace App\Enums;


use BenSampo\Enum\Enum;

final class TypeActiviteRenforcement extends Enum
{
    const Formation = "Formation";
    const Sensibilisation  = "Sensibilisation";
    const Communication  = "Communication";
    const Autre  = "Autre";
    public static function getDescription($value): string
    {
        switch ($value) {
            case self::Formation:
                return "Formation";
                break;
            case self::Communication:
                return "Sensibilisation";
                break;
            case self::Sensibilisation:
                return "Communication";
                break;
          case self::Autre:
                return "Autre";
                break;
            default:
                return self::getKey($value);
        }
    }
}
