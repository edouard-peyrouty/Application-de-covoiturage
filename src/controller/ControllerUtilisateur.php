<?php

namespace App\Covoiturage\Controller;

use App\Covoiturage\Lib\ConnexionUtilisateur;
use App\Covoiturage\Lib\MessageFlash;
use App\Covoiturage\Lib\MotDePasse;
use App\Covoiturage\Model\DataObject\Utilisateur;
use App\Covoiturage\Model\Repository\UtilisateurRepository;
use Exception;
use PDOException;

class ControllerUtilisateur extends GenericController {

    public static function create() : void {
        static::afficheVue([
                "pagetitle" => "Création d'un utilisateur",
                "cheminVueBody" => "utilisateur/create.php"
            ]); 
    }

    public static function created() : void {
        if($_GET["mdp"] == $_GET["mdp2"]) {
            $utilisateur = Utilisateur::construireDepuisFormulaire($_GET);
            if (!ConnexionUtilisateur::estAdministrateur()) {
                $utilisateur->set_estAdmin(false);
            }
            try {
                (new UtilisateurRepository)->insert($utilisateur);
            } catch (PDOException) {
                MessageFlash::ajouter("warning", "Cet utilisateur existe déjà");
                static::create();
                exit();
            }
            $login = $utilisateur->get_login();
            MessageFlash::ajouter("success", "L'utilisateur ayant le login $login a bien été créé.");
            static::readAll();
        } else {
            MessageFlash::ajouter("warning", "Mots de passe distincts");
            static::create();
        }
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
        if(ConnexionUtilisateur::estUtilisateur($login) || ConnexionUtilisateur::estAdministrateur()) {
            $utilisateur = (new UtilisateurRepository)->select($login);
            if($utilisateur) {
                static::afficheVue([
                    "utilisateur" => $utilisateur,
                    "pagetitle" => "Modification d'un utilisateur",
                    "cheminVueBody" => "utilisateur/update.php"
                ]);
            } else {
                MessageFlash::ajouter("warning", "Le login que vous cherchez n'existe pas.");
                static::readAll();   
            }
        } else {
            MessageFlash::ajouter("danger", "Accès interdit");
            static::readAll();
        }
    }

    public static function updated() : void {
        // on vérifie que tous les champs sont bien remplie
        if(isset($_GET["login"]) && isset($_GET["nom"]) && isset($_GET["prenom"]) 
            && isset($_GET["mdp"]) && isset($_GET["new_mdp"]) && isset($_GET["new_mdp2"])) 
        {
            // on vérifie que l'utilisateur existe
            $utilisateur = (new UtilisateurRepository)->select($_GET["login"]);
            if($utilisateur) {
                // on vérifie que les deux nouveaux mots de passe coïncides
                if($_GET["new_mdp"] == $_GET["new_mdp2"]) {
                    // erreur affichée sur vscode à cause de $utilisateur qui est de type 
                    // AbstractDataObject au lieu de Utilisateur mais ça marche donc don't worry
                    // On vérifie que l'ancien mot de passe est correct
                    if(MotDePasse::verifier($_GET["mdp"], $utilisateur->get_mdpHache())) {
                        // On vérifie que l'utilisateur mis à jour correspond à l'utilisateur connecté
                        if(ConnexionUtilisateur::estUtilisateur($utilisateur->get_login()) || ConnexionUtilisateur::estAdministrateur()) {
                            $utilisateur->set_nom($_GET["nom"]);
                            $utilisateur->set_prenom($_GET["prenom"]);
                            $utilisateur->set_mdpHache($_GET["new_mdp"]);
                            if(ConnexionUtilisateur::estAdministrateur()) {
                                $utilisateur->set_estAdmin(isset($_GET["estAdmin"]));
                            }
                            (new UtilisateurRepository)->update($utilisateur);
                            $login = $utilisateur->get_login();
                            $message = "L'utilisateur ayant le login $login a bien été mis à jour.";
                            MessageFlash::ajouter("success", $message);
                            static::readAll();
                            exit();
                        } else {
                            MessageFlash::ajouter("danger", "Impossible de modifier un utilisateur non connecté");
                        }
                    } else {
                        MessageFlash::ajouter("warning", "Ancien mot de passe erroné"); 
                    }
                } else {
                    MessageFlash::ajouter("warning", "Mots de passe distincts");   
                }
            } else {
                MessageFlash::ajouter("warning", "Le login que vous cherchez n'existe pas.");
            }
        } else {
            MessageFlash::ajouter("danger", "Formulaire incomplet");
        }
        static::update();
    }

    public static function delete() : void {
        if(isset($_GET["login"])) {
            $login = $_GET['login'];
            // On vérifie que l'utilisateur à supprimer correspond à l'utilisateur connecté
            if(ConnexionUtilisateur::estUtilisateur($login) || ConnexionUtilisateur::estAdministrateur()) {
                (new UtilisateurRepository())->delete($login);
                $message = "L'utilisateur ayant le login $login a bien été supprimé.";
                MessageFlash::ajouter("success", $message);
                static::deconnecter();
                exit();
            } else {
                MessageFlash::ajouter("danger", "Impossible de supprimer un utilisateur non connecté");
            }
        } else {
            MessageFlash::ajouter("danger", "Login non précisé");
        }
        static::readAll();
    }

    public static function formulaireConnexion() : void {
        static::afficheVue([
            "pagetitle" => "Connexion",
            "cheminVueBody" => "utilisateur/formulaireConnexion.php"
        ]);
    }

    public static function connecter() : void {
        if(isset($_GET["login"]) && isset($_GET["mdp"])) {
            $utilisateur = (new UtilisateurRepository)->select($_GET["login"]);
            if($utilisateur && MotDePasse::verifier($_GET["mdp"], $utilisateur->get_mdpHache())) {
                ConnexionUtilisateur::connecter($utilisateur->get_login());
                MessageFlash::ajouter("success", "Connexion réussie");
                static::read();
            } else {
                MessageFlash::ajouter("warning", "Login ou mot de passe incorrect");
                static::formulaireConnexion(); 
            }
        } else {
            MessageFlash::ajouter("danger", "Formulaire vide"); 
            static::formulaireConnexion(); 
        }
    }

    public static function deconnecter() : void {
        ConnexionUtilisateur::deconnecter();
        MessageFlash::ajouter("success", "Déconnexion réussie");
        static::readAll();
    }
}