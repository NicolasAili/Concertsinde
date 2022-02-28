<?php
/*
	Type fichier : php
	Fonction : affiche un probleme en particulier
	Emplacement : superadmin
	Connexion à la BDD :  oui
	Contenu HTML : oui
	JS+JQuery : non
	CSS : non
*/
?>
<?php

include 'php/error.php';
require 'php/connectcookie.php';
include 'php/base.php';
include 'php/css.php';
include 'php/js.php';
require 'php/database.php';
include 'contenu/reseaux.php';

$idcheckmodif = $_POST['idcheckmodif']; //var pour vérifier une modification
$idcheck = $_GET['idcheck']; //requête à afficher
$idchecklink = $_GET['idchecklink']; //var qui récupère l'id de la requête après une modification
if($idchecklink)
{
	$idcheckmodif = NULL;
	$idcheck = $idchecklink;
}

require ('php/inject.php'); //0) ajouter inject et définir redirect
$redirect = 'support.php';

$inject = array(); 
$returnval = inject($idcheckmodif, 'identifier'); //2.1) vérifier les champs avec des regex spéciaux : 'url' 'text' ou 'num'
if (!is_null($returnval)) 
{
  array_push($inject, $returnval); //2.2)ajouter les erreurs si injection détectée
}
$returnval = inject($idcheck, 'identifier'); //2.1) vérifier les champs avec des regex spéciaux : 'url' 'text' ou 'num'
if (!is_null($returnval)) 
{
  array_push($inject, $returnval); //2.2)ajouter les erreurs si injection détectée
}
$returnval = inject($idchecklink, 'identifier'); //2.1) vérifier les champs avec des regex spéciaux : 'url' 'text' ou 'num'
if (!is_null($returnval)) 
{
  array_push($inject, $returnval); //2.2)ajouter les erreurs si injection détectée
}
$validate = validate($inject, $redirect); //3)validation de tous les champs
if($validate == 0) //4) si pas d'injection : ajout des variables
{
  $idcheckmodif = mysqli_real_escape_string($con, $idcheckmodif); 
  $idcheck = mysqli_real_escape_string($con, $idcheck); 
  $idchecklink = mysqli_real_escape_string($con, $idchecklink); 
}

if($idcheckmodif) //s'il y a eu modification
{
	$probleme = $_POST['probleme'];
	$sql = "UPDATE probleme SET probleme = '$probleme', edited = '1', Date_edit = NOW() WHERE id = '$idcheckmodif'";
	$query = mysqli_query($con, $sql);
	header("Location: ./supportshow.php?idchecklink=$idcheckmodif");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/body/supportshow.css">
	</head>
	<header>
		<?php include('contenu/header.php'); ?>
	</header>
	<body>
		<div id="content">
			<?php

			if(!$idcheckmodif)
			{
				$sql = "SELECT * FROM probleme WHERE id = '$idcheck'";
				$query = mysqli_query($con ,$sql);
				$row = mysqli_fetch_array($query);

				$probleme = $row['probleme'];
				$sujet = $row['sujet'];
				$resolu = $row['resolu'];
				$concert = $row['id_concert'];

				$newDate = date("d-m-Y", strtotime($row['date_envoi']));?>

				<div id="statut"><?php
					echo "<div class='title'> ID du ticket </div>"; echo '#' . $row['id'];
					echo "<div class='title'> Date de création </div>"; echo $newDate;
					echo "<div class='title'> Statut </div>"; if($row['resolu'] == 0){echo "non résolu";} else if($row['resolu'] == 1){echo "en cours de résolution";} else if($row['resolu'] == 2){echo "resolu";}
					echo "<div class='title'> Type </div>"; if($row['type'] == 1){echo "Probleme concert";} else if($row['type'] == 2){echo "Probleme site";} else if($row['type'] == 3){echo "Contact";}?>
				</div>
				<div id="main">
					<a href="support.php"> ⬅ Retour vers mes demandes</a>
					<?php
					switch($row['type'])
					{
						case "1":
							?>

							<h3>Champ(s) concerné(s)</h3>
							<input type="checkbox" id="artiste" name="artiste" value="artiste" <?php if($row['artiste']){echo "checked";}?> disabled>
							<label for="artiste">artiste</label>
							<input type="checkbox" id="date" name="date" value="date" <?php if($row['date']){echo "checked";}?>disabled>
							<label for="date">date</label>
							<input type="checkbox" id="heure" name="heure" value="heure" <?php if($row['heure']){echo "checked";}?>disabled>
							<label for="heure">heure</label>
							<input type="checkbox" id="salle" name="salle" value="salle/denomination" <?php if($row['salle']){echo "checked";}?>disabled>
							<label for="salle">salle</label>
							<input type="checkbox" id="ville" name="ville" value="ville" <?php if($row['ville']){echo "checked";}?>disabled>
							<label for="ville">ville</label>
							<input type="checkbox" id="cp" name="cp" value="code_postal" <?php if($row['cp']){echo "checked";}?>disabled>
							<label for="cp">code_postal</label>
							<input type="checkbox" id="departement" name="departement" value="departement" <?php if($row['departement']){echo "checked";}?>disabled>
							<label for="departement">departement</label>
							<input type="checkbox" id="region" name="region" value="region" <?php if($row['region']){echo "checked";}?>disabled>
							<label for="region">region</label>
							<input type="checkbox" id="pays" name="pays" value="pays" <?php if($row['pays']){echo "checked";}?>disabled>
							<label for="pays">pays</label>
							<input type="checkbox" id="adresse" name="adresse" value="adresse" <?php if($row['adresse']){echo "checked";}?>disabled>
							<label for="adresse">adresse</label>
							<input type="checkbox" id="lien_fb" name="lien_fb" value="lien de l'evenement" <?php if($row['lien_fb']){echo "checked";}?>disabled>
							<label for="lien_fb">lien de l'evenement</label>
							<input type="checkbox" id="lien_ticket" name="lien_ticket" value="lien vers la billetterie" <?php if($row['lien_ticket']){echo "checked";}?>disabled>
							<label for="lien_ticket">lien vers la billetterie</label>
							<input type="checkbox" id="autre" name="autre" value="autre chose" <?php if($row['autre']){echo "checked";}?>disabled>
							<label for="autre">autre</label>
						<?php
						break;
					}?>
					<p>
						<h2> <?php echo $row['sujet'];?> </h2>
					</p>
					<form method="post" id="connect" action="supportshow.php">
						<div id="pb">
							<?php echo $probleme; ?>
						</div>
						<input type="hidden" id="idcheckmodif" name="idcheckmodif" value="<?php echo $idcheck;?>">
						<div id="confirm">
							<textarea cols="40" rows="5" name="probleme" id="probleme"><?php echo $probleme; ?></textarea>
							<div id="foot">
								<input type="submit" name="submit" id="submit" value="Modifier">
								<button type="button" id="button"> Annuler </button>
							</div>	
						</div>
						<button type="button" id="edit"> Editer </button>
					</form>
				</div>
				<?php
				if($concert)
				{?>
					<div id="infosconcert"><?php
						$sql = "SELECT nom_artiste, datec, nom_salle, nom_ext FROM concert, salle WHERE id_concert = '$concert' AND salle.id_salle = concert.fksalle";
						$result = mysqli_query($con, $sql);
						$rowc = mysqli_fetch_array($result);
						$artiste = $rowc['nom_artiste'];
						$datec = $rowc['datec'];
						$datec = date("d-m-Y", strtotime($rowc['datec']));
						echo "<div id='concon'> Concert concerné </div>"; 
						echo "<div class='title'> Artiste </div>";
						echo $artiste;
						echo "<div class='title'> Date </div>";
						echo $datec; 
						echo "<div class='title'> Lieu </div>";
						echo $rowc['nom_salle']; 
						echo $rowc['nom_ext'];?>
					</div><?php
				}
			}
			?>

		</div>
		<?php include('contenu/scrolltop.html'); ?>
		<?php include('contenu/footer.html'); ?>
	</body>
</html>


