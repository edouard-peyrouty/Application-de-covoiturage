<form method="get" action=<?php __DIR__."/../web/frontController.php" ?>>
    <fieldset>
        <legend>Mon formulaire :</legend>
        <input type='hidden' name='action' value='updated'>
        <p class="InputAddOn">
            <label class="InputAddOn-item" for="immat_id">Immatriculation :</label> 
            <input class="InputAddOn-field" type="text" value=<?php echo htmlspecialchars($voiture->getImmatriculation()) ?> name="immatriculation" id="immat_id" readonly/>
        </p>
        <p class="InputAddOn">
            <label class="InputAddOn-item" for="marque_id">Marque :</label> 
            <input class="InputAddOn-field" type="text" value=<?php echo htmlspecialchars($voiture->getMarque()) ?> name="marque" id="marque_id" required/>
        </p>
        <p class="InputAddOn">
            <label class="InputAddOn-item" for="couleur_id">Couleur :</label> 
            <input class="InputAddOn-field" type="text" value=<?php echo htmlspecialchars($voiture->getCouleur()) ?> name="couleur" id="couleur_id" required/>
        </p>
        <p class="InputAddOn">
            <label class="InputAddOn-item" for="nbSieges_id">Nombre de Sièges :</label> 
            <input class="InputAddOn-field" type="number" value=<?php echo htmlspecialchars($voiture->getNbSieges()) ?> name="nbSieges" id="nbSieges_id" required/>
        </p>
        <p class="InputAddOn">
            <input class="InputAddOn-field" type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>