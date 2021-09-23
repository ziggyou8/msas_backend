<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class EtatPassationMarche extends Enum
{
    const Initialisation = "initialisation";
    const LancementMarche = "lancement_marche";
    const Approbation = "approbation";
    const OuverturePlis = "ouverture_plis";
    const Adjudication = "adjudication";
    const SignatureContrat = "signature_contart";
    const DemarrageTravaux = "demarrage_travaux";
    const FinitionTravaux = "finition_travaux";
    const ReceptionTravaux = "reception_travaux";

    public static function getDescription($value): string
    {
        switch ($value) {
            case self::Initialisation:
                return "Initialisation du marché";
                break;
            case self::LancementMarche:
                return "Lancement du marché";
                break;
            case self::Approbation:
                return "Approbation du marché";
                break;
            case self::OuverturePlis:
                return "Ouverture des plis";
                break;
            case self::Adjudication:
                return "Adjudication du marché";
                break;
            case self::SignatureContrat:
                return "Signature du contrat";
                break;
            case self::DemarrageTravaux:
                return "Démarrage des travaux";
                break;
            case self::FinitionTravaux:
                return "Finition des travaux";
                break;
            case self::ReceptionTravaux:
                return "Réception des travaux";
                break;
            default:
                return self::getKey($value);
        }
    }
}
