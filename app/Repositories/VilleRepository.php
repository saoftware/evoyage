<?php

    namespace App\Repositories;

    use App\Models\Ville;

    class VilleRepository extends ResourceRepository
    {
        // Fonction constructeur
        public function __construct(Ville $villeRepository)
        {
            $this->model = $villeRepository;
        }

        /**
         * Fonction qui retourne les villes dans l'API
         */
        public function getAllVillesForApi()
        {
            return Ville::select('villes.*')
                        ->orderBy('nomVille')
                        ->get();
        }

        // Fonction de recherche d'une ville
        public function searchVilleForApi($request)
        {
            return Ville::where('nomVille', 'like', "%$request%")
                        ->orderBy('nomVille')
                        ->get();
        }
	
    }