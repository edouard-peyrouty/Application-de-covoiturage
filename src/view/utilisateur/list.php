<a href='frontController.php?controller=utilisateur&action=create'>
    <button>Ajouter un utilisateur</button>
</a>
<h2>Liste des utilisateurs</h2>
<table>
    <thead>
        <tr>
            <th>Login</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <?php
            //echo "";
            foreach ($liste_utilisateurs as $utilisateur){
                $loginHTML = htmlspecialchars($utilisateur->get_login()); 
                $loginURL = rawurlencode($utilisateur->get_login());
                echo "<tr>
                        <td>
                            <a href='frontController.php?controller=utilisateur&action=read&login=$loginURL'>
                                $loginHTML
                            </a>
                        </td>
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
                    </tr>";
            }            
        ?>
    </tbody>
</table>


