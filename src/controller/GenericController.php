<?php 

namespace App\Covoiturage\Controller;

use App\Covoiturage\Lib\MessageFlash;
use App\Covoiturage\Lib\PreferenceControleur;

class GenericController {

    protected static function afficheVue(array $parametres = []) : void {
        extract($parametres); // Crée des variables à partir du tableau $parametres
        $messagesFlash = MessageFlash::lireTousMessages();
        require __DIR__."/../view/view.php"; // Charge la vue
    }

    public static function error(string $errorMessage = "") : void {
        static::afficheVue([
            "errorMessage" => $errorMessage,
            "pagetitle" => "Erreur",
            "cheminVueBody" => "error.php"
        ]);
    }
    
    public static function formulairePreference() : void {
        $controleur_defaut = PreferenceControleur::lire(); 
        static::afficheVue([
            "controleur_defaut" => $controleur_defaut,
            "pagetitle" => "Préférences",
            "cheminVueBody" => "formulairePreference.php"
        ]);
    }

    public static function enregistrerPreference(): void {
        $controleur_defaut = $_GET["controleur_defaut"];
        PreferenceControleur::enregistrer($controleur_defaut);
        $message = "La préférence de contrôleur est enregistrée !";
        MessageFlash::ajouter("success", $message);
        $url = "frontController.php";
        static::rediriger($url);
    }

    private static function rediriger($url) : void {
        header("Location: $url"); 
        exit();
    }
}