<?php
/*
	Type fichier : php
	Fonction : accueil superadmin
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
		<title>Accueil interface admin</title>
		<meta charset="utf-8">
		<?php
			include '../php/error.php';
			require '../php/connectcookie.php';
			require '../php/database.php';
		?>
	</head>
	<body>
		<?php
		require('../php/database.php');
		$pseudo = $_SESSION['pseudo'];
		$sql = "SELECT admin FROM utilisateur WHERE pseudo = '$pseudo'";
		$result = mysqli_query($con ,$sql);
		$row = mysqli_fetch_array($result);
		if($row['admin'] == 2)
		{?> 
			<a href="users.php"> Gestion des utilisateurs </a> <br>
			<a href="accueil.php"> Gestion de la page accueil (not available yet) </a> <br>
			<a href="sessions.php"> Gestion des sessions </a> <br>
			<a href="contact.php"> Gestion des erreurs </a> <br>
			<a href="news.php"> Gestion des actualités </a> <br>
			<a href="ajoutimage.php"> Gestion artistes et drapeaux </a> <br>
			<a href="salles.php"> Gestion des salles </a> <br>
			<a href="../index.php"> Quitter </a> <br>
		<?php
		}
		else
		{
			echo "accès non autorisé";
		}
		?>
	</body>
</html>