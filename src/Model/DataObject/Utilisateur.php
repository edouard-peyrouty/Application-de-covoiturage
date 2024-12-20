<?php
    
namespace App\Covoiturage\Model\DataObject;

use App\Covoiturage\Lib\MotDePasse;

class Utilisateur extends AbstractDataObject {

    // attributs
    private string $login;
    private string $nom;
    private string $prenom;
    private string $mdpHache;
    private bool $estAdmin;

    // constructeur
    public function __construct(string $login, string $nom, string $prenom, string $mdpHache, bool $estAdmin) {
        $this->login = $login;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->mdpHache = $mdpHache;
        $this->estAdmin = $estAdmin;
    }

    // getters
    public function get_login(): string {return $this->login;}
    public function get_nom(): string {return $this->nom;}
    public function get_prenom(): string {return $this->prenom;}
    public function get_mdpHache(): string {return $this->mdpHache;}
    public function get_estAdmin(): bool {return $this->estAdmin;}

    // setters
    public function set_login(string $login) {$this->login = $login;}
    public function set_nom(string $nom) {$this->nom = $nom;}
    public function set_prenom(string $prenom) {$this->prenom = $prenom;}
    public function set_mdpHache(string $mdp) {$this->mdpHache = MotDePasse::hacher($mdp);}
    public function set_estAdmin(bool $estAdmin) {$this->estAdmin = $estAdmin;}

    public function formatTableau(): array {
        return [
            "login" => $this->get_login(), 
            "nom" => $this->get_nom(),
            "prenom" => $this->get_prenom(),
            "mdpHache"=> $this->get_mdpHache(),
            "estAdmin" => $this->estAdmin ? 1 : 0
        ];
    }

    public static function construireDepuisFormulaire (array $ligneFormatTableau) : Utilisateur {
        return new Utilisateur(
            $ligneFormatTableau["login"], 
            $ligneFormatTableau["nom"],
            $ligneFormatTableau["prenom"],
            MotDePasse::hacher($ligneFormatTableau["mdp"]),
            isset($ligneFormatTableau["estAdmin"])
        );
    }
}