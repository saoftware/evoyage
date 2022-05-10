<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Horaire;
use App\Repositories\HoraireRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HorairesController extends Controller
{
    public function __construct(HoraireRepository $horaireRepository)
    {
        $this->horaireRepository = $horaireRepository; 
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lesHoraires = $this->horaireRepository->getAllHorairesForApi();
        
        if(!empty($lesHoraires))
        {
            return response()->json(['data' => $lesHoraires], Response::HTTP_OK);
        }
        else
        {
            $msg = "Aucun Item disponible";
            
            return response()->json(["msg" => $msg], Response::HTTP_NOT_FOUND);
        }

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(empty($request->heure)){
            return response()->json(["Veillez entrer l\'heure"], Response::HTTP_NOT_FOUND);
        }
        else{
            $horaire = Horaire::create($request->all());
            return response($horaire, 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $horaire = Horaire::find($id);
        
        if(is_null($horaire))
        {
            return response()->json(['message' => 'L\'heure n\'existe pas'], 404);
        }
        if(!empty($horaire))
        {
             return response()->json(['data' => $horaire], Response::HTTP_OK);
        }
        
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
        $categorie = Horaire::find($id);

        if(is_null($categorie))
        {
            return response()->json(['message' => 'L\'heure n\'existe pas'], 404);
        }
        $categorie->update($request->all());
        return response($categorie, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $horaire = Horaire::find($id);

        if(is_null($horaire))
        {
            return response()->json(['message' => 'L\'heure n\'existe pas'], 404);
        }
        $horaire->delete();
        return response()->json(['message' => 'Heure supprimée avec succès'], 204);
    }
    
    // Fonction de recherche d'une catéggorie
    public function search(Request $request)
    {
        // Recuperer la liste des enquêtes transférées disponibles
        $lesHorairees = $this->horaireRepository->searchhoraireForApi($request);

        if(!empty($lesHorairees))
        {
           return response()->json(['data' => $lesHorairees], Response::HTTP_OK);
        }
        else
        {
            $msg = "Aucun Item disponible";
           return response()->json(["msg" => $msg], Response::HTTP_NOT_FOUND);
        }

    }
    
}