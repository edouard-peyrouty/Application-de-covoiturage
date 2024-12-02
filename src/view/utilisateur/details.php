<?php
    $nomHTML = htmlspecialchars($utilisateur->get_nom());
    $prenomHTML = htmlspecialchars($utilisateur->get_prenom());
    $loginHTML = htmlspecialchars($utilisateur->get_login()); 
    echo "<p>Le login de l'utilisateur $prenomHTML $nomHTML est : $loginHTML.</p>";
    
    $loginURL = rawurlencode($utilisateur->get_login());
    echo "<a href='frontController.php?controller=utilisateur&action=update&login=$loginURL'>
            <button>Modifier</button>
        </a>
        <a href='frontController.php?controller=utilisateur&action=delete&login=$loginURL'>
            <button>Supprimer</button>
        </a>";
?>