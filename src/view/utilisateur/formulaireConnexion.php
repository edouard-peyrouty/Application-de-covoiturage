<form method="get" action=<?php __DIR__."/../web/frontController.php" ?>>
    <fieldset>
        <legend>Mon formulaire :</legend>
        <input type='hidden' name='action' value='connecter'>
        <input type='hidden' name='controller' value='utilisateur'>
        <p class="InputAddOn">
            <label class="InputAddOn-item" for="login_id">Login&#42; :</label> 
            <input class="InputAddOn-field" type="text" placeholder="login" name="login" id="login_id" required/>
        </p>
        <p class="InputAddOn">
            <label class="InputAddOn-item" for="mdp_id">Mot de passe&#42; :</label>
            <input class="InputAddOn-field" type="password" value="" placeholder="password" name="mdp" id="mdp_id" required>
        </p>
        <p class="InputAddOn">
            <input class="InputAddOn-field" type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>