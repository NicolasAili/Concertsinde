
<?php
require('../php/database.php');

$action = $_POST['submit'];

switch ($action) {
	case 'ajouter':
		$type = $_POST['type'];
		$rubrique = $_POST['rubrique'];
		$titre = $_POST['titre'];
		$soustitre = $_POST['soustitre'];
		$contenu = $_POST['contenu'];
		$contenu = mysqli_real_escape_string($con, $contenu);

		$sql = "INSERT INTO actualites(type, date, rubrique, titre, soustitre, contenu) VALUES ('$type', NOW(), '$rubrique', '$titre', '$soustitre', '$contenu')";
		$query = mysqli_query($con ,$sql);

		$idactu = "SELECT MAX(id) AS id_max FROM actualites"; //on recupere l'ID le plus haut 
		$query = mysqli_query($con, $idactu);
		$row = mysqli_fetch_array($query);
		$idmax = $row['id_max'];

		$uploaddir = '../image/actualites/';
		$target_file = $uploaddir . basename($_FILES["userfile"]["name"]);
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$_FILES['userfile']['name']  = "news" . $idmax . "." . $imageFileType;

		$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

		echo '<pre>';
		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) 
		{
		    header("Location: saccueil.php");
		} 
		else 
		{
		    echo "Erreur dans la mise en ligne du fichier\n";
		    echo 'Infos de debug:';
			print_r($_FILES);
		}
		print "</pre>";
		break;
	case 'modifier':
		$idactu = $_POST['idactu'];

		$sql = "SELECT * FROM actualites WHERE id = $idactu";
		$query = mysqli_query($con ,$sql);
		$row = mysqli_fetch_array($query);
		?>
		<form method="POST" class="newsajout" action="newsajout.php">
			<h3> Type </h3>
				<select id="type" name="type"><?php
					echo '<option value="' . $row['type'] . '">' . $row['type'] . '</option>';?>
					<option value="site">site</option>
					<option value="scene">scene</option>
				</select>
				<h3> Rubrique </h3>
				<select id="rubrique" name="rubrique"><?php
				  echo '<option value="' . $row['rubrique'] . '">' . $row['rubrique'] . '</option>';?>
				  <option value="Mise à jour">Mise à jour</option>
				  <option value="Maintenance">Maintenance</option>
				  <option value="Actualité">Actualité</option>
				  <option value="Sondage">Sondage</option>
				  <option value="Clip">Clip</option>
				  <option value="Concert">Concert</option>
				  <option value="Festival">Festival</option>
				  <option value="Album">Album</option>
				  <option value="Tournée">Tournée</option>
				  <option value="Divers">Divers</option>
				  <option value="Information">Information</option>
				</select>
				<h3> Titre </h3>
				<input type="text" name="titre" <?php echo 'value = "' . $row['titre'] . '"';?>>
				<h3> Sous-titre </h3>
				<textarea cols="100" rows="3" name="soustitre" id="soustitre"><?php echo $row['soustitre']; ?></textarea>
				<h3> Contenu </h3>
				<textarea cols="150" rows="25" name="contenu" id="contenu"><?php echo $row['contenu']; ?></textarea>
				<br>
				<input type="hidden" name="idactu"<?php echo 'value = "' . $row['id'] . '"';?>>
				<input type="submit" name="submit" value="modifconfirm">
		</form><?php
		break;
	case 'modifconfirm':
		$idactu = $_POST['idactu'];
		$type = $_POST['type'];
		$rubrique = $_POST['rubrique'];
		$titre = $_POST['titre'];
		$soustitre = $_POST['soustitre'];
		$contenu = $_POST['contenu'];
		$contenu = mysqli_real_escape_string($con, $contenu);
		$sql = "UPDATE actualites SET type = '$type', rubrique = '$rubrique', titre = '$titre', soustitre = '$soustitre', contenu = '$contenu' WHERE id = '$idactu'";
		$query = mysqli_query($con ,$sql);
		header("Location: saccueil.php");
		break;
	case 'supprimer':
		$idactu = $_POST['idactu'];
		$sql = "DELETE FROM actualites WHERE id = $idactu";
		$query = mysqli_query($con ,$sql);
		header("Location: saccueil.php");
		break;
	
	default:
		echo "erreur inconnue\n";
		echo "<a href='saccueil.php'>retour accueil</a>";
		break;
}
?>

