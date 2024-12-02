<form method="get" action=<?php __DIR__."/../web/frontController.php" ?>>
    <fieldset>
        <legend>Mon formulaire :</legend>
        <input type='hidden' name='action' value='created'>
        <p>
            <label for="immat_id">Immatriculation</label> :
            <input type="text" placeholder="256AB34" name="immatriculation" id="immat_id" required/>
        </p>
        <p>
            <label for="marque_id">Marque</label> :
            <input type="text" placeholder="Audi" name="marque" id="marque_id" required/>
        </p>
        <p>
            <label for="couleur_id">Couleur</label> :
            <input type="text" placeholder="Noire" name="couleur" id="couleur_id" required/>
        </p>
        <p>
            <label for="nbSieges_id">Nombre de Sièges</label> :
            <input type="number" placeholder="5" name="nbSieges" id="nbSieges_id" required/>
        </p>
        <p>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>