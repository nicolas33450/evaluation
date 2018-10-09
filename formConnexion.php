<?php
if (isset($_POST['valider']))
{
    $nom = $_POST['nom'];
    $mp = $_POST['mdp'];

    // on inclut les renseignements utiles pour la connexion à la base
    include 'connexion.php';

    $requete = $pdo->prepare("select nom, mdp from utilisateur where nom=:nom and mdp=:mp");

    // On convertit le mot de passe
    $pass = hash('sha256', $mp);


    // On exécute la requête (en passant les paramètres) et on récupère le
    // résultat (jeu d'enregistrement)
    $requete->execute(array(':nom'=>$nom, ':mp'=>$pass));

    if ($requete->rowCount()==0)
    {
        header('location: erreur.php ');
    }
    else
    {
        // Si le login et le mot de passe correspondent à un utilisateur
        session_start();// on démarre une session

        // On enregistre les variables login et password dans la session en cours 
        $ligne_tab = $requete ->fetch();
        $_SESSION['log']=$nom;
        $_SESSION['mdp']=$mp;

        // Redirection sur une page
        header('location: index.php'); 
    }

    // On vide le jeu d'enregistrements
    $result->closeCursor();
}
else
{
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">       
                
        <title>Connexion a la BDD</title>
        
    </head>
    
    <body>
    <?php
        include 'menu.php' 
        ?>
        <form action="formConnexion.php" method="post">
            <div class="container p-5">
                <div class="row">
                    <div class="col-12 text-center mb-4">
                        <img class="w-50" src="image/connex.jpg" alt="connexion">
                    </div>

                    <div class="col-12 col-md-4 ">
                        <label for="idn"> Nom : </label>
                    </div>
                    <div class="col-12 col-md-8">
                        <input class="form-control" type="text" name="nom" placeholder="Entrez votre nom" require/>
                    </div>

                    <div class="col-12 col-md-4">
                        <label for="idn"> Mot de passe : </label>
                    </div>
                    <div class="col-12 col-md-8 mt-2">
                        <input class="form-control" type="password" name="mdp" placeholder="Entrez votre mot de passe" require/>
                    </div>

                    <div class="col-12 mt-4">
                        <button class="send btn btn-warning w-100" type="submit" name="valider"> Connexion </button>
                    </div>                    
                </div>
            </div>
        </form>
        
        <?php
            }
        include 'footer.php';
        ?>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
    </body>
</html>

