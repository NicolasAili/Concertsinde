<?php
/*
	Type fichier : php
	Fonction : affichage des sessions
	Emplacement : superadmin
	Connexion à la BDD : oui
	Contenu HTML : oui
	JS+JQuery : non
	CSS : non
*/
    session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Gestion des sessions</title>
		<meta charset="utf-8">
		<?php
			include '../php/error.php';
			require '../php/connectcookie.php';
			require '../php/database.php';
		?>
	</head>
	<body>
		<?php
		$pseudo = $_SESSION['pseudo'];
		$sql = "SELECT admin FROM utilisateur WHERE pseudo = '$pseudo'";
		$result = mysqli_query($con ,$sql);
		$row = mysqli_fetch_array($result);
		if($row['admin'] == 2)
		{
			$sql = "SELECT id, date_debut, date_fin, actif FROM session ORDER BY id DESC";
			$query = mysqli_query($con, $sql);
			?>
			<a href="saccueil.php">retour accueil</a>
			<br>
			<h2> Ajouter une session </h2>
			<br>
			<form method="post" id="connect" action="sessionmodif.php">
				<input type="date" name="date_debut" placeholder="Saisir debut session " id="date_debut" required>
				<input type="date" name="date_fin" placeholder="Saisir fin session " id="date_fin" required>
				<input type="submit" value="ajout_session" class="ajout_session" name="modsuppr" href="">
			</form>
			<br>
			<br>
			<br>
			<table>
	    		<caption>Sessions</caption>
	    		<tr>
	    		<th scope="col">Num</th>
		        <th scope="col">Du</th>
		        <th scope="col">Au</th>
		        <th scope="col">Actif</th>
   				</tr><?php
   				while($row = mysqli_fetch_array($query))
				{
					$newDatedebut = date("d-m-Y", strtotime($row['date_debut']));
					$newDatefin = date("d-m-Y", strtotime($row['date_fin']));
					?>
					<form method="post" id="connect" action="sessionmodif.php">
						<tr>
					        <th scope="row"><?php echo $row['id']; ?></th>
					        <td><?php echo  $newDatedebut; ?> </td>
					        <td><?php echo  $newDatefin; ?> </td>
					        <td><input type="checkbox" class="actif" name="actif" <?php if($row['actif'] == 1){echo "checked "; echo "disabled";} else{echo "required";} ?> > </td>
					        <input type="hidden" class="idcheck" name="idcheck" <?php echo 'value="' . $row['id'] . '"' ?> >
					        <?php if($row['actif'] == 0){?><td><input type="submit" value="valider" class="valider" name="modsuppr" href=""></td><?php } ?>
		    			</tr>
		    		</form>
	    		<?php
				}
				?>
			</table><?php
		}
		else
		{
			echo "accès non autorisé";
		}
		?>
	</body>
</html>
