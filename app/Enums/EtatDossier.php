<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class EtatDossier extends Enum
{
    const Nouveau = "identification";
    const Diagnostique = "diagnostique";
    const Formulation = "formulation";
    const Formule = "formule";
    const ValidationRegionale = "evaluation";
    const Evalue = "evalue";
    const ComiteCredit = "comite_credit";
    const ValideCC = "valide_cc";
    const Finance = "finance";
    const PretAccorde = "pret_accorde";
    const RetourEvaluation = "retour_evaluation";
    const RetourFormulation = "retour_formulation";
    const RetourDiagnostique = "retour_diagnostique";

    public static function getDescription($value): string
    {
        switch ($value) {
            case self::ValidationRegionale:
                return "Validation régionale";
                break;
            case self::Evalue:
                return "Evalué";
                break;
            case self::Finance:
                return "Financé";
                break;
            case self::ComiteCredit:
                return "En attente de traitement CC";
                break;
            case self::ValideCC:
                return "Validation du CC";
                break;
            case self::PretAccorde:
                return "Prêt accordé";
                break;
            case self::RetourEvaluation:
                return "Retourner à l'évaluation régionale";
                break;
            case self::RetourFormulation:
                return "Retourner pour reformulation";
                break;
            case self::RetourDiagnostique:
                return "Retourner pour diagnostique";
                break;
            default:
                return self::getKey($value);
        }
    }
}
