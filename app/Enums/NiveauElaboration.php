<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class NiveauElaboration extends Enum
{
    const UGP = "ugp";
    const AntenneDakar = "antenne_dakar";
    const AntenneKaolack = "antenne_kaolack";
    const AntenneSedhiou = "antenne_sedhiou";

    public static function getDescription($value): string
    {
        switch ($value) {
            case self::AntenneDakar:
                return "Antenne de Dakar";
                break;
            case self::AntenneKaolack:
                return "Antenne de Kaolack";
                break;
            case self::AntenneSedhiou:
                return "Antenne de Sédhiou";
                break;
            default:
                return self::getKey($value);
        }
    }
}
