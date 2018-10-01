<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Connexion </title>
    </head>
    <body>
        <?php

        

        //define = constante//
        define('HOTE','localhost');	// Mettre le nom d'hôte fourni par l'hébergeur
        define('BDD','evaluation');	// Mettre le nom de la base de données fourni par l'hébergeur
        define('UTIL','root');	// Mettre le nom de l'utilisateur de la base de données fourni par l'hébergeur
        define('MDP','');	// Mettre le mot de passe

        try 
        {
            $pdo = new PDO('mysql:host=' . HOTE . ';dbname=' . BDD , UTIL, MDP);
            // On définit le codage en utf8
            $pdo->exec("set character set utf8");
            // On configure PDO pour qu’il nous renvoie les erreurs dans les requêtes
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }

        catch (PDOException $e)
        {
            echo 'La connexion a échouée : ' . $e->getMessage();
            exit(1);
        }
        ?>
    </body>
</html>
