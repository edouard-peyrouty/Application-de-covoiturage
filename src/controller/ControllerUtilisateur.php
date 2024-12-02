<?php
    namespace App\Covoiturage\Controller;

use App\Covoiturage\Model\DataObject\Utilisateur;
use App\Covoiturage\Model\Repository\UtilisateurRepository;

    class ControllerUtilisateur {

        private static function afficheVue(array $parametres = []) : void {
            extract($parametres); // Crée des variables à partir du tableau $parametres
            require __DIR__."/../view/view.php"; // Charge la vue
        }

        public static function create() : void {
            static::afficheVue([
                    "pagetitle" => "Création d'un utilisateur",
                    "cheminVueBody" => "utilisateur/create.php"
                ]); 
        }

        public static function created() : void {
            $utilisateur = (new UtilisateurRepository)->construire($_GET);
            (new UtilisateurRepository)->insert($utilisateur);
            static::afficheVue([
                "liste_utilisateurs" => (new UtilisateurRepository())->selectAll(),
                "pagetitle" => "Liste des utilisateurs",
                "cheminVueBody" => "utilisateur/created.php"
            ]);
        }
        
        // Déclaration de type de retour void : la fonction ne retourne pas de valeur
        public static function readAll() : void {
            static::afficheVue([
                "liste_utilisateurs" => (new UtilisateurRepository())->selectAll(),
                "pagetitle" => "Liste des utilisateurs",
                "cheminVueBody" => "utilisateur/list.php"
            ]);
        }

        public static function read() : void {
            $login = $_GET['login'];
            $utilisateur = (new UtilisateurRepository())->select($login);
            if($utilisateur) {
                static::afficheVue([
                    "utilisateur" => $utilisateur,
                    "pagetitle" => "Détails d'un utilisateur",
                    "cheminVueBody" => "utilisateur/details.php"
                ]);
            } else {
                static::error("Le login que vous cherchez n'existe pas.");
            }
        }

        public static function update() : void {
            $login = $_GET['login'];
            $utilisateur = (new UtilisateurRepository)->select($login);
            if($utilisateur) {
                static::afficheVue([
                    "utilisateur" => $utilisateur,
                    "pagetitle" => "Modification d'un utilisateur",
                    "cheminVueBody" => "utilisateur/update.php"
                ]);
            } else {
                static::error("Le login que vous cherchez n'existe pas.");   
            }
        }

        public static function updated() : void {
            $utilisateur = (new UtilisateurRepository)->construire($_GET);
            (new UtilisateurRepository)->update($utilisateur);
            static::afficheVue([
                "liste_utilisateurs" => (new UtilisateurRepository())->selectAll(),
                "login" => $utilisateur->get_login(),
                "pagetitle" => "Liste des utilisateurs",
                "cheminVueBody" => "utilisateur/updated.php"
            ]);
        }

        public static function delete() : void {
            $login = $_GET['login'];
            (new UtilisateurRepository())->delete($login);
            static::afficheVue([
                "liste_utilisateurs" => (new UtilisateurRepository())->selectAll(),
                "login" => $login,
                "pagetitle" => "Liste des utilisateurs",
                "cheminVueBody" => "utilisateur/deleted.php"
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