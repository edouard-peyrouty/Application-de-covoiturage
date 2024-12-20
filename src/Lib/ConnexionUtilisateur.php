<?php

namespace App\Covoiturage\Lib;

use App\Covoiturage\Model\HTTP\Session;
use App\Covoiturage\Model\Repository\UtilisateurRepository;

class ConnexionUtilisateur {
    
    // L'utilisateur connecté sera enregistré en session associé à la clé suivante
    private static string $cleConnexion = "_utilisateurConnecte";
    
    public static function connecter(string $loginUtilisateur): void
    {
        Session::getInstance()->enregistrer(static::$cleConnexion, $loginUtilisateur);
    }
    
    public static function estConnecte(): bool
    {
        return Session::getInstance()->contient(static::$cleConnexion);    
    }
    
    public static function deconnecter(): void
    {
        Session::getInstance()->supprimer(static::$cleConnexion);
    }
    
    public static function getLoginUtilisateurConnecte(): ?string
    {
        if(static::estConnecte()) {
            return Session::getInstance()->lire(static::$cleConnexion);
        } else {
            return null;
        }
    }

    public static function estUtilisateur($login): bool {
        return static::estConnecte() && ($login == static::getLoginUtilisateurConnecte());
    }

    public static function estAdministrateur() : bool {
        $login = static::getLoginUtilisateurConnecte();
        if($login != null) {
            $utilisateur = (new UtilisateurRepository)->select($login);
            return $utilisateur->get_estAdmin();
        }
        return false;
    }
}