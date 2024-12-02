<?php
    echo "<a href='frontController.php?action=create'><button>Ajouter une voiture</button></a>";
    foreach ($voitures as $voiture){
        $immatHTML = htmlspecialchars($voiture->getImmatriculation()); 
        $immatURL = rawurlencode($voiture->getImmatriculation());
        echo "
            <p> 
                Voiture d\'immatriculation 
                <a href='frontController.php?action=read&immat=$immatURL'>
                    $immatHTML
                </a>
                <a href='frontController.php?action=update&immat=$immatURL'>
                    Modifier
                </a>
                <a href='frontController.php?action=delete&immat=$immatURL'>
                    Supprimer
                </a>
            </p>
        ";
    }            
?>