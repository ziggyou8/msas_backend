<?php


namespace App\Enums;


use BenSampo\Enum\Enum;

final class TypeRenforcement extends Enum
{
    const Formation = "formation";
    const Sensibilisation  = "sensibilisation";
    const Communication  = "communication";
    public static function getDescription($value): string
    {
        switch ($value) {
            case self::Formation:
                return "Formation";
                break;
            case self::Sensibilisation:
                return "Sensibilisation ";
                break;
            case self::Communication:
                return "Communication";
                break;
            default:
                return self::getKey($value);
        }
    }
}
