<form method="get" action=<?php

use App\Covoiturage\Lib\ConnexionUtilisateur;

 __DIR__."/../web/frontController.php?action=updated&controller=utilisateur" ?>>
    <fieldset>
        <legend>Mon formulaire :</legend>
        <input type='hidden' name='action' value='updated'>
        <input type='hidden' name='controller' value='utilisateur'>
        <p class="InputAddOn">
            <label class="InputAddOn-item" for="login_id">Login :</label> 
            <input class="InputAddOn-field" type="text" value=<?= htmlspecialchars($utilisateur->get_login()) ?> name="login" id="login_id" readonly/>
        </p>
        <p class="InputAddOn">
            <label class="InputAddOn-item" for="nom_id">Nom :</label> 
            <input class="InputAddOn-field" type="text" value=<?= htmlspecialchars($utilisateur->get_nom()) ?> name="nom" id="nom_id" required/>
        </p>
        <p class="InputAddOn">
            <label class="InputAddOn-item" for="prenom_id">Prénom :</label> 
            <input class="InputAddOn-field" type="text" value=<?= htmlspecialchars($utilisateur->get_prenom()) ?> name="prenom" id="prenom_id" required/>
        </p>
        <p class="InputAddOn">
            <label class="InputAddOn-item" for="estAdmin_id">Administrateur</label>
            <input class="InputAddOn-field" type="checkbox" placeholder="" name="estAdmin" id="estAdmin_id" <?php if($utilisateur->get_estAdmin()) echo "checked" ?>>
        </p>
        <p class="InputAddOn">
            <label class="InputAddOn-item" for="ancien_mdp_id">Ancien mot de passe&#42; :</label>
            <input class="InputAddOn-field" type="password" value="" placeholder="" name="mdp" id="ancien_mdp_id" required>
        </p>
        <p class="InputAddOn">
            <label class="InputAddOn-item" for="mdp_id">Nouveau mot de passe&#42; :</label>
            <input class="InputAddOn-field" type="password" value="" placeholder="" name="new_mdp" id="mdp_id" required>
        </p>
        <p class="InputAddOn">
            <label class="InputAddOn-item" for="mdp2_id">Vérification du nouveau mot de passe&#42; :</label>
            <input class="InputAddOn-field" type="password" value="" placeholder="" name="new_mdp2" id="mdp2_id" required>
        </p>
        <p class="InputAddOn">
            <input class="InputAddOn-field" type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>