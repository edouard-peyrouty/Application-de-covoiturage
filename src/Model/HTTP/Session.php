<?php

namespace App\Covoiturage\Model\HTTP;

use Exception;
use App\Covoiturage\Config\Conf;

class Session {

    private static ?Session $instance = null;
    
    /**
     * @throws Exception
     */
    private function __construct()
    {
        if (session_start() === false) {
            throw new Exception("La session n'a pas réussi à démarrer.");
        }
    }

    public static function getInstance(): Session
    {
        if (!static::$instance) {
            static::$instance = new Session();
            static::$instance->verifierDerniereActivite();
            return static::$instance;
        }
        return static::$instance;
    }
    
    public function contient($name): bool
    {
        return isset($_SESSION[$name]);
    }

    public function enregistrer(string $name, mixed $value): void
    {
        $_SESSION[$name] = $value;
    }

    public function lire(string $name): mixed
    {
        if(static::contient($name)) {
            return $_SESSION[$name];
        } else {
            return null;
        }
    }

    public function supprimer($name): void
    {
        unset($_SESSION[$name]);
    }

    public function detruire() : void
    {
        session_unset(); // unset $_SESSION variable for the run-time
        session_destroy(); // destroy session data in storage
        Cookie::supprimer(session_name()); // deletes the session cookie
        // Il faudra reconstruire la session au prochain appel de getInstance()
        static::$instance = null;
    }

    private function verifierDerniereActivite() : void {
        $derniere_activite = static::lire("derniereActivite");
        if($derniere_activite && ((time() - $derniere_activite) > Conf::$dureeExpiration)) {
            static::detruire();
        }
        static::enregistrer("derniereActivite", time());
    }
}