<?php

    namespace App\Repositories;

    use App\Models\Horaire;

    class HoraireRepository extends ResourceRepository
    {
        // Fonction constructeur
        public function __construct(Horaire $horaireRepository)
        {
            $this->model = $horaireRepository;
        }

        /**
         * Fonction qui retourne les horaires dans l'API
         */
        public function getAllHorairesForApi()
        {
            return Horaire::select('horaires.*')
                        ->orderBy('heure')
                        ->get();
        }

        // Fonction de recherche d'horaire
        public function searchHoraireForApi($request)
        {
            return Horaire::where('heure', 'like', "%$request%")
                        ->orderBy('heure')
                        ->get();
        }
	
    }