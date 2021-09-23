<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class CategorieConstruction extends Enum
{
    const Education = "education";
    const Sante = "sante";
    const SocioCommunautaire = "socio_communautaire";
    const Autre = "autres";

    public static function getDescription($value): string
    {
        switch ($value) {
            case self::Education:
                return "Education";
                break;
            case self::Sante:
                return "Santé";
                break;
            case self::SocioCommunautaire:
                return "Socio-communautaire";
                break;
            default:
                return self::getKey($value);
        }
    }
}
