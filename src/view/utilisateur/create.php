<form method="get" action=<?php __DIR__."/../web/frontController.php" ?>>
    <fieldset>
        <legend>Mon formulaire :</legend>
        <input type='hidden' name='action' value='created'>
        <input type='hidden' name='controller' value='utilisateur'>
        <p>
            <label for="login_id">Login</label> :
            <input type="text" placeholder="prenom.nom" name="login" id="login_id" required/>
        </p>
        <p>
            <label for="nom_id">Nom</label> :
            <input type="text" placeholder="nom" name="nom" id="nom_id" required/>
        </p>
        <p>
            <label for="prenom_id">Prénom</label> :
            <input type="text" placeholder="prénom" name="prenom" id="prenom_id" required/>
        </p>
        <p>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>