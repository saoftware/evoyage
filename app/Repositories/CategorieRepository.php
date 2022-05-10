<?php

    namespace App\Repositories;

    use App\Models\Categorie;

    class CategorieRepository extends ResourceRepository
    {
        // Fonction constructeur
        public function __construct(Categorie $categorieRepository)
        {
            $this->model = $categorieRepository;
        }

        /**
         * Fonction qui retourne les catégories dans l'API
         */
        public function getAllCategoriesForApi()
        {
            return Categorie::select('categories.*')
                        ->orderBy('libelle')
                        ->get();
        }

        // Fonction de recherche d'une catégorie dans l'Api
        public function searchCategorieForApi($request)
        {
            $searchCategorie = request()->input('searchCategorie');
            return Categorie::where('libelle', 'like', "%$request%")
                        ->Orwhere('description', 'like', "%$request%")
                        ->orderBy('libelle')
                        ->get();
        }
	
    }