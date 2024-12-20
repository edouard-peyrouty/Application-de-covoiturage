<form method="get" action=<?php __DIR__."/../web/frontController.php" ?>>
    <fieldset>
        <legend>Mon formulaire :</legend>
        <p class="InputAddOn">
            <input type='hidden' name='action' value='enregistrerPreference'>
            <label class="InputAddOn-item" for="voitureId">Voiture</label>
            <input class="InputAddOn-field" type="radio" id="voitureId" name="controleur_defaut" value="voiture" <?php if($controleur_defaut == "voiture") echo "checked" ?>>
            <label class="InputAddOn-item" for="utilisateurId">Utilisateur</label>
            <input class="InputAddOn-field" type="radio" id="utilisateurId" name="controleur_defaut" value="utilisateur" <?php if($controleur_defaut == "utilisateur") echo "checked" ?>>
            <label class="InputAddOn-item" for="trajetId">Trajet</label>
            <input class="InputAddOn-field" type="radio" id="trajetId" name="controleur_defaut" value="trajet" <?php if($controleur_defaut == "trajet") echo "checked" ?>>
        </p>
        <p>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>