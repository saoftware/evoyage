<?php

    namespace App\Repositories;

    use App\Models\Convoi;

    class ConvoiRepository extends ResourceRepository
    {
        // Fonction constructeur
        public function __construct(Convoi $convoiRepository)
        {
            $this->model = $convoiRepository;
        }

        /**
         * Fonction qui retourne les convois dans l'API
         */
        public function getAllConvoisForApi($id_user)
        {
            return Convoi::join('horaires', 'horaires.id', '=', 'convois.horaire_id')
                        ->join('cars', 'cars.id', '=', 'convois.car_id')
                        ->join('categories', 'categories.id', '=', 'cars.categorie_id')
                        ->join('villes', 'villes.id', '=', 'convois.villeDepart_id')
                        ->join('villes', 'villes.id', '=', 'convois.villeArrivee_id')
                        ->join('users', 'users.id', '=', 'convois.user_id')
                        ->where('convois.user_id', '=', $id_user)
                        ->select('convois.*', 'categories.libelle', 'villes.nomVille as villeDepart', 'villes.nomVille as villeArrivee')
                        ->orderBy('categories.libelle')
                        ->get();
        }

        // Fonction de recherche d'un convoi
        public function searchConvoiForApi($ville, $heure, $cat)
        {
            return Convoi::join('horaires', 'horaires.id', '=', 'convois.horaire_id')
                        ->join('cars', 'cars.id', '=', 'convois.car_id')
                        ->join('categories', 'categories.id', '=', 'cars.categorie_id')
                        ->join('villes', 'villes.id', '=', 'convois.villeDepart_id')
                        ->join('villes', 'villes.id', '=', 'convois.villeArrivee_id')
                        ->join('users', 'users.id', '=', 'convois.user_id')
                        ->select('convois.*', 'categories.libelle', 'villes.nomVille as villeDepart', 'villes.nomVille as villeArrivee')
                        ->orderBy('categories.libelle')
                        ->where('categories.libelle', 'like', "%$cat%")
                        ->Orwhere('villes.nomVille', 'like', "%$ville%")
                        ->Orwhere('horaires.heure', 'like', "%$heure%")
                        ->get();
        }
	
    }