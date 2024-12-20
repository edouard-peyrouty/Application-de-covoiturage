<?php
    $immatriculationHTML = htmlspecialchars($voiture->getImmatriculation());
    $marqueHTML = htmlspecialchars($voiture->getMarque());
    $couleurHTML = htmlspecialchars($voiture->getCouleur());
    $nbSiegesHTML = htmlspecialchars($voiture->getNbSieges());
    echo "<p>Voiture $immatriculationHTML de marque $marqueHTML (couleur $couleurHTML, 
        $nbSiegesHTML sieges) </p>"; 
        
    $immatURL = rawurlencode($voiture->getImmatriculation());
    echo "<a href='frontController.php?controller=voiture&action=update&immat=$immatURL'>
            <button>Modifier</button>
        </a>
        <a href='frontController.php?controller=voiture&action=delete&immat=$immatURL'>
            <button>Supprimer</button>
        </a>";
?>