<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\DemandeInformationRequest;
use App\Http\Resources\DemandeInformationRessource;
use App\Repositories\DemandeInformationRepository;
use Illuminate\Http\Request;

class DemandeInformationController extends BaseController
{
    protected $demandeInformationRepository;

    const ITEM_LIMIT = 15;

    public function __construct(DemandeInformationRepository $demandeInformationRepository)
    {
        $this->demandeInformationRepository = $demandeInformationRepository;
    }

    public function index(Request $request)
    {
        $this->validate($request, ['n' => 'nullable|numeric']);
        $demandes = $this->demandeInformationRepository->getPaginate($request->get('n') ?? self::ITEM_LIMIT);
        return $this->sendResponse(DemandeInformationRessource::collection($demandes), 'Succés');
    }

    public function store(DemandeInformationRequest $request)
    {
        $demande = $this->demandeInformationRepository->store($request->all());
        if (!$demande)
            return $this->sendError('Erreur lors de l\'ajout');
        return $this->sendResponse(new DemandeInformationRessource($demande), 'Demande d\'information enregistré avec succés');
    }

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
}