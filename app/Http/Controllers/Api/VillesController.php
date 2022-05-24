<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ville;
use App\Repositories\VilleRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VillesController extends Controller
{
    public function __construct(VilleRepository $villeRepository)
    {
        $this->villeRepository = $villeRepository; 
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Recuperer la liste des enquêtes transférées disponibles
        $lesVilles = $this->villeRepository->getAllVillesForApi();

        if(!empty($lesVilles))
        {
           return response()->json(['data' => $lesVilles], 200);
        }
        else
        {
            $msg = "Aucun Item disponible";
           return response()->json(["msg" => $msg], 400);
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
        if(empty($request->nomVille)){
            return response()->json(["Veillez entrer le nom de la ville"], Response::HTTP_NOT_FOUND);
        }
        if(empty($request->pays_id)){
            return response()->json(["Veillez préciser le pays"], Response::HTTP_NOT_FOUND);
        }
        else{
            $ville = Ville::create($request->all());
            return response($ville, 201);
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
        $ville = Ville::find($id);
        
        if(is_null($ville))
        {
            return response()->json(['message' => 'La ville n\'existe pas'], 404);
        }
        if(!empty($ville))
        {
            return response()->json(['data' => $ville], Response::HTTP_OK);
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
        $ville = Ville::find($id);

        if(is_null($ville))
        {
            return response()->json(['message' => 'La catégorie n\'existe pas'], 404);
        }
        $ville->update($request->all());
        return response($ville, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ville = Ville::find($id);

        if(is_null($ville))
        {
            return response()->json(['message' => 'La ville n\'existe pas'], 404);
        }
        $ville->delete();
        return response()->json(['message' => 'Ville supprimée avec succès'], 204);
    }

    // Recherche une ville
    public function search(Request $request)
    {
        // Recuperer la liste des enquêtes transférées disponibles
        $lesVilles = $this->villeRepository->searchVilleForApi($request);

        if(!empty($lesVilles))
        {
           return response()->json(['data' => $lesVilles], Response::HTTP_OK);
        }
        else
        {
            $msg = "Aucun Item disponible";
           return response()->json(["msg" => $msg], Response::HTTP_NOT_FOUND);
        }

    }
    
}