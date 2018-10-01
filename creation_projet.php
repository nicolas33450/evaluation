<?php
session_start();
function affiche_creation_projet($nom = '',$code = '', $description ='', $debut = '', $fin ='', $verif = false){
    ?>
<form action="creation_projet.php" method="post">
    
    <div class="container">
        <div class="row">
            
            <div class="col-12 mt-3 mb-3 text-center">
                <h2> Ajout Projet </h2>
            </div>

            <div class="col-12 col-md-3 pt-3 text-center">
                <label class="control" for="idn"> Nom du projet : </label>
            </div>   
            <div class="col-12 col-md-9 ">
                <input class="form-control mt-3" type="text" name="nom" id="idn" placeholder="nom"  value="<?= $nom ?>" require/>
            </div>

            <div class="col-12 col-md-3 pt-3 text-center">
                <label class="control" for="idcu"> code utilisateur : </label>
            </div>   
            <div class="col-12 col-md-9 ">
                <input class="form-control mt-3" type="text" name="code" id="idcu" placeholder="code utilisateur"  value="<?= $code ?>" require/>
            </div>
            
            <div class="col-12 col-md-3 pt-3 text-center">
                <label class="control" for="idd"> Description du projet : </label>
            </div>   
            <div class="col-12 col-md-9 ">
                <textarea class="form-control mt-3" type="text" name="description" id="idd" placeholder="description"  value="<?= $description ?>" require></textarea>
            </div>

            <div class="col-12 col-md-3 pt-3 text-center">
                <label class="control" for="iddebut"> Date de début : </label>
            </div>   
            <div class="col-12 col-md-3 ">
                <input class="form-control mt-3" type="date" name="date_de_debut" id="iddebut" placeholder="date_de_debut"  value="<?= $debut ?>" require/>
            </div>

            <div class="col-12 col-md-3 pt-3 text-center">
                <label class="control" for="idfin"> Date de fin : </label>
            </div>   
            <div class="col-12 col-md-3">
                <input class="form-control mt-3" type="date" name="date_de_fin" id="idfin" placeholder="date_de_fin"  value="<?= $fin ?>" require/>
            </div>

            <div class="col-12">
                <button class="btn btn-success mt-5 w-100" type="submit" name="enregistrer" value="enregistrer"> Enregistrer </button>
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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
        <link rel="stylesheet" href="css/formulaire-get.css">
        <title> Formulaire recup post </title>
    </head>
    
    <body>        
        
        <?php   
        include 'menu_admin.php';
         
        //on verifie que l'on a recu par la methode post une variable envoyer (bouton)
        if(isset($_POST['enregistrer']))
        {
            $n = strtoupper(trim($_POST['nom']));// strtoupper : majuscule du nom
            $c = trim($_POST['code']);
            $d = trim($_POST['description']); 
            $dd = trim($_POST['date_de_debut']); 
            $df = trim($_POST['date_de_fin']);           
            
            if(empty($n) || empty($c) || empty($d) || empty($dd) || empty($df)) //empty remplace le == ''
            {

                affiche_creation_projet($n, $c, $d, $dd, $df, true);

                if($n == '')
                {
                    echo 'veuillez saisir un nom de projet <br/>';
                }
                if($c == '')
                {
                    echo 'veuillez saisir un code utilisateur <br/>';
                }
                if($d == '')
                {
                    echo 'veuillez saisir une description <br/>';
                } 
                if($dd == '')
                {
                    echo 'veuillez saisir une date de début de projet <br/>';
                } 
                if($df == '')
                {
                    echo 'veuillez saisir une date de fin de projet <br/>';
                }                         
            }
            else
            { 
                  //Connexion à la base de données
                  include 'connexion.php';

                  $requete = $pdo->prepare("insert into projet(nom_projet, id_utilisateur, description, date_debut_projet, date_fin_projet, avancement)
                                            values(:nom,  :code, :description, :date_de_debut, :date_de_fin, :avancement)");
  
                  $requete->bindValue(':nom', $n);
                  $requete->bindValue(':code', $c);
                  $requete->bindValue(':description', $d);
                  $requete->bindValue(':date_de_debut', $dd);
                  $requete->bindValue(':date_de_fin', $df);
                  $requete->bindValue(':avancement', 0);
                  
                  //On exécute la requête
                  $requete->execute();  
                  
                  header('location: index.php');
            }
        }
        else
        { 
            affiche_creation_projet();
        }
        ?>  
        <?php
        include'footer.php';
        ?> 
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
    </body>
</html>
