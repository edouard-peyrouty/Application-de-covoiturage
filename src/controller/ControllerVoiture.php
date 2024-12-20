<?php
    namespace App\Covoiturage\Controller;

use App\Covoiturage\Lib\MessageFlash;
use App\Covoiturage\Model\Repository\VoitureRepository;

    class ControllerVoiture extends GenericController {

        public static function create() : void {
            static::afficheVue([
                    "pagetitle" => "Création d'une voiture",
                    "cheminVueBody" => "voiture/create.php"
                ]); 
        }

        public static function created() : void {
            $voiture = (new VoitureRepository)->construire($_GET);
            (new VoitureRepository)->insert($voiture);
            $immat = $voiture->getImmatriculation();
            $message = "La voiture ayant l'immatriculation $immat a bien été créée.";
            MessageFlash::ajouter("success", $message);
            static::readAll();
        }
        
        // Déclaration de type de retour void : la fonction ne retourne pas de valeur
        public static function readAll() : void {
            static::afficheVue([
                "liste_voitures" => (new VoitureRepository())->selectAll(),
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
            $immat = $voiture->getImmatriculation();
            $message = "La voiture ayant l'immatriculation $immat a bien été mise à jour.";
            MessageFlash::ajouter("success", $message);
            static::readAll();
        }

        public static function delete() : void {
            $immat = $_GET['immat'];
            (new VoitureRepository())->delete($immat);
            $message = "La voiture ayant l'immatriculation $immat a bien été supprimée.";
            MessageFlash::ajouter("success", $message);
            static::readAll();
        }
    }