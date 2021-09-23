<?php


namespace App\Enums;


use BenSampo\Enum\Enum;

final class TypeMarche extends Enum
{
    const PrestationIntellectuelle = "prestation_intellectuelle";
    const Fournitures = "fournitures";
    const ServicesCourants = "services_courants";
    const Travaux = "travaux";

    public static function getDescription($value): string
    {
        switch ($value) {
            case self::PrestationIntellectuelle:
                return "Prestations intellectuelles/Consultants";
                break;
            default:
                return self::getKey($value);
        }
    }
}
