<?php

namespace App\Http\Controllers\API;

use App\Enums\TypeActeur;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\StructureResource;
use App\Models\Structures\Structure;
use App\Models\sousRecipiandaire;
use App\Repositories\Structures\CollectiviteTerritorialeRepository;
use App\Repositories\Structures\EpsRepository;
use App\Repositories\Structures\EtatRepository;
use App\Repositories\Structures\OngRepository;
use App\Repositories\Structures\PtfRepository;
use App\Repositories\Structures\SecteurPriveNonSanitaireRepository;
use App\Repositories\Structures\SpsRepository;
use App\Repositories\Structures\StructureRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Utils\UploadUtil;
use App\Enums\TypeUpload;
use App\Models\AxeIntervention;
use App\Models\DistrictIntervention;
use App\Models\Investissement;
use App\Models\ModeFinancement;
use App\Models\NatureInvestissement;
use App\Models\Pilier;
use App\Models\Projet;
use App\Models\RegionIntervention;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use function PHPUnit\Framework\isEmpty;

class StructureController extends BaseController
{
    protected $structureRepository;
    protected $ongRepository;
    protected $etatRepository;
    protected $secteurPriveNonSanitaireRepository;
    protected $collectiviteTerritorialeRepository;
    protected $ptfRepository;
    protected $userRepository;
    protected $epsRepository;
    protected $spsRepository;
    protected $uploadUtil;
    
    public function __construct(StructureRepository $structureRepository,
                                OngRepository $ongRepository,
                                EtatRepository $etatRepository,
                                SecteurPriveNonSanitaireRepository $secteurPriveNonSanitaireRepository,
                                CollectiviteTerritorialeRepository $collectiviteTerritorialeRepository,
                                PtfRepository $ptfRepository,
                                UserRepository $userRepository,
                                EpsRepository $epsRepository,
                                SpsRepository $spsRepository,
                                uploadUtil $uploadUtil)
                                
    {
        $this->structureRepository = $structureRepository;
        $this->ongRepository = $ongRepository;
        $this->etatRepository = $etatRepository;
        $this->secteurPriveNonSanitaireRepository = $secteurPriveNonSanitaireRepository;
        $this->collectiviteTerritorialeRepository = $collectiviteTerritorialeRepository;
        $this->ptfRepository = $ptfRepository;
        $this->userRepository = $userRepository;
        $this->epsRepository = $epsRepository;
        $this->spsRepository = $spsRepository;
        $this->uploadUtil = $uploadUtil;
        //$this->middleware("auth");
        // $this->middleware("permission:structure-list|structure-create", ["only" => ["index","store"]]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Get(
     ** path="/v1/structures",
     *   tags={"Structures"},
     *   summary="List Structures ",
     *   operationId="List Structures",
     *  security={{"bearerAuth": {}}},
     *
     *   @OA\Response(
     *      response=200,
     *      description="Success",
     *      @OA\Property(ref="#/components/schemas/Structures"),
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *      description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function index()
    {
        //$structures = Structure::all();
        $structures = $this->structureRepository->getData();
        return $this->sendResponse(StructureResource::collection($structures), "succés.");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function storeStepOne(Request $request)
    {
        DB::beginTransaction();
        $success = false;
        try {
        $firstStepInputs["denomination"] = $request->denomination;
        $firstStepInputs["categorie_rse"] = $request->categorie_rse;
        $firstStepInputs["type_acteur"] = $request->type_acteur;
        $firstStepInputs["specialite"] = $request->specialite;
        $firstStepInputs["autre_specialite"] = $request->autre_specialite;
        $firstStepInputs["source_financement"]=$request->source_financement;
        $firstStepInputs["telephone_siege"]=$request->telephone_siege;
        $firstStepInputs["email_siege"]=$request->email_siege;
        $firstStepInputs["adresse_siege"] = $request->adresse_siege;
        $firstStepInputs["telephone_siege"] = $request->telephone_siege;
        $firstStepInputs["prenom_responsable"]=$request->prenom_responsable;
        $firstStepInputs["fonction_responsable"]=$request->fonction_responsable;
        $firstStepInputs["nom_responsable"]=$request->nom_responsable;
        $firstStepInputs["telephone_responsable"]=$request->telephone_responsable;
        $firstStepInputs["email_responsable"]=$request->email_responsable;
        $structure = $this->structureRepository->store($firstStepInputs);

        try {
            $password = bin2hex(openssl_random_pseudo_bytes(4));
            $userInputs["prenom"]=$request->prenom_responsable;
            $userInputs["fonction"]=$request->fonction_responsable;
            $userInputs["nom"]=$request->nom_responsable;
            $userInputs["telephone"]=$request->telephone_responsable;
            $userInputs["email"]=$request->email_responsable;
            $userInputs["structure_id"]=$structure->id;
            $userInputs["password"]= bcrypt($password);
            $pontFocal = $this->userRepository->store($userInputs);
            $pontFocal->assignRole('Admin_structure');
           /*  switch ($request->source_financement) {
                case 'SPS':
                    $pontFocal->assignRole('SPS Admin');
                    break;
                case 'EPS':
                    $pontFocal->assignRole('EPS Admin');
                    break;
                case 'PTF':
                    $pontFocal->assignRole('PTF Admin');
                    break;
                case 'ONG':
                    $pontFocal->assignRole('ONG Admin');
                    break;
                case 'RSE':
                    $pontFocal->assignRole('RSE Admin');
                    break;
                default:
                    break;
            } */

            $details = [
                'email' => $request->email_responsable,
                'full_name' => $userInputs["prenom"] .' '. $userInputs["nom"],
                'structure_name' => $request->denomination,
                'password' => $password
                ];
           
                try {
                    Mail::to($userInputs["email"])->send(new \App\Mail\CreatedAcountMailer($details));
                } catch (\Throwable $th) {
                    return $this->sendError("Connexion faible!! Essayez de vous reconnecter");
                }

          
        } catch (\Exception $e) {
            return $this->sendError("Email est déjà utilisé");
        }

        if($request->district_interventions){
            foreach ($request->district_interventions as $intervention) {
                $decodedIntervention = json_decode($intervention);
                $region = RegionIntervention::create([
                     "nom"=> $decodedIntervention->nom,
                     "structure_id"=> $structure->id
                 ]);
 
                 foreach ($decodedIntervention->districts as $district) {
                     DistrictIntervention::create([
                         "nom"=> $district->nom,
                        "region_intervention_id"=> $region->id
                     ]);
                 }
            }
         }
         $success = true;
            if ($success) {
                DB::commit();
            }
        return $this->sendResponse(new StructureResource($structure), "Ajouté avec succés.");
        } catch (\Exception $e) {
            DB::rollback();
		    $success = false;
            return $this->sendError("Erreur! Réessayez svp");
        }
    }


    public function storeStepTwo(Request $request)
    {

        
     //return json_decode($request->piliers[0])->axe[0]->investissement;
       

        function getStatut (){
            $statuts =[
                "Admin_structure" => "En attente de validation",
                "Point_focal" => "Enregistrer"
            ];
            return $statuts[Auth::user()->roles[0]->name];
        }
    
       $structure= Auth::user()->structure;

    
        DB::beginTransaction();
        $success = false;
        //les input partagés par les types d"acteur (step 1)
        try {
        /* $structureInputs["adresse_siege"] = $request->adresse_siege;
        $structureInputs["email_siege"] = $request->email_siege;
        $structureInputs["telephone_siege"] = $request->telephone_siege;
        $structureInputs["latitude"] = $request->latitude;
        $structureInputs["longitude"] = $request->longitude;
        $structureInputs["altitude"] = $request->altitude; */
        $structureInputs["mobilisation_ressource"]=$request->mobilisation_ressource;
        $structureInputs["mis_en_commun_ressource"]=$request->mis_en_commun_ressource;
        $structureInputs["achat_service"]=$request->achat_service;
        $this->structureRepository->update( $structure->id, $structureInputs);
        Auth::user()->roles[0]->name;
        $roes=[];
        //capture les infos sur la deuxième phase
        $investissement = Investissement::create([
            "annee" => $request->annee,
            "monnaie" => $request->monnaie,
            "statut" => getStatut(),
            "structure_id" => $structure->id
        ]);

        //Mode de fiance lié à investissement
        foreach ($request->mode_finance as $mode) {
            $decodedMode = json_decode($mode);
            if($decodedMode->montant &&  $decodedMode->libelle !==""){
                ModeFinancement::create([
                    "libelle"=>$decodedMode->libelle,
                    "montant"=>$decodedMode->montant,
                    "investissement_id"=> $investissement->id
                ]);
            }
        }

        //Pilier->Axe[]->NatureInvestissement[]
        foreach ($request->piliers as $pilier) {
            $decodedPilier = json_decode($pilier);
            if($decodedPilier->pilier !== ""){
                $newPilier = Pilier::create([
                    'libelle' => $decodedPilier->pilier,
                    'monnaie' => $request->monnaie,
                    'investissement_id' =>$investissement->id,
                ]);
                foreach ($decodedPilier->axe as $axe) {
                    if($axe->libelle !== ""){
                        $newAxe = AxeIntervention::create([
                            'pilier_id' => $newPilier->id,
                            'libelle' => $axe->libelle,
                        ]);
                    }
                
                    NatureInvestissement::create([
                        "libelle" => "Investissements",
                        "montant_prevu" => $axe->investissement->montant_prevu,
                        "montant_mobilise" => $axe->investissement->montant_mobilise,
                        "montant_execute" => $axe->investissement->montant_execute,
                        "axe_intervention_id"=> $newAxe->id
                    ]);
                    NatureInvestissement::create([
                        "libelle" => "Biens et services",
                        "montant_prevu" => $axe->bien_et_service->montant_prevu,
                        "montant_mobilise" => $axe->bien_et_service->montant_mobilise,
                        "montant_execute" => $axe->bien_et_service->montant_execute,
                        "axe_intervention_id"=> $newAxe->id
                    ]);
                
            }
            }
        }
                                              
        /* $firstStepInputs["specialite"] = $request->specialite;
        $firstStepInputs["autre_specialite"] = $request->autre_specialite;
        $firstStepInputs["source_financement"]=$request->source_financement;
        $firstStepInputs["telephone_siege"]=$request->telephone_siege;
        $firstStepInputs["email_siege"]=$request->email_siege;
        $firstStepInputs["adresse_siege"] = $request->adresse_siege;
        $firstStepInputs["telephone_siege"] = $request->telephone_siege;
        $firstStepInputs["prenom_responsable"]=$request->prenom_responsable;
        $firstStepInputs["fonction_responsable"]=$request->fonction_responsable;
        $firstStepInputs["nom_responsable"]=$request->nom_responsable;
        $firstStepInputs["telephone_responsable"]=$request->telephone_responsable;
        $firstStepInputs["email_responsable"]=$request->email_responsable; */
        //$structure = $this->structureRepository->store($firstStepInputs);

        $success = true;
        if ($success) {
            DB::commit();
        }
        return $this->sendResponse(new StructureResource($structure), "Ajouté avec succés.");
        } catch (\Exception $e) {
            DB::rollback();
		    $success = false;
            return $this->sendError($e->getMessage());
        }
    }
     
    public function supprimerPilier($id){
        Pilier::find($id)->delete();
    }
    public function supprimerAxe($id){
        AxeIntervention::find($id)->delete();
    }

    public function updateStepTwo(Request $request)
    {
        //return $request->all();
      // $structure= Auth::user()->structure;
        DB::beginTransaction();
        $success = false;
        //les input partagés par les types d"acteur (step 1)
        try {
         $structure = Structure::findOrFail($request->structure_id);
        $structureInputs["mobilisation_ressource"]=$request->mobilisation_ressource ? 1 : 0;
        $structureInputs["mis_en_commun_ressource"]=$request->mis_en_commun_ressource ? 1 : 0;
        $structureInputs["achat_service"]=$request->achat_service ? 1 : 0;
        $this->structureRepository->update( $structure->id, $structureInputs);
        
        //capture les infos sur la deuxième phase
        $investissement = Investissement::find($request->investissement_id);
        $investissement->update([
            "annee" => $request->annee,
            "monnaie" => $request->monnaie,
        ]);

        foreach ($request->mode_finance as $mode) {
            $decodedMode = json_decode($mode);
            if($decodedMode->id){
                ModeFinancement::find($decodedMode->id)
                ->update([
                    "montant" => $decodedMode->montant
                ]);
            }elseif(!$decodedMode->id && $decodedMode->montant){
                ModeFinancement::create([
                    "libelle"=>$decodedMode->libelle,
                    "montant"=>$decodedMode->montant,
                    "investissement_id"=> $investissement->id
                ]);
            }elseif($decodedMode->montant){
                ModeFinancement::find($decodedMode->id)->delete();
            }
        }

        //Pilier->Axe[]->NatureInvestissement[]
        foreach ($request->piliers as $pilier) {
            $decodedPilier = json_decode($pilier);
            if(isset($decodedPilier->id)){
                Pilier::find($decodedPilier->id)
                            ->update([
                                'libelle' => $decodedPilier->pilier
                            ]);

                foreach ($decodedPilier->axe as $axe) {
                    if(isset($axe->id)){
                        $updatetAxe = AxeIntervention::find($axe->id);
                        $updatetAxe->update([
                        'libelle' => $axe->libelle,
                     ]);
                     $updatInvestissement = NatureInvestissement::find($axe->investissement->id);
                     $updatInvestissement->update([
                        "montant_prevu" => $axe->investissement->montant_prevu,
                        "montant_mobilise" => $axe->investissement->montant_mobilise,
                        "montant_execute" => $axe->investissement->montant_execute,
                    ]);

                    $updatBienEtService = NatureInvestissement::find($axe->bien_et_service->id);
                     $updatBienEtService->update([
                        "montant_prevu" => $axe->bien_et_service->montant_prevu,
                        "montant_mobilise" => $axe->bien_et_service->montant_mobilise,
                        "montant_execute" => $axe->bien_et_service->montant_execute,
                    ]);
                        
                    }elseif(!isset($axe->id)){
                        $newAxe = AxeIntervention::create([
                            'pilier_id' => $decodedPilier->id,
                            'libelle' => $axe->libelle,
                        ]);
                        NatureInvestissement::create([
                            "libelle" => "Investissements",
                            "montant_prevu" => $axe->investissement->montant_prevu,
                            "montant_mobilise" => $axe->investissement->montant_mobilise,
                            "montant_execute" => $axe->investissement->montant_execute,
                            "axe_intervention_id"=> $newAxe->id
                        ]);
                        NatureInvestissement::create([
                            "libelle" => "Biens et services",
                            "montant_prevu" => $axe->bien_et_service->montant_prevu,
                            "montant_mobilise" => $axe->bien_et_service->montant_mobilise,
                            "montant_execute" => $axe->bien_et_service->montant_execute,
                            "axe_intervention_id"=> $newAxe->id
                        ]);
                    }   
            } 
          }elseif(!isset($decodedPilier->id)){
            $newPilier = Pilier::create([
                'libelle' => $decodedPilier->pilier,
                'monnaie' => $request->monnaie,
                'investissement_id' =>$investissement->id,
            ]);
            foreach ($decodedPilier->axe as $axe) {
                if($axe->libelle !== ""){
                    $newAxe = AxeIntervention::create([
                        'pilier_id' => $newPilier->id,
                        'libelle' => $axe->libelle,
                    ]);
                }
            
                NatureInvestissement::create([
                    "libelle" => "Investissements",
                    "montant_prevu" => $axe->investissement->montant_prevu,
                    "montant_mobilise" => $axe->investissement->montant_mobilise,
                    "montant_execute" => $axe->investissement->montant_execute,
                    "axe_intervention_id"=> $newAxe->id
                ]);
                NatureInvestissement::create([
                    "libelle" => "Biens et services",
                    "montant_prevu" => $axe->bien_et_service->montant_prevu,
                    "montant_mobilise" => $axe->bien_et_service->montant_mobilise,
                    "montant_execute" => $axe->bien_et_service->montant_execute,
                    "axe_intervention_id"=> $newAxe->id
                ]);
            
        }
        }
        }

        $success = true;
        if ($success) {
            DB::commit();
        }
        return $this->sendResponse(new StructureResource($structure), "Modifié avec succés.");
        } catch (\Exception $e) {
            DB::rollback();
		    $success = false;
            return $this->sendError($e->getMessage());
        }
    }

    public function basicInfoUpdate(Request $request, $id)
    {
      
        $structureToUpdate = Structure::find($id);
        $basicInfoInputs["adresse_siege"] = $request->adresse_siege;
        $basicInfoInputs["email_siege"] = $request->email_siege;
        $basicInfoInputs["telephone_siege"] = $request->telephone_siege;
        $basicInfoInputs["latitude"] = $request->latitude;
        $basicInfoInputs["longitude"] = $request->longitude;
        $basicInfoInputs["altitude"] = $request->altitude;
        $this->structureRepository->update( $structureToUpdate->id, $basicInfoInputs);
        return $this->sendResponse(new StructureResource($structureToUpdate), "Modifié avec succès");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Post(
     ** path="/v1/structures",
     *   tags={"Structures"},
     *   summary="Create Structure",
     *   operationId="create Structure",
     *   security={{"bearerAuth": {}}},
     *
     *  @OA\Parameter(
     *      name="denomination",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     * 
     * @OA\Parameter(
     *      name="addresse_siege",
     *      in="query",
     *      required=true, 
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="telephone",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *       name="type_fonds",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="prenom_personne_responsable",
     *      in="query",
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="nom_personne_responsable",
     *      in="query",
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="email_personne_responsable",
     *      in="query",
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="telephone_personne_responsable",
     *      in="query",
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *    @OA\Parameter(
     *      name="source_financement_id",
     *      in="query",
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="type_acteur_id",
     *      in="query",
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     * 
     * 
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     */
    public function store(Request $request)
    {
     
        
        //les input partagés par les types d"acteur (step 1)
        $firstStepInputs["denomination"] = $request->denomination;
        $firstStepInputs["type_acteur"] = $request->type_acteur;
        $firstStepInputs["specialite"] = $request->specialite;
        //$firstStepInputs["autre_specialite"] = $request->autre_specialite;
        $firstStepInputs["adresse_siege"] = $request->adresse_siege;
        $firstStepInputs["source_financement"]=$request->source_financement;
        $firstStepInputs["telephone_siege"]=$request->telephone_siege;
        $firstStepInputs["secteur_intervention"]=$request->secteur_intervention;
        $firstStepInputs["paquet_sante_intervention"]=$request->paquet_sante_intervention;
        $firstStepInputs["region_intervention"]=$request->region_intervention;
        $firstStepInputs["departement_intervention"]=$request->departement_intervention;
        $firstStepInputs["commune_intervention"]=$request->commune_intervention;
        $firstStepInputs["districte_intervention"]=$request->districte_intervention;
        $firstStepInputs["mobilisation_ressource"]=$request->mobilisation_ressource;
        $firstStepInputs["mis_en_commun_ressource"]=$request->mis_en_commun_ressource;
        $firstStepInputs["achat_service"]=$request->achat_service;
        $firstStepInputs["email_siege"]=$request->email_siege;
        $firstStepInputs["latitude"]=$request->latitude;
        $firstStepInputs["longitude"]=$request->longitude;
        $firstStepInputs["altitude"]=$request->altitude;
        $firstStepInputs["prenom_responsable"]=$request->prenom_responsable;
        $firstStepInputs["fonction_responsable"]=$request->fonction_responsable;
        $firstStepInputs["nom_responsable"]=$request->nom_responsable;
        $firstStepInputs["telephone_responsable"]=$request->telephone_responsable;
        $firstStepInputs["email_responsable"]=$request->email_responsable;
        $structure = $this->structureRepository->store($firstStepInputs);
         
        /* $details = [
            'title' => 'Mail from ItSolutionStuff.com',
            'body' => 'This is for testing email using smtp'
        ];
       
        Mail::to('myrespect4all@gmail.com')->send(new \App\Mail\CreatedAcountMailer($details)); */
        
        //Checker le type d"acteur
        switch ($request["source_financement"]) {
            //inputs pour les ONG et PTF
            case TypeActeur::ONG :
                $ongInputs["structure_id"] = $structure->id;
                $ongInputs["numero_agrement"] = $request->numero_agrement; 
                $ongInputs["type"] = $request->type;
                //$ongInputs["accord_siege"] = $request->accord_siege;
                if ($request->hasFile('accord_siege')) {
                    $ongInputs['accord_siege'] = $this->uploadUtil->traiterFile($request->file('accord_siege'), TypeUpload::PTF);
                }
                $ongInputs["bailleur"] = $request->bailleur;
                $ongInputs["date_debut_intervention"] = $request->date_debut_intervention;
                $ongInputs["date_fin_intervention"] = $request->date_fin_intervention;
                $ongInputs["email"] = $request->email;
                $ongInputs["piliers_intervention"] = $request->piliers_intervention;
                $ongInputs["montant_global_projet"] = $request->montant_global_projet;
                $ongInputs["mt_prevu_par_pilier"] = $request->mt_prevu_par_pilier;
                $ongInputs["mt_mobilise_par_pilier"] = $request->mt_mobilise_par_pilier;
                $ongInputs["mt_execute_par_pilier"] = $request->mt_execute_par_pilier;
                $ongInputs["mecanisme_financement"] = $request->mecanisme_financement;
                $ong = $this->ongRepository->store($ongInputs);

                if($request->projet_sous_recipiandaire && $request->montant_sous_recipiandaire){
                    $monatnts = $request->montant_sous_recipiandaire;
                    $projets =collect($request->projet_sous_recipiandaire);
            
                    $multiplied = $projets->map(function ($item, $key) use($monatnts, $ong) {
                        if ($item && $monatnts[$key]) {
                             return sousRecipiandaire::create([
                                'ong_id'=>$ong->id, 
                                'projet'=>$item,
                                'montant'=>$monatnts[$key]]);
                        }
                    });
                }

                break;
            case TypeActeur::PTF :
                $ptfInputs["structure_id"] = $structure->id;
                $ptfInputs["type"] = $request->type;
                $ptfInputs["bailleur"] = $request->bailleur;
                $ptfInputs["pays_nationalite"] = $request->pays_nationalite;
                $ptfInputs["numero_agrement"] = $request->numero_agrement; //first step
                $ptfInputs["agent_execution"] = $request->agent_execution;
                $ptfInputs["date_debut_intervention"] = $request->date_debut_intervention;
                $ptfInputs["date_fin_intervention"] = $request->date_fin_intervention;
                $ptfInputs["piliers_intervention"] = $request->piliers_intervention;
                $ptfInputs["mt_prevu_par_pilier_annee_en_cour"] = $request->mt_prevu_par_pilier_annee_en_cour;
                $ptfInputs["mt_mobilise_par_pilier"] = $request->mt_mobilise_par_pilier;
                $ptfInputs["mt_execute_par_pilier"] = $request->mt_execute_par_pilier;
                //$ptfInputs["projection_annee_n_plus1_par_pilier"] = $request->projection_annee_n_plus1_par_pilier;
                $ptfInputs["projection_annee_n_plus2_par_pilier"] = $request->projection_annee_n_plus2_par_pilier;
                $ptfInputs["mecanisme_financement"] = $request->mecanisme_financement;
                if ($request->hasFile('projection_annee_n_plus1_par_pilier')) {
                    $ptfInputs['projection_annee_n_plus1_par_pilier'] = $this->uploadUtil->traiterFile($request->file('projection_annee_n_plus1_par_pilier'), TypeUpload::PTF);
                }
                if ($request->hasFile('projection_annee_n_plus2_par_pilier')) {
                    $ptfInputs['projection_annee_n_plus2_par_pilier'] = $this->uploadUtil->traiterFile($request->file('projection_annee_n_plus2_par_pilier'), TypeUpload::PTF);
                }
                $this->ptfRepository->store($ptfInputs);
                break;

                //EPS attribut
                case TypeActeur::EPS :
                    $EPS_Inputs["structure_id"] = $structure->id;
                    $EPS_Inputs["mecanisme_financement"] = $request->mecanisme_financement;
                    if ($request->hasFile('documents')) {
                        $EPS_Inputs['documents'] = $this->uploadUtil->traiterFile($request->file('documents'), TypeUpload::PTF);
                    }
                    $this->epsRepository->store($EPS_Inputs);
                        //Pilier & Axe Loops
                        $piliers =[];
                        foreach ($request->piliers as $pilier) {
                            $decodedPilier = json_decode($pilier);
                            if($decodedPilier->pilier !== ""){
                                array_push($piliers, $decodedPilier);
                            }
                        }
                        foreach ($piliers as $pilier) {
                            $newPilier = Pilier::create([
                                'libelle' => $pilier->pilier,
                                'monnaie' => $request->monnaie,
                                'structure_id' =>$structure->id,
                            ]);
                        
                            foreach ($pilier->axe as $axe) {
                            if($axe->libelle !== ""){
                                AxeIntervention::create([
                                    'pilier_id' => $newPilier->id,
                                    'libelle' => $axe->libelle,
                                    'montant_prevu' => $axe->montant_prevu,
                                    'montant_mobilise' => $axe->montant_mobilise,
                                    'montant_execute' => $axe->montant_execute,
                                ]);
                            }
                            }
                        }
                    
                        //Investissement
                        $investissements =[];
                        foreach ($request->investissements as $investissement) {
                        $decodedInvest = json_decode($investissement);
                            if($decodedInvest->libelle !== "" && $decodedInvest->montant !==""){
                                array_push($investissements, $decodedInvest);
                            }
                        }

                        foreach ($investissements as $invest) {
                        $newInvest = Investissement::create([
                                'libelle' => $invest->libelle,
                                'montant' => $invest->montant,
                                'structure_id' => $structure->id,
                            ]);
                        }

                        //Projets
                        $projets =[];
                        foreach ($request->projets as $projet) {
                        $decodedProjet = json_decode($projet);
                            if($decodedProjet->libelle !== ""){
                                array_push($projets, $decodedProjet);
                            }
                        }

                        foreach ($projets as $projet) {
                        $newProjet = Projet::create([
                                'libelle' => $projet->libelle,
                                'perspective' => $projet->perspective,
                                'opportunite' => $projet->opportunite,
                                'structure_id' => $structure->id,
                            ]);
                        }
                    break;
                case TypeActeur::SPS :
                        $SPS_Inputs["structure_id"] = $structure->id;
                        $SPS_Inputs["type_structure"] = $request->type_structure;
                        $SPS_Inputs["numero_autorisation"] = $request->numero_autorisation;
                        /* $SPS_Inputs["mt_prevu_par_pilier"] = $request->mt_prevu_par_pilier;
                        $SPS_Inputs["mt_mobilise_par_pilier"] = $request->mt_mobilise_par_pilier;
                        $SPS_Inputs["mt_execute_par_pilier"] = $request->mt_execute_par_pilier;
                        $SPS_Inputs["investissement_en_cours"] = $request->investissement_en_cours;
                        $SPS_Inputs["projets"] = $request->projets;
                        $SPS_Inputs["opportunites"] = $request->opportunites;
                        $SPS_Inputs["perspective"] = $request->perspective; */
                        $SPS_Inputs["mecanisme_financement"] = $request->mecanisme_financement;
                       // $SPS_Inputs["documents"] = $request->documents;
                        if ($request->hasFile('documents')) {
                            $ptfInputs['documents'] = $this->uploadUtil->traiterFile($request->file('documents'), TypeUpload::PTF);
                        }
                        
                        $this->spsRepository->store($SPS_Inputs);
                           //Pilier & Axe Loops
                           $piliers =[];
                           foreach ($request->piliers as $pilier) {
                               $decodedPilier = json_decode($pilier);
                               if($decodedPilier->pilier !== ""){
                                   array_push($piliers, $decodedPilier);
                               }
                           }
                           foreach ($piliers as $pilier) {
                               $newPilier = Pilier::create([
                                   'libelle' => $pilier->pilier,
                                   'monnaie' => $request->monnaie,
                                   'structure_id' =>$structure->id,
                               ]);
                           
                               foreach ($pilier->axe as $axe) {
                               if($axe->libelle !== ""){
                                   AxeIntervention::create([
                                       'pilier_id' => $newPilier->id,
                                       'libelle' => $axe->libelle,
                                       'montant_prevu' => $axe->montant_prevu,
                                       'montant_mobilise' => $axe->montant_mobilise,
                                       'montant_execute' => $axe->montant_execute,
                                   ]);
                               }
                               }
                           }
                       
                           //Investissement
                           $investissements =[];
                           foreach ($request->investissements as $investissement) {
                           $decodedInvest = json_decode($investissement);
                               if($decodedInvest->libelle !== "" && $decodedInvest->montant !==""){
                                   array_push($investissements, $decodedInvest);
                               }
                           }
   
                           foreach ($investissements as $invest) {
                           $newInvest = Investissement::create([
                                   'libelle' => $invest->libelle,
                                   'montant' => $invest->montant,
                                   'structure_id' => $structure->id,
                               ]);
                           }
   
                           //Projets
                           $projets =[];
                           foreach ($request->projets as $projet) {
                           $decodedProjet = json_decode($projet);
                               if($decodedProjet->libelle !== ""){
                                   array_push($projets, $decodedProjet);
                               }
                           }
   
                           foreach ($projets as $projet) {
                           $newProjet = Projet::create([
                                   'libelle' => $projet->libelle,
                                   'perspective' => $projet->perspective,
                                   'opportunite' => $projet->opportunite,
                                   'structure_id' => $structure->id,
                               ]);
                           }
                        break;
                //inputs pour Etat
                case TypeActeur::Etat :
                    $etatInputs["structure_id"] = $structure->id;
                    $etatInputs["type_achat"] = $request->type_achat;
                    $etatInputs["domaine_intervention_sante"] = $request->domaine_intervention_sante;
                    $etatInputs["piliers_intervention"] = $request->piliers_intervention;
                    $etatInputs["beneficiaire"] = $request->beneficiaire;
                    $etatInputs["mt_mobilise_par_annee"] = $request->mt_mobilise_par_annee;
                    $etatInputs["realisation"] = $request->realisation;
                    $etatInputs["prestation_prise_en_charge"] = $request->prestation_prise_en_charge;
                    $etatInputs["projet_en_cours"] = $request->projet_en_cours;
                    $etatInputs["opportunites"] = $request->opportunites;
                    $etatInputs["perspective"] = $request->perspective;
                    $etatInputs["documents"] = $request->documents;
                    $etatInputs["service_soins_achetes"] = $request->service_soins_achetes;
                    $etatInputs["mecanisme_achat"] = $request->mecanisme_achat;
                    $this->etatRepository->store($etatInputs);
                    break;
                    //inputs pour le secteur privé non sanitaire
                case TypeActeur::SecteurPriveNonSanitaire :
                    $SPNS_Inputs["structure_id"] = $structure->id;
                    $SPNS_Inputs["adresse_siege"] = $request->adresse_siege;
                    $SPNS_Inputs["type_entreprise"] = $request->type_entreprise;
                    $SPNS_Inputs["domaine_intervention"] = $request->domaine_intervention;
                    $SPNS_Inputs["secteur_intervention_sante"] = $request->secteur_intervention_sante;
                    $SPNS_Inputs["rse_intervention_sante"] = $request->rse_intervention_sante;
                    $SPNS_Inputs["volume_investissement_global"] = $request->volume_investissement_global;
                    $SPNS_Inputs["volume_investissement_par_annee"] = $request->volume_investissement_par_annee;
                    $SPNS_Inputs["date_debut_intervention"] = $request->date_debut_intervention;
                    $SPNS_Inputs["date_fin_intervention"] = $request->date_fin_intervention;
                    $SPNS_Inputs["partenaire_de_mis_en_ouvre"] = $request->partenaire_de_mis_en_ouvre;
                    $this->secteurPriveNonSanitaireRepository->store($SPNS_Inputs);
                    break;
                    //inputs pour collectivité territoriales
                    case TypeActeur::CT :
                        $CtInputs["structure_id"] = $structure->id;
                        $CtInputs["nbr_structure_sante_polarises"] = $request->nbr_structure_sante_polarises;
                        $CtInputs["type_structure_sante_polarises"] = $request->type_structure_sante_polarises;
                        $CtInputs["domaine_intervention_sante"] = $request->domaine_intervention_sante;
                        $CtInputs["volume_investissement_global_sante"] = $request->volume_investissement_global_sante;
                        $CtInputs["volume_investissement_sante"] = $request->volume_investissement_sante;
                        $CtInputs["montant_fdd_mobilise_sante"] = $request->montant_fdd_mobilise_sante;
                        $CtInputs["montant_fonds_propre_sante"] = $request->montant_fonds_propre_sante;
                        $CtInputs["montant_fecl_mobilise_sante"] = $request->montant_fecl_mobilise_sante;
                       // $CtInputs["accord_de_siege"] = $request->accord_de_siege;
                        if ($request->hasFile('accord_siege')) {
                            $CtInputs['accord_siege'] = $this->uploadUtil->traiterFile($request->file('accord_siege'), TypeUpload::PTF);
                        }
                        $this->collectiviteTerritorialeRepository->store($CtInputs);
                        break;
                    default:
                        # code...
                        break;
        }

        return $this->sendResponse(new StructureResource($structure), "Ajouté avec succés.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Get(
     ** path="/v1/structures/{id}",
     *   tags={"Structures"},
     *   summary="Detail Structure",
     *   operationId="Structure Detail",
     *  security={{"bearerAuth": {}}},
     *
     *   @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *
     *   @OA\Response(
     *      response=200,
     *      description="Success",
     *      @OA\Property(ref="#/components/schemas/Structure"),
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *      description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function show($id)
    {
        $structure = Structure::find($id);
        if (!is_null($structure)) {
            return $this->sendResponse(new StructureResource($structure), "succés.");
          } else {
            return $this->sendError("Cette structure n'existe pas");
          }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
     /**
     * @OA\Put(
     ** path="/v1/structures/{id}",
     *   tags={"Structures"},
     *   summary="Update Structure",
     *   operationId="update Structure",
     *   security={{"bearerAuth": {}}},
     *
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     * ),
     *  @OA\Parameter(
     *      name="denomination",
     *      in="query",
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     * 
     * @OA\Parameter(
     *      name="addresse_siege",
     *      in="query", 
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="telephone",
     *      in="query",
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *       name="type_fonds",
     *      in="query",
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="prenom_personne_responsable",
     *      in="query",
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="nom_personne_responsable",
     *      in="query",
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="type_acteur_id",
     *      in="query",
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="email_personne_responsable",
     *      in="query",
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="telephone_personne_responsable",
     *      in="query",
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *    @OA\Parameter(
     *      name="source_financement_id",
     *      in="query",
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     * 
     * 
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     */
    public function update(Request $request, $id)
    {
        $structurre = Structure::find($id);
        $structurre->denomination  = $request->denomination ? $request->denomination :$structurre->denomination;
        $structurre->logo  = $request->logo ? $request->logo :$structurre->logo;
        $structurre->type_fonds  = $request->type_fonds ? $request->type_fonds :$structurre->type_fonds;
        $structurre->telephone  = $request->telephone ? $request->telephone :$structurre->telephone;
        $structurre->addresse_siege  = $request->addresse_siege ? $request->addresse_siege :$structurre->addresse_siege;
        $structurre->source_financement_id  = $request->source_financement_id ? $request->source_financement_id :$structurre->source_financement_id;
        $structurre->type_acteur_id  = $request->type_acteur_id ? $request->type_acteur_id :$structurre->type_acteur_id;
        $structurre->prenom_personne_responsable  = $request->prenom_personne_responsable ? $request->prenom_personne_responsable :$structurre->prenom_personne_responsable;
        $structurre->nom_personne_responsable  = $request->nom_personne_responsable ? $request->nom_personne_responsable :$structurre->nom_personne_responsable;
        $structurre->telephone_personne_responsable  = $request->telephone_personne_responsable ? $request->telephone_personne_responsable :$structurre->telephone_personne_responsable;
        $structurre->email_personne_responsable  = $request->email_personne_responsable ? $request->email_personne_responsable :$structurre->email_personne_responsable;
        $structurre->save();

        return $this->sendResponse(new StructureResource($structurre), "succés.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

      /**
     * @OA\Delete(
     ** path="/v1/structures/{id}",
     *   tags={"Structures"},
     *   summary="Delete Structure",
     *   operationId="delete Structure",
     *  security={{"bearerAuth": {}}},
     *
     *   @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *
     *   @OA\Response(
     *      response=200,
     *      description="Success",
     *      @OA\Property(ref="#/components/schemas/Structure"),
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *      description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function destroy($id)
    {
        $structure = Structure::find($id);
        $structure->delete();
        return $this->sendResponse([], "Structure supprimé avec succés.");
    }


    public function getacteur($type)
    {
        $structures = $this->structureRepository->getStructureByTypeActeur($type);
        //$structures = $this->structureRepository->getData();
        return $this->sendResponse(StructureResource::collection($structures), "succés.");
    }
}
