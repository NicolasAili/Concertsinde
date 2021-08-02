<?php
require('../php/database.php');

$idcheckmodif = $_GET['idcheckmodif'];
$idcheck = $_POST['idcheck'];

if(!$idcheckmodif)
{
	$sql = "SELECT * FROM probleme WHERE id = '$idcheck'";
	$query = mysqli_query($con ,$sql);
	$row = mysqli_fetch_array($query);

	$sql = "UPDATE probleme SET lu = 1 WHERE id = '$idcheck'";
	$query = mysqli_query($con, $sql);

	$probleme = $row['probleme'];
	$ajout = $row['ajout'];
	$etapes = $row['etapes'];
	$userid = $row['utilisateur'];
	$mail = $row['mail'];
	$resolu = $row['resolu'];
	$commentaire = $row['commentaire'];

	echo $commentaire;

	$sql = "SELECT pseudo, email FROM utilisateur WHERE ID_user = '$userid'";
	$result = mysqli_query($con, $sql);
	$rowx = mysqli_fetch_array($result);
	$pseudo = $rowx['pseudo'];
	$email = $rowx['email'];

	echo "Utilisateur : "; ?> <a href="users.php?pseudoget=<?php echo $pseudo; ?>" > <?php echo $pseudo; ?> </a> <?php echo "<br>";
	echo "Email : "; echo $mail; echo $email; echo "<br>";
	echo "Date d'émission :"; echo $row['date_envoi']; echo "<br>";
	echo "Statut : "; if($row['resolu'] == 0){echo "non résolu";} else if($row['resolu'] == 1){echo "en attente";} else if($row['resolu'] == 2){echo "resolu";} echo "<br>";
	echo "Type : "; if($row['type'] == 1){echo "Probleme concert";} else if($row['type'] == 2){echo "Probleme site";} else if($row['type'] == 3){echo "Contact";} echo "<br>";
	echo "<br>";
	echo "<hr>";
	switch($row['type'])
	{
		case "1":
			echo "concert concerné : "; // à faire
			echo "<br>";
		?>
				<input type="checkbox" id="artiste" name="artiste" value="artiste" <?php if($row['artiste']){echo "checked";}?>>
				<label for="artiste">artiste</label>
				<input type="checkbox" id="date" name="date" value="date" <?php if($row['date']){echo "checked";}?>>
				<label for="date">date</label>
				<input type="checkbox" id="heure" name="heure" value="heure" <?php if($row['heure']){echo "checked";}?>>
				<label for="heure">heure</label>
				<input type="checkbox" id="salle" name="salle" value="salle/denomination" <?php if($row['salle']){echo "checked";}?>>
				<label for="salle">salle</label>
				<input type="checkbox" id="ville" name="ville" value="ville" <?php if($row['ville']){echo "checked";}?>>
				<label for="ville">ville</label>
				<input type="checkbox" id="cp" name="cp" value="code_postal" <?php if($row['cp']){echo "checked";}?>>
				<label for="cp">code_postal</label>
				<input type="checkbox" id="departement" name="departement" value="departement" <?php if($row['departement']){echo "checked";}?>>
				<label for="departement">departement</label>
				<input type="checkbox" id="region" name="region" value="region" <?php if($row['region']){echo "checked";}?>>
				<label for="region">region</label>
				<input type="checkbox" id="pays" name="pays" value="pays" <?php if($row['pays']){echo "checked";}?>>
				<label for="pays">pays</label>
				<input type="checkbox" id="adresse" name="adresse" value="adresse" <?php if($row['adresse']){echo "checked";}?>>
				<label for="adresse">adresse</label>
				<input type="checkbox" id="lien_fb" name="lien_fb" value="lien de l'evenement" <?php if($row['lien_fb']){echo "checked";}?>>
				<label for="lien_fb">lien de l'evenement</label>
				<input type="checkbox" id="lien_ticket" name="lien_ticket" value="lien vers la billetterie" <?php if($row['lien_ticket']){echo "checked";}?>>
				<label for="lien_ticket">lien vers la billetterie</label>
				<input type="checkbox" id="autre" name="autre" value="autre chose" <?php if($row['autre']){echo "checked";}?>>
				<label for="autre">autre</label>

				<p>
					<label for="probleme">Probleme</label><br />
					<textarea name="probleme" id="probleme" cols="40" rows="5"> <?php echo $probleme; ?> </textarea>
				</p>
				<?php 
				if($ajout)
				{?>
					<p>
						<label for="ajout">Autres infos</label><br />
						<textarea name="ajout" id="ajout" cols="40" rows="5"> <?php echo $ajout; ?></textarea>
					</p>
				<?php
				}
		break;

		case "2":
		?>
				<p>
					<label for="probleme">Probleme</label><br />
					<textarea name="probleme" id="probleme" cols="40" rows="5"> <?php echo $probleme; ?> </textarea>
				</p>
				<?php 
				if($etapes)
				{?>
					<p>
						<label for="ajout">Etapes</label><br />
						<textarea name="etapes" id="etapes" cols="40" rows="5"> <?php echo $etapes; ?></textarea>
					</p>
				<?php
				}
				if($ajout)
				{?>
					<p>
						<label for="ajout">Autres infos</label><br />
						<textarea name="ajout" id="ajout" cols="40" rows="5"> <?php echo $ajout; ?></textarea>
					</p>
				<?php
				}
		break;

		case "3":
		?>
			<p>
				<label for="probleme">Probleme</label><br />
				<textarea name="probleme" id="probleme" cols="40" rows="5"> <?php echo $probleme; ?> </textarea>
			</p>
		<?php
		break;
	}
	?>
	<br>
	<br>
	<hr>
	<h2> Mise à jour de la requête </h2>

	<form action="contactmodif.php" method="get">
		<label for="resolu"> Resolu : </label> 
		<input type="text" id="resolu" name="resolu" value="<?php echo $resolu;?>"> //0 = non résolu, 1 = en cours, 2 = résolu
		<br>
		<label for="commentaire"> commentaire : </label> 
		<textarea name="commentaire" id="commentaire" cols="40" rows="5"> <?php echo $commentaire; ?> </textarea>
		<input type="hidden" id="idcheckmodif" name="idcheckmodif" value="<?php echo $idcheck;?>">
		<br> 
		<input type="submit" value="Mise à jour">
	</form>
	<?php
}
else
{
	$commentaire = $_GET['commentaire'];
	$resolu = $_GET['resolu'];
	$sql = "UPDATE probleme SET commentaire = '$commentaire', resolu = '$resolu' WHERE id = '$idcheckmodif'";
	$query = mysqli_query($con, $sql);
	echo $commentaire;
	header("Location: ./contact.php");
}

