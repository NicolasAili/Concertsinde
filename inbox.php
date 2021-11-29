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