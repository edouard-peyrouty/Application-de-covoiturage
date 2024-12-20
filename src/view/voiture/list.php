<a href='frontController.php?controller=voiture&action=create'>
    <button>Ajouter une voiture</button>
</a>
<h2>Liste des voitures</h2>
<table>
    <thead>
        <tr>
            <th>Immatriculation</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($liste_voitures as $voiture){
                $immat = $voiture->getImmatriculation(); 
                $immatHTML = htmlspecialchars($immat); 
                $immatURL = rawurlencode($immat);
                echo "
                    <tr>
                        <td>
                            <a href='frontController.php?controller=voiture&action=read&immat=$immatURL'>
                                $immatHTML
                            </a>
                        </td>
                        <td>
                            <a href='frontController.php?controller=voiture&action=update&immat=$immatURL'>
                                Modifier
                            </a>
                        </td>
                        <td>
                            <a href='frontController.php?controller=voiture&action=delete&immat=$immatURL'>
                                Supprimer
                            </a>
                        </td>
                    </tr>
                ";
            }            
        ?>
    </tbody>
</table>