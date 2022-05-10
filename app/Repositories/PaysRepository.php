<?php

    namespace App\Repositories;

    use App\Models\Pays;

    class PaysRepository extends ResourceRepository
    {
        // Fonction constructeur
        public function __construct(Pays $paysRepository)
        {
            $this->model = $paysRepository;
        }

        /**
         * Fonction qui retourne les pays dans l'API
         */
        public function getAllPaysForApi()
        {
            return Pays::select('pays.*')
                        ->orderBy('nomPays')
                        ->get();
        }

        // Fonction de recherche d'un pays dans l'API
        public function searchPaysForApi($request)
        {
            return Pays::where('nomPays', 'like', "%$request%")
                        ->orderBy('nomPays')
                        ->get();
        }
	
    }