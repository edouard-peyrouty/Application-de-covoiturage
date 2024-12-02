<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $pagetitle; ?></title>
        <link rel="stylesheet" href="/R3.01/TD6/assets/css/style.css">
    </head>
    
    <body>
        <header>
            <nav>
                <a href="frontController.php?action=readAll">
                    <button>Afficher les voitures</button>
                </a>
                <a href="frontController.php?action=readAll&controller=utilisateur">
                    <button>Afficher les utilisateurs</button>
                </a>
                <a href="frontController.php?action=readAll&controller=trajet">
                    <button>Afficher les trajets</button>
                </a>
            </nav>
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