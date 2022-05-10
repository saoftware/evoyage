<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Repositories\CategorieRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoriesController extends Controller
{
    public function __construct(CategorieRepository $categorieRepository)
    {
        $this->categorieRepository = $categorieRepository; 
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lesCategories = $this->categorieRepository->getAllCategoriesForApi();
        
        if(!empty($lesCategories))
        {
            return response()->json(['data' => $lesCategories], Response::HTTP_OK);
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
        if(empty($request->libelle)){
            return response()->json(["Veillez entrer le libellé de la catégorie"], Response::HTTP_NOT_FOUND);
        }
        else{
            $categorie = Categorie::create($request->all());
            return response($categorie, 201);
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
        $categorie = Categorie::find($id);
        
        if(is_null($categorie))
        {
            return response()->json(['message' => 'La catégorie n\'existe pas'], 404);
        }
        if(!empty($categorie))
        {
             return response()->json(['data' => $categorie], Response::HTTP_OK);
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
        $categorie = Categorie::find($id);

        if(is_null($categorie))
        {
            return response()->json(['message' => 'La catégorie n\'existe pas'], 404);
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
        $categorie = Categorie::find($id);

        if(is_null($categorie))
        {
            return response()->json(['message' => 'La catégorie n\'existe pas'], 404);
        }
        $categorie->delete();
        return response()->json(['message' => 'Catégorie du car supprimée avec succès'], 204);
    }
    
    // Fonction de recherche d'une catéggorie
    public function search(Request $request)
    {
        // Recuperer la liste des enquêtes transférées disponibles
        $lesCategories = $this->categorieRepository->searchCategorieForApi($request);

        if(!empty($lesCategories))
        {
           return response()->json(['data' => $lesCategories], Response::HTTP_OK);
        }
        else
        {
            $msg = "Aucun Item disponible";
           return response()->json(["msg" => $msg], Response::HTTP_NOT_FOUND);
        }

    }
    
}