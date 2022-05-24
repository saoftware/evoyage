<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pays;
use App\Repositories\PaysRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PaysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(PaysRepository $paysRepository)
    {
        $this->paysRepository = $paysRepository; 
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Recuperer la liste des enquêtes transférées disponibles
        $lesPays = $this->paysRepository->getAllPaysForApi();

        if(!empty($lesPays))
        {
           return response()->json(['data' => $lesPays], 200);
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
        $pays = Pays::where('nomPays', $request->nomPays)->first();
     
        if(empty($request->nomPays)){
            return response()->json(["Veillez entrer le nom du pays"], 400);
        }
        else{
            $Ville = Pays::create($request->all());
            return response($Ville, 201);
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
        $pays = Pays::find($id);
        
        if(is_null($pays))
        {
            return response()->json(['message' => 'Le pays n\'existe pas'], 404);
        }
        if(!empty($pays))
        {
            return response()->json(['data' => $pays], Response::HTTP_OK);
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
        $pays = Pays::find($id);

        if(is_null($pays))
        {
            return response()->json(['message' => 'Le pays n\'existe pas'], 404);
        }
        $pays->update($request->all());
        return response($pays, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pays = Pays::find($id);

        if(is_null($pays))
        {
            return response()->json(['message' => 'Le pays n\'existe pas'], 404);
        }
        $pays->delete();
        return response()->json(['message' => 'Pays supprimé avec succès'], 204);
    }

    // Recherche une ville
    public function search(Request $request)
    {
        // Recuperer la liste des enquêtes transférées disponibles
        $lesPays = $this->paysRepository->searchPaysForApi($request);

        if(!empty($lesPays))
        {
           return response()->json(['data' => $lesPays], Response::HTTP_OK);
        }
        else
        {
            $msg = "Aucun Item disponible";
           return response()->json(["msg" => $msg], Response::HTTP_NOT_FOUND);
        }

    }
}