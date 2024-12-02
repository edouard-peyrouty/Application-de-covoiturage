<?php
    namespace App\Covoiturage\Model\DataObject;
    
    class Utilisateur extends AbstractDataObject {

        // attributs
        private string $login;
        private string $nom;
        private string $prenom;

        // constructeur
        public function __construct(string $login, string $nom, string $prenom) {
            $this->login = $login;
            $this->nom = $nom;
            $this->prenom = $prenom;
        }

        // getters
        public function get_login(): string {return $this->login;}
        public function get_nom(): string {return $this->nom;}
        public function get_prenom(): string {return $this->prenom;}

        // setters
        public function set_login(string $login) {$this->login = $login;}
        public function set_nom(string $nom) {$this->nom = $nom;}
        public function set_prenom(string $prenom) {$this->prenom = $prenom;}

        public function formatTableau(): array {
            return [
                "login" => $this->get_login(), 
                "nom" => $this->get_nom(),
                "prenom" => $this->get_prenom()
            ];
        }
    }
?>