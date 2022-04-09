<?php

namespace App\Http\Controllers\API;

use App\Enums\EtatDemandeInformation;
use App\Http\Requests\DemandeInformationRequest;
use App\Http\Resources\DemandeInformationRessource;
use App\Repositories\DemandeInformationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class DemandeInformationController extends BaseController
{
    protected $demandeInformationRepository;

    const ITEM_LIMIT = 15;

    public function __construct(DemandeInformationRepository $demandeInformationRepository)
    {
        $this->demandeInformationRepository = $demandeInformationRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function index(Request $request)
    {
        $this->validate($request, ['n' => 'nullable|numeric']);
        $demandes = $this->demandeInformationRepository->getPaginate($request->get('n') ?? self::ITEM_LIMIT);
        return $this->sendResponse(DemandeInformationRessource::collection($demandes), 'Succés');
    }

    /**
     * @param DemandeInformationRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(DemandeInformationRequest $request)
    {
        $demande = $this->demandeInformationRepository->store($request->all());
        if (!$demande)
            return $this->sendError('Erreur lors de l\'ajout');
        return $this->sendResponse(new DemandeInformationRessource($demande), 'Demande d\'information enregistré avec succés');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $demande = $this->demandeInformationRepository->getById($id);
        return $this->sendResponse(new DemandeInformationRessource($demande), 'Succés');
    }

    public function update(DemandeInformationRequest $request, $id)
    {
    }

    public function destroy($id)
    {
        if ($this->demandeInformationRepository->destroy($id))
            return $this->sendResponse([], "Demande d'information supprimée avec succés.");
        return $this->sendError('Erreur lors de la suppression');
    }

    public function getProfils()
    {
        $profils = $this->demandeInformationRepository->getProfil();
        return $this->sendResponse($profils, 'Succés');
    }

    public function markAsTreated($id)
    {
        $result = $this->demandeInformationRepository->changeStatus($id, [
            'user_id' => Auth::user()->id ?? null,
            'date_traitement' => Date::now(),
            'etat' => EtatDemandeInformation::Traitee
        ]);

        if ($result)
            return $this->sendResponse([], "Demande d'information traitée avec succés.");
        return $this->sendError('Erreur lors du traitement');
    }

    public function markAsNoTreated($id)
    {
        $result = $this->demandeInformationRepository->changeStatus($id, [
            'user_id' => Auth::user()->id ?? null,
            'date_traitement' => null,
            'etat' => EtatDemandeInformation::NonTraitee
        ]);

        if ($result)
            return $this->sendResponse([], "Etat de la demande d'information changé avec succés");
        return $this->sendError('Erreur lors du traitement');
    }

    public function changeStructure(Request $request, $id)
    {
        $request->validate(['structure_id' => 'required|numeric']);

        $result = $this->demandeInformationRepository->updateStructure($id, $request->get('structure_id'));

        if ($result)
            return $this->sendResponse([], "Structure attribuée avec succés.");
        return $this->sendError('Erreur lors du changement de structure');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function getByStructure(Request $request, $idStructure)
    {
        $this->validate($request, ['n' => 'nullable|numeric']);
        $demandes = $this->demandeInformationRepository->getPaginateByStructure($idStructure, $request->get('n') ?? self::ITEM_LIMIT);
        return $this->sendResponse(DemandeInformationRessource::collection($demandes), 'Succés');
    }

}