<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= $pagetitle ?></title>
        <link rel="stylesheet" href="/R3.01/TD8/assets/css/style.css">
    </head>
    
    <body>
        <header>
            <nav>
                <div class="icones">
                    <a href="frontController.php?action=formulairePreference" class="img">
                        <img src="../assets/img/coeur.png" alt="icone formulaire préféré"/>
                    </a>
                    <?php

                        use App\Covoiturage\Lib\ConnexionUtilisateur;

                        if(ConnexionUtilisateur::estConnecte()) {
                            $loginURL = urlencode(ConnexionUtilisateur::getLoginUtilisateurConnecte());
                            echo "   
                                <a href='frontController.php?controller=utilisateur&action=read&login=$loginURL' class='img'>
                                    <img src='../assets/img/user.webp' alt='icone user'/>
                                </a>
                                <a href='frontController.php?controller=utilisateur&action=deconnecter' class='img'>
                                    <img src='../assets/img/deconnexion.png' alt='icone déconnexion'/>
                                </a>
                            ";
                        } else {
                            echo "
                                <a href='frontController.php?action=formulaireConnexion&controller=utilisateur'>
                                    Se connecter
                                </a>
                            ";
                        } 
                    ?>
                </div>
                <div class="menu">
                    <a href="frontController.php?action=readAll&controller=voiture">
                        Afficher les voitures
                    </a>
                    <a href="frontController.php?action=readAll&controller=utilisateur">
                        Afficher les utilisateurs
                    </a>
                    <a href="frontController.php?action=readAll&controller=trajet">
                        Afficher les trajets
                    </a>
                </div>
            </nav>
            <?php
                if($messagesFlash) {
                    foreach($messagesFlash as $type => $liste_messages) {
                        foreach($liste_messages as $message) {
                            echo "
                                <div class='alert alert-$type'>
                                        $message
                                </div>
                            ";
                        }
                    }
                }
            ?>
        </header>
        
        <main>   
            <?php
                require __DIR__ . "/{$cheminVueBody}";
            ?>
        </main>
        
        <footer>
            <p>
                Site de covoiturage de Edouard Peyrouty
            </p>
        </footer>
    </body>
</html>