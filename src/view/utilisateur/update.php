<form method="get" action=<?php __DIR__."/../web/frontController.php" ?>>
    <fieldset>
        <legend>Mon formulaire :</legend>
        <input type='hidden' name='action' value='updated'>
        <input type='hidden' name='controller' value='utilisateur'>
        <p>
            <label for="login_id">Login</label> :
            <input type="text" value=<?php echo htmlspecialchars($utilisateur->get_login()) ?> name="login" id="login_id" readonly/>
        </p>
        <p>
            <label for="nom_id">Nom</label> :
            <input type="text" value=<?php echo htmlspecialchars($utilisateur->get_nom()) ?> name="nom" id="nom_id" required/>
        </p>
        <p>
            <label for="prenom_id">Prénom</label> :
            <input type="text" value=<?php echo htmlspecialchars($utilisateur->get_prenom()) ?> name="prenom" id="prenom_id" required/>
        </p>
        <p>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>