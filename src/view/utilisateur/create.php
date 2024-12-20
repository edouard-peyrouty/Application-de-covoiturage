<form method="get" action=<?php __DIR__."/../web/frontController.php" ?>>
    <fieldset>
        <legend>Mon formulaire :</legend>
        <input type='hidden' name='action' value='created'>
        <input type='hidden' name='controller' value='utilisateur'>
        <p class="InputAddOn">
            <label class="InputAddOn-item" for="login_id">Login&#42; :</label> 
            <input class="InputAddOn-field" type="text" placeholder="prenom.nom" name="login" id="login_id" required/>
        </p>
        <p class="InputAddOn">
            <label class="InputAddOn-item" for="nom_id">Nom :</label>
            <input class="InputAddOn-field" type="text" placeholder="nom" name="nom" id="nom_id"/>
        </p>
        <p class="InputAddOn">
            <label class="InputAddOn-item" for="prenom_id">Prénom :</label> 
            <input class="InputAddOn-field" type="text" placeholder="prénom" name="prenom" id="prenom_id"/>
        </p>
        <?php 
            use App\Covoiturage\Lib\ConnexionUtilisateur;
            if(ConnexionUtilisateur::estAdministrateur()) {
                echo '
                    <p class="InputAddOn">
                        <label class="InputAddOn-item" for="estAdmin_id">Administrateur</label>
                        <input class="InputAddOn-field" type="checkbox" placeholder="" name="estAdmin" id="estAdmin_id">
                    </p>
                ';
            }
        ?>
        <p class="InputAddOn">
            <label class="InputAddOn-item" for="mdp_id">Mot de passe&#42; :</label>
            <input class="InputAddOn-field" type="password" value="" placeholder="" name="mdp" id="mdp_id" required>
        </p>
        <p class="InputAddOn">
            <label class="InputAddOn-item" for="mdp2_id">Vérification du mot de passe&#42; :</label>
            <input class="InputAddOn-field" type="password" value="" placeholder="" name="mdp2" id="mdp2_id" required>
        </p>
        <p class="InputAddOn">
            <input class="InputAddOn-field" type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>