<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\SourceFinancementRessoure;
use App\Models\SourceFinancement;
use App\Models\TypeActeur;
use Illuminate\Http\Request;

class SourceFinancementController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $financement = SourceFinancement::all();
        return $this->sendResponse(SourceFinancementRessoure::collection($financement), 'succés.');
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sourceFinance = new SourceFinancement;
        $sourceFinance->denomination  = $request->denomination;
        $sourceFinance->save();

        for ($i=0; $i < count($request->only('type_acteur')['type_acteur']); $i++) { 
            $acteur = new TypeActeur;
            $acteur->libelle = $request['type_acteur'][$i];
            $acteur->source_financement_id = $sourceFinance->id;
            $acteur->save();
        }

        return $this->sendResponse(new SourceFinancementRessoure($sourceFinance), 'Ajouté avec succés.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $financement = SourceFinancement::find($id);
        $financement->delete();
        return $this->sendResponse([], 'Supprimé avec succés.');
    }
}
