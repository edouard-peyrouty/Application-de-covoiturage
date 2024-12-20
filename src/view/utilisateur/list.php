<a href='frontController.php?controller=utilisateur&action=create'>
    <button>Ajouter un utilisateur</button>
</a>
<h2>Liste des utilisateurs</h2>
<table>
    <thead>
        <tr>
            <th>Login</th>
            <?php
                use App\Covoiturage\Lib\ConnexionUtilisateur;
                if(ConnexionUtilisateur::estAdministrateur()) {
                    echo "   
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    ";
                }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($liste_utilisateurs as $utilisateur){
                $loginHTML = htmlspecialchars($utilisateur->get_login()); 
                $loginURL = rawurlencode($utilisateur->get_login());
                echo "
                    <tr>
                        <td>
                            <a href='frontController.php?controller=utilisateur&action=read&login=$loginURL'>
                                $loginHTML
                            </a>
                        </td>
                ";
                if(ConnexionUtilisateur::estAdministrateur()) {
                    echo "
                        <td>
                            <a href='frontController.php?controller=utilisateur&action=update&login=$loginURL'>
                                Modifier
                            </a>
                        </td>
                        <td>
                            <a href='frontController.php?controller=utilisateur&action=delete&login=$loginURL'>
                                Supprimer
                            </a>
                        </td>
                    ";
                }
                echo "</tr>";
            }            
        ?>
    </tbody>
</table>