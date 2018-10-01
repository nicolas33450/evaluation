<?php
session_start();
function afficheForm($nom = '')
{
?>
	<form action="rechercher_utilisateur.php" method="post">
		<div class="container">
			<div class="row">
					<div class="col-12 col-md-4 text-center">
						<label for="idnom">nom : </label>
					</div>
					<div class="col-12 col-md-8">
						<input class="form-control" type="text" id="idnom" name="nom" placeholder="nom" value="<?php echo  $nom; ?>" size="30" maxlength="40"/>
						<br />
					</div>					
					
				<input class="form-control btn btn-success w-100 mt-5" type="submit" value="Rechercher" name="rechercher" />
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
		<title>Les clients</title>		
		<link rel="stylesheet" href="css/evaluation.css">
	</head>

	<body>
		<?php
		include 'menu_admin.php';
		?>
		<div class="text-center"><img class="w-50 mb-5" src="image/planning.png" alt="planning"></div>
		<h1 class="text-center mb-5	planning"> Planning projets </h1>

		<?php
		
		// On vérifie si la page a reçue le bouton rechercher par la méthode POST (==> donc on a validé le formulaire)
		if(isset($_POST['rechercher']))		{

			// On récupère les données envoyées par la formulaire (dans des variables)
			
			$nom=trim($_POST['nom']);						

			// On ré-affiche le formulaire
			afficheForm($nom);
			
			if (!empty($nom))
			{				
				$nom = $_POST['nom'];				

				//Connexion à la base de données
				require 'connexion.php';

				$requete = $pdo->prepare("select nom, nom_projet, description, date_debut_projet, date_fin_projet, avancement
				from utilisateur, projet where utilisateur.id_utilisateur = projet.id_utilisateur and nom = :user");

				$requete->bindValue(':user', $nom);										

				//On exécute la requête
				$requete->execute();
				
				// On récupère le nombre de ligne dans le recordset
				$nb_ligne= $requete->rowCount();

				echo 'Nombre de ligne(s) : ' . $nb_ligne . '<br />';
				
				if ($nb_ligne != 0)
				{
				?>
					<div class="container mt-5">
						<table class="table">
							<thead class="table-info">
								<tr>
									<th scope="col"> Nom chef de projet </th>
									<th scope="col"> Nom du projet </th>	
									<th scope="col"> Description </th>	
									<th scope="col"> Date de début </th>	
									<th scope="col"> Date de fin </th>	
									<th scope="col"> Avancement </th>
									<th scope="col"> Modifier </th>										
							</thead>														
							
						<?php
						while($ligne_tab = $requete->fetch())
						{
							//$ligne_tab['date_debut_projet'] = date("d.m.y");
							//$ligne_tab['date_fin_projet'] = date("d.m.y");
						?>
						<tbody>
							<tr class="table-primary">
								<td><?= $ligne_tab['nom'] ?></td>
								<td><?= $ligne_tab['nom_projet'] ?></td>
								<td><?= $ligne_tab['description'] ?></td>
								<td><?= $ligne_tab['date_debut_projet']?></td>
								<td><?= $ligne_tab['date_fin_projet']?></td>
								<td>
									<div class="progress">
									<div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: <?= $ligne_tab['avancement'] ?>%" aria-valuenow="<?= $ligne_tab['avancement'] ?>" aria-valuemin="0" aria-valuemax="100"><?= $ligne_tab['avancement'] ?> %</div>
									</div>						
							   </td>
							   <td><a href="modif_projet.php"><button class="btn btn-warning"> Modifier </button></a></td>								
							</tr>
						</tbody>						
						<?php
						}
						
						// On vide le jeu d'enregistrements
						$requete->closeCursor();
						
						?>
						</table>	
					</div>
				<?php
				}
				else
				{
				?>
					<div class="container mt-5">
						<div class="row">
							<div class="col-12 text-center">
								Désolé aucun projet correspond à ce critère
							</div>
						</div>
					</div>
				<?php
				}
			}
			else
			{
				?>
				
				<div class="container mt-5">
						<div class="row">
							<div class="col-12 text-center">
								<h4> Veuillez remplir un des champs</h4>
							</div>
						</div>
					</div>
				<?php
			}
		}
		else
		{
			afficheForm();
		}	
		include 'footer.php';
		?>

		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
	</body>
</html>
