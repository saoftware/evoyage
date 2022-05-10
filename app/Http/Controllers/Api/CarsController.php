<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Repositories\CarRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CarsController extends Controller
{
    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository; 
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lesCars = $this->carRepository->getAllCarsForApi(1);
        
        if(!empty($lesCars))
        {
            return response()->json(['data' => $lesCars], Response::HTTP_OK);
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
            return response()->json(["Veillez entrer le libellé"], Response::HTTP_NOT_FOUND);
        }
        if(empty($request->nombreDePlace)){
            return response()->json(["Veillez entrer le nombre de place"], Response::HTTP_NOT_FOUND);
        }
        if(empty($request->categorie_id)){
            return response()->json(["Veillez préciser la categorie"], Response::HTTP_NOT_FOUND);
        }
        if(empty($request->user_id)){
            return response()->json(["Utilisateur inconnu"], Response::HTTP_NOT_FOUND);
        }
        else{
            $car = Car::create($request->all());
            return response($car, 201);
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
        
        $car = Car::find($id);
        // $car = $this->carRepository->getCarForApi($car_id);
        
        if(is_null($car))
        {
            return response()->json(['message' => 'Le car n\'existe pas'], 404);
        }
        if(!empty($car))
        {
             return response()->json(['data' => $car], Response::HTTP_OK);
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
        $car = Car::find($id);

        if(is_null($car))
        {
            return response()->json(['message' => 'Le car n\'existe pas'], 404);
        }
        $car->update($request->all());
        return response($car, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $car = Car::find($id);

        if(is_null($car))
        {
            return response()->json(['message' => 'Le car n\'existe pas'], 404);
        }
        $car->delete();
        return response()->json(['message' => 'Car supprimé avec succès'], 204);
    }
    
    // Fonction de recherche d'une catéggorie
    public function search(Request $request)
    {
        // Recuperer la liste des enquêtes transférées disponibles
        $lesCares = $this->carRepository->searchCarForApi($request);

        if(!empty($lesCares))
        {
           return response()->json(['data' => $lesCares], Response::HTTP_OK);
        }
        else
        {
            $msg = "Aucun Item disponible";
           return response()->json(["msg" => $msg], Response::HTTP_NOT_FOUND);
        }

    }
    
}