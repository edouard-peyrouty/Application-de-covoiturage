<?php

use App\Covoiturage\Lib\ConnexionUtilisateur;

    $nomHTML = htmlspecialchars($utilisateur->get_nom());
    $prenomHTML = htmlspecialchars($utilisateur->get_prenom());
    $login = $utilisateur->get_login();
    $loginHTML = htmlspecialchars($login); 
    echo "<p>Le login de l'utilisateur $prenomHTML $nomHTML est : $loginHTML.</p>";
    
    if(ConnexionUtilisateur::estUtilisateur($login)) {
        $loginURL = rawurlencode($login);
        echo "
            <a href='frontController.php?controller=utilisateur&action=update&login=$loginURL'>
                <button>Modifier</button>
            </a>
            <a href='frontController.php?controller=utilisateur&action=delete&login=$loginURL'>
                <button>Supprimer</button>
            </a>
        ";
    }
?>