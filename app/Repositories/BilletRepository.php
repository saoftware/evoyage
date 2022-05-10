<?php

    namespace App\Repositories;

    use App\Models\Billet;

    class BilletRepository extends ResourceRepository
    {
        // Fonction constructeur
        public function __construct(Billet $billetRepository)
        {
            $this->model = $billetRepository;
        }

        /**
         * Fonction qui retourne les billet dans l'API
         */
        public function getAllBilletsForApi($id_user)
        {
            return Billet::join('convois', 'convois.id', '=', 'billets.convoi_id')
                        ->join('cars', 'cars.id', '=', 'convois.car_id')
                        ->join('categories', 'categories.id', '=', 'cars.categorie_id')
                        ->join('villes', 'villes.id', '=', 'convois.villeDepart_id')
                        ->join('villes', 'villes.id', '=', 'convois.villeArrivee_id')
                        ->join('users', 'users.id', '=', 'convois.user_id')
                        ->where('billets.user_id', '=', $id_user)
                        ->select('billets.*', 'categories.libelle', 'villes.nomVille as villeDepart', 'villes.nomVille as villeArrivee')
                        ->orderBy('categories.libelle')
                        ->get();
        }

        // Fonction de recherche d'un billet
        public function searchConvoiForApi($ville, $heure, $cat)
        {
            return Billet::join('convois', 'convois.id', '=', 'billets.convoi_id')
                        ->join('cars', 'cars.id', '=', 'convois.car_id')
                        ->join('categories', 'categories.id', '=', 'cars.categorie_id')
                        ->join('villes', 'villes.id', '=', 'convois.villeDepart_id')
                        ->join('villes', 'villes.id', '=', 'convois.villeArrivee_id')
                        ->join('users', 'users.id', '=', 'billet.user_id')
                        ->select('billets.*', 'categories.libelle', 'villes.nomVille as villeDepart', 'villes.nomVille as villeArrivee')
                        ->orderBy('categories.libelle')
                        ->where('categories.libelle', 'like', "%$cat%")
                        ->Orwhere('villes.nomVille', 'like', "%$ville%")
                        ->Orwhere('horaires.heure', 'like', "%$heure%")
                        ->get();
        }
	
    }