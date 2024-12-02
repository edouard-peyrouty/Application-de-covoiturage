<?php
    namespace App\Covoiturage\Controller;

    use App\Covoiturage\Model\Repository\VoitureRepository;

    class ControllerVoiture {

        private static function afficheVue(array $parametres = []) : void {
            extract($parametres); // Crée des variables à partir du tableau $parametres
            require __DIR__."/../view/view.php"; // Charge la vue
        }

        public static function create() : void {
            static::afficheVue([
                    "pagetitle" => "Création d'une voiture",
                    "cheminVueBody" => "voiture/create.php"
                ]); 
        }

        public static function created() : void {
            $voiture = (new VoitureRepository)->construire($_GET);
            (new VoitureRepository)->insert($voiture);
            static::afficheVue([
                "voitures" => (new VoitureRepository())->selectAll(),
                "pagetitle" => "Liste des voitures",
                "cheminVueBody" => "voiture/created.php"
            ]);
        }
        
        // Déclaration de type de retour void : la fonction ne retourne pas de valeur
        public static function readAll() : void {
            static::afficheVue([
                "voitures" => (new VoitureRepository())->selectAll(),
                "pagetitle" => "Liste des voitures",
                "cheminVueBody" => "voiture/list.php"
            ]);
        }

        public static function read() : void {
            $immat = $_GET['immat'];
            $voiture = (new VoitureRepository())->select($immat);
            if($voiture) {
                static::afficheVue([
                    "voiture" => $voiture,
                    "pagetitle" => "Détails d'une voiture",
                    "cheminVueBody" => "voiture/details.php"
                ]);
            } else {
                static::error("L'immatriculation que vous cherchez n'existe pas.");
            }
        }

        public static function update() : void {
            $immat = $_GET['immat'];
            $voiture = (new VoitureRepository)->select($immat);
            if($voiture) {
                static::afficheVue([
                    "voiture" => $voiture,
                    "pagetitle" => "Modification d'une voiture",
                    "cheminVueBody" => "voiture/update.php"
                ]);
            } else {
                static::error("L'immatriculation que vous cherchez n'existe pas.");   
            }
        }
        
        public static function updated() : void {
            $voiture = (new VoitureRepository)->construire($_GET);
            (new VoitureRepository)->update($voiture);
            static::afficheVue([
                "voitures" => (new VoitureRepository())->selectAll(),
                "immatriculation" => $voiture->getImmatriculation(),
                "pagetitle" => "Liste des voitures",
                "cheminVueBody" => "voiture/updated.php"
            ]);
        }

        public static function delete() : void {
            $immat = $_GET['immat'];
            (new VoitureRepository())->delete($immat);
            static::afficheVue([
                "voitures" => (new VoitureRepository())->selectAll(),
                "immatriculation" => $immat,
                "pagetitle" => "Liste des voitures",
                "cheminVueBody" => "voiture/deleted.php"
            ]);
        }

        public static function error(string $errorMessage = "") : void {
            static::afficheVue([
                "errorMessage" => $errorMessage,
                "pagetitle" => "Erreur",
                "cheminVueBody" => "voiture/error.php"
            ]);
        }
    }
?>