<?php

    namespace App\Repositories;

    use App\Models\Car;

    class CarRepository extends ResourceRepository
    {
        // Fonction constructeur
        public function __construct(Car $carRepository)
        {
            $this->model = $carRepository;
        }

        /**
         * Fonction qui retourne les cars dans l'API
         */
        public function getAllCarsForApi($id_user)
        {
            return Car::join('categories', 'categories.id', '=', 'cars.categorie_id')
                        ->join('users', 'users.id', '=', 'cars.user_id')
                        ->where('cars.user_id', '=', $id_user)
                        ->select('cars.*', 'categories.libelle')
                        ->orderBy('categories.libelle')
                        ->get();
        }

        public function getCarForApi($id)
        {
            return Car::join('categories', 'categories.id', '=', 'cars.categorie_id')
                        ->join('users', 'users.id', '=', 'cars.user_id')
                        ->where('cars.id', '=', $id)
                        ->select('cars.nombreDePlace', 'cars.libelle', 'cars.description', 'categories.libelle as categorie')
                        ->orderBy('categories.libelle')
                        ->get();
        }

        // Fonction de recherche d'un car
        public function searchCarForApi($nbPlace, $desc, $cat)
        {
            return Car::join('categories', 'categories.id', '=', 'cars.categorie_id')
                        ->join('users', 'users.id', '=', 'cars.user_id')
                        ->select('cars.*', 'categories.libelle')
                        ->orderBy('categories.libelle')
                        ->where('cars.user_id', '=', "users.id")
                        ->where('categories.libelle', 'like', "%$cat%")
                        ->Orwhere('cars.nombreDePlace', 'like', "%$nbPlace%")
                        ->Orwhere('cars.descruption', 'like', "%$desc%")
                        ->orderBy('nomVille')
                        ->get();
        }
	
    }