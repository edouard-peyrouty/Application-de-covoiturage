<?php

namespace App\Covoiturage\Model\Repository;

use App\Covoiturage\Model\DataObject\Utilisateur;

class UtilisateurRepository extends AbstractRepository {

    protected function getNomTable() : string {
        return "utilisateur";
    }

    protected function getNomClePrimaire(): string {
        return "login";
    }

    protected function getNomsColonnes(): array {
        return ["login", "nom", "prenom", "mdpHache", "estAdmin"];    
    }

    // renvoie un objet Utilisateur à partir d'un tableau contenant les valeurs des attributs
    public function construire(array $ligneFormatTableau) : Utilisateur {
        return new Utilisateur(
                                $ligneFormatTableau["login"], 
                                $ligneFormatTableau["nom"],
                                $ligneFormatTableau["prenom"],
                                $ligneFormatTableau["mdpHache"],
                                $ligneFormatTableau["estAdmin"]
                            );
    }    
}
