<?php

function affiche_form($nom = '', $prenom = '',$mdp = '', $cmdp = '', $verif = false){
?>
<form action="formulaire-inscription.php" method="post">

    <div class="container">
        <div class="row">
            
            <div class="col-12 col-md-3 mt-5">
                <label for="idn"> Nom : </label>
            </div>
            <div class="col-12 col-md-9 mt-5">
                <input class="form-control m-2" type="text" name="nom" id="idn" placeholder="Nom"  value="<?= $nom ?>" require/>
            </div>

            <div class="col-12 col-md-3">
                <label for="idp"> Prenom : </label>
            </div>
            <div class="col-12 col-md-9">
                <input class="form-control m-2" type="text" name="prenom" id="idp" placeholder="Prenom" require value="<?= $prenom ?>">
            </div>

            <div class="col-12 col-md-3">
                <label for="idl"> Mot de passe : </label>
            </div>           
            <div class="col-12 col-md-9">
                <input class="form-control m-2" type="password" name="mdp" id="idmdp" placeholder="mdp" require value="<?= $mdp ?>">
            </div>
            
            <div class="col-12 col-md-3">
                <label for="idcmdp"> Confirmation mot de passe : </label>
            </div>           
            <div class="col-12 col-md-9">
                <input class="form-control m-2" type="password" name="cmdp" id="idcmdp" placeholder="mdp" require value="<?= $cmdp ?>">
            </div> 

            <div class="col-12">
                <button class="btn btn-success mt-5 w-100" type="submit" name="envoyer" value="Envoyer"> Inscription </button>
            </div>
        </div>
    </div>
</form>
<?php                                                                 
 }
?>    

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">       
        <link rel="stylesheet" href="css/formulaire-get.css">
        <title> Formulaire recup post </title>
    </head>

    <body>

        <?php      
        include'menu.php';
        //on verifie que l'on a recu par la methode post une variable envoyer (bouton)
        if(isset($_POST['envoyer']))
        {
            $n = strtoupper(trim($_POST['nom']));// strtoupper : majuscule du nom
            $p = ucfirst(trim($_POST['prenom']));// trim enleve les espaces avant et apres le nom// ucfirst: premire lettre en maj             
            $m = trim($_POST['mdp']);
            $cmdp = trim($_POST['cmdp']);          
            
            if(empty($n) || empty($p) || empty($m) || empty($cmdp)) //empty remplace le == ''
            {
                affiche_form($n, $p, $m, true);

                if($n == '')
                {
                    echo 'veuillez saisir votre nom <br/>';
                }
                if($p == '')
                {
                    echo 'veuillez saisir votre prenom <br/>';
                }               
                if($m == '')
                {
                    echo 'veuillez saisir votre mot de passe <br/>';
                } 
                if($cmdp == '')
                {
                    echo 'veuillez confirmer votre mot de passe <br/>';
                }          
            }           
            if($_POST['mdp'] == $_POST['cmdp'])
            { 
                  //Connexion à la base de données
                  include 'connexion.php';
                  
                  $pw =  hash('sha256', $m);               
                  $requete = $pdo->prepare("insert into utilisateur(nom, prenom, mdp) values(:nom, :prenom, :mdp)");
  
                  $requete->bindValue(':nom', $n);
                  $requete->bindValue(':prenom', $p);
                  $requete->bindValue(':mdp', $pw);

                  //On exécute la requête
                  $requete->execute();    
                  
                  header('location: index.php');
                }
            }
            else
            { 
                affiche_form();
            }        
        include 'footer.php';
        ?>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
    </body>
</html>
