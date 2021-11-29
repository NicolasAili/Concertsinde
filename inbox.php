<?php
/*
	Type fichier : php
	Fonction : page profil
	Emplacement : /
	Connexion à la BDD :  oui
	Contenu HTML : oui
	JS+JQuery : non
	CSS : oui
*/
?>

<!DOCTYPE html>
<?php
    session_start();
?>
<html lang="fr">
	<head>
		<?php
			include 'php/base.php'; 
			include 'php/css.php'; 
			include 'contenu/reseaux.php';

			require('php/database.php');
		?>
		<link rel="stylesheet" type="text/css" href="css/body/inbox.css">
	</head>
</html>
<?php 
		    $pseudo = $_SESSION['pseudo'];
			$requestpseudo = "SELECT id_user FROM utilisateur WHERE pseudo = '$pseudo'";
			$query = mysqli_query($con, $requestpseudo);
			$row = mysqli_fetch_array($query);
			$idpseudo = $row['id_user'];
$sql = "SELECT message, id FROM message WHERE utilisateur = '$idpseudo' ORDER BY date_envoi DESC";
				$query = mysqli_query($con, $sql);

				while ($row = mysqli_fetch_array($query)) 
				{
					$id = $row['id'];
					echo $count;
					echo " : ";
					echo $row['message'];
					echo "<br>";
					$count++;
					$sql = "UPDATE message SET lu = 1 WHERE id = '$id'";
					$querylu = mysqli_query($con, $sql);
				}

/* 
1) empêcher l'accès à cette page si non connecté
2) sélectionner tous les topics avec pour receiver le current session
3) faire des forms get sur chaque topic pour arriver sur la page messages
4) récupếrer l'id du topic et les messages associés
5) champ pour ajouter un message au topic
6) création de topic depuis l'interface d'admin (insert into msg ctrl f)
*/