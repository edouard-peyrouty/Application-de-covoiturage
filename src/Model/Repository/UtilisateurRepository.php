<?php
    namespace App\Covoiturage\Model\Repository;

    use App\Covoiturage\Model\DataObject\Utilisateur;
    use App\Covoiturage\Model\Repository\DatabaseConnection;

    class UtilisateurRepository extends AbstractRepository {

        protected function getNomTable() : string {
            return "utilisateur";
        }

        protected function getNomClePrimaire(): string {
            return "login";
        }

        protected function getNomsColonnes(): array {
            return ["login", "nom", "prenom"];    
        }

        // renvoie un objet Utilisateur à partir d'un tableau contenant les valeurs des attributs
        public function construire(array $ligneFormatTableau) : Utilisateur {
            return new Utilisateur($ligneFormatTableau["login"], $ligneFormatTableau["nom"], $ligneFormatTableau["prenom"]);
        }    
    }

?>